<?php
namespace App\EventListener;

use App\Services\Objets\WsClient;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\WsManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AuthenticationSuccessListener
 *
 */
class AuthenticationSuccessListener
{
    /**
     * @var WsManager
     */
    private $manager;

    /**
     * @param WsManager $manager
     */
    public function __construct(WsManager $manager)
    {
        $this->manager = $manager;
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

        if(!is_null($this->manager)) {
            $cntx = $this->manager->getDemarre(null, null, WsAlgorithmOpenSSL::NONE);

            $TTRetour = $this->manager->getClientByCodCli($user->getUsername());
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

        $event->setData($data);
    }

    private function hydrate($data, $user, $cntx=null, WsClient $wsClient=null) {

        if(!is_null($wsClient)) {
            $data['user'] = array(
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'fullname' => $user->getFullname(),
                'email' => $user->getEmail(),
                'last_login' => $user->getLastLogin(),
                'raison_sociale' => $user->getRaisonSociale(),
                'id_cli' => $wsClient->getIdCli(),
                'no_cli' => $wsClient->getNoCli(),
                'code_cli' => $wsClient->getCodCli(),
                'roles' => $user->getRoles(),
                'cntx_valid' => (!is_null($cntx) && $cntx->isValid()) ? true : false
            );
        }
        else {
            $data['user'] = array(
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'fullname' => $user->getFullname(),
                'email' => $user->getEmail(),
                'last_login' => $user->getLastLogin(),
                'code_client' => $user->getCodeClient(),
                'raison_sociale' => $user->getRaisonSociale(),
                'id_cli' => null,
                'no_cli' => null,
                'code_cli' => null,
                'roles' => $user->getRoles(),
                'cntx_valid' => (!is_null($cntx) && $cntx->isValid()) ? true : false
            );
        }

        return $data;
    }
}