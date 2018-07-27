<?php

namespace App\Tests\Services;

use App\Entity\User;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsParameters;
use App\Services\Request\CallerService;
use App\Services\WsManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Simple\FilesystemCache;

class WsManagerTest extends TestCase
{
    public function testConstructor() {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('__construct'))
            ->setConstructorArgs(array('titi', 'toto'))
            ->getMock();

        $this->assertEquals('titi', $manager->getWsAdminUser(), "La methode getWsAdminUser() ne retourne pas la valeur attendue");
        $this->assertEquals('toto', $manager->getWsAdminPassword(), "La methode getWsAdminPassword() ne retourne pas la valeur attendue");
        $this->assertInstanceOf(CallerService::class, $manager->getCaller(), "L'objet parsé n'est pas une instance de type CallerService:class");
    }

    /**
     * @param $algorithmeOpenSSL
     *
     * @dataProvider algorithmesOpenSSLProvider
     */
    public function testGetDemarre($algorithmeOpenSSL)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        // On déroule notre code normalement
        $retour = $manager->getDemarre($algorithmeOpenSSL);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(CntxAdmin::class, $retour, "L'objet parsé n'est pas une instance de type CntxAdmin:class");
        }
    }


    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetClientWithUser($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getClient();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTRetour){
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
        else {
            $this->assertEquals('{}', $retour, "La réponse attendue n'est pas celle souhaitée");
        }
    }

    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetClientByIdCli($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getClientByIdCli($user->getIdCli());

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetClientByCodCli($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getClientByCodCli($user->getCode());

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetClientByNoCli($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getClientByNoCli($user->getNoCli());

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    /**
     * @param $id_rep
     *
     * @dataProvider representantProvider
     */
    public function testGetClientsWithRep($id_rep)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getClientsWithRep($id_rep);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetClients($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getClientByNoCli('1234');

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $depots
     *
     * @dataProvider depotsProvider
     */
    public function testGetArticles($depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticles($depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $depots
     *
     * @dataProvider userAndDepotsProvider
     */
    public function testGetArticlesWithClient($user, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticlesWithClient($depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $depots
     *
     * @dataProvider userAndDepotsProvider
     */
    public function testGetArticleWithClientByNoAD($user, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleWithClientByNoAD($user->getIdCli(),34880, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $depots
     *
     * @dataProvider userAndDepotsProvider
     */
    public function testGetArticleWithClientByIdAD($user, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleWithClientByIdAD($user->getIdCli(),34880, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $depots
     *
     * @dataProvider userAndDepotsProvider
     */
    public function testGetArticleWithClientByCodAD($user, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleWithClientByCodAD($user->getIdCli(),'GTPS139B', $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $depots
     *
     * @dataProvider userAndDepotsProvider
     */
    public function testGetArticleWithClientByIdArt($user, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleWithClientByIdArt($user->getIdCli(),270949, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    /**
     * @param $user
     * @param $prixnet
     * @param $depots
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByNoAD($user, $prixnet, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleByNoAD(34880, $prixnet, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $prixnet
     * @param $depots
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByIdAD($user, $prixnet, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleByIdAD(34880, $prixnet, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $prixnet
     * @param $depots
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByCodAD($user, $prixnet, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleByCodAD('GTPS139B', $prixnet, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    /**
     * @param $user
     * @param $prixnet
     * @param $depots
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByIdArt($user, $prixnet, $depots)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getArticleByIdArt(270949, $prixnet, $depots);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetDocuments()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($this->getUserFilled());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getDocuments(WsParameters::TYPE_PRENDRE_DEVIS, WsParameters::FORMAT_DOCUMENT_ENT);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetFacturesEnAttentes()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($this->getUserFilled());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getFacturesEnAttentes();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    public function testGetFactureEnAttente()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($this->getUserFilled());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getFactureEnAttente(1234);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetEdition()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getEdition(123556, WsParameters::TYPE_PRENDRE_EDITION_DEVIS);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetDepots()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getDepots();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    public function testGetDepot()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getDepot(1);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetLibelles()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getLibelles();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetFournisseurs()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getFournisseurs();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetCategories()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getCategories();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    public function testGetInstancesCategories()
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getInstsCats();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetContacts($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn(new CallerService());

        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        // On déroule notre code normalement
        $retour = $manager->getContacts($user->getIdCli());

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }


    //**************************************
    //  DATAPROVIDER POUR LES TESTS
    //**************************************

    public static function representantProvider()
    {
        return array(
            array(array(0)),
            array(array(187))
        );
    }

    public static function userAndDepotsProvider()
    {
        $userEmpty = new User();
        $userEmpty->setCode('');
        $userEmpty->setEmail('');
        $userEmpty->setFullname('');
        $userEmpty->setIdCli(0);
        $userEmpty->setIdDepotCli(-1);
        $userEmpty->setNoCli(-1);
        $userEmpty->setNomDepotCli('');
        $userEmpty->setRaisonSociale('');
        $userEmpty->setUsername('');

        $userFilled = new User();
        $userFilled->setCode('PERSO124');
        $userFilled->setEmail('test@test.com');
        $userFilled->setFullname('test test');
        $userFilled->setIdCli(56610);
        $userFilled->setIdDepotCli(5);
        $userFilled->setNoCli(3850);
        $userFilled->setNomDepotCli('VERTOU');
        $userFilled->setRaisonSociale('test');
        $userFilled->setUsername('NICA');

        return array(
            array($userFilled, false, array()),
            array($userFilled, true, array(1, 5)),
            array($userEmpty, false, array()),
            array($userEmpty, true, array(1, 5))
        );
    }

    public static function depotsProvider()
    {
        return array(
            array(array()),
            array(array(1, 5))
        );
    }

    public static function algorithmesOpenSSLProvider()
    {
        return array(
            array(''),
            array(WsAlgorithmOpenSSL::NONE),
            array(WsAlgorithmOpenSSL::RSAES_OAEP),
            array(WsAlgorithmOpenSSL::RSASSA_PKCS1_v1_5)
        );
    }

    public static function usersProvider()
    {
        $userEmpty = new User();
        $userEmpty->setCode('');
        $userEmpty->setEmail('');
        $userEmpty->setFullname('');
        $userEmpty->setIdCli(0);
        $userEmpty->setIdDepotCli(-1);
        $userEmpty->setNoCli(-1);
        $userEmpty->setNomDepotCli('');
        $userEmpty->setRaisonSociale('');
        $userEmpty->setUsername('');

        $userFilled = new User();
        $userFilled->setCode('PERSO124');
        $userFilled->setEmail('test@test.com');
        $userFilled->setFullname('test test');
        $userFilled->setIdCli(56610);
        $userFilled->setIdDepotCli(5);
        $userFilled->setNoCli(3850);
        $userFilled->setNomDepotCli('VERTOU');
        $userFilled->setRaisonSociale('test');
        $userFilled->setUsername('NICA');

        return array(
            array($userEmpty),
            array($userFilled)
        );
    }

    public static function stocksProvider()
    {
        $userEmpty = new User();
        $userEmpty->setCode('');
        $userEmpty->setEmail('');
        $userEmpty->setFullname('');
        $userEmpty->setIdCli(0);
        $userEmpty->setIdDepotCli(-1);
        $userEmpty->setNoCli(-1);
        $userEmpty->setNomDepotCli('');
        $userEmpty->setRaisonSociale('');
        $userEmpty->setUsername('');

        $userFilled = new User();
        $userFilled->setCode('PERSO124');
        $userFilled->setEmail('test@test.com');
        $userFilled->setFullname('test test');
        $userFilled->setIdCli(56610);
        $userFilled->setIdDepotCli(5);
        $userFilled->setNoCli(3850);
        $userFilled->setNomDepotCli('VERTOU');
        $userFilled->setRaisonSociale('test');
        $userFilled->setUsername('NICA');

        $userFilledDepLogi = new User();
        $userFilledDepLogi->setCode('PERSO124');
        $userFilledDepLogi->setEmail('test@test.com');
        $userFilledDepLogi->setFullname('test test');
        $userFilledDepLogi->setIdCli(56610);
        $userFilledDepLogi->setIdDepotCli(1);
        $userFilledDepLogi->setNoCli(3850);
        $userFilledDepLogi->setNomDepotCli('VERTOU');
        $userFilledDepLogi->setRaisonSociale('test');
        $userFilledDepLogi->setUsername('NICA');

        return array(
            array($userFilled, false, array()),
            array($userFilled, true, array(1, 5)),
            array($userEmpty, false, array()),
            array($userEmpty, true, array(1, 5)),
            array($userFilledDepLogi, false, array()),
            array($userFilledDepLogi, true, array(1, 5))
        );
    }


    //**************************************
    //  METHODES PRIVATE POUR LES TESTS
    //**************************************

    private function getUserFilled() {
        $userFilled = new User();
        $userFilled->setCode('PERSO124');
        $userFilled->setEmail('test@test.com');
        $userFilled->setFullname('test test');
        $userFilled->setIdCli(56610);
        $userFilled->setIdDepotCli(5);
        $userFilled->setNoCli(3850);
        $userFilled->setNomDepotCli('VERTOU');
        $userFilled->setRaisonSociale('test');
        $userFilled->setUsername('NICA');

        return $userFilled;
    }

}