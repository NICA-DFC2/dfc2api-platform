<?php
namespace App\EventListener;

use App\Services\Objets\CntxAdmin;
use App\Services\Objets\WsClient;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\WsManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

/**
 * AuthenticationSuccessListener
 *
 */
class AuthenticationSuccessListener
{
    /**
     * @var WsManager
     */
    private $ws_manager;

    /**
     * @param WsManager $manager
     */
    public function __construct(WsManager $manager)
    {
        $this->ws_manager = $manager;
    }

    /**
     * Add public data to the authentication response
     *
     * @param AuthenticationSuccessEvent $event
     * @param WsManager $manager
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if(!is_null($this->ws_manager)) {
            $cntx = $this->ws_manager->getDemarre(WsAlgorithmOpenSSL::NONE);

            $TTRetour = $this->ws_manager->getClientByCodCli($user->getCode());

            if(!is_null($TTRetour)) {
                $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);
                $wsClient = $TTParam->getItem(0);

                $data = $this->hydrate($data, $user, $cntx, $wsClient);
            }
            else {
                $data = $this->hydrate($data, $user, $cntx);
            }
        }
        else {
            $data = $this->hydrate($data, $user);
        }

        if($data["code"] !== 200) {
            $event->getResponse()->setStatusCode($data["code"]);
        }
        $event->setData($data);
    }

    private function hydrate($data, $user, $cntx=null, WsClient $wsClient=null) {

        $data['code'] = "503";
        $data['message'] = "Les données du client non pas pu être chargées. Demandez de l'aide à un technicien.";
        $data['user'] = array(
            'id' => null,
            'username' => null,
            'code' => null,
            'fullname' => null,
            'email' => null,
            'last_login' => null,
            'code_client' => null,
            'raison_sociale' => null,
            'id_cli' => null,
            'no_cli' => null,
            'id_depot_cli' => null,
            'nom_depot_cli' => null,
            'roles' => null,
            'cntx_valid' => false
        );

        if(!is_null($wsClient) && $cntx instanceof CntxAdmin) {
            $data['code'] = "200";
            $data['message'] = "Connexion réussie.";
            $data['user'] = array(
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'code' => $user->getCode(),
                'fullname' => $user->getFullname(),
                'email' => $user->getEmail(),
                'last_login' => $user->getLastLogin(),
                'raison_sociale' => $user->getRaisonSociale(),
                'id_cli' => $wsClient->getIdCli(),
                'no_cli' => $wsClient->getNoCli(),
                'id_depot_cli' => $wsClient->getIdDep(),
                'nom_depot_cli' => $wsClient->getNomDep(),
                'roles' => $user->getRoles(),
                'cntx_valid' => (!is_null($cntx) && $cntx->isValid()) ? true : false
            );
        }
        else {
            $data['token'] = '';
        }

        return $data;
    }
}
