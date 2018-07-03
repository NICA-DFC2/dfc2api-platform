<?php

namespace App\Services;

use App\Entity\User;
use App\Services\Filter\WsFilter;
use App\Services\Objets\CntxAdmin;
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

    protected $httpheaders = array(
        'Accept' => WsParameters::ACCEPT,
        'Content-type' => WsParameters::CONTENT_TYPE,
        'Origin' => WsParameters::ORIGIN,
        'Referer' => WsParameters::REFERER);
    protected $baseUrl;
    protected $url;
    protected $environement;
    protected $requestStack;
    protected $encryptor;
    protected $paramAppel;
    protected $critSel;
    protected $wsAdminUser;
    protected $wsAdminPassword;
    protected $session;
    protected $publicKeyVal;
    protected $cache;
    protected $user;
    protected $filter;


    /* #################################################
     *
     * CONSTRUCTOR
     *
     ################################################# */

    public function __construct($env, RequestStack $requestStack, SessionInterface $session, string $wsAdminUser, string $wsAdminPassword) {
        $this->environement = $env;
        $this->wsAdminUser = $wsAdminUser;
        $this->wsAdminPassword = $wsAdminPassword;
        $this->requestStack = $requestStack;
        $this->session = $session;
        $this->baseUrl = $requestStack->getCurrentRequest()->getBaseUrl() . WsParameters::URL_SUFFIX;
        $this->setBaseUrl();
        $this->cache = new FilesystemCache();
    }



    /* #################################################
     *
     * METHODS OF CLASS
     *
     ################################################# */

    private function setBaseUrl()
    {
        if ($this->environement == 'dev') {
            $this->baseUrl = 'http://www.dfc2.fr' . WsParameters::URL_SUFFIX;
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    private function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    private function getFilter()
    {
        $filter = new WsFilter($this->filter);
        return $filter->getCritSel();
    }

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

    public function setUser(User $user)
    {
        $this->user = $user;
    }


    /**
     * @return ResponseDecode
     */
    private function getPublicKeyVal()
    {
        return $this->publicKeyVal;
    }

    private function setPublicKeyVal($publicKeyVal)
    {
        $this->publicKeyVal = $publicKeyVal;
    }



    private function call_get($module, $type_context = WsTypeContext::CONTEXT_NONE)
    {
        $url = $this->baseUrl . '?' . 'picModule=' . $module;

        switch($type_context) {
            case WsTypeContext::CONTEXT_ADMIN:
                $url .= '&' . $this->getCntxAdminToString();
                break;
            case WsTypeContext::CONTEXT_NONE:
                break;
        }

        if (!empty($this->getParamAppel())){
            $url .= '&' . $this->getParamAppel();
        }

        if (!empty($this->getCritSel())){
            $url .= '&' . $this->getCritSel();
        }
        $this->setUrl($url);

        $response = $this->getRequest();
        return $response;
    }

    private function getRequest() {
        return Unirest\Request::get($this->getUrl(), $this->httpheaders, null);
    }

    /*
     * NON UTILISE POUR L'INSTANT
     * MODIFICATION/ENREGISTREMENT
     */
    private function putRequest() {
        return Unirest\Request::put($this->getUrl(), $this->httpheaders, null);
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
        $context = null;
        $this->getPublicKey();

        if($this->cache->has($this->cache_key_admin)) {
            $cntxAdmin =  new Objets\CntxAdmin();
            $cntxAdmin->__parse($this->cache->get($this->cache_key_admin));
            if($cntxAdmin->isValid()) {
                return $cntxAdmin;
            }
        }

        $context = $this->getCntxAdmin($this->wsAdminUser, $this->wsAdminPassword, $algorithme);
        if ($context instanceof CntxAdmin) {
            // met en cache le contexte de connexion
            $this->cache->set($this->cache_key_admin, $context->__toValsString());
        }

        return $context;
    }

    /**
     * @param        $login
     * @param        $password
     * @param string $algorithme
     * @return ResponseDecode
     */
    private function login($login, $password, $algorithme = WsAlgorithmOpenSSL::NONE)
    {
        $publicKeyNumber = $this->getValPublicKeyNumber();

        $TTparam = new TTParam();
        $TTparam->addItem(new CritParam('Login', (!is_null($login)) ? $this->encryptByOpenSSL($login, $algorithme) : ''));
        $TTparam->addItem(new CritParam('MotDePasse', (!is_null($password)) ? $this->encryptByOpenSSL($password, $algorithme) : ''));
        $TTparam->addItem(new CritParam('Algorithme', $algorithme));
        $TTparam->addItem(new CritParam('NumClePublique', $publicKeyNumber));
        $this->setParamAppel($TTparam);

        return new ResponseDecode($this->call_get(WsParameters::MODULE_DEMARRE));
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
     * @param $login
     * @param $password
     * @param $algorithme
     * @return Objets\CntxAdmin|\Exception|mixed
     */
    private function getCntxAdmin($login, $password, $algorithme)
    {
        return $this->login($login, $password, $algorithme)->decodeCntxAdmin();
    }



    /**
     * @return string
     * @throws
     */
    private function getCntxAdminToString()
    {
        if($this->cache->has($this->cache_key_admin)) {
            $data = $this->cache->get($this->cache_key_admin);
            $contexte = new CntxAdmin();
            if($contexte->__parse($data)) {
                return 'pijDSCntxClient=' . $contexte->__toString();
            }
        }
        return 'pijDSCntxClient={"ProDataSet":{}}';
    }



    /**
     * @return string
     */
    private function getPublicKey()
    {
        $TTparam = new TTParam();
        $TTparam->addItem(new CritParam('Action', 'GetClePub'));
        $this->setParamAppel($TTparam);
        $this->setPublicKeyVal(new ResponseDecode($this->call_get(WsParameters::MODULE_DEMARRE)));
    }

    /**
     * @return string|Notif
     */
    private function getValPublicKey()
    {
        $response = $this->getPublicKeyVal();
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
        $response = $this->getPublicKeyVal();
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
        if(!is_null($this->getUser())) {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_CLI_ADRESSE));
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            $this->setCritSel($TTCritSel);

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_CLIENT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
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
        $this->setParamAppel($TTParamAppel);

        $TTCritSel = new TTParam();
        $TTCritSel->addItem(new CritParam('IdCli', $id_cli));
        $this->setCritSel($TTCritSel);

        $response = new ResponseDecode($this->call_get(WsParameters::MODULE_CLIENT, WsTypeContext::CONTEXT_ADMIN));
        return $response->decodeRetour();
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
        $this->setParamAppel($TTParamAppel);

        $TTCritSel = new TTParam();
        $TTCritSel->addItem(new CritParam('NoCli', $no_cli));
        $this->setCritSel($TTCritSel);

        $response = new ResponseDecode($this->call_get(WsParameters::MODULE_CLIENT, WsTypeContext::CONTEXT_ADMIN));
        return $response->decodeRetour();
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
        $this->setParamAppel($TTParamAppel);

        $TTCritSel = new TTParam();
        $TTCritSel->addItem(new CritParam('CodCli', $cod_cli));
        $this->setCritSel($TTCritSel);

        $response = new ResponseDecode($this->call_get(WsParameters::MODULE_CLIENT, WsTypeContext::CONTEXT_ADMIN));
        return $response->decodeRetour();
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
            if(!is_null($this->getUser())) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));
                $this->setParamAppel($TTParamAppel);

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('NoAD', $no_ad));
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                $this->setCritSel($TTCritSel);

                $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
                return $response->decodeRetourPrixNet();
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
            if(!is_null($this->getUser())) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));
                $this->setParamAppel($TTParamAppel);

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('IdAD', $id_ad));
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                $this->setCritSel($TTCritSel);

                $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
                return $response->decodeRetourPrixNet();
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
            if(!is_null($this->getUser())) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));
                $this->setParamAppel($TTParamAppel);

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                $this->setCritSel($TTCritSel);

                $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
                return $response->decodeRetourPrixNet();
            }

            return 0.0;
        }


        /* #################################################
         * DETAIL ARTICLE WEB
         ################################################# */

        /**
         * Lecture des informations d'un article par son numéro
         * @param $no_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWebByNoAD($no_ad, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('NoAD', $no_ad));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
        }

        /**
         * Lecture des informations d'un article par son identifiant unique
         * @param $id_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWebByIdAD($id_ad, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdAD', $id_ad));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
        }

        /**
         * Lecture des informations d'un article par son code
         * @param $cod_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWebByCodAD($cod_ad, $calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
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
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('NoAD', $no_ad));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
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
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdAD', $id_ad));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
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

            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdArt', $id_art));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
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
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));
            $this->setCritSel($TTCritSel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
        }




        /* #################################################
         * DETAILS ARTICLES COMMANDES POUR LE CLIENT CONNECTE
         ################################################# */

        /**
         * Lecture des informations des articles commandés avec le stock pour le client connecté
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $onlyPlateform : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme
         * @param $onlyPlateformAndDepCli : Indique si la réponse de l'appel doit être filtrée seulement pour la plateforme et le dépôt du client connecté
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArtsCmdesForCntxClient($calculPrixNet = false, $onlyPlateform = false, $onlyPlateformAndDepCli = false)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_WEB));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            $TTParamAppel->addItem(new CritParam("TypeRecherche", WsParameters::TYPE_RECHERCHE_ARTDET));
            if(!is_null($this->getUser()) && $calculPrixNet) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $filter_depots = array();
            if(!is_null($this->getUser()) && $onlyPlateform) {
                $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
            }
            else if(!is_null($this->getUser()) && $onlyPlateformAndDepCli) {
                if(WsParameters::ID_DEP_PLATEFORME === intval($this->getUser()->getIdDepotCli())) {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME);
                }
                else {
                    $filter_depots = array(WsParameters::ID_DEP_PLATEFORME, intval($this->getUser()->getIdDepotCli()));
                }
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_ARTICLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour($filter_depots);
        }



        /* #################################################
         * DOCUMENT PANIER
         ################################################# */

        /**
         * Lecture d'un nouveau panier
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getPanier()
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypePds', WsParameters::TYPE_PDS_SIMPLE));
            $TTParamAppel->addItem(new CritParam("TypePrendre", WsParameters::TYPE_PRENDRE_PANIER));

            if(!is_null($this->getUser())) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DOCUMENT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
        }

        /**
         * Lecture d'un nouveau panier
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function putPanier()
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypePds', WsParameters::TYPE_PDS_SIMPLE));
            $TTParamAppel->addItem(new CritParam("TypePrendre", WsParameters::TYPE_PRENDRE_PANIER));

            if(!is_null($this->getUser())) {
                $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
            }
            $this->setParamAppel($TTParamAppel);

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DOCUMENT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
        }


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
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            if(!is_null($this->getUser())) {
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                $this->setCritSel($TTCritSel);
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DOCUMENT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
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
            $this->setParamAppel(new TTParam());

            $TTCritSel = new TTParam();
            if(!is_null($this->getUser())) {
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                $this->setCritSel($TTCritSel);
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_FACCLIATT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
        }

        /**
         * Lecture d'une facture en attentes d'un client
         * @param integer $id
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getFactureEnAttente($id)
        {
            $this->setParamAppel(new TTParam());

            $TTCritSel = new TTParam();
            if(!is_null($this->getUser())) {
                $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                $TTCritSel->addItem(new CritParam('IdFac', $id));
                $this->setCritSel($TTCritSel);
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_FACCLIATT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
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
            $this->setParamAppel($TTParamAppel);

            $TTCritSel = new TTParam();
            if(!is_null($this->getUser())) {
                $TTCritSel->addItem(new CritParam('IdDocDE', $id));
                $this->setCritSel($TTCritSel);
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_EDITION, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
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
            $this->setParamAppel(new TTParam());

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DEPOT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
        }

        /**
         * Lecture d'un depot
         * @param $id : identifiant du depot à lire
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getDepot($id)
        {
            $this->setParamAppel(new TTParam());

            $TTCritSel = new TTParam();
            if(!is_null($this->getUser())) {
                $TTCritSel->addItem(new CritParam('IdDep', $id));
                $this->setCritSel($TTCritSel);
            }

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_DEPOT, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
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
            $this->setParamAppel(new TTParam());

            $response = new ResponseDecode($this->call_get(WsParameters::MODULE_LIBELLE, WsTypeContext::CONTEXT_ADMIN));
            return $response->decodeRetour();
        }


    /* #################################################
     *
     * MANAGE THE PARAMETERS OF CALL
     *
     ################################################# */

    /**
     * @return mixed
     */
    private function getParamAppel()
    {
        return $this->paramAppel;
    }

    /**
     * @param TTParam $paramAppel
     * @return string
     */
    private function setParamAppel(TTParam $paramAppel)
    {
        if($paramAppel->countItems() > 0) {
            $this->paramAppel = 'pijDSParamAppel={"ProDataSet":{"ttParam":' . $paramAppel->__toString() . '}}';
        }
        else {
            $this->paramAppel = 'pijDSParamAppel={"ProDataSet":{}}';
        }
        return $this->paramAppel;
    }

    /**
     * @return mixed
     */
    private function getCritSel()
    {
        return $this->critSel;
    }

    /**
     * @param TTParam $critSel
     * @return string
     */
    private function setCritSel(TTParam $critSel)
    {
        $filters = $this->getFilter();
        if(!is_null($filters) && count($filters) > 0) {
            foreach ($filters as $param) {
                $critSel->addItem($param);
            }
        }

        if($critSel->countItems() > 0) {
            $this->critSel = 'pijDSCritSel={"ProDataSet":{"ttParam":' . $critSel->__toString() . '}}';
        }
        else {
            $this->critSel = 'pijDSCritSel={"ProDataSet":{}}';
        }

        return $this->critSel;
    }

}
