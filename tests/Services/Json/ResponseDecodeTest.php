<?php

namespace App\Tests\Services\Json;

use App\Services\Json\ResponseDecode;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTParam;
use App\Services\Objets\TTRetour;
use App\Services\Objets\Notif;
use PHPUnit\Framework\TestCase;
use Unirest\Response;

class ResponseDecodeTest extends TestCase
{
    /**
     * @param $body_raw
     *
     * @dataProvider bodyRawRetourProvider
     */
    public function testDecodeRetour($body_raw) {
        // On crée un mock
        $responseDecode = $this->getMockBuilder(ResponseDecode::class)
            ->setMethods(array('getResponse'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $responseDecode->expects($this->any())
            ->method('getResponse')
            ->willReturn(new Response(200, $body_raw, ''));

        // On déroule notre code normalement
        $retour = $responseDecode->decodeRetour(array(8));

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTRetour){
            $this->assertInstanceOf(TTRetour::class, $retour, "L'objet parsé n'est pas une instance de type TTRetour:class");
        }
        else {
            $this->assertEquals(NULL, $retour, "L'objet parsé doit être NULL");
        }
    }

    /**
     * @param $body_raw
     *
     * @dataProvider bodyRawNotifProvider
     */
    public function testDecodeNotif($body_raw) {
        // On crée un mock
        $responseDecode = $this->getMockBuilder(ResponseDecode::class)
            ->setMethods(array('getResponse'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $responseDecode->expects($this->any())
            ->method('getResponse')
            ->willReturn(new Response(200, $body_raw, ''));

        // On déroule notre code normalement
        $retour = $responseDecode->decodeNotif(__FUNCTION__);

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else {
            $this->assertEquals(NULL, $retour, "L'objet parsé doit être NULL");
        }
    }

    /**
     * @param $body_raw
     *
     * @dataProvider bodyRawContextProvider
     */
    public function testDecodeContext($body_raw) {
        // On crée un mock
        $responseDecode = $this->getMockBuilder(ResponseDecode::class)
            ->setMethods(array('getResponse'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $responseDecode->expects($this->any())
            ->method('getResponse')
            ->willReturn(new Response(200, $body_raw, ''));

        // On déroule notre code normalement
        $retour = $responseDecode->decodeCntxAdmin();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof CntxAdmin) {
            $this->assertInstanceOf(CntxAdmin::class, $retour, "L'objet parsé n'est pas une instance de type CntxAdmin:class");
        }
        else {
            $this->assertEquals(NULL, $retour, "L'objet parsé doit être NULL");
        }
    }

    /**
     * @param $body_raw
     *
     * @dataProvider bodyRawParamRetourProvider
     */
    public function testDecodeParamRetour($body_raw) {
        // On crée un mock
        $responseDecode = $this->getMockBuilder(ResponseDecode::class)
            ->setMethods(array('getResponse'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $responseDecode->expects($this->any())
            ->method('getResponse')
            ->willReturn(new Response(200, $body_raw, ''));

        // On déroule notre code normalement
        $retour = $responseDecode->decodeParamRetour();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if($retour instanceof TTParam) {
            $this->assertInstanceOf(TTParam::class, $retour, "L'objet parsé n'est pas une instance de type TTParam:class");
        }
        else {
            $this->assertEquals(NULL, $retour, "L'objet parsé doit être NULL");
        }
    }

    /**
     * @param $body_raw
     *
     * @dataProvider bodyRawPrixNetProvider
     */
    public function testDecodePrixNet($body_raw) {
        // On crée un mock
        $responseDecode = $this->getMockBuilder(ResponseDecode::class)
            ->setMethods(array('getResponse'))
            ->disableOriginalConstructor()
            ->getMock();

        // On précise les attentes concernant les méthodes getCaller et getCache
        $responseDecode->expects($this->any())
            ->method('getResponse')
            ->willReturn(new Response(200, $body_raw, ''));

        // On déroule notre code normalement
        $retour = $responseDecode->decodeRetourPrixNet();

        if($retour instanceof Notif) {
            $this->assertInstanceOf(Notif::class, $retour, "L'objet parsé n'est pas une instance de type Notif:class");
        }
        else if(is_double($retour)){
            if($retour > 0){
                $this->assertEquals(19.8, $retour, "La valeur de retour doit être 19.8");
            }
            else {
                $this->assertEquals(0.0, $retour, "L'objet parsé doit être NULL");
            }
        }
        else {
            $this->assertEquals(NULL, $retour, "L'objet parsé doit être NULL");
        }
    }


    //**************************************
    //  DATAPROVIDER POUR LES TESTS
    //**************************************

    public static function bodyRawRetourProvider()
    {
        return array(
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttDepot": [{ "IdDep": 8, "IdDirDep": null, "IdCli": 5, "IdFour": 1, "IdSoc": 1, "NomDep": "MARSEILLE", "CodDep": "01-MAR", "FlgPlateformeDep": false, "FlgActifDep": true, "DateCreDep": "2004-01-15" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttCli": [{ "IdCli": 42535, "IdSal": 1, "IdSoc": 1, "RgpCli": "RESO", "NoCli": 87971, "CodCli": "TESTX99991", "RSocCli": "TESTX EVOLUBAT9", "IdDep": 0, "NomDep": null, "SiretCli": null, "SirenCli": "", "LivNonFact": 0, "IdAdr": 174829, "RSocAdr": "TESTX EVOLUBAT9", "CorpsAdr": "TESTX EVOLUBAT9", "CPAdr": "01700", "VilleAdr": "BEYNOST", "PaysAdr": "", "TypeAdr": "Livraison", "LibTypeAdr": "Livraison", "MailAdr": "", "Tel1Adr": "", "Tel2Adr": "", "FaxAdr": "", "ComCmrxCli": "", "IdCpt": 15564, "IdTC": 1, "CodTC": "00", "LibTC": "PUBLIC", "TypeCli": "V", "LibTypeCli": "VCD", "IdCliSoc": 42537, "IdCSS": 42536, "CodSuspCli": "1", "LibCodSuspCli": "Blocage apr�s limite de cr�dit", "CauseSuspCli": "", "EchRegCli": "0", "FraisFactCli": "2", "JRegCli": 0, "MRegCli": "1", "ModeReg": "R�glement par Ch�que Comptant Fin de mois", "Echeances": 0, "SectGeoCli": "00001", "LstJourLivCli": "L,M,Me,J,V", "TypeTvaCli": "01", "LibTypeTvaCli": "Soumis TVA", "NoComptaCli": "02TESTX94", "CSPCli": "01", "CSP2Cli": "A", "TypeLimiteCredit": "", "LimiteCredit": 1500, "DateLimiteCredit": "2017-01-02", "LimiteTmpCredit": 0, "DateLimiteTmpCredit": null, "MontantAssure": 0, "DateMontantAssure": "2017-01-02", "DateDebMontantAssure": "2017-01-02", "DateFinMontantAssure": "9999-12-31", "RisqueInterne": 1500, "EncoursRetard": 0, "EncoursTotal": 0, "EncoursDisponible": 1500, "EncoursCommande": 0, "CalcEncCmdCliSoc": "O", "EdPxNetCli": "1", "ComConcCli": "", "ComSfacCliSoc": "", "ComLimCliSoc": "", "ComLimComplCliSoc": "", "NumTvaCli": "", "FlgAssujettiTvaCli": false, "TypeVCDCli": "", "TypeObjCli": "Par", "DateLimFoncCli": "2017-04-02", "StrucFactCli": "0", "SocieteAssurance": false, "RelFMCli": false, "FinMoisCli": true, "DecalRegCli": "FINMOIS", "Jour1factCli": 0, "Jour2factCli": 0, "ChiffBLCli": "N", "IdTG": 43, "FlgTTCCli": false, "CodPortCli": "02", "FlgEncCmdAncCliSoc": false, "FlgFacPayCli": true, "VFrancoCli": 0, "UFrancoCli": "AUC", "TypEdtFacCli": "", "CodGroupeCli": "", "DatSuspCli": "2017-01-02", "FlgComptaCli": true, "FlgExclureAnoCli": true, "MotPasseCli": "T24S0", "MontFFCliSoc": 5 }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": [{ "IdAD": 18542, "IdArt": 4635, "IdSoc": 1, "IdDep": 8, "IdIC": 55, "NoAD": 18511, "CodAD": "BP1201M4", "DesiAutoAD": "NEWTONE Residence 1201 600x600x6", "ValNivAD": "", "StkReelAD": 37, "StkResAD": 3, "StkCmdeAD": 0, "CodGesStkAD": "02", "EtatStockAD": "06", "StockDisponible": 34, "StockDisponibleSoc": 105, "StockPratique": 34, "StkReelPlat1": 0, "QteCIDSsCFAD": 0, "UVteArt": "M2", "UStoArt": "CAR", "CvStoVteAD": 5.76, "TypCvStoVteAD": true, "NbUStoCondVteAD": 32, "PoidsUVteArt": 7.29, "NbUVteUCondVte": 184.32, "PrixPubUCondVte": 5960.9088, "PrixNetUCondVte": 3649.536, "NbUStoUVte": 0, "NbUVteUSto": 0, "ValEcoTaxe": 0, "CodCatAD": "", "PrixPubCli": 0.0, "TypeTarif": "", "NbrDecArt": 0, "LongAD": 0, "LargAD": 0, "EpaisAD": 0, "CondVteAD": "PALET 32 CARTON", "FlgDecondAD": true, "Desi2Art": "CARTON DE 16 PNX SOIT 5,76m2-ARMSTRONG-", "PrixNet": 19.8, "PrixPubAD": 32.34, "PrixRevConvAD": 13.2, "PrixRevReelAD": 13.2, "CoefPRRAD": 2.45, "CoefPRCAD": 2.45, "MargeReelleAD": 59.19, "MargeConvAD": 59.19, "IdFour": 9, "NomDep": "MARSEILLE", "CodSuspAD": "N", "MultimediaArt": "", "ComTechAD": "", "DocLie": "", "GenCodAD": "", "CodEcoTaxeAD": "", "MtEcoTaxe": "NE PAS SUPPRIMER", "IdDepPlat": 0, "IdADF": 3969144, "CodADF": "1201M4", "GenCod1ADF": "", "GenCod2ADF": "" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": [{ "IdAD": 18542, "IdArt": 4635, "IdSoc": 1, "IdDep": 8, "IdIC": 55, "NoAD": 18511, "CodAD": "BP1201M4", "DesiAutoAD": "NEWTONE Residence 1201 600x600x6", "ValNivAD": "", "StkReelAD": 37, "StkResAD": 3, "StkCmdeAD": 0, "CodGesStkAD": "02", "EtatStockAD": "06", "StockDisponible": 34, "StockDisponibleSoc": 105, "StockPratique": 34, "StkReelPlat1": 0, "QteCIDSsCFAD": 0, "UVteArt": "M2", "UStoArt": "CAR", "CvStoVteAD": 5.76, "TypCvStoVteAD": true, "NbUStoCondVteAD": 32, "PoidsUVteArt": 7.29, "NbUVteUCondVte": 184.32, "PrixPubUCondVte": 5960.9088, "PrixNetUCondVte": 3649.536, "NbUStoUVte": 0, "NbUVteUSto": 0, "ValEcoTaxe": 0, "CodCatAD": "", "PrixPubCli": 0.0, "TypeTarif": "", "NbrDecArt": 0, "LongAD": 0, "LargAD": 0, "EpaisAD": 0, "CondVteAD": "PALET 32 CARTON", "FlgDecondAD": true, "Desi2Art": "CARTON DE 16 PNX SOIT 5,76m2-ARMSTRONG-", "PrixNet": 19.8, "PrixPubAD": 32.34, "PrixRevConvAD": 13.2, "PrixRevReelAD": 13.2, "CoefPRRAD": 2.45, "CoefPRCAD": 2.45, "MargeReelleAD": 59.19, "MargeConvAD": 59.19, "IdFour": 9, "NomDep": "MARSEILLE", "CodSuspAD": "N", "MultimediaArt": "", "ComTechAD": "", "DocLie": "", "GenCodAD": "", "CodEcoTaxeAD": "", "MtEcoTaxe": "NE PAS SUPPRIMER", "IdDepPlat": 0, "IdADF": 3969144, "CodADF": "1201M4", "GenCod1ADF": "", "GenCod2ADF": "" }], "ttStock": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": [{ "IdAD": 18542, "IdArt": 4635, "IdSoc": 1, "IdDep": 8, "IdIC": 55, "NoAD": 18511, "CodAD": "BP1201M4", "DesiAutoAD": "NEWTONE Residence 1201 600x600x6", "ValNivAD": "", "StkReelAD": 37, "StkResAD": 3, "StkCmdeAD": 0, "CodGesStkAD": "02", "EtatStockAD": "06", "StockDisponible": 34, "StockDisponibleSoc": 105, "StockPratique": 34, "StkReelPlat1": 0, "QteCIDSsCFAD": 0, "UVteArt": "M2", "UStoArt": "CAR", "CvStoVteAD": 5.76, "TypCvStoVteAD": true, "NbUStoCondVteAD": 32, "PoidsUVteArt": 7.29, "NbUVteUCondVte": 184.32, "PrixPubUCondVte": 5960.9088, "PrixNetUCondVte": 3649.536, "NbUStoUVte": 0, "NbUVteUSto": 0, "ValEcoTaxe": 0, "CodCatAD": "", "PrixPubCli": 0.0, "TypeTarif": "", "NbrDecArt": 0, "LongAD": 0, "LargAD": 0, "EpaisAD": 0, "CondVteAD": "PALET 32 CARTON", "FlgDecondAD": true, "Desi2Art": "CARTON DE 16 PNX SOIT 5,76m2-ARMSTRONG-", "PrixNet": 19.8, "PrixPubAD": 32.34, "PrixRevConvAD": 13.2, "PrixRevReelAD": 13.2, "CoefPRRAD": 2.45, "CoefPRCAD": 2.45, "MargeReelleAD": 59.19, "MargeConvAD": 59.19, "IdFour": 9, "NomDep": "MARSEILLE", "CodSuspAD": "N", "MultimediaArt": "", "ComTechAD": "", "DocLie": "", "GenCodAD": "", "CodEcoTaxeAD": "", "MtEcoTaxe": "NE PAS SUPPRIMER", "IdDepPlat": 0, "IdADF": 3969144, "CodADF": "1201M4", "GenCod1ADF": "", "GenCod2ADF": "" }], "ttStock": [{ "IdAD": 18542, "IdArt": 4635, "IdSoc": 1, "IdDep": 8, "IdIC": 0, "NoAD": 18511, "CodAD": "BP1201M4", "DesiAutoAD": "NEWTONE Residence 1201 600x600x6", "ValNivAD": "", "StkReelAD": 37, "StkResAD": 3, "StkCmdeAD": 0, "CodGesStkAD": "02", "EtatStockAD": "06", "StockDisponible": 34, "StockDisponibleSoc": 105, "StockPratique": 34, "StkReelPlat1": 0, "QteCIDSsCFAD": 0, "UVteArt": "M2", "UStoArt": "CAR", "CvStoVteAD": 5.76, "TypCvStoVteAD": true, "NbUStoCondVteAD": 32, "PoidsUVteArt": 7.29, "NbUVteUCondVte": 0, "PrixPubUCondVte": 0, "PrixNetUCondVte": 0 }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": [], "ttStock": [{ "IdAD": 18542, "IdArt": 4635, "IdSoc": 1, "IdDep": 8, "IdIC": 0, "NoAD": 18511, "CodAD": "BP1201M4", "DesiAutoAD": "NEWTONE Residence 1201 600x600x6", "ValNivAD": "", "StkReelAD": 37, "StkResAD": 3, "StkCmdeAD": 0, "CodGesStkAD": "02", "EtatStockAD": "06", "StockDisponible": 34, "StockDisponibleSoc": 105, "StockPratique": 34, "StkReelPlat1": 0, "QteCIDSsCFAD": 0, "UVteArt": "M2", "UStoArt": "CAR", "CvStoVteAD": 5.76, "TypCvStoVteAD": true, "NbUStoCondVteAD": 32, "PoidsUVteArt": 7.29, "NbUVteUCondVte": 0, "PrixPubUCondVte": 0, "PrixNetUCondVte": 0 }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": [], "ttStock": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttFacCliAtt": [{ "IdFCA": 1, "IdFac": 999999, "IdSoc": 1, "IdDep": 0, "IdCli": 999999, "IdSal": 999, "NoFacFCA": 999999, "DateFacFCA": "2013-03-26", "DateRegFCA": "2013-03-31", "DateFinRisqueFCA": "2013-04-10", "DateRegleFCA": null, "MontTotTtcFCA": 216.28, "ResteDuFCA": 216.28, "LibFCA": "Facture TEST SA", "LibSocFCA": null, "TypeFCA": "Fac", "MRegFCA": "2", "CodAcceptFCA": "0", "CodDepartFCA": "", "CodImpFCA": "R", "CodLitFCA": "0", "CodReseauFCA": "0", "NbRelFCA": 0, "LettrageFCA": "", "AnnotFCA": "", "NbJoursRetard": 0 }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttDocumEnt": [{ "FamDocDE": "", "IdDE": 0, "IdDocDE": 0, "NumDE": 0, "DateDE": "", "IdSoc": 0, "EtatDE": "", "TypeDE": "", "RefDE": "", "MontTTCDE": 0, "MontHTDE": 0, "ComDE": "", "AnnotDE": "", "FlgValidDE": false, "MotsClesAutoDE": "", "EchRegDE": "", "FinMoisDE": false, "DecalRegDE": "", "JRegDE": 0, "MRegDE": "", "FlgTTCDE": false, "RemDE": 0, "TypeTvaDE": "", "IdDepCre": 0, "IdDepLiv": 0, "CodDepCre": "", "CodDepLiv": "", "CodPortDE": "", "IdCam": 0, "CodCam": "", "LibCam": "", "DateCreDE": "", "HeureCreDE": 0, "DateModDE": "", "IdDUCre": 0, "IdDUMod": 0, "MontTvaDE": 0, "MontTgapDE": 0, "MontParafDE": 0, "MontHTApRemDE": 0, "MontTvaApRemDE": 0, "MontParafApRemDE": 0, "MontTTCApRemDE": 0, "MontHTMarDE": 0, "MontRevReMarDE": 0, "MontRevConvMarDE": 0, "MontEcoTaxeDE": 0, "MontHTAvecPortDE": 0, "MontRevReDE": 0, "MontRevConvDE": 0, "TotPoidsDE": 0, "ComLivDE": "", "ZoneLivDE": "", "FlgTva2DE": false, "TotRegDE": 0, "MontHTExtDE": 0, "MontTVAExtDE": 0, "MontTTCExtDE": 0, "DateRegDE": "", "RSocDE": "", "DateHeureEditDE": "", "CodRgpt": "", "HASH": "", "IdCli": 0, "NoCli": 0, "CodCli": "", "NoComptaCli": "", "RSocCli": "", "RSocLivDE": "", "AdrLivDE": "", "CPLivDE": "", "VilleLivDE": "", "PaysLivDE": "", "TelLivDE": "", "FaxLivDE": "", "MailLivDE": "", "RSocFacDE": "", "AdrFacDE": "", "CPFacDE": "", "VilleFacDE": "", "PaysFacDE": "", "TelFacDE": "", "FaxFacDE": "", "MailFacDE": "", "IdSalVend": 0, "CodSalVend": "", "IdSalRep": 0, "CodSalRep": "", "IdCha": 0, "CodCha": "", "LibCha": "", "AdrCha": "", "CPCha": "", "VilleCha": "", "MontPortDE": 0, "DateLivDE": "", "IdTC": 0, "PrisParDE": "", "DateReacDE": "", "FlgPFDE": false, "CodOrigDE": "", "DateCloDE": "", "DateRelDE": "", "IdSalRel": 0, "NatDE": "", "DateRealDE": "", "DateFacDE": "", "CodTvaDE": "", "BaseHTDE": "", "BaseTvaDE": "", "BaseTgapDE": "", "BaseParafDE": "", "MontTgapTableDE": "", "MontParafTableDE": "", "MontTvaTableDE": "" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttDocumEnt": [{ "FamDocDE": "", "IdDE": 0, "IdDocDE": 0, "NumDE": 0, "DateDE": "", "IdSoc": 0, "EtatDE": "", "TypeDE": "", "RefDE": "", "MontTTCDE": 0, "MontHTDE": 0, "ComDE": "", "AnnotDE": "", "FlgValidDE": false, "MotsClesAutoDE": "", "EchRegDE": "", "FinMoisDE": false, "DecalRegDE": "", "JRegDE": 0, "MRegDE": "", "FlgTTCDE": false, "RemDE": 0, "TypeTvaDE": "", "IdDepCre": 0, "IdDepLiv": 0, "CodDepCre": "", "CodDepLiv": "", "CodPortDE": "", "IdCam": 0, "CodCam": "", "LibCam": "", "DateCreDE": "", "HeureCreDE": 0, "DateModDE": "", "IdDUCre": 0, "IdDUMod": 0, "MontTvaDE": 0, "MontTgapDE": 0, "MontParafDE": 0, "MontHTApRemDE": 0, "MontTvaApRemDE": 0, "MontParafApRemDE": 0, "MontTTCApRemDE": 0, "MontHTMarDE": 0, "MontRevReMarDE": 0, "MontRevConvMarDE": 0, "MontEcoTaxeDE": 0, "MontHTAvecPortDE": 0, "MontRevReDE": 0, "MontRevConvDE": 0, "TotPoidsDE": 0, "ComLivDE": "", "ZoneLivDE": "", "FlgTva2DE": false, "TotRegDE": 0, "MontHTExtDE": 0, "MontTVAExtDE": 0, "MontTTCExtDE": 0, "DateRegDE": "", "RSocDE": "", "DateHeureEditDE": "", "CodRgpt": "", "HASH": "", "IdCli": 0, "NoCli": 0, "CodCli": "", "NoComptaCli": "", "RSocCli": "", "RSocLivDE": "", "AdrLivDE": "", "CPLivDE": "", "VilleLivDE": "", "PaysLivDE": "", "TelLivDE": "", "FaxLivDE": "", "MailLivDE": "", "RSocFacDE": "", "AdrFacDE": "", "CPFacDE": "", "VilleFacDE": "", "PaysFacDE": "", "TelFacDE": "", "FaxFacDE": "", "MailFacDE": "", "IdSalVend": 0, "CodSalVend": "", "IdSalRep": 0, "CodSalRep": "", "IdCha": 0, "CodCha": "", "LibCha": "", "AdrCha": "", "CPCha": "", "VilleCha": "", "MontPortDE": 0, "DateLivDE": "", "IdTC": 0, "PrisParDE": "", "DateReacDE": "", "FlgPFDE": false, "CodOrigDE": "", "DateCloDE": "", "DateRelDE": "", "IdSalRel": 0, "NatDE": "", "DateRealDE": "", "DateFacDE": "", "CodTvaDE": "", "BaseHTDE": "", "BaseTvaDE": "", "BaseTgapDE": "", "BaseParafDE": "", "MontTgapTableDE": "", "MontParafTableDE": "", "MontTvaTableDE": "" }, "ttDocumLig": [{ "CodParafDL": "", "CondVteDL": "", "TypeLongDL": "", "MontEcoTaxeDL": 0, "PrixTTCDL": 0, "MontRevConvDL": 0, "MontRevReDL": 0, "MontHTAvecPortDL": 0, "IdTar": 0, "IdTarPre": 0, "TypeTarDL": "", "CodMethDL": "", "TypeSeuTarDL": "", "PRCAutoDL": 0, "PRRAutoDL": 0, "PrixTarDL": 0, "IdTarComp": 0, "IdTarComp2": 0, "IdCas": 0, "RemValDL": 0, "PrixPubDL": 0, "CoefDL": 0, "Remise1DL": 0, "Remise2DL": 0, "Remise3DL": 0, "ComModPRDL": "", "DateModPRDL": "", "IdUModPRDL": 0, "PrixPortDL": 0, "MargConvDL": 0, "CvVteVteDL": 0, "GrpTarSeuDL": "", "MargReelDL": 0, "NbUStoCondVteDL": 0, "TypCvStoVteDL": "", "CvStoVteDL": "", "EpaisDL": 0, "LongDL": 0, "LargDL": 0, "IdEch": 0, "IdPort": 0, "TypePRDL": "", "VolUAchDL": 0, "PoidsUAchDL": 0, "CodDevDL": "", "NbDecPrixRevDL": 0, "NbDecPrixRendDL": 0, "NbDecPDepDL": 0, "NbDecPNetDL": 0, "PrixRevReelDL": 0.0, "PrixRevConvDL": 0.0, "PrixNetReelDL": 0.0, "PrixNetConvDL": 0.0, "PrixDepReelDL": 0.0, "PrixDepConvDL": 0.0, "PrixAchDL": 0.0, "PrixAchDevDL": 0.0, "CvAchVteDL": "", "TypCvAchVteDL": "", "UAchDL": "", "CodTVADL": "", "EtatDL": "", "IdDep": 0, "IdTC": 0, "DateModDL": "2004-01-15", "NbUAchDL": 0, "IdFour": 0, "IdExtDL": 0, "ComDL": "", "UVteDL": "", "NbUVteDL": 0, "PrixNetDL": 0.0, "MontTTCDL": 0.0, "IdDL": 1, "IdDE": 1, "IdDocDL": 2445041, "IdDocDE": 289205, "IdDocSecDE": 0, "IdAD": 19815, "NumDL": 1, "NbUStoDL": 1, "UStoDL": "CAR", "MontHTDL": 33.81, "CodEcoTaxeDL": "", "CodTgapDL": "", "PoidsUVteDL": 3.5, "MontTVADL": 6.76, "MontTgapDL": 0, "MontParafDL": 0, "NbUCondDL": 0.028, "FlgBonniDL": false, "TypeQteDL": "S", "IdPTA": 0, "IdCel": 0, "MontTTCComDL": 0, "MontHTComDL": 0, "NbUVteComDL": 0, "FlgVarDL": false, "NbUStoComDL": 0, "IdTA": 1, "NoAD": 20593, "CodAD": "BP704M4", "CodADDL": "BP704M4", "RefDL": "TEGULAR CORTEGA 704 600x600CART 5.76", "DesignationAD": "TEGULAR CORTEGA 704 600x600CART 5.76", "Desi2Art": "CARTON DE 16 PNX SOIT 5,76m2-ARMSTRONG-", "HASH": "", "TypePrixDL": "T", "ComCel": "" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttDocumLig": [{ "CodParafDL": "", "CondVteDL": "", "TypeLongDL": "", "MontEcoTaxeDL": 0, "PrixTTCDL": 0, "MontRevConvDL": 0, "MontRevReDL": 0, "MontHTAvecPortDL": 0, "IdTar": 0, "IdTarPre": 0, "TypeTarDL": "", "CodMethDL": "", "TypeSeuTarDL": "", "PRCAutoDL": 0, "PRRAutoDL": 0, "PrixTarDL": 0, "IdTarComp": 0, "IdTarComp2": 0, "IdCas": 0, "RemValDL": 0, "PrixPubDL": 0, "CoefDL": 0, "Remise1DL": 0, "Remise2DL": 0, "Remise3DL": 0, "ComModPRDL": "", "DateModPRDL": "", "IdUModPRDL": 0, "PrixPortDL": 0, "MargConvDL": 0, "CvVteVteDL": 0, "GrpTarSeuDL": "", "MargReelDL": 0, "NbUStoCondVteDL": 0, "TypCvStoVteDL": "", "CvStoVteDL": "", "EpaisDL": 0, "LongDL": 0, "LargDL": 0, "IdEch": 0, "IdPort": 0, "TypePRDL": "", "VolUAchDL": 0, "PoidsUAchDL": 0, "CodDevDL": "", "NbDecPrixRevDL": 0, "NbDecPrixRendDL": 0, "NbDecPDepDL": 0, "NbDecPNetDL": 0, "PrixRevReelDL": 0.0, "PrixRevConvDL": 0.0, "PrixNetReelDL": 0.0, "PrixNetConvDL": 0.0, "PrixDepReelDL": 0.0, "PrixDepConvDL": 0.0, "PrixAchDL": 0.0, "PrixAchDevDL": 0.0, "CvAchVteDL": "", "TypCvAchVteDL": "", "UAchDL": "", "CodTVADL": "", "EtatDL": "", "IdDep": 0, "IdTC": 0, "DateModDL": "2004-01-15", "NbUAchDL": 0, "IdFour": 0, "IdExtDL": 0, "ComDL": "", "UVteDL": "", "NbUVteDL": 0, "PrixNetDL": 0.0, "MontTTCDL": 0.0, "IdDL": 1, "IdDE": 1, "IdDocDL": 2445041, "IdDocDE": 289205, "IdDocSecDE": 0, "IdAD": 19815, "NumDL": 1, "NbUStoDL": 1, "UStoDL": "CAR", "MontHTDL": 33.81, "CodEcoTaxeDL": "", "CodTgapDL": "", "PoidsUVteDL": 3.5, "MontTVADL": 6.76, "MontTgapDL": 0, "MontParafDL": 0, "NbUCondDL": 0.028, "FlgBonniDL": false, "TypeQteDL": "S", "IdPTA": 0, "IdCel": 0, "MontTTCComDL": 0, "MontHTComDL": 0, "NbUVteComDL": 0, "FlgVarDL": false, "NbUStoComDL": 0, "IdTA": 1, "NoAD": 20593, "CodAD": "BP704M4", "CodADDL": "BP704M4", "RefDL": "TEGULAR CORTEGA 704 600x600CART 5.76", "DesignationAD": "TEGULAR CORTEGA 704 600x600CART 5.76", "Desi2Art": "CARTON DE 16 PNX SOIT 5,76m2-ARMSTRONG-", "HASH": "", "TypePrixDL": "T", "ComCel": "" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttEdition": [{ "IdEdi": 1, "IdDocDE": 713514, "TypeEdi": "PDF", "LienEdi": "", "LienLocalEdi": "", "DataEdi": "JVBERi0xLjIgCiXi48\/TIAoxIDAg" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttSal": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttLib": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttLib": [{ "FamLIB": "TypeCC", "CodLIB": "C", "CodGimLib": "CPT", "LibLIB": "Vente comptant", "RgpLib": "RESO" }, { "FamLIB": "TypeCC", "CodLIB": "Dep", "CodGimLib": "DEP", "LibLIB": "Transfert Dépot", "RgpLib": "RESO" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}}}}')
        );
    }

    public static function bodyRawPrixNetProvider()
    {
        return array(
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": [{ "IdAD": 18542, "IdArt": 4635, "IdSoc": 1, "IdDep": 8, "IdIC": 55, "NoAD": 18511, "CodAD": "BP1201M4", "DesiAutoAD": "NEWTONE Residence 1201 600x600x6", "ValNivAD": "", "StkReelAD": 37, "StkResAD": 3, "StkCmdeAD": 0, "CodGesStkAD": "02", "EtatStockAD": "06", "StockDisponible": 34, "StockDisponibleSoc": 105, "StockPratique": 34, "StkReelPlat1": 0, "QteCIDSsCFAD": 0, "UVteArt": "M2", "UStoArt": "CAR", "CvStoVteAD": 5.76, "TypCvStoVteAD": true, "NbUStoCondVteAD": 32, "PoidsUVteArt": 7.29, "NbUVteUCondVte": 184.32, "PrixPubUCondVte": 5960.9088, "PrixNetUCondVte": 3649.536, "NbUStoUVte": 0, "NbUVteUSto": 0, "ValEcoTaxe": 0, "CodCatAD": "", "PrixPubCli": 0.0, "TypeTarif": "", "NbrDecArt": 0, "LongAD": 0, "LargAD": 0, "EpaisAD": 0, "CondVteAD": "PALET 32 CARTON", "FlgDecondAD": true, "Desi2Art": "CARTON DE 16 PNX SOIT 5,76m2-ARMSTRONG-", "PrixNet": 19.8, "PrixPubAD": 32.34, "PrixRevConvAD": 13.2, "PrixRevReelAD": 13.2, "CoefPRRAD": 2.45, "CoefPRCAD": 2.45, "MargeReelleAD": 59.19, "MargeConvAD": 59.19, "IdFour": 9, "NomDep": "MARSEILLE", "CodSuspAD": "N", "MultimediaArt": "", "ComTechAD": "", "DocLie": "", "GenCodAD": "", "CodEcoTaxeAD": "", "MtEcoTaxe": "NE PAS SUPPRIMER", "IdDepPlat": 0, "IdADF": 3969144, "CodADF": "1201M4", "GenCod1ADF": "", "GenCod2ADF": "" }]}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttArtDet": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}}}}')
        );
    }

    public static function bodyRawNotifProvider()
    {
        return array(
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{"ttParam": [{ "Metier": "CntxNv", "Texte": "Connection refusée", "Titre": "Login", "Type": "ERREUR" }, { "Code": "DemarreNvApiM_ErrNewCntxNv", "Metier": "DemarreNvApiM", "Mode": "Controle", "Texte": "Création ou restauration du contexte de session impossible", "Titre": "Login", "Type": "ERREUR"}
]}},"pojDSRetour": {"ProDataSet": {"ttDepot": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttCli": []}}}}')
        );
    }

    public static function bodyRawParamRetourProvider()
    {
        return array(
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{"ttParam": [{ "Metier": "CntxNv", "Texte": "Connection refusée", "Titre": "Login", "Type": "ERREUR" }, { "Code": "DemarreNvApiM_ErrNewCntxNv", "Metier": "DemarreNvApiM", "Mode": "Controle", "Texte": "Création ou restauration du contexte de session impossible", "Titre": "Login", "Type": "ERREUR"}
]}},"pojDSRetour": {"ProDataSet": {"ttDepot": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttCli": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttCli": []}}}}')
        );
    }

    public static function bodyRawContextProvider()
    {
        return array(
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{"ttParam": [ { "IdentAppliCli": "123", "IdCais": "172", "IdAdr": "172692", "IdCli": "3413", "IdDep": "9", "IdSal": "81", "IdSession": "2457484038733701562", "IdSoc": "1", "IdU": "123", "Valid": "04/04/2016 11:45:35.828+02:00" } ]}},"pojDSParamRetour": {"ProDataSet":{"ttParam": [{ "FamPar": "", "NomPar": "RowIdEnrSuiv", "IndPar": 1, "ValPar": "0x00000000004b9712" }]}},"pojDSNotif": {"ProDataSet":{"ttParam": [{ "Metier": "CntxNv", "Texte": "Connection refusée", "Titre": "Login", "Type": "ERREUR" }, { "Code": "DemarreNvApiM_ErrNewCntxNv", "Metier": "DemarreNvApiM", "Mode": "Controle", "Texte": "Création ou restauration du contexte de session impossible", "Titre": "Login", "Type": "ERREUR"}
]}},"pojDSRetour": {"ProDataSet": {"ttDepot": []}}}}'),
            array('{"response": {"pojDSCntxClient": {"ProDataSet":{}},"pojDSParamRetour": {"ProDataSet":{}},"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttCli": []}}}}'),
            array('{"response": {"pojDSNotif": {"ProDataSet":{}},"pojDSRetour": {"ProDataSet": {"ttCli": []}}}}')
        );
    }
}