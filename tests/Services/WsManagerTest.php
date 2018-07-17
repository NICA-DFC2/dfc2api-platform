<?php

namespace App\Services;

use App\Entity\User;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsParameters;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Cache\Simple\FilesystemCache;
use App\Services\Objets\Notif;
use Unirest;

class WsManagerTest extends WebTestCase
{

    protected $service = NULL;
    protected $user_service = NULL;
    protected $user = NULL;


    public function setUp() {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $this->service = $container->get('dfc2.api.manager');
        $this->user_service = $container->get('dfc2.user.service');
        $requestStack = $this->getMockBuilder(RequestStack::class)->getMock();
        $this->service->setRequestStack($requestStack);
        $this->createUser();

    }

    private function createUser() {
        $headers = array("Content-Type"=>"application/json",
            "Accept"=>"application/json");

        // connecter un utilisateur
        $reponse = Unirest\Request::post("http://127.0.0.1:8000/login_check", $headers, '{"username":"NICA","password":"test"}');

        $user = new User();
        $user->setCode($reponse->body->user->code);
        $user->setEmail($reponse->body->user->email);
        $user->setFullname($reponse->body->user->fullname);
        $user->setIdCli($reponse->body->user->id_cli);
        $user->setIdDepotCli($reponse->body->user->id_depot_cli);
        $user->setNoCli($reponse->body->user->no_cli);
        $user->setNomDepotCli($reponse->body->user->nom_depot_cli);
        $user->setRaisonSociale($reponse->body->user->raison_sociale);
        $user->setUsername($reponse->body->user->username);

        $this->setUser($user);
    }

    private function setUser(User $user) {
        $this->user = $user;
    }

    private function getUser() {
        return $this->user;
    }

    private function getUserEmpty() {
        $user = new User();
        $user->setCode('');
        $user->setEmail('');
        $user->setFullname('');
        $user->setIdCli(-1);
        $user->setIdDepotCli(-1);
        $user->setNoCli(-1);
        $user->setNomDepotCli('');
        $user->setRaisonSociale('');
        $user->setUsername('');
        return $user;
    }


    public function testGetDemarreWithUserExistsNotEncrypted() {
        $this->service->setCache(new FilesystemCache());
        $retour = $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);
        $this->assertInstanceOf(CntxAdmin::class, $retour, "L'objet parsé n'est pas une instance de type CntxAdmin:class");
    }

    public function testGetDemarreWithUserExistsEncrypted_RSAES_OAEP() {
        $this->service->setCache(new FilesystemCache());
        $retour = $this->service->getDemarre(WsAlgorithmOpenSSL::RSAES_OAEP);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(CntxAdmin::class, $retour, "L'objet parsé n'est pas une instance de type CntxAdmin:class");
        }
    }

    public function testGetDemarreWithUserExistsEncrypted_RSASSA_PKCS1() {
        $this->service->setCache(new FilesystemCache());
        $retour = $this->service->getDemarre(WsAlgorithmOpenSSL::RSASSA_PKCS1_v1_5);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(CntxAdmin::class, $retour, "L'objet parsé n'est pas une instance de type CntxAdmin:class");
        }
    }

    public function testGetDemarreWithUserNotExistsNotEncrypted() {
        $this->service->setCache(new FilesystemCache());
        $this->service->setWsAdminPassword('test');
        $this->service->setWsAdminUser('test');
        $retour = $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);
        $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        if($retour instanceof Notif) {
            $message = $retour->getTexte();
            $this->assertEquals("Connexion refusée. Création ou restauration du contexte de session impossible. ", $message, "Le message d'erreur n'est pas celui attendu: $message");
        }
    }

    public function testGetDemarreWithUserNotExistsEncrypted_RSAES_OAEP() {
        $this->service->setCache(new FilesystemCache());
        $this->service->setWsAdminPassword('test');
        $this->service->setWsAdminUser('test');
        $retour = $this->service->getDemarre(WsAlgorithmOpenSSL::RSAES_OAEP);
        $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        if($retour instanceof Notif) {
            $message = $retour->getTexte();
            $this->assertEquals("Connexion refusée. Création ou restauration du contexte de session impossible. ", $message, "Le message d'erreur n'est pas celui attendu: $message");
        }
    }

    public function testGetDemarreWithUserNotExistsEncrypted_RSASSA_PKCS1() {
        $this->service->setCache(new FilesystemCache());
        $this->service->setWsAdminPassword('test');
        $this->service->setWsAdminUser('test');
        $retour = $this->service->getDemarre(WsAlgorithmOpenSSL::RSASSA_PKCS1_v1_5);
        $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        if($retour instanceof Notif) {
            $message = $retour->getTexte();
            $this->assertEquals("Connexion refusée. Création ou restauration du contexte de session impossible. ", $message, "Le message d'erreur n'est pas celui attendu: $message");
        }
    }



    public function testGetClientWithNotUserExists()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $retour = $this->service->getClient();
        $this->assertEquals("{}", $retour, "La réponse n'est pas celle attendue: $retour");
    }

    public function testGetClientWithUserExistsReturn()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getClient();
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetClientByIdWithUserExistsReturn()
    {
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getClientByIdCli($this->getUser()->getIdCli());
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetClientByCodeWithUserExistsReturn()
    {
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getClientByCodCli($this->getUser()->getCode());
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetClientByNoCliWithUserExistsReturn()
    {
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getClientByNoCli($this->getUser()->getNoCli());
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }



    public function testGetPrixNetByNoADWithNotUserExists()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $prix_net = $this->service->getPrixNetByNoAD(34880);
        $this->assertEquals(0, $prix_net, "Le prix net recherché doit être égale à 0");
    }

    public function testGetPrixNetByNoADWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $prix_net = $this->service->getPrixNetByNoAD(34880);
        $this->assertNotEquals(0, $prix_net, "Le prix net recherché n'est pas valide");
    }

    public function testGetPrixNetByIdADWithNotUserExists()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $prix_net = $this->service->getPrixNetByIdAD(1255592);
        $this->assertEquals(0, $prix_net, "Le prix net recherché doit être égale à 0");
    }

    public function testGetPrixNetByIdADWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $prix_net = $this->service->getPrixNetByIdAD(1255592);
        $this->assertNotEquals(0, $prix_net, "Le prix net recherché n'est pas valide");
    }

    public function testGetPrixNetByCodADWithNotUserExists()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $prix_net = $this->service->getPrixNetByCodAD('GTPS139B');
        $this->assertEquals(0, $prix_net, "Le prix net recherché doit être égale à 0");
    }

    public function testGetPrixNetByCodADWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $prix_net = $this->service->getPrixNetByCodAD('GTPS139B');
        $this->assertNotEquals(0, $prix_net, "Le prix net recherché n'est pas valide");
    }



    public function testGetArticleByNoADWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByNoAD(34880);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");

    }

    public function testGetArticleByNoADWithUserExists_PrixNet()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByNoAD(34880, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByNoADWithUserExists_PrixNet_Logistic()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByNoAD(34880, true, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByNoADWithUserExists_PrixNet_Logistic_AgenceCli()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByNoAD(34880, true, false, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }


    public function testGetArticleByIdADWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdAD(1255592);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");

    }

    public function testGetArticleByIdADWithUserExists_PrixNet()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdAD(1255592, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByIdADWithUserExists_PrixNet_Logistic()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdAD(1255592, true, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByIdADWithUserExists_PrixNet_Logistic_AgenceCli()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdAD(1255592, true, false, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }


    public function testGetArticleByIdArtWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdArt(270949);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");

    }

    public function testGetArticleByIdArtWithUserExists_PrixNet()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdArt(270949, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByIdArtWithUserExists_PrixNet_Logistic()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdArt(270949, true, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByIdArtWithUserExists_PrixNet_Logistic_AgenceCli()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByIdArt(270949, true, false, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }


    public function testGetArticleByCodADWithUserExists()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByCodAD('GTPS139B');
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");

    }

    public function testGetArticleByCodADWithUserExists_PrixNet()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByCodAD('GTPS139B', true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByCodADWithUserExists_PrixNet_Logistic()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByCodAD('GTPS139B', true, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetArticleByCodADWithUserExists_PrixNet_Logistic_AgenceCli()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getArticleByCodAD('GTPS139B', true, false, true);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }



    public function testGetDocuments()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getDocuments(WsParameters::TYPE_PRENDRE_DEVIS, WsParameters::FORMAT_DOCUMENT_ENT);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }



    public function testGetFacturesEnAttentes()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getFacturesEnAttentes();
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetFactureEnAttente()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getFactureEnAttente(1254);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }



    public function testGetEdition()
    {
        $this->service->setUser($this->getUser());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getEdition(123556, WsParameters::TYPE_PRENDRE_EDITION_DEVIS);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }



    public function testGetDepots()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getDepots();
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }

    public function testGetDepot()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getDepot(1);
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }



    public function testGetLibelles()
    {
        $this->service->setUser($this->getUserEmpty());
        $this->service->setCache(new FilesystemCache());
        $this->service->getDemarre(WsAlgorithmOpenSSL::NONE);

        $TTRetour = $this->service->getLibelles();
        $this->assertInstanceOf(TTRetour::class, $TTRetour, "L'appel à ne retourne pas la bonne instance d'objet TTRetour::class");
    }
}
