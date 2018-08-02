<?php

namespace App\Services;

use App\Entity\User;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTRetour;
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
            'roles' => null,
            'cntx_valid' => false
        ];
    }

    public function getCurrentUser()
    {
        $token = $this->tokenStorage->getToken();
        if ($token instanceof TokenInterface)
        {
            /** @var User $user */
            $user = $token->getUser();

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

            $cntx = $this->ws_manager->getDemarre(WsAlgorithmOpenSSL::NONE);

            if(in_array('ROLE_COMMERCIAL', $user->getRoles()) || in_array('ROLE_MARKET_LEADER', $user->getRoles())) {

                $TTRetour = $this->ws_manager->getUtilisateur($user);

                if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
                    $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_UTIL);
                    $wsUtil = $TTParam->getItem(0);

                    if(!is_null($wsUtil) && $cntx instanceof CntxAdmin) {
                        $user->setIdSal($wsUtil->getIdSal());

                        $this->user_infos['id_sal'] = $wsUtil->getIdSal();
                    }
                }
            }
            else {
                $TTRetour = $this->ws_manager->getClientByCodCli($user->getCode());

                if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
                    if (!is_null($TTRetour)) {
                        $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);
                        $wsClient = $TTParam->getItem(0);

                        if(!is_null($wsClient) && $cntx instanceof CntxAdmin) {
                            $user->setIdCli($wsClient->getIdCli());
                            $user->setIdDepotCli($wsClient->getIdDep());
                            $user->setNomDepotCli($wsClient->getNomDep());
                            $user->setNoCli($wsClient->getNoCli());

                            $this->user_infos['id_cli'] = $wsClient->getIdCli();
                            $this->user_infos['id_depot'] = $wsClient->getIdDep();
                            $this->user_infos['nom_depot'] = $wsClient->getNomDep();
                            $this->user_infos['no_cli'] = $wsClient->getNoCli();
                        }
                    }
                }
            }

            return $user;
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