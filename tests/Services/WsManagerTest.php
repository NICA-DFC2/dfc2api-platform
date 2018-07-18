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
    protected $user = NULL;


    public function setUp() {
    }


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

    public function testGetClientByIdCli()
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
        $retour = $manager->getClientByIdCli(1234);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    public function testGetClientByCodCli()
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
        $retour = $manager->getClientByCodCli('TEST');

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
    }

    public function testGetClientByNoCli()
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
        $retour = $manager->getClientByNoCli('1234');

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
    public function testGetPrixNetByNoADWithUser($user)
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
        $retour = $manager->getPrixNetByNoAD(34880);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTRetour){
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
        else {
            $this->assertEquals(0, $retour, "La réponse attendue n'est pas celle souhaitée");
        }
    }

    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetPrixNetByIdADWithUser($user)
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
        $retour = $manager->getPrixNetByIdAD(34880);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTRetour){
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
        else {
            $this->assertEquals(0, $retour, "La réponse attendue n'est pas celle souhaitée");
        }
    }

    /**
     * @param $user
     *
     * @dataProvider usersProvider
     */
    public function testGetPrixNetByCodADWithUser($user)
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
        $retour = $manager->getPrixNetByCodAD('GTPS139B');

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTRetour){
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
        else {
            $this->assertEquals(0, $retour, "La réponse attendue n'est pas celle souhaitée");
        }
    }


    /**
     * @param $user
     * @param $prixnet
     * @param $logistic
     * @param $logisticAndAgency
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByNoAD($user, $prixnet, $logistic, $logisticAndAgency)
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
        $retour = $manager->getArticleByNoAD(34880, $prixnet, $logistic, $logisticAndAgency);

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
     * @param $logistic
     * @param $logisticAndAgency
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByIdAD($user, $prixnet, $logistic, $logisticAndAgency)
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
        $retour = $manager->getArticleByIdAD(34880, $prixnet, $logistic, $logisticAndAgency);

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
     * @param $logistic
     * @param $logisticAndAgency
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByCodAD($user, $prixnet, $logistic, $logisticAndAgency)
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
        $retour = $manager->getArticleByCodAD('GTPS139B', $prixnet, $logistic, $logisticAndAgency);

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
     * @param $logistic
     * @param $logisticAndAgency
     *
     * @dataProvider stocksProvider
     */
    public function testGetArticleByIdArt($user, $prixnet, $logistic, $logisticAndAgency)
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
        $retour = $manager->getArticleByIdArt(270949, $prixnet, $logistic, $logisticAndAgency);

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



    //**************************************
    //  DATAPROVIDER POUR LES TESTS
    //**************************************

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
            array($userFilled, false, false, false),
            array($userFilled, true, false, false),
            array($userFilled, true, true, false),
            array($userFilled, true, false, true),
            array($userEmpty, false, false, false),
            array($userEmpty, true, false, false),
            array($userEmpty, true, true, false),
            array($userEmpty, true, false, true),
            array($userFilledDepLogi, false, false, false),
            array($userFilledDepLogi, true, false, false),
            array($userFilledDepLogi, true, true, false),
            array($userFilledDepLogi, true, false, true)
        );
    }


    //**************************************
    //  METHODES PRIVATE POUR LES TESTS
    //**************************************

    private function getUserEmpty() {
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

        return $userEmpty;
    }

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