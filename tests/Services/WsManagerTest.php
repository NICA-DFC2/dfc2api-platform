<?php

namespace App\Tests\Services;

use App\Entity\User;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\Notif;
use App\Services\Objets\TTParam;
use App\Services\Objets\TTRetour;
use App\Services\Objets\WsDepot;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsParameters;
use App\Services\Request\CallerService;
use App\Services\WsManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Unirest\Response;

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

        $caller = $this->getMockBuilder(CallerService::class)
            ->setMethods(array('get'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        $response = new Response(200,
            '{"response":{"pojDSCntxClient":"{\"ProDataSet\":{\"ttParam\":[{\"IdCais\":\"7\",\"IdDep\":\"5\",\"IdentAppliCli\":\"\",\"IdSal\":\"986\",\"IdSession\":\"2458335053865014656\",\"IdSoc\":\"1\",\"IdU\":\"544\",\"Valid\":\"03/08/2018 16:39:53.314+02:00\"}]}}","pojDSParamRetour":"{\"ProDataSet\":{\"ttParam\":[{\"FamPar\":\"\",\"NomPar\":\"RowIdEnrSuiv\",\"IndPar\":1,\"ValPar\":null}]}}","pojDSNotif":"{\"ProDataSet\":{}}","pojDSRetour":"{\"ProDataSet\":{\"ttCli\":[{\"IdCli\":56610,\"IdSal\":55,\"IdSoc\":1,\"RgpCli\":\"DFC2\",\"NoCli\":3850,\"CodCli\":\"PERSO124\",\"RSocCli\":\"NICOLAS CARTIER\",\"IdDep\":1,\"NomDep\":\"VERTOU\",\"SiretCli\":\"\",\"SirenCli\":\"\",\"LivNonFact\":0.0,\"DateHeureModCli\":\"2018-06-29T23:17:24.696+02:00\",\"IdAdr\":23414,\"RSocAdr\":\"NICOLAS CARTIER\",\"CorpsAdr\":\"5 ALLEE DE LA CASTILLE\",\"CPAdr\":\"44190\",\"VilleAdr\":\"GORGES\",\"PaysAdr\":\"\",\"TypeAdr\":\"Livraison\",\"LibTypeAdr\":\"Livraison\",\"MailAdr\":\"n.cartier@dfc2.biz\",\"Tel1Adr\":\"\",\"Tel2Adr\":\"0633521481\",\"FaxAdr\":\"\",\"ComCmrxCli\":\"\",\"RespAdr\":\"\",\"PrenomAdr\":\"\",\"IdCpt\":19339,\"IdTC\":624,\"CodTC\":\"T027\",\"LibTC\":\"T027 - PERSONNEL\",\"TypeCli\":\"R\",\"LibTypeCli\":\"Relevé\",\"IdCliSoc\":56612,\"IdCSS\":56611,\"CodSuspCli\":\"3\",\"LibCodSuspCli\":\"Suspendu (sauf vente comptant)\",\"CauseSuspCli\":\"\",\"EchRegCli\":\"0\",\"FraisFacturation\":\"0\",\"JRegCli\":0,\"MRegCli\":\"1\",\"ModeReg\":\"Règlement par Chèque Comptant Fin de mois\",\"Echeances\":0.0,\"SectGeoCli\":\"44SE\",\"LstJourLivCli\":\"L,M,Me,J,V\",\"TypeTvaCli\":\"01\",\"LibTypeTvaCli\":\"Soumis TVA\",\"NoComptaCli\":\"00PERSO124\",\"CSPCli\":\"\",\"CSP2Cli\":\"A\",\"TypeLimiteCredit\":\"AMT\",\"LimiteCredit\":1000.0,\"DateLimiteCredit\":\"2018-06-27\",\"LimiteTmpCredit\":0.0,\"DateLimiteTmpCredit\":null,\"MontantAssure\":7000.0,\"DateMontantAssure\":\"2016-10-21\",\"DateDebMontantAssure\":\"2016-10-21\",\"DateFinMontantAssure\":\"9999-12-31\",\"LimComplCliSoc\":0.0,\"TypeLimComplCliSoc\":\"\",\"DatLimComplCliSoc\":null,\"DatDebComplCliSoc\":null,\"DatFinComplCliSoc\":null,\"RisqueInterne\":-6000.0,\"EncoursRetard\":0.0,\"EncoursTotal\":0.0,\"EncoursDisponible\":1000.0,\"EncoursCommande\":0.0,\"CalcEncCmdCliSoc\":\"O\",\"EdPxNetCli\":\"1\",\"ComConcCli\":\"\",\"ComSfacCliSoc\":\"\",\"ComLimCliSoc\":\"\",\"ComLimComplCliSoc\":\"\",\"NumTvaCli\":\"\",\"FlgAssujettiTvaCli\":true,\"TypeVCDCli\":\"\",\"TypeObjCli\":\"Aucun\",\"DateLimFoncCli\":\"2012-11-06\",\"StrucFactCli\":\"0\",\"SocieteAssurance\":true,\"RelFMCli\":false,\"FinMoisCli\":false,\"DecalRegCli\":\"AUCUN\",\"Jour1factCli\":0,\"Jour2factCli\":0,\"ChiffBLCli\":\"N\",\"IdTG\":0,\"FlgTTCCli\":false,\"CodPortCli\":\"02\",\"FlgEncCmdAncCliSoc\":false,\"FlgFacPayCli\":true,\"VFrancoCli\":0.0,\"UFrancoCli\":\"AUC\",\"TypEdtFacCli\":\"\",\"CodGroupeCli\":\"\",\"DatSuspCli\":\"2018-06-27\",\"FlgComptaCli\":true,\"FlgExclureAnoCli\":false,\"MotPasseCli\":\"\",\"MontFFCliSoc\":0.0,\"MotsClesAutoCli\":\" NICOLAS CARTIER PERSO124 44190 GORGES 1IDDEP CHPETATRETARDCLI1CHPAUCUN CHPETATRETARDCLICHPAUCUN 55IDSAL CHPFLGRELANCECLICHPNON 0IDSALREL !§!\",\"EtatRetardCli\":\"Aucun\",\"FlgRelanceCli\":false,\"IdSalRel\":0}]}}"}}'
            , null);

        $caller->expects($this->any())
            ->method('get')
            ->willReturn($response);

        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn($caller);

        // On déroule notre code normalement
        $retour = $manager->getClient();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTRetour){
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
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

        $caller = $this->getMockBuilder(CallerService::class)
            ->setMethods(array('get'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        $response = new Response(200,
            '{"response":{"pojDSCntxClient":"{\"ProDataSet\":{\"ttParam\":[{\"IdCais\":\"7\",\"IdDep\":\"5\",\"IdentAppliCli\":\"\",\"IdSal\":\"986\",\"IdSession\":\"2458335053865014656\",\"IdSoc\":\"1\",\"IdU\":\"544\",\"Valid\":\"03/08/2018 16:39:53.314+02:00\"}]}}","pojDSParamRetour":"{\"ProDataSet\":{\"ttParam\":[{\"FamPar\":\"\",\"NomPar\":\"RowIdEnrSuiv\",\"IndPar\":1,\"ValPar\":null}]}}","pojDSNotif":"{\"ProDataSet\":{}}","pojDSRetour":"{\"ProDataSet\":{\"ttCli\":[{\"IdCli\":56610,\"IdSal\":55,\"IdSoc\":1,\"RgpCli\":\"DFC2\",\"NoCli\":3850,\"CodCli\":\"PERSO124\",\"RSocCli\":\"NICOLAS CARTIER\",\"IdDep\":1,\"NomDep\":\"VERTOU\",\"SiretCli\":\"\",\"SirenCli\":\"\",\"LivNonFact\":0.0,\"DateHeureModCli\":\"2018-06-29T23:17:24.696+02:00\",\"IdAdr\":23414,\"RSocAdr\":\"NICOLAS CARTIER\",\"CorpsAdr\":\"5 ALLEE DE LA CASTILLE\",\"CPAdr\":\"44190\",\"VilleAdr\":\"GORGES\",\"PaysAdr\":\"\",\"TypeAdr\":\"Livraison\",\"LibTypeAdr\":\"Livraison\",\"MailAdr\":\"n.cartier@dfc2.biz\",\"Tel1Adr\":\"\",\"Tel2Adr\":\"0633521481\",\"FaxAdr\":\"\",\"ComCmrxCli\":\"\",\"RespAdr\":\"\",\"PrenomAdr\":\"\",\"IdCpt\":19339,\"IdTC\":624,\"CodTC\":\"T027\",\"LibTC\":\"T027 - PERSONNEL\",\"TypeCli\":\"R\",\"LibTypeCli\":\"Relevé\",\"IdCliSoc\":56612,\"IdCSS\":56611,\"CodSuspCli\":\"3\",\"LibCodSuspCli\":\"Suspendu (sauf vente comptant)\",\"CauseSuspCli\":\"\",\"EchRegCli\":\"0\",\"FraisFacturation\":\"0\",\"JRegCli\":0,\"MRegCli\":\"1\",\"ModeReg\":\"Règlement par Chèque Comptant Fin de mois\",\"Echeances\":0.0,\"SectGeoCli\":\"44SE\",\"LstJourLivCli\":\"L,M,Me,J,V\",\"TypeTvaCli\":\"01\",\"LibTypeTvaCli\":\"Soumis TVA\",\"NoComptaCli\":\"00PERSO124\",\"CSPCli\":\"\",\"CSP2Cli\":\"A\",\"TypeLimiteCredit\":\"AMT\",\"LimiteCredit\":1000.0,\"DateLimiteCredit\":\"2018-06-27\",\"LimiteTmpCredit\":0.0,\"DateLimiteTmpCredit\":null,\"MontantAssure\":7000.0,\"DateMontantAssure\":\"2016-10-21\",\"DateDebMontantAssure\":\"2016-10-21\",\"DateFinMontantAssure\":\"9999-12-31\",\"LimComplCliSoc\":0.0,\"TypeLimComplCliSoc\":\"\",\"DatLimComplCliSoc\":null,\"DatDebComplCliSoc\":null,\"DatFinComplCliSoc\":null,\"RisqueInterne\":-6000.0,\"EncoursRetard\":0.0,\"EncoursTotal\":0.0,\"EncoursDisponible\":1000.0,\"EncoursCommande\":0.0,\"CalcEncCmdCliSoc\":\"O\",\"EdPxNetCli\":\"1\",\"ComConcCli\":\"\",\"ComSfacCliSoc\":\"\",\"ComLimCliSoc\":\"\",\"ComLimComplCliSoc\":\"\",\"NumTvaCli\":\"\",\"FlgAssujettiTvaCli\":true,\"TypeVCDCli\":\"\",\"TypeObjCli\":\"Aucun\",\"DateLimFoncCli\":\"2012-11-06\",\"StrucFactCli\":\"0\",\"SocieteAssurance\":true,\"RelFMCli\":false,\"FinMoisCli\":false,\"DecalRegCli\":\"AUCUN\",\"Jour1factCli\":0,\"Jour2factCli\":0,\"ChiffBLCli\":\"N\",\"IdTG\":0,\"FlgTTCCli\":false,\"CodPortCli\":\"02\",\"FlgEncCmdAncCliSoc\":false,\"FlgFacPayCli\":true,\"VFrancoCli\":0.0,\"UFrancoCli\":\"AUC\",\"TypEdtFacCli\":\"\",\"CodGroupeCli\":\"\",\"DatSuspCli\":\"2018-06-27\",\"FlgComptaCli\":true,\"FlgExclureAnoCli\":false,\"MotPasseCli\":\"\",\"MontFFCliSoc\":0.0,\"MotsClesAutoCli\":\" NICOLAS CARTIER PERSO124 44190 GORGES 1IDDEP CHPETATRETARDCLI1CHPAUCUN CHPETATRETARDCLICHPAUCUN 55IDSAL CHPFLGRELANCECLICHPNON 0IDSALREL !§!\",\"EtatRetardCli\":\"Aucun\",\"FlgRelanceCli\":false,\"IdSalRel\":0}]}}"}}'
            , null);

        $caller->expects($this->any())
            ->method('get')
            ->willReturn($response);

        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn($caller);

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

        $caller = $this->getMockBuilder(CallerService::class)
            ->setMethods(array('get'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        $response = new Response(200,
            '{"response":{"pojDSCntxClient":"{\"ProDataSet\":{\"ttParam\":[{\"IdCais\":\"7\",\"IdDep\":\"5\",\"IdentAppliCli\":\"\",\"IdSal\":\"986\",\"IdSession\":\"2458335053865014656\",\"IdSoc\":\"1\",\"IdU\":\"544\",\"Valid\":\"03/08/2018 16:39:53.314+02:00\"}]}}","pojDSParamRetour":"{\"ProDataSet\":{\"ttParam\":[{\"FamPar\":\"\",\"NomPar\":\"RowIdEnrSuiv\",\"IndPar\":1,\"ValPar\":null}]}}","pojDSNotif":"{\"ProDataSet\":{}}","pojDSRetour":"{\"ProDataSet\":{\"ttCli\":[{\"IdCli\":56610,\"IdSal\":55,\"IdSoc\":1,\"RgpCli\":\"DFC2\",\"NoCli\":3850,\"CodCli\":\"PERSO124\",\"RSocCli\":\"NICOLAS CARTIER\",\"IdDep\":1,\"NomDep\":\"VERTOU\",\"SiretCli\":\"\",\"SirenCli\":\"\",\"LivNonFact\":0.0,\"DateHeureModCli\":\"2018-06-29T23:17:24.696+02:00\",\"IdAdr\":23414,\"RSocAdr\":\"NICOLAS CARTIER\",\"CorpsAdr\":\"5 ALLEE DE LA CASTILLE\",\"CPAdr\":\"44190\",\"VilleAdr\":\"GORGES\",\"PaysAdr\":\"\",\"TypeAdr\":\"Livraison\",\"LibTypeAdr\":\"Livraison\",\"MailAdr\":\"n.cartier@dfc2.biz\",\"Tel1Adr\":\"\",\"Tel2Adr\":\"0633521481\",\"FaxAdr\":\"\",\"ComCmrxCli\":\"\",\"RespAdr\":\"\",\"PrenomAdr\":\"\",\"IdCpt\":19339,\"IdTC\":624,\"CodTC\":\"T027\",\"LibTC\":\"T027 - PERSONNEL\",\"TypeCli\":\"R\",\"LibTypeCli\":\"Relevé\",\"IdCliSoc\":56612,\"IdCSS\":56611,\"CodSuspCli\":\"3\",\"LibCodSuspCli\":\"Suspendu (sauf vente comptant)\",\"CauseSuspCli\":\"\",\"EchRegCli\":\"0\",\"FraisFacturation\":\"0\",\"JRegCli\":0,\"MRegCli\":\"1\",\"ModeReg\":\"Règlement par Chèque Comptant Fin de mois\",\"Echeances\":0.0,\"SectGeoCli\":\"44SE\",\"LstJourLivCli\":\"L,M,Me,J,V\",\"TypeTvaCli\":\"01\",\"LibTypeTvaCli\":\"Soumis TVA\",\"NoComptaCli\":\"00PERSO124\",\"CSPCli\":\"\",\"CSP2Cli\":\"A\",\"TypeLimiteCredit\":\"AMT\",\"LimiteCredit\":1000.0,\"DateLimiteCredit\":\"2018-06-27\",\"LimiteTmpCredit\":0.0,\"DateLimiteTmpCredit\":null,\"MontantAssure\":7000.0,\"DateMontantAssure\":\"2016-10-21\",\"DateDebMontantAssure\":\"2016-10-21\",\"DateFinMontantAssure\":\"9999-12-31\",\"LimComplCliSoc\":0.0,\"TypeLimComplCliSoc\":\"\",\"DatLimComplCliSoc\":null,\"DatDebComplCliSoc\":null,\"DatFinComplCliSoc\":null,\"RisqueInterne\":-6000.0,\"EncoursRetard\":0.0,\"EncoursTotal\":0.0,\"EncoursDisponible\":1000.0,\"EncoursCommande\":0.0,\"CalcEncCmdCliSoc\":\"O\",\"EdPxNetCli\":\"1\",\"ComConcCli\":\"\",\"ComSfacCliSoc\":\"\",\"ComLimCliSoc\":\"\",\"ComLimComplCliSoc\":\"\",\"NumTvaCli\":\"\",\"FlgAssujettiTvaCli\":true,\"TypeVCDCli\":\"\",\"TypeObjCli\":\"Aucun\",\"DateLimFoncCli\":\"2012-11-06\",\"StrucFactCli\":\"0\",\"SocieteAssurance\":true,\"RelFMCli\":false,\"FinMoisCli\":false,\"DecalRegCli\":\"AUCUN\",\"Jour1factCli\":0,\"Jour2factCli\":0,\"ChiffBLCli\":\"N\",\"IdTG\":0,\"FlgTTCCli\":false,\"CodPortCli\":\"02\",\"FlgEncCmdAncCliSoc\":false,\"FlgFacPayCli\":true,\"VFrancoCli\":0.0,\"UFrancoCli\":\"AUC\",\"TypEdtFacCli\":\"\",\"CodGroupeCli\":\"\",\"DatSuspCli\":\"2018-06-27\",\"FlgComptaCli\":true,\"FlgExclureAnoCli\":false,\"MotPasseCli\":\"\",\"MontFFCliSoc\":0.0,\"MotsClesAutoCli\":\" NICOLAS CARTIER PERSO124 44190 GORGES 1IDDEP CHPETATRETARDCLI1CHPAUCUN CHPETATRETARDCLICHPAUCUN 55IDSAL CHPFLGRELANCECLICHPNON 0IDSALREL !§!\",\"EtatRetardCli\":\"Aucun\",\"FlgRelanceCli\":false,\"IdSalRel\":0}]}}"}}'
            , null);

        $caller->expects($this->any())
            ->method('get')
            ->willReturn($response);

        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn($caller);

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

        $caller = $this->getMockBuilder(CallerService::class)
            ->setMethods(array('get'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        $response = new Response(200,
            '{"response":{"pojDSCntxClient":"{\"ProDataSet\":{\"ttParam\":[{\"IdCais\":\"7\",\"IdDep\":\"5\",\"IdentAppliCli\":\"\",\"IdSal\":\"986\",\"IdSession\":\"2458335053865014656\",\"IdSoc\":\"1\",\"IdU\":\"544\",\"Valid\":\"03/08/2018 16:39:53.314+02:00\"}]}}","pojDSParamRetour":"{\"ProDataSet\":{\"ttParam\":[{\"FamPar\":\"\",\"NomPar\":\"RowIdEnrSuiv\",\"IndPar\":1,\"ValPar\":null}]}}","pojDSNotif":"{\"ProDataSet\":{}}","pojDSRetour":"{\"ProDataSet\":{\"ttCli\":[{\"IdCli\":56610,\"IdSal\":55,\"IdSoc\":1,\"RgpCli\":\"DFC2\",\"NoCli\":3850,\"CodCli\":\"PERSO124\",\"RSocCli\":\"NICOLAS CARTIER\",\"IdDep\":1,\"NomDep\":\"VERTOU\",\"SiretCli\":\"\",\"SirenCli\":\"\",\"LivNonFact\":0.0,\"DateHeureModCli\":\"2018-06-29T23:17:24.696+02:00\",\"IdAdr\":23414,\"RSocAdr\":\"NICOLAS CARTIER\",\"CorpsAdr\":\"5 ALLEE DE LA CASTILLE\",\"CPAdr\":\"44190\",\"VilleAdr\":\"GORGES\",\"PaysAdr\":\"\",\"TypeAdr\":\"Livraison\",\"LibTypeAdr\":\"Livraison\",\"MailAdr\":\"n.cartier@dfc2.biz\",\"Tel1Adr\":\"\",\"Tel2Adr\":\"0633521481\",\"FaxAdr\":\"\",\"ComCmrxCli\":\"\",\"RespAdr\":\"\",\"PrenomAdr\":\"\",\"IdCpt\":19339,\"IdTC\":624,\"CodTC\":\"T027\",\"LibTC\":\"T027 - PERSONNEL\",\"TypeCli\":\"R\",\"LibTypeCli\":\"Relevé\",\"IdCliSoc\":56612,\"IdCSS\":56611,\"CodSuspCli\":\"3\",\"LibCodSuspCli\":\"Suspendu (sauf vente comptant)\",\"CauseSuspCli\":\"\",\"EchRegCli\":\"0\",\"FraisFacturation\":\"0\",\"JRegCli\":0,\"MRegCli\":\"1\",\"ModeReg\":\"Règlement par Chèque Comptant Fin de mois\",\"Echeances\":0.0,\"SectGeoCli\":\"44SE\",\"LstJourLivCli\":\"L,M,Me,J,V\",\"TypeTvaCli\":\"01\",\"LibTypeTvaCli\":\"Soumis TVA\",\"NoComptaCli\":\"00PERSO124\",\"CSPCli\":\"\",\"CSP2Cli\":\"A\",\"TypeLimiteCredit\":\"AMT\",\"LimiteCredit\":1000.0,\"DateLimiteCredit\":\"2018-06-27\",\"LimiteTmpCredit\":0.0,\"DateLimiteTmpCredit\":null,\"MontantAssure\":7000.0,\"DateMontantAssure\":\"2016-10-21\",\"DateDebMontantAssure\":\"2016-10-21\",\"DateFinMontantAssure\":\"9999-12-31\",\"LimComplCliSoc\":0.0,\"TypeLimComplCliSoc\":\"\",\"DatLimComplCliSoc\":null,\"DatDebComplCliSoc\":null,\"DatFinComplCliSoc\":null,\"RisqueInterne\":-6000.0,\"EncoursRetard\":0.0,\"EncoursTotal\":0.0,\"EncoursDisponible\":1000.0,\"EncoursCommande\":0.0,\"CalcEncCmdCliSoc\":\"O\",\"EdPxNetCli\":\"1\",\"ComConcCli\":\"\",\"ComSfacCliSoc\":\"\",\"ComLimCliSoc\":\"\",\"ComLimComplCliSoc\":\"\",\"NumTvaCli\":\"\",\"FlgAssujettiTvaCli\":true,\"TypeVCDCli\":\"\",\"TypeObjCli\":\"Aucun\",\"DateLimFoncCli\":\"2012-11-06\",\"StrucFactCli\":\"0\",\"SocieteAssurance\":true,\"RelFMCli\":false,\"FinMoisCli\":false,\"DecalRegCli\":\"AUCUN\",\"Jour1factCli\":0,\"Jour2factCli\":0,\"ChiffBLCli\":\"N\",\"IdTG\":0,\"FlgTTCCli\":false,\"CodPortCli\":\"02\",\"FlgEncCmdAncCliSoc\":false,\"FlgFacPayCli\":true,\"VFrancoCli\":0.0,\"UFrancoCli\":\"AUC\",\"TypEdtFacCli\":\"\",\"CodGroupeCli\":\"\",\"DatSuspCli\":\"2018-06-27\",\"FlgComptaCli\":true,\"FlgExclureAnoCli\":false,\"MotPasseCli\":\"\",\"MontFFCliSoc\":0.0,\"MotsClesAutoCli\":\" NICOLAS CARTIER PERSO124 44190 GORGES 1IDDEP CHPETATRETARDCLI1CHPAUCUN CHPETATRETARDCLICHPAUCUN 55IDSAL CHPFLGRELANCECLICHPNON 0IDSALREL !§!\",\"EtatRetardCli\":\"Aucun\",\"FlgRelanceCli\":false,\"IdSalRel\":0}]}}"}}'
            , null);

        $caller->expects($this->any())
            ->method('get')
            ->willReturn($response);

        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn($caller);

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
     * @param $user
     *
     * @dataProvider representantProvider
     */
    public function testGetClientsWithRep($user)
    {
        // On crée un mock
        $manager = $this->getMockBuilder(WsManager::class)
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre'))
            ->disableOriginalConstructor()
            ->getMock();

        $caller = $this->getMockBuilder(CallerService::class)
            ->setMethods(array('get'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $manager->expects($this->any())
            ->method('getCache')
            ->willReturn(new FilesystemCache());

        $manager->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $manager->expects($this->any())
            ->method('getDemarre')
            ->willReturn(new CntxAdmin('7','5','','986','2458319032855713246','1','544','18/07/2018 10:07:35.599 02:00'));

        $response = new Response(200,
            '{"response":{"pojDSCntxClient":"{\"ProDataSet\":{\"ttParam\":[{\"IdCais\":\"7\",\"IdDep\":\"5\",\"IdentAppliCli\":\"\",\"IdSal\":\"986\",\"IdSession\":\"2458335053865014656\",\"IdSoc\":\"1\",\"IdU\":\"544\",\"Valid\":\"03/08/2018 16:39:53.314+02:00\"}]}}","pojDSParamRetour":"{\"ProDataSet\":{\"ttParam\":[{\"FamPar\":\"\",\"NomPar\":\"RowIdEnrSuiv\",\"IndPar\":1,\"ValPar\":null}]}}","pojDSNotif":"{\"ProDataSet\":{}}","pojDSRetour":"{\"ProDataSet\":{\"ttCli\":[{\"IdCli\":56610,\"IdSal\":55,\"IdSoc\":1,\"RgpCli\":\"DFC2\",\"NoCli\":3850,\"CodCli\":\"PERSO124\",\"RSocCli\":\"NICOLAS CARTIER\",\"IdDep\":1,\"NomDep\":\"VERTOU\",\"SiretCli\":\"\",\"SirenCli\":\"\",\"LivNonFact\":0.0,\"DateHeureModCli\":\"2018-06-29T23:17:24.696+02:00\",\"IdAdr\":23414,\"RSocAdr\":\"NICOLAS CARTIER\",\"CorpsAdr\":\"5 ALLEE DE LA CASTILLE\",\"CPAdr\":\"44190\",\"VilleAdr\":\"GORGES\",\"PaysAdr\":\"\",\"TypeAdr\":\"Livraison\",\"LibTypeAdr\":\"Livraison\",\"MailAdr\":\"n.cartier@dfc2.biz\",\"Tel1Adr\":\"\",\"Tel2Adr\":\"0633521481\",\"FaxAdr\":\"\",\"ComCmrxCli\":\"\",\"RespAdr\":\"\",\"PrenomAdr\":\"\",\"IdCpt\":19339,\"IdTC\":624,\"CodTC\":\"T027\",\"LibTC\":\"T027 - PERSONNEL\",\"TypeCli\":\"R\",\"LibTypeCli\":\"Relevé\",\"IdCliSoc\":56612,\"IdCSS\":56611,\"CodSuspCli\":\"3\",\"LibCodSuspCli\":\"Suspendu (sauf vente comptant)\",\"CauseSuspCli\":\"\",\"EchRegCli\":\"0\",\"FraisFacturation\":\"0\",\"JRegCli\":0,\"MRegCli\":\"1\",\"ModeReg\":\"Règlement par Chèque Comptant Fin de mois\",\"Echeances\":0.0,\"SectGeoCli\":\"44SE\",\"LstJourLivCli\":\"L,M,Me,J,V\",\"TypeTvaCli\":\"01\",\"LibTypeTvaCli\":\"Soumis TVA\",\"NoComptaCli\":\"00PERSO124\",\"CSPCli\":\"\",\"CSP2Cli\":\"A\",\"TypeLimiteCredit\":\"AMT\",\"LimiteCredit\":1000.0,\"DateLimiteCredit\":\"2018-06-27\",\"LimiteTmpCredit\":0.0,\"DateLimiteTmpCredit\":null,\"MontantAssure\":7000.0,\"DateMontantAssure\":\"2016-10-21\",\"DateDebMontantAssure\":\"2016-10-21\",\"DateFinMontantAssure\":\"9999-12-31\",\"LimComplCliSoc\":0.0,\"TypeLimComplCliSoc\":\"\",\"DatLimComplCliSoc\":null,\"DatDebComplCliSoc\":null,\"DatFinComplCliSoc\":null,\"RisqueInterne\":-6000.0,\"EncoursRetard\":0.0,\"EncoursTotal\":0.0,\"EncoursDisponible\":1000.0,\"EncoursCommande\":0.0,\"CalcEncCmdCliSoc\":\"O\",\"EdPxNetCli\":\"1\",\"ComConcCli\":\"\",\"ComSfacCliSoc\":\"\",\"ComLimCliSoc\":\"\",\"ComLimComplCliSoc\":\"\",\"NumTvaCli\":\"\",\"FlgAssujettiTvaCli\":true,\"TypeVCDCli\":\"\",\"TypeObjCli\":\"Aucun\",\"DateLimFoncCli\":\"2012-11-06\",\"StrucFactCli\":\"0\",\"SocieteAssurance\":true,\"RelFMCli\":false,\"FinMoisCli\":false,\"DecalRegCli\":\"AUCUN\",\"Jour1factCli\":0,\"Jour2factCli\":0,\"ChiffBLCli\":\"N\",\"IdTG\":0,\"FlgTTCCli\":false,\"CodPortCli\":\"02\",\"FlgEncCmdAncCliSoc\":false,\"FlgFacPayCli\":true,\"VFrancoCli\":0.0,\"UFrancoCli\":\"AUC\",\"TypEdtFacCli\":\"\",\"CodGroupeCli\":\"\",\"DatSuspCli\":\"2018-06-27\",\"FlgComptaCli\":true,\"FlgExclureAnoCli\":false,\"MotPasseCli\":\"\",\"MontFFCliSoc\":0.0,\"MotsClesAutoCli\":\" NICOLAS CARTIER PERSO124 44190 GORGES 1IDDEP CHPETATRETARDCLI1CHPAUCUN CHPETATRETARDCLICHPAUCUN 55IDSAL CHPFLGRELANCECLICHPNON 0IDSALREL !§!\",\"EtatRetardCli\":\"Aucun\",\"FlgRelanceCli\":false,\"IdSalRel\":0}]}}"}}'
            , null);

        $caller->expects($this->any())
            ->method('get')
            ->willReturn($response);

        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn($caller);

        // On déroule notre code normalement
        $retour = $manager->getClientsWithRep();

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

        $caller = $this->getMockBuilder(CallerService::class)
            ->setMethods(array('get'))
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

        $response = new Response(200,
            '{"response":{"pojDSCntxClient":"{\"ProDataSet\":{\"ttParam\":[{\"IdCais\":\"7\",\"IdDep\":\"5\",\"IdentAppliCli\":\"\",\"IdSal\":\"986\",\"IdSession\":\"2458335053865014656\",\"IdSoc\":\"1\",\"IdU\":\"544\",\"Valid\":\"03/08/2018 16:39:53.314+02:00\"}]}}","pojDSParamRetour":"{\"ProDataSet\":{\"ttParam\":[{\"FamPar\":\"\",\"NomPar\":\"RowIdEnrSuiv\",\"IndPar\":1,\"ValPar\":null}]}}","pojDSNotif":"{\"ProDataSet\":{}}","pojDSRetour":"{\"ProDataSet\":{\"ttCli\":[{\"IdCli\":56610,\"IdSal\":55,\"IdSoc\":1,\"RgpCli\":\"DFC2\",\"NoCli\":3850,\"CodCli\":\"PERSO124\",\"RSocCli\":\"NICOLAS CARTIER\",\"IdDep\":1,\"NomDep\":\"VERTOU\",\"SiretCli\":\"\",\"SirenCli\":\"\",\"LivNonFact\":0.0,\"DateHeureModCli\":\"2018-06-29T23:17:24.696+02:00\",\"IdAdr\":23414,\"RSocAdr\":\"NICOLAS CARTIER\",\"CorpsAdr\":\"5 ALLEE DE LA CASTILLE\",\"CPAdr\":\"44190\",\"VilleAdr\":\"GORGES\",\"PaysAdr\":\"\",\"TypeAdr\":\"Livraison\",\"LibTypeAdr\":\"Livraison\",\"MailAdr\":\"n.cartier@dfc2.biz\",\"Tel1Adr\":\"\",\"Tel2Adr\":\"0633521481\",\"FaxAdr\":\"\",\"ComCmrxCli\":\"\",\"RespAdr\":\"\",\"PrenomAdr\":\"\",\"IdCpt\":19339,\"IdTC\":624,\"CodTC\":\"T027\",\"LibTC\":\"T027 - PERSONNEL\",\"TypeCli\":\"R\",\"LibTypeCli\":\"Relevé\",\"IdCliSoc\":56612,\"IdCSS\":56611,\"CodSuspCli\":\"3\",\"LibCodSuspCli\":\"Suspendu (sauf vente comptant)\",\"CauseSuspCli\":\"\",\"EchRegCli\":\"0\",\"FraisFacturation\":\"0\",\"JRegCli\":0,\"MRegCli\":\"1\",\"ModeReg\":\"Règlement par Chèque Comptant Fin de mois\",\"Echeances\":0.0,\"SectGeoCli\":\"44SE\",\"LstJourLivCli\":\"L,M,Me,J,V\",\"TypeTvaCli\":\"01\",\"LibTypeTvaCli\":\"Soumis TVA\",\"NoComptaCli\":\"00PERSO124\",\"CSPCli\":\"\",\"CSP2Cli\":\"A\",\"TypeLimiteCredit\":\"AMT\",\"LimiteCredit\":1000.0,\"DateLimiteCredit\":\"2018-06-27\",\"LimiteTmpCredit\":0.0,\"DateLimiteTmpCredit\":null,\"MontantAssure\":7000.0,\"DateMontantAssure\":\"2016-10-21\",\"DateDebMontantAssure\":\"2016-10-21\",\"DateFinMontantAssure\":\"9999-12-31\",\"LimComplCliSoc\":0.0,\"TypeLimComplCliSoc\":\"\",\"DatLimComplCliSoc\":null,\"DatDebComplCliSoc\":null,\"DatFinComplCliSoc\":null,\"RisqueInterne\":-6000.0,\"EncoursRetard\":0.0,\"EncoursTotal\":0.0,\"EncoursDisponible\":1000.0,\"EncoursCommande\":0.0,\"CalcEncCmdCliSoc\":\"O\",\"EdPxNetCli\":\"1\",\"ComConcCli\":\"\",\"ComSfacCliSoc\":\"\",\"ComLimCliSoc\":\"\",\"ComLimComplCliSoc\":\"\",\"NumTvaCli\":\"\",\"FlgAssujettiTvaCli\":true,\"TypeVCDCli\":\"\",\"TypeObjCli\":\"Aucun\",\"DateLimFoncCli\":\"2012-11-06\",\"StrucFactCli\":\"0\",\"SocieteAssurance\":true,\"RelFMCli\":false,\"FinMoisCli\":false,\"DecalRegCli\":\"AUCUN\",\"Jour1factCli\":0,\"Jour2factCli\":0,\"ChiffBLCli\":\"N\",\"IdTG\":0,\"FlgTTCCli\":false,\"CodPortCli\":\"02\",\"FlgEncCmdAncCliSoc\":false,\"FlgFacPayCli\":true,\"VFrancoCli\":0.0,\"UFrancoCli\":\"AUC\",\"TypEdtFacCli\":\"\",\"CodGroupeCli\":\"\",\"DatSuspCli\":\"2018-06-27\",\"FlgComptaCli\":true,\"FlgExclureAnoCli\":false,\"MotPasseCli\":\"\",\"MontFFCliSoc\":0.0,\"MotsClesAutoCli\":\" NICOLAS CARTIER PERSO124 44190 GORGES 1IDDEP CHPETATRETARDCLI1CHPAUCUN CHPETATRETARDCLICHPAUCUN 55IDSAL CHPFLGRELANCECLICHPNON 0IDSALREL !§!\",\"EtatRetardCli\":\"Aucun\",\"FlgRelanceCli\":false,\"IdSalRel\":0}]}}"}}'
            , null);

        $caller->expects($this->any())
            ->method('get')
            ->willReturn($response);

        $manager->expects($this->any())
            ->method('getCaller')
            ->willReturn($caller);

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();


        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
            ->setMethods(array('getCaller', 'getCache', 'getUser', 'getDemarre', 'setDepotsClass'))
            ->disableOriginalConstructor()
            ->getMock();

        $manager->expects($this->any())
            ->method('setDepotsClass')
            ->with($this->getDepotWS());

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
        $userEmpty = new User();
        $userEmpty->setCode('');
        $userEmpty->setEmail('');
        $userEmpty->setFullname('');
        $userEmpty->setIdCli(0);
        $userEmpty->setIdSal(0);
        $userEmpty->setIdDepotCli(-1);
        $userEmpty->setNoCli(-1);
        $userEmpty->setNomDepotCli('');
        $userEmpty->setRaisonSociale('');
        $userEmpty->setUsername('');

        $userFilled = new User();
        $userFilled->setCode('PERSO124');
        $userFilled->setEmail('test@test.com');
        $userFilled->setFullname('test test');
        $userFilled->setIdCli(0);
        $userFilled->setIdSal(187);
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

    public function getDepotWS(){
        $depot1 = new WsDepot();
        $depot1->setCodDep("DFC² VERTOU");
        $depot1->setFlgActifDep(true);
        $depot1->setFlgPlateformeDep(false);
        $depot1->setIdDep(1);
        $depot1->setNomDep("VERTOU");

        $depot5 = new WsDepot();
        $depot5->setCodDep("DFC2P");
        $depot5->setFlgActifDep(true);
        $depot5->setFlgPlateformeDep(true);
        $depot5->setIdDep(5);
        $depot5->setNomDep("LOGISTIQUE");

        $TTParam = new TTParam();
        $TTParam->addItem($depot1);
        $TTParam->addItem($depot5);

        return $TTParam;
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