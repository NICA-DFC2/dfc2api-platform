<?php

namespace App\Serializer;

use App\Entity\Article;
use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Services\Parameters\WsTableNamesRetour;

use App\Utils\StockDepot;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * Classe qui permet l'hydratation des propriétés vides avec les services web GIMEL d'une entité.
 *
 * Héritage des interfaces NormalizerInterface, DenormalizerInterface, SerializerAwareInterface.
 *
 */
final class ObjectNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    private $normalizer;

    /**
     * @SWG\Property(
     *     name="ws_manager",
     *     type="WsManager",
     *     description="Service qui permet de faire des appels aux services web GIMEL")
     */
    private $ws_manager;

    /**
     * @SWG\Property(
     *     name="user_service",
     *     type="UserService",
     *     description="Service qui permet de récupérer le client connecté par son token")
     */
    private $user_service;

    public function __construct(NormalizerInterface $normalizer, WsManager $wsManager, UserService $userService)
    {
        if (!$normalizer instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }
        else if (!$wsManager instanceof WsManager) {
            throw new \InvalidArgumentException(sprintf('The wsManager must implement the %s.', WsManager::class));
        }
        else if (!$userService instanceof UserService) {
            throw new \InvalidArgumentException(sprintf('The userService must implement the %s.', UserService::class));
        }

        $this->normalizer = $normalizer;
        $this->ws_manager = $wsManager;
        $this->user_service = $userService;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->normalizer->supportsNormalization($data, $format);
    }

    /**
     * Fonction qui permet l'hydration selon l'objet reçu en paramétre
     *
     * @param object $object
     * @param null $format
     * @param array $context
     * @return mixed
     * @throws
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        /*
         * si data est de type Article : Hydratation d'un article
         */
        if($object instanceof Article) {
            return $this->normalizeArtDet($data, $context['uri']);
        }
        return $data;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->normalizer->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->normalizer->denormalize($data, $class, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if($this->normalizer instanceof SerializerAwareInterface) {
            $this->normalizer->setSerializer($serializer);
        }
    }


    /**
     * Fonction qui permet l'hydration d'un Article
     *
     * @param $data
     * @return mixed
     * @throws \ErrorException
     */
    private function normalizeArtDet($data, $uri) {

        $depots = array();
        $flg_prixnet = false;

        $parseUrl = parse_url($uri);
        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }

            if(array_key_exists('prixnet', $arrayQuery)){
                $prixnet = $arrayQuery['prixnet'];
                $flg_prixnet = ($prixnet==='yes'||$prixnet==='y'||$prixnet==='1') ? true : false;
            }
        }

        // Identifiant technique de l'article dans Evolubat
        $IdArtEvoAD = $data["IdArtEvoAD"];

        // Lecture du user connecté
        $user = $this->user_service->getCurrentUser();

        // si user connecté et de type User
        if($user instanceof User) {
            // hydratation de l'entité User avec les informations du service web gimel
            $user = $this->normalizeUser($user);
            // instancie la propriété user du manager des services web gimel
            $this->ws_manager->setUser($user);
            // Appel service web d'un article par son identifiant technique IdArt et calcul du prix net si client connecté
            $TTRetour = $this->ws_manager->getArticleByIdArt2($IdArtEvoAD, $flg_prixnet, $depots);
        }
        else {
            // Appel service web d'un article par son identifiant technique IdArt
            $TTRetour = $this->ws_manager->getArticleByIdArt2($IdArtEvoAD, false, $depots);
        }

        // si le retour est de type Notif
        // Message d'erreur retourné par les webservices
        if($TTRetour instanceof Notif) {
            //throw new \ErrorException(sprintf('Il y a une erreur:  %s.', $TTRetour->__toString()), 401 ,1, __FILE__);
        }

        if(!is_null($TTRetour)) {
            $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

            if(is_null($TTParam)) {
                //throw new \ErrorException('Il y a une erreur, objet TTParam:class null ', 401 ,1, __FILE__);
            }
            else if($TTParam->countItems() == 0) {
                //throw new \ErrorException(sprintf('Il y a une erreur, objet TTParam:class vide:  %s.', $TTParam->__toString()), 401 ,1, __FILE__);
            }
            else {
                $wsArticle = $TTParam->getItem(0);

                // Lecture du tableau des stocks
                // Le retour est complexe on doit créer un tableau simplifié
                $stocks = $wsArticle->getStocks();

                $arrayStocks = array();
                if (!is_null($stocks) && count($stocks) > 0) {
                    // Création d'un tableau des stocks simplifié
                    for ($i = 0; $i < count($stocks); $i++) {
                        $wsStock = $stocks[$i];

                        $TTDepotRetour = $this->ws_manager->getDepot($wsStock->getIdDep());
                        if(!is_null($TTDepotRetour) && $TTDepotRetour instanceof TTRetour) {
                            $TTDepot = $TTDepotRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DEPOT);
                            $wsDepot = $TTDepot->getItem(0);

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                    }
                    $data["Stocks"] = $arrayStocks;
                }

                $data["IdADWS"] = $wsArticle->getIdAD();
                $data["NoADWS"] = $wsArticle->getNoAD();
                $data["CodADFWS"] = $wsArticle->getCodADF();
                $data["DesiAutoADWS"] = $wsArticle->getDesiAutoAD();
                $data["CodADWS"] = $wsArticle->getCodAD();
                $data["UVteADWS"] = $wsArticle->getUVteArt();
                $data["UStoADWS"] = $wsArticle->getUStoArt();
                $data["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                $data["PrixNetCliADWS"] = $wsArticle->getPrixNet();

                $data["IdDepWS"] = $wsArticle->getIdDep();
                $data["NoADWS"] = $wsArticle->getNoAD();
                $data["CodADWS"] = $wsArticle->getCodAD();
                $data["StkReelADWS"] = $wsArticle->getStkReelAD();
                $data["StkResADWS"] = $wsArticle->getStkResAD();
                $data["StkCmdeADWS"] = $wsArticle->getStkCmdeAD();
                $data["StockDisponibleWS"] = $wsArticle->getStockDisponible();
                $data["StockDisponibleSocWS"] = $wsArticle->getStockDisponibleSoc();
                $data["StockPratiqueWS"] = $wsArticle->getStockPratique();
                $data["StkReelPlat1WS"] = $wsArticle->getStkReelPlat1();
                $data["UVteArtWS"] = $wsArticle->getUVteArt();
                $data["UStoArtWS"] = $wsArticle->getUStoArt();
                $data["PrixPubUCondVteWS"] = $wsArticle->getPrixPubUCondVte();
                $data["PrixNetUCondVteWS"] = $wsArticle->getPrixNetUCondVte();

                $data["LongADWS"] = $wsArticle->getLongAD();
                $data["LargADWS"] = $wsArticle->getLargAD();
                $data["EpaisADWS"] = $wsArticle->getEpaisAD();
                $data["CondVteADWS"] = $wsArticle->getCondVteAD();
                $data["FlgDecondADWS"] = $wsArticle->getFlgDecondAD();
                $data["Desi2ArtWS"] = $wsArticle->getDesi2Art();
                $data["IdFourWS"] = $wsArticle->getIdFour();
                $data["NomDepWS"] = $wsArticle->getNomDep();
                $data["CodSuspADWS"] = $wsArticle->getCodSuspAD();
                $data["GenCodADWS"] = $wsArticle->getGenCodAD();
                $data["CodADFWS"] = $wsArticle->getCodADF();
                $data["GenCod1ADFWS"] = $wsArticle->getGenCod1ADF();
                $data["GenCod2ADFWS"] = $wsArticle->getGenCod2ADF();

                $data["PrixNetWS"] = $wsArticle->getPrixNet();
                $data["PrixPubCliWS"] = $wsArticle->getPrixPubCli();
                $data["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                $data["PrixRevConvADWS"] = $wsArticle->getPrixRevConvAD();
                $data["CoefPRCADWS"] = $wsArticle->getCoefPRCAD();
                $data["MargeConvADWS"] = $wsArticle->getMargeConvAD();
            }
        }
        return $data;
    }

    /**
     * Fonction qui permet l'hydration d'un User
     *
     * @param $user_data
     * @return mixed
     * @throws
     */
    private function normalizeUser(User $user_data) {
        // Appel service web d'un client par son code client (CodCli)
        $TTRetour = $this->ws_manager->getClientByCodCli($user_data->getCode());

        // si le retour est de type Notif
        // Message d'erreur retourné par les webservices
        if($TTRetour instanceof Notif) {
            throw new \ErrorException(sprintf('Il y a une erreur:  %s.', $TTRetour->__toString()), 401 ,1, __FILE__);
        }

        if(!is_null($TTRetour)) {
            $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);
            $wsClient = $TTParam->getItem(0);

            if(!is_null($wsClient)) {
                $user_data->setIdCli($wsClient->getIdCli());
                $user_data->setNoCli($wsClient->getNoCli());
                $user_data->setIdDepotCli($wsClient->getIdDep());
                $user_data->setNomDepotCli($wsClient->getNomDep());
            }
            return $user_data;
        }
        return $user_data;
    }
}