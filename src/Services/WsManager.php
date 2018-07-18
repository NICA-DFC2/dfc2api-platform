<?php

namespace App\Services;

use App\Entity\User;
use App\Services\Filter\WsFilter;
use App\Services\Objets\CntxAdmin;
use App\Services\Request\CallerService;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;

use App\Services\Objets\TTParam;
use App\Services\Objets\CritParam;
use App\Services\Objets\Notif;
use App\Services\Json\ResponseDecode;
use App\Services\Parameters\WsParameters;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsTypeContext;

use Unirest;

class WsManager
{
    /* #################################################
     *
     * PROPERTIES OF CLASS [PRIVATE OR PROTECTED]
     *
     ################################################# */
    private $cache_key_admin = 'dfc2.api.contexte.admin';

    protected $wsAdminUser;
    protected $wsAdminPassword;
    protected $publicKeyObject;
    protected $cache;
    protected $user;
    protected $filter;
    protected $caller = null;


    /* #################################################
     *
     * CONSTRUCTOR
     *
     ################################################# */

    public function __construct(string $wsAdminUser, string $wsAdminPassword) {
        $this->setWsAdminUser($wsAdminUser);
        $this->setWsAdminPassword($wsAdminPassword);
        $this->setCache(new FilesystemCache());
        $this->caller = new CallerService();
    }


    /* #################################################
     *
     * GETTERS // SETTERS
     *
     ################################################# */

    /**
     * @return CallerService|null
     */
    public function getCaller(): ?CallerService
    {
        return $this->caller;
    }


    /**
     * @return string
     */
    public function getWsAdminUser()
    {
        return $this->wsAdminUser;
    }

    /**
     * @param string $wsAdminUser
     */
    public function setWsAdminUser(string $wsAdminUser)
    {
        $this->wsAdminUser = $wsAdminUser;
    }

    /**
     * @return string
     */
    public function getWsAdminPassword()
    {
        return $this->wsAdminPassword;
    }

    /**
     * @param string $wsAdminPassword
     */
    public function setWsAdminPassword(string $wsAdminPassword)
    {
        $this->wsAdminPassword = $wsAdminPassword;
    }

    /**
     * @return FilesystemCache
     */
    public function getCache(): FilesystemCache
    {
        return $this->cache;
    }

    /**
     * @param FilesystemCache $cache
     */
    public function setCache(FilesystemCache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    private function getFilter()
    {
        $filter = new WsFilter($this->filter);
        return $filter->getCritSel();
    }

    /**
     * @param $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return User
     */
    private function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return ResponseDecode
     */
    private function getPublicKeyObject()
    {
        return $this->publicKeyObject;
    }

    /**
     * @param ResponseDecode $object
     */
    private function setPublicKeyObject(ResponseDecode $object)
    {
        $this->publicKeyObject = $object;
    }



    /* #################################################
     *
     * MANAGE WS CONNEXION
     *
     ################################################# */

        /**
         * @param string $algorithme
         * @return mixed
         * @throws
         */
        public function getDemarre($algorithme = WsAlgorithmOpenSSL::NONE) {
            $this->getPublicKey();

            if($this->getCache()->has($this->cache_key_admin)) {
                $cntxAdmin =  new Objets\CntxAdmin();
                $cntxAdmin->__parse($this->getCache()->get($this->cache_key_admin));
                if($cntxAdmin->isValid()) {
                    return $cntxAdmin;
                }
            }

            $publicKeyNumber = $this->getValPublicKeyNumber();

            $TTparam = new TTParam();
            $TTparam->addItem(new CritParam('Login', (!is_null($this->wsAdminUser)) ? $this->encryptByOpenSSL($this->wsAdminUser, $algorithme) : ''));
            $TTparam->addItem(new CritParam('MotDePasse', (!is_null($this->wsAdminPassword)) ? $this->encryptByOpenSSL($this->wsAdminPassword, $algorithme) : ''));
            $TTparam->addItem(new CritParam('Algorithme', $algorithme));
            $TTparam->addItem(new CritParam('NumClePublique', $publicKeyNumber));


            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_DEMARRE)
                ->setParamsAppel($TTparam)
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            $context = $responseDecode->decodeCntxAdmin();
            if ($context instanceof CntxAdmin) {
                // met en cache le contexte de connexion
                $this->getCache()->set($this->cache_key_admin, $context->__toValsString());
            }

            return $context;
        }

        /**
         * @param $value : valeur à crypter
         * @param $algorithme : RSASSA-PKCS1-v1_5 or RSAES-OAEP or NONE (default)
         * @return string en base64
         */
        private function encryptByOpenSSL($value, $algorithme = WsAlgorithmOpenSSL::NONE) {

            if ($value === '') {
                return $value;
            }

            if($this->getValPublicKey() === "") {
                return new \Exception('The public key is empty !');
            }
            else if($algorithme === WsAlgorithmOpenSSL::RSASSA_PKCS1_v1_5 || $algorithme === WsAlgorithmOpenSSL::RSAES_OAEP) {
                $pubKey = openssl_pkey_get_public($this->getValPublicKey());

                switch($algorithme) {
                    case WsAlgorithmOpenSSL::RSASSA_PKCS1_v1_5:
                        try {
                            openssl_public_encrypt($value, $encryptedData, $pubKey, OPENSSL_PKCS1_PADDING);
                            return base64_encode($encryptedData);
                        }
                        catch(\Exception $ex) {
                            return $ex;
                        }
                    case WsAlgorithmOpenSSL::RSAES_OAEP:
                        try {
                            openssl_public_encrypt($value, $encryptedData, $pubKey, OPENSSL_PKCS1_OAEP_PADDING);
                            return base64_encode($encryptedData);
                        }
                        catch(\Exception $ex) {
                            return $ex;
                        }
                }
            }
            else if($algorithme === WsAlgorithmOpenSSL::NONE ) {
                return $value;
            }

            return new \Exception('$padding must be equal to OPENSSL_PKCS1_PADDING or OPENSSL_PKCS1_OAEP_PADDING or NONE');

        }

        /**
         * @return string
         */
        private function getPublicKey()
        {
            $TTParamsAppel = new TTParam();
            $TTParamsAppel->addItem(new CritParam('Action', 'GetClePub'));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_DEMARRE)
                ->setParamsAppel($TTParamsAppel)
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            $this->setPublicKeyObject($responseDecode);
        }

        /**
         * @return string|Notif
         */
        private function getValPublicKey()
        {
            $response = $this->getPublicKeyObject();

            $ttParam = $response->decodeParamRetour();
            if($ttParam instanceof TTParam){
                foreach ($ttParam->getItems() as $item) {
                    if ($item->getNomPar() == 'ClePublique') {
                        $clePublique = $item->getValPar();
                        return $clePublique;
                    }
                }
            }
            else if($ttParam instanceof Notif){
                return $ttParam;
            }
            return 'Undefined public key';
        }

        /**
         * @return int|Notif
         */
        private function getValPublicKeyNumber()
        {
            $response = $this->getPublicKeyObject();

            $ttParam = $response->decodeParamRetour();
            if($ttParam instanceof TTParam){
                foreach ($ttParam->getItems() as $item) {
                    if ($item->getNomPar() == 'NumClePublique') {
                        $publicKeyNumber = $item->getValPar();
                        return intval($publicKeyNumber);
                    }
                }
            }
            else if($ttParam instanceof Notif){
                return $ttParam;
            }
            return 'Undefined public key Number';
        }


    /* #################################################
     *
     * MANAGE CLIENTS
     *
     ################################################# */

        /**
         * Lecture des informations du client connecte
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClient()
        {
            if($this->getUser()->getIdCli() > 0) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_CLI_ADRESSE));

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_CLIENT)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel($TTParamAppel)
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetour();
            }

            return '{}';
        }

        /**
         * Lecture des informations d'un client par son identifiant unique
         * @param $id_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientByIdCli($id_cli)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_CLI_ADRESSE));

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdCli', $id_cli));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_CLIENT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

        /**
         * Lecture des informations d'un client par son numéro
         * @param $no_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientByNoCli($no_cli)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_CLI_ADRESSE));

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('NoCli', $no_cli));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_CLIENT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

        /**
         * Lecture des informations d'un client par son code
         * @param $cod_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientByCodCli($cod_cli)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_CLI_ADRESSE));

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('CodCli', $cod_cli));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_CLIENT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }




    /* #################################################
     *
     * MANAGE ARTICLES
     *
     ################################################# */


        /* #################################################
         * PRIX NET
         ################################################# */

        /**
         * Lecture d'un prix net d'un article par son numéro
         * @param $no_ad
         * @return mixed
         */
        public function getPrixNetByNoAD($no_ad)
        {
            if($this->getUser()->getIdCli() > 0) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('NoAD', $no_ad));
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_ARTICLE)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel($TTParamAppel)
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetourPrixNet();
            }

            return 0.0;
        }

        /**
         * Lecture d'un prix net d'un article par son identifiant unique
         * @param $id_ad
         * @return mixed
         */
        public function getPrixNetByIdAD($id_ad)
        {
            if($this->getUser()->getIdCli() > 0) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('IdAD', $id_ad));
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_ARTICLE)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel($TTParamAppel)
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetourPrixNet();
            }

            return 0.0;
        }

        /**
         * Lecture d'un prix net d'un article par son code
         * @param $cod_ad
         * @return mixed
         */
        public function getPrixNetByCodAD($cod_ad)
        {
            if($this->getUser()->getIdCli() > 0) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_ARTICLE)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel($TTParamAppel)
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetourPrixNet();
            }

            return 0.0;
        }



        /* #################################################
         * DETAIL ARTICLE AVEC INFOS SUR LE STOCK
         ################################################# */

        /**
         * Lecture des informations d'un article avec le stock par son numéro
         * @param $no_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByNoAD($no_ad, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('NoAD', $no_ad));

            $filter_depots = array();
            if($this->getUser()->getIdCli() > 0 && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if($this->getUser()->getIdCli() > 0 && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour($filter_depots);
        }

        /**
         * Lecture des informations d'un article avec le stock par son identifiant unique
         * @param $id_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByIdAD($id_ad, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdAD', $id_ad));

            $filter_depots = array();
            if($this->getUser()->getIdCli() > 0 && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if($this->getUser()->getIdCli() > 0 && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour($filter_depots);
        }

        /**
         * Lecture des informations d'un article avec le stock par son identifiant unique evolubat IdArt
         * @param $id_art
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByIdArt($id_art, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));

            if($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdArt', $id_art));

            $filter_depots = array();
            if($this->getUser()->getIdCli() > 0 && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if($this->getUser()->getIdCli() > 0 && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour($filter_depots);
        }

        /**
         * Lecture des informations d'un article avec le stock par son code
         * @param $cod_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByCodAD($cod_ad, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));

            $filter_depots = array();
            if($this->getUser()->getIdCli() > 0 && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if($this->getUser()->getIdCli() > 0 && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour($filter_depots);
        }



        /* #################################################
         * DOCUMENT PANIER
         ################################################# */

        /**
         * Lecture d'un nouveau panier
         * @return Objets\TTRetour|\Exception|mixed
         */
//        public function getPanier()
//        {
//            $TTParamAppel = new TTParam();
//            $TTParamAppel->addItem(new CritParam('TypePds', WsParameters::TYPE_PDS_SIMPLE));
//            $TTParamAppel->addItem(new CritParam("TypePrendre", WsParameters::TYPE_PRENDRE_PANIER));
//
//            if(!is_null($this->getUser())) {
//                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
//            }
//            $this->setParamAppel($TTParamAppel);
//
//            $this->setCritSel(new TTParam());
//
//            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DOCUMENT, WsTypeContext::CONTEXT_ADMIN));
//            return $response->decodeRetour();
//        }

        /**
         * Lecture d'un nouveau panier
         * @return Objets\TTRetour|\Exception|mixed
         */
//        public function putPanier()
//        {
//            $TTParamAppel = new TTParam();
//            $TTParamAppel->addItem(new CritParam('TypePds', WsParameters::TYPE_PDS_SIMPLE));
//            $TTParamAppel->addItem(new CritParam("TypePrendre", WsParameters::TYPE_PRENDRE_PANIER));
//
//            if(!is_null($this->getUser())) {
//                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
//            }
//            $this->setParamAppel($TTParamAppel);
//
//            $this->setCritSel(new TTParam());
//
//            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DOCUMENT, WsTypeContext::CONTEXT_ADMIN));
//            return $response->decodeRetour();
//        }


    /* #################################################
    *
    * MANAGE DOCUMENTS
    *
    ################################################# */

        /**
         * Lecture des documents d'un client
         * @param $format : Indique le type de retour (Tout, Entete ou ligne)
         * @param $type_prendre : Indique le type de document à lire
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getDocuments($type_prendre=null, $format = WsParameters::FORMAT_DOCUMENT_VIDE)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypePds', WsParameters::TYPE_PDS_SIMPLE));
            $TTParamAppel->addItem(new CritParam("TypePrendre", $type_prendre));
            if ($format !== WsParameters::FORMAT_DOCUMENT_VIDE) {
                $TTParamAppel->addItem(new CritParam("FormatDocument", $format));
            }

            $TTCritSel = new TTParam();
            if($this->getUser()->getIdCli() > 0) {
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_DOCUMENT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }


    /* #################################################
    *
    * MANAGE FACTURES EN ATTENTES
    *
    ################################################# */

        /**
         * Lecture des factures en attentes d'un client
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getFacturesEnAttentes()
        {
            $TTCritSel = new TTParam();
            if($this->getUser()->getIdCli() > 0) {
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_FACCLIATT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

        /**
         * Lecture d'une facture en attentes d'un client
         * @param integer $id
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getFactureEnAttente($id)
        {
            $TTCritSel = new TTParam();
            if($this->getUser()->getIdCli() > 0) {
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $TTCritSel->addItem(new CritParam('IdFac', $id));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_FACCLIATT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }


    /* #################################################
    *
    * MANAGE EDITION
    *
    ################################################# */

        /**
         * Lecture de l'édition d'un document pour un client
         * @param $id : identifiant du document à lire
         * @param $type_prendre : type d'edition à lire
         * @param $format : Indique le type de retour (Tout, BLOB, LINK)
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getEdition($id, $type_prendre=null, $format = WsParameters::FORMAT_EDITION_BLOB)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam("TypePrendre", $type_prendre));
            if ($format !== WsParameters::FORMAT_EDITION_VIDE) {
                $TTParamAppel->addItem(new CritParam("FormatEdition", $format));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdDocDE', $id));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_EDITION)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

    /* #################################################
    *
    * MANAGE DEPOTS
    *
    ################################################# */

        /**
         * Lecture des depots
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getDepots()
        {
            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_DEPOT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

        /**
         * Lecture d'un depot
         * @param $id : identifiant du depot à lire
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getDepot($id)
        {
            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdDep', $id));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_DEPOT)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

    /* #################################################
    *
    * MANAGE LIBELLES
    *
    ################################################# */

        /**
         * Lecture des libellés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getLibelles()
        {
            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_LIBELLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }


}
