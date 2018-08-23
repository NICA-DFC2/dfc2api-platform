<?php

namespace App\Services;

use App\Entity\User;
use App\Services\Filter\WsFilter;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\Request\CallerService;
use App\Utils\StockDepot;
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
    private $cache_key_depots = 'dfc2.api.depots';

    protected $wsAdminUser;
    protected $wsAdminPassword;
    protected $publicKeyObject;
    protected $cache;
    protected $user;
    protected $filter;
    protected $caller = null;


    /**
     * @var TTParam
     */
    protected $depots;


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

        $this->instantiateDepots();
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
     * @param CallerService $caller
     */
    public function setCaller(CallerService $caller)
    {
        $this->caller = $caller;
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
        return ['criteres_selection' => $filter->getCritSel(), 'params_appel' => $filter->getParamsAppel()];
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
    public function getUser()
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


    /**
     * Lecture des dépots : à chaque instance de WsMananger on hydrate les dépôts
     */
    private function instantiateDepots(){
        if($this->getCache()->has($this->cache_key_depots)) {
            $this->depots = $this->getCache()->get($this->cache_key_depots);
        }
        $TTDepotRetour = $this->getDepots();
        if(!is_null($TTDepotRetour) && $TTDepotRetour instanceof TTRetour) {
            $this->depots = $TTDepotRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DEPOT);
            $this->getCache()->set($this->cache_key_depots, $this->depots);
        }

    }

    /**
     * @return mixed
     */
    public function getDepotsClass(){
        return $this->depots;
    }


    /**
     * @param $id_depot
     * @return mixed
     */
    private function getDepotClass($id_depot){
        if(is_null($this->depots))
            return null;

        return $this->depots->getItemByFilter('IdDep', $id_depot);
    }

    /**
     * @param array
     */
    public function setDepotsClass($depots){
        $this->depots = $depots;
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
            if($this->getCache()->has($this->cache_key_admin)) {
                $cntxAdmin =  new Objets\CntxAdmin();
                $cntxAdmin->__parse($this->getCache()->get($this->cache_key_admin));
                if($cntxAdmin->isValid()) {
                    return $cntxAdmin;
                }
            }

            $TTparam = new TTParam();

            if(!$this->getPublicKey() && $algorithme != WsAlgorithmOpenSSL::NONE) {
                return new Notif('WsManager::class', 'Impossible de lire la clé publique', 'Appel échoué', '', __FUNCTION__);
            }
            else if($algorithme != WsAlgorithmOpenSSL::NONE){
                $publicKeyNumber = $this->getValPublicKeyNumber();

                $TTparam->addItem(new CritParam('Login', (!is_null($this->wsAdminUser)) ? $this->encryptByOpenSSL($this->wsAdminUser, $algorithme) : ''));
                $TTparam->addItem(new CritParam('MotDePasse', (!is_null($this->wsAdminPassword)) ? $this->encryptByOpenSSL($this->wsAdminPassword, $algorithme) : ''));
                $TTparam->addItem(new CritParam('Algorithme', $algorithme));
                $TTparam->addItem(new CritParam('NumClePublique', $publicKeyNumber));
            }
            else {
                $TTparam->addItem(new CritParam('Login', (!is_null($this->wsAdminUser)) ? $this->encryptByOpenSSL($this->wsAdminUser, $algorithme) : ''));
                $TTparam->addItem(new CritParam('MotDePasse', (!is_null($this->wsAdminPassword)) ? $this->encryptByOpenSSL($this->wsAdminPassword, $algorithme) : ''));
                $TTparam->addItem(new CritParam('Algorithme', $algorithme));
            }

            $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_DEMARRE)
                ->setParamsAppel($TTparam)
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($this->getCaller()->getResponse());
            $context = $responseDecode->decodeCntxAdmin();

            if ($context instanceof CntxAdmin) {
                $this->getCache()->clear();
                $this->instantiateDepots();
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

            if($this->getValPublicKey() === "" && $algorithme != WsAlgorithmOpenSSL::NONE) {
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
            if($responseDecode instanceof Notif){
                return false;
            }

            $this->setPublicKeyObject($responseDecode);
            return true;
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
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0) {
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
            }

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés getUser() est NULL ou getIdCli() inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }

        /**
         * Lecture des informations des clients d'un représentant
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientsWithRep()
        {
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdSal() > 0) {
                    $TTParamAppel = new TTParam();
                    $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_CLI_ADRESSE));

                    $TTCritSel = new TTParam();
                    $TTCritSel->addItem(new CritParam('IdSal', $this->getUser()->getIdSal()));

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
            }

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés getUser() est NULL ou getIdSal() inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }

        /**
         * Lecture des informations d'un client par son identifiant unique
         * @param $id_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientByIdCli($id_cli)
        {
            if($id_cli > 0) {
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

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés id_cli inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }

        /**
         * Lecture des informations d'un client par son numéro
         * @param $no_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientByNoCli($no_cli)
        {
            if($no_cli > 0) {
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

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés no_cli inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }

        /**
         * Lecture des informations d'un client par son code
         * @param $cod_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getClientByCodCli($cod_cli)
        {
            if(!empty($cod_cli) && !is_null($cod_cli)) {
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

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés cod_cli est NULL ou vide', 'Paramètres manquants', '', __FUNCTION__);
        }


    /* #################################################
     *
     * MANAGE UTILISATEURS
     *
     ################################################# */

        /**
         * Lecture des informations du salarié connecte
         * @param $user
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getUtilisateur(User $user)
        {
            if($user->getCode() !== '') {
                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('CodU', $user->getCode()));

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_UTILISATEUR)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel(new TTParam())
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetour();
            }

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés getUser() est NULL ou getIdSal() inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }


    /* #################################################
     *
     * MANAGE CONTACTS
     *
     ################################################# */

        /**
         * Lecture des informations des contacts d'un client
         * @param $id_cli
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getContacts($id_cli)
        {
            if($id_cli > 0) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypePrendre', WsParameters::TYPE_PRENDRE_CONTACTWEB));

                $TTCritSel = new TTParam();
                $TTCritSel->addItem(new CritParam('IdCli', $id_cli));

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_CONTACT)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel($TTParamAppel)
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetour();
            }

            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés id_cli inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }


    /* #################################################
     *
     * MANAGE INSTANCES CATEGORIES (Schéma de classement) / CATEGORIES (Classement)
     *
     ################################################# */

        /**
         * Lecture des instances de catégorie
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getInstsCats()
        {
            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_INSTANCE_CATEGORIE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

        /**
         * Lecture des catégories
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getCategories()
        {
            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_CATEGORIE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel(new TTParam())
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            return $responseDecode->decodeRetour();
        }

    /* #################################################
     *
     * MANAGE FOURNISSEUR
     *
     ################################################# */

        /**
         * Lecture des fournisseurs
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getFournisseurs()
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_FOUR));

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('TypeFour', 'N', 1));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_FOURNISSEUR)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);

            var_dump($responseDecode);

            return $responseDecode->decodeRetour();
        }


    /* #################################################
     *
     * MANAGE ARTICLES
     *
     ################################################# */


        /* #################################################
         * DETAIL ARTICLE AVEC INFOS SUR LE STOCK
         ################################################# */

        /**
         * Lecture des informations des articles
         * @param $filter_depots
         * @param $tailleLot
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticles($filter_depots = array(), $tailleLot = 50)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", "no"));
            $TTParamAppel->addItem(new CritParam("TailleLotEnr", $tailleLot));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    unset($stocks);

                    $TTParam->setItem($i, $wsArticle);
                }

                $TTParamRetour = $responseDecode->decodeParamRetour();
                if(!$TTParamRetour instanceof Notif) {
                    for ($i = 0; $i < $TTParamRetour->countItems(); $i++) {
                        $param = $TTParamRetour->getItem($i);
                        if($param->getNomPar() === 'RowIdEnrSuiv') {
                            $TTParam->setView(['next' => '/api/ws/articles?RowIdEnrSuiv='.$param->getValPar()]);
                        }
                    }
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }

            return $decode;
        }

        /**
         * Lecture des informations des articles
         * @param $idarts
         * @param $calculPrixNet
         * @param $filter_depots
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticlesByArray(?array $idarts, $calculPrixNet = false, $filter_depots = array())
        {
            if(!is_null($this->getUser())) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
                $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));

                if ($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                    $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }

                $TTCritSel = new TTParam();
                for ($i = 0; $i < count($idarts); $i++) {
                    if ($i == 0) {
                        $TTCritSel->addItem(new CritParam('IdArt', $idarts[$i], 1));
                    } else {
                        $TTCritSel->addItem(new CritParam('IdArt', $idarts[$i], 1));
                        $TTCritSel->addItem(new CritParam('IdArt', 'OR', 4));
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
                $decode = $responseDecode->decodeRetour($filter_depots);

                if (!$decode instanceof Notif && !is_null($decode)) {
                    $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                    for ($i = 0; $i < $TTParam->countItems(); $i++) {
                        $wsArticle = $TTParam->getItem($i);

                        // Lecture du tableau des stocks
                        // Le retour est complexe on doit créer un tableau simplifié
                        $stocks = $wsArticle->getStocks();

                        $arrayStocks = array();
                        if (!is_null($stocks) && count($stocks) > 0) {
                            // Création d'un tableau des stocks simplifié
                            for ($iS = 0; $iS < count($stocks); $iS++) {
                                $wsStock = $stocks[$iS];

                                $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                                $stockDepot = new StockDepot();
                                $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                                $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                            }
                            $wsArticle->setStocks($arrayStocks);
                        }
                        $TTParam->setItem($i, $wsArticle);
                    }

                    $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
                }
                return $decode;
            }
            
            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés getUser() est NULL ou getIdCli() inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }

        /**
         * Lecture des informations des articles pour un client
         * @param $id_cli
         * @param $filter_depots
         * @param $tailleLot
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticlesWithClient($id_cli, $filter_depots = array(), $tailleLot = 50)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", "yes"));
            $TTParamAppel->addItem(new CritParam('IdCli', $id_cli));
            $TTParamAppel->addItem(new CritParam("TailleLotEnr", $tailleLot));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect(new TTParam())
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    unset($stocks);

                    $TTParam->setItem($i, $wsArticle);
                }

                $TTParamRetour = $responseDecode->decodeParamRetour();
                if(!$TTParamRetour instanceof Notif) {
                    for ($i = 0; $i < $TTParamRetour->countItems(); $i++) {
                        $param = $TTParamRetour->getItem($i);
                        if($param->getNomPar() === 'RowIdEnrSuiv') {
                            $TTParam->setView(['next' => '/api/ws/articles?RowIdEnrSuiv='.$param->getValPar()]);
                        }
                    }
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock pour un client par son numéro
         * @param $id_cli
         * @param $no_ad
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWithClientByNoAD($id_cli, $no_ad, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($id_cli > 0) ? "yes" : "no"));
            if($id_cli > 0) {
                $TTParamAppel->addItem(new CritParam('IdCli', $id_cli));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('NoAD', $no_ad));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock pour un client par son identifiant unique
         * @param $id_cli
         * @param $id_ad
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWithClientByIdAD($id_cli, $id_ad, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($id_cli > 0) ? "yes" : "no"));
            if($id_cli > 0) {
                $TTParamAppel->addItem(new CritParam('IdCli', $id_cli));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdAD', $id_ad));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock pour un client par son code
         * @param $id_cli
         * @param $cod_ad
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWithClientByCodAD($id_cli, $cod_ad, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($id_cli > 0) ? "yes" : "no"));
            if($id_cli > 0) {
                $TTParamAppel->addItem(new CritParam('IdCli', $id_cli));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock pour un client par son identifiant unique evolubat IdArt
         * @param $id_cli
         * @param $id_art
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleWithClientByIdArt($id_cli, $id_art, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($id_cli > 0) ? "yes" : "no"));

            if($id_cli > 0) {
                $TTParamAppel->addItem(new CritParam('IdCli', $id_cli));
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdArt', $id_art));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock par son numéro
         * @param $no_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByNoAD($no_ad, $calculPrixNet = false, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                    $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('NoAD', $no_ad));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock par son identifiant unique
         * @param $id_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByIdAD($id_ad, $calculPrixNet = false, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                    $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdAD', $id_ad));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock par son code
         * @param $cod_ad
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByCodAD($cod_ad, $calculPrixNet = false, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                    $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('CodAD', $cod_ad));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                for ($i = 0; $i < $TTParam->countItems(); $i++) {
                    $wsArticle = $TTParam->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArticle->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($iS = 0; $iS < count($stocks); $iS++) {
                            $wsStock = $stocks[$iS];

                            $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                            $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                        }
                        $wsArticle->setStocks($arrayStocks);
                    }
                    $TTParam->setItem($i, $wsArticle);
                }

                $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
            }
            return $decode;
        }

        /**
         * Lecture des informations d'un article avec le stock par son identifiant unique evolubat IdArt
         * @param $id_art
         * @param $calculPrixNet : Indique si l'appel doit récupérer le PRIX NET du client connecté
         * @param $filter_depots : Lecture des stocks pour la liste des dépots renseignés
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getArticleByIdArt($id_art, $calculPrixNet = false, $filter_depots = array())
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypeDonnee', WsParameters::TYPE_DONNEE_ARTDET_STOCK));
            $TTParamAppel->addItem(new CritParam("CalculPrixNet", ($calculPrixNet) ? "yes" : "no"));

            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0 && $calculPrixNet) {
                    $TTParamAppel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }
            }

            $TTCritSel = new TTParam();
            $TTCritSel->addItem(new CritParam('IdArt', $id_art));

            $response = $this->getCaller()
                ->setCache($this->getCache())
                ->setModule(WsParameters::MODULE_ARTICLE)
                ->setContext(WsTypeContext::CONTEXT_ADMIN)
                ->setFilter($this->getFilter())
                ->setParamsAppel($TTParamAppel)
                ->setCritsSelect($TTCritSel)
                ->get();

            $responseDecode = new ResponseDecode($response);
            $decode = $responseDecode->decodeRetour($filter_depots);

            if(!$decode instanceof Notif) {
                $TTParam = $decode->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                if(!is_null($TTParam)) {
                    for ($i = 0; $i < $TTParam->countItems(); $i++) {
                        $wsArticle = $TTParam->getItem($i);

                        // Lecture du tableau des stocks
                        // Le retour est complexe on doit créer un tableau simplifié
                        $stocks = $wsArticle->getStocks();

                        $arrayStocks = array();
                        if (!is_null($stocks) && count($stocks) > 0) {
                            // Création d'un tableau des stocks simplifié
                            for ($iS = 0; $iS < count($stocks); $iS++) {
                                $wsStock = $stocks[$iS];

                                $wsDepot = $this->getDepotClass($wsStock->getIdDep());

                                $stockDepot = new StockDepot();
                                $stockDepot->parseObject($wsStock, (!is_null($wsDepot)) ? $wsDepot->getNomDep() : $iS);
                                $arrayStocks[(!is_null($wsDepot)) ? $wsDepot->getNomDepLower() : $iS] = $stockDepot->parseString();
                            }
                            $wsArticle->setStocks($arrayStocks);
                        }
                        $TTParam->setItem($i, $wsArticle);
                    }
                    $decode->setTable($TTParam, WsTableNamesRetour::TABLENAME_TT_ARTDET);
                }
            }
            return $decode;
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
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0) {
                    $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }
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

        /**
         * Lecture des documents d'un client
         * @param $id_cli
         * @param $format : Indique le type de retour (Tout, Entete ou ligne)
         * @param $type_prendre : Indique le type de document à lire
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getDocumentsWithClient($id_cli, $type_prendre=null, $format = WsParameters::FORMAT_DOCUMENT_VIDE)
        {
            $TTParamAppel = new TTParam();
            $TTParamAppel->addItem(new CritParam('TypePds', WsParameters::TYPE_PDS_SIMPLE));
            $TTParamAppel->addItem(new CritParam("TypePrendre", $type_prendre));
            if ($format !== WsParameters::FORMAT_DOCUMENT_VIDE) {
                $TTParamAppel->addItem(new CritParam("FormatDocument", $format));
            }

            $TTCritSel = new TTParam();
            if($id_cli > 0) {
                $TTCritSel->addItem(new CritParam('IdCli', $id_cli));
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
            if(!is_null($this->getUser())) {
                if ($this->getUser()->getIdCli() > 0) {
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
            
            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés getUser() est NULL ou getIdCli() inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
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

            print_r($this->getCaller()->getUrl());

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

    /* #################################################
    *
    * MANAGE STATISTIQUE
    *
    ################################################# */

        /**
         * Lecture des statistiques client
         * @param $avecBlEnCours : valeur possible oui ou non
         * @param $type_donnee
         * @return Objets\TTRetour|\Exception|mixed
         */
        public function getStatistiquesClient($type_donnee = WsParameters::TYPE_DONNEE_STAT_CLI, $avecBlEnCours = "oui")
        {
            if(!is_null($this->getUser())) {
                $TTParamAppel = new TTParam();
                $TTParamAppel->addItem(new CritParam("TypeDonnee", $type_donnee));
                $TTParamAppel->addItem(new CritParam("AvecBLenCours", $avecBlEnCours));

                $TTCritSel = new TTParam();
                if ($this->getUser()->getIdCli() > 0) {
                    $TTCritSel->addItem(new CritParam('IdCli', $this->getUser()->getIdCli()));
                }

                $response = $this->getCaller()
                    ->setCache($this->getCache())
                    ->setModule(WsParameters::MODULE_STATISTIQUE)
                    ->setContext(WsTypeContext::CONTEXT_ADMIN)
                    ->setFilter($this->getFilter())
                    ->setParamsAppel($TTParamAppel)
                    ->setCritsSelect($TTCritSel)
                    ->get();

                $responseDecode = new ResponseDecode($response);
                return $responseDecode->decodeRetour();
            }
            
            return new Notif('WsManager::class', 'Les paramètres d\'appel ne sont pas tous renseignés getUser() est NULL ou getIdCli() inférieur à 0', 'Paramètres manquants', '', __FUNCTION__);
        }


}
