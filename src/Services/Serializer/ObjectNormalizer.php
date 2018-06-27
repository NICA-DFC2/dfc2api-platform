<?php

namespace App\Services\Serializer;

use App\Entity\Article;

use App\Entity\Document;
use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Parameters\WsParameters;
use App\Services\UserService;
use App\Services\WsManager;
use App\Services\Parameters\WsTableNamesRetour;

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
class ObjectNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    private $decorated;

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

    public function __construct(NormalizerInterface $decorated, WsManager $wsManager, UserService $userService)
    {
        if (!$decorated instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }
        else if (!$wsManager instanceof WsManager) {
            throw new \InvalidArgumentException(sprintf('The wsManager must implement the %s.', WsManager::class));
        }
        else if (!$userService instanceof UserService) {
            throw new \InvalidArgumentException(sprintf('The userService must implement the %s.', UserService::class));
        }

        $this->decorated = $decorated;
        $this->ws_manager = $wsManager;
        $this->user_service = $userService;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    /**
     * Fonction qui permet l'hydration selon l'objet reçu en paramétre
     *
     * @param object $object
     * @param null $format
     * @param array $context
     * @return mixed
     * @throws \ErrorException
     *
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->decorated->normalize($object, $format, $context);

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
        return $this->decorated->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $class, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if($this->decorated instanceof SerializerAwareInterface) {
            $this->decorated->setSerializer($serializer);
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

        $flg_prixnet = (strpos($uri, 'prix-net') !== false);
        $flg_logistic = (strpos($uri, 'logistic') !== false);
        $flg_anduser = (strpos($uri, 'and-user')  !== false);

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
            $TTRetour = $this->ws_manager->getArticleByIdArt($IdArtEvoAD, $flg_prixnet, $flg_logistic, $flg_anduser);
        }
        else {
            // Appel service web d'un article par son identifiant technique IdArt
            $TTRetour = $this->ws_manager->getArticleByIdArt($IdArtEvoAD, false, $flg_logistic);
        }

        // si le retour est de type Notif
        // Message d'erreur retourné par les webservices
        if($TTRetour instanceof Notif) {
            throw new \ErrorException(sprintf('Il y a une erreur:  %s.', $TTRetour->__toString()), 401 ,1, __FILE__);
        }

        if(!is_null($TTRetour)) {
            $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

            if(is_null($TTParam)) {
                throw new \ErrorException('Il y a une erreur, objet TTParam:class null ', 401 ,1, __FILE__);
            }
            else if($TTParam->countItems() == 0) {
                throw new \ErrorException(sprintf('Il y a une erreur, objet TTParam:class vide:  %s.', $TTParam->__toString()), 401 ,1, __FILE__);
            }
            else {
                $wsArticle = $TTParam->getItem(0);

                // Lecture du tableau des stocks
                // Le retour est complexe on doit créer un tableau simplifié
                $stocks = $wsArticle->getStocks();
                $arrayStocks = [];
                if (!is_null($stocks)) {
                    // Création d'un tableau des stocks simplifié
                    for ($i = 0; $i < $stocks->countItems(); $i++) {
                        array_push($arrayStocks, json_decode($stocks->getItem($i)->__toString()));
                    }
                }

                $data["IdADWS"] = $wsArticle->getIdAD();
                $data["NoADWS"] = $wsArticle->getNoAD();
                $data["CodADFWS"] = $wsArticle->getCodADF();
                $data["DesiADWS"] = $wsArticle->getDesiAutoAD();
                $data["CodADWS"] = $wsArticle->getCodAD();
                $data["UVteADWS"] = $wsArticle->getUVteArt();
                $data["UStoADWS"] = $wsArticle->getUStoArt();
                $data["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                $data["PrixNetCliADWS"] = $wsArticle->getPrixNet();
                $data["Stocks"] = $arrayStocks;
            }
        }
        else {
            $data["IdADWS"] = null;
            $data["NoADWS"] = null;
            $data["CodADFWS"] = null;
            $data["DesiADWS"] = null;
            $data["CodADWS"] = null;
            $data["UVteADWS"] = null;
            $data["UStoADWS"] = null;
            $data["PrixPubADWS"] = 0.0;
            $data["PrixNetCliADWS"] = 0.0;
            $data["Stocks"] = [];
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