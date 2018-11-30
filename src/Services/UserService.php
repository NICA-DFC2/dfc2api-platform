<?php

namespace App\Services;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Objets\WsClient;
use App\Services\Objets\WsUtil;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsTableNamesRetour;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserService
{
    /** @var  TokenStorageInterface */
    private $tokenStorage;

    /** @var  WsManager */
    private $ws_manager;

    /** @var array */
    private $user_infos;

    /**
     * @param TokenStorageInterface  $storage
     * @param WsManager $manager
     */
    public function __construct(TokenStorageInterface $storage, WsManager $manager)
    {
        $this->tokenStorage = $storage;
        $this->ws_manager = $manager;

        $this->user_infos = [ 'id' => null,
            'username' => null,
            'code' => null,
            'fullname' => null,
            'email' => null,
            'last_login' => null,
            'raison_sociale' => null,
            'id_cli' => null,
            'id_sal' => null,
            'no_cli' => null,
            'id_depot' => null,
            'nom_depot' => null,
            'cod_cli' => null,
            'rsoc_cli' => null,
            'codsusp_cli' => null,
            'causesusp_cli' => null,
            'mail_adr' => null,
            'tel1_adr' => null,
            'tel2_adr' => null,
            'roles' => null,
            'cntx_valid' => false,
            'erreur' => null,
            //'interface' => null,
            'lien_cmd' => null,
            'lien_bl' => null,
            'lien_dev' => null,
            'lien_fac' => null,
            'lien_paniers' => null
        ];
    }

    public function getCurrentUser()
    {
        $token = $this->tokenStorage->getToken();

        if ($token instanceof TokenInterface)
        {
            $this->ws_manager->getDemarre(WsAlgorithmOpenSSL::NONE);
            /** @var User $user */
            $user = $token->getUser();

            if(!is_string($user)) {
                $this->user_infos['id'] = $user->getId();
                $this->user_infos['username'] = $user->getUsername();
                $this->user_infos['code'] = $user->getCode();
                $this->user_infos['fullname'] = $user->getFullname();
                $this->user_infos['email'] = $user->getEmail();
                $this->user_infos['last_login'] = $user->getLastLogin();
                $this->user_infos['raison_sociale'] = $user->getRaisonSociale();
                $this->user_infos['id_depot'] = $user->getIdDepotCli();
                $this->user_infos['nom_depot'] = $user->getNomDepotCli();
                $this->user_infos['roles'] = $user->getRoles();
                $this->user_infos['cntx_valid'] = true;

                if (in_array('ROLE_COMMERCIAL', $user->getRoles()) || in_array('ROLE_MARKET_LEADER', $user->getRoles())) {

                    $TTRetour = $this->ws_manager->getUtilisateur($user);

                    if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
                        $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_UTIL);
                        /* @var $wsUtil WsUtil */
                        $wsUtil = $TTParam->getItem(0);

                        if (!is_null($wsUtil)) {
                            $user->setIdSal($wsUtil->getIdSal());

                            $this->user_infos['id_sal'] = $wsUtil->getIdSal();
                            //$this->user_infos['interface'] = serialize($token);
                        }
                    } else if ($TTRetour instanceof Notif) {
                        $this->user_infos['cntx_valid'] = false;
                        $this->user_infos['erreur'] = json_decode($TTRetour->__ShorttoString());
                    }
                } else {
                    $TTRetour = $this->ws_manager->getClientByCodCli($user->getCode());

                    if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
                        if (!is_null($TTRetour)) {
                            $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);
                            /* @var $wsClient WsClient */
                            $wsClient = $TTParam->getItem(0);

                            if (!is_null($wsClient)) {
                                $user->setIdCli($wsClient->getIdCli());
                                $user->setIdDepotCli($wsClient->getIdDep());
                                $user->setNomDepotCli($wsClient->getNomDep());
                                $user->setNoCli($wsClient->getNoCli());

                                $this->user_infos['id_cli'] = $wsClient->getIdCli();
                                $this->user_infos['id_depot'] = $wsClient->getIdDep();
                                $this->user_infos['nom_depot'] = $wsClient->getNomDep();
                                $this->user_infos['no_cli'] = $wsClient->getNoCli();
                                $this->user_infos['cod_cli'] = $wsClient->getCodCli();
                                $this->user_infos['rsoc_cli'] = $wsClient->getRSocCli();
                                $this->user_infos['codsusp_cli'] = $wsClient->getCodSuspCli();
                                $this->user_infos['causesusp_cli'] = $wsClient->getCauseSuspCli();
                                $this->user_infos['mail_adr'] = $wsClient->getMailAdr();
                                $this->user_infos['tel1_adr'] = $wsClient->getTel1Adr();
                                $this->user_infos['tel2_adr'] = $wsClient->getTel2Adr();
                                $this->user_infos['lien_bl'] = 'api/ws/bonslivraison/' . $wsClient->getIdCli() . '/client';
                                $this->user_infos['lien_cmd'] = 'api/ws/commandes/' . $wsClient->getIdCli() . '/client';
                                $this->user_infos['lien_dev'] = 'api/ws/devis/' . $wsClient->getIdCli() . '/client';
                                $this->user_infos['lien_fac'] = 'api/ws/factures/' . $wsClient->getIdCli() . '/client';
                                $this->user_infos['lien_paniers'] = 'api/paniers?user.id=' . $user->getId();
                                //$this->user_infos['interface'] = serialize($token);

                            }
                        }
                    } else if ($TTRetour instanceof Notif) {
                        $this->user_infos['cntx_valid'] = false;
                        $this->user_infos['erreur'] = json_decode($TTRetour->__ShorttoString());
                    }
                }

                return $user;
            }
            return null;
        }
        else
        {
            return null;
        }
    }

    public function getUserInfos()
    {
        return $this->user_infos;
    }
}