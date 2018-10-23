<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Services\Objets\WsClient;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entité qui représente les clients. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_ws_clients_items_rep_get"},
*           "current"={"route_name"="api_ws_client_item_current_get"}
 *      }
 * )
 *
 */
class Client
{

    private $IdCli;
    private $IdSal;
    private $IdSoc;
    private $RgpCli;
    private $NoCli;
    private $CodCli;
    private $RSocCli;
    private $IdDep;
    private $NomDep;
    private $SiretCli;
    private $SirenCli;
    private $LivNonFact;
    private $IdAdr;
    private $RSocAdr;
    private $CorpsAdr;
    private $CPAdr;
    private $VilleAdr;
    private $PaysAdr;
    private $TypeAdr;
    private $LibTypeAdr;
    private $MailAdr;
    private $Tel1Adr;
    private $Tel2Adr;
    private $FaxAdr;
    private $ComCmrxCli;
    private $IdCpt;
    private $IdTC;
    private $CodTC;
    private $LibTC;
    private $TypeCli;
    private $LibTypeCli;
    private $IdCliSoc;
    private $IdCSS;
    private $CodSuspCli;
    private $LibCodSuspCli;
    private $CauseSuspCli;
    private $EchRegCli;
    private $FraisFactCli;
    private $JRegCli;
    private $MRegCli;
    private $ModeReg;
    private $Echeances;
    private $SectGeoCli;
    private $LstJourLivCli;
    private $TypeTvaCli;
    private $LibTypeTvaCli;
    private $NoComptaCli;
    private $CSPCli;
    private $CSP2Cli;
    private $TypeLimiteCredit;
    private $LimiteCredit;
    private $DateLimiteCredit;
    private $LimiteTmpCredit;
    private $DateLimiteTmpCredit;
    private $MontantAssure;
    private $DateMontantAssure;
    private $DateDebMontantAssure;
    private $DateFinMontantAssure;
    private $RisqueInterne;
    private $EncoursRetard;
    private $EncoursTotal;
    private $EncoursDisponible;
    private $EncoursCommande;
    private $CalcEncCmdCliSoc;
    private $EdPxNetCli;
    private $ComConcCli;
    private $ComSfacCliSoc;
    private $ComLimCliSoc;
    private $ComLimComplCliSoc;
    private $NumTvaCli;
    private $FlgAssujettiTvaCli;
    private $TypeVCDCli;
    private $TypeObjCli;
    private $DateLimFoncCli;
    private $StrucFactCli;
    private $SocieteAssurance;
    private $RelFMCli;
    private $FinMoisCli;
    private $DecalRegCli;
    private $Jour1factCli;
    private $Jour2factCli;
    private $ChiffBLCli;
    private $IdTG;
    private $FlgTTCCli;
    private $CodPortCli;
    private $FlgEncCmdAncCliSoc;
    private $FlgFacPayCli;
    private $VFrancoCli;
    private $UFrancoCli;
    private $TypEdtFacCli;
    private $CodGroupeCli;
    private $DatSuspCli;
    private $FlgComptaCli;
    private $FlgExclureAnoCli;
    private $MotPasseCli;
    private $MontFFCliSoc;
    
    private $LienContacts;
    private $LienDevis;
    private $LienCommandes;
    private $LienBL;
    private $LienFactures;

    private $LienNbDevisEtatE = 0;
    private $LienNbCommandesEtatE = 0;
    private $LienNbBLEtatE = 0;
    private $LienNbFacturesEtatE = 0;


    /**
     * Client constructor.
     */
    public function __construct()
    {

    }

    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsClient $json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdCli($json_object->{'IdCli'});
            $this->setIdSal($json_object->{'IdSal'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setRgpCli($json_object->{'RgpCli'});
            $this->setNoCli($json_object->{'NoCli'});
            $this->setCodCli($json_object->{'CodCli'});
            $this->setRSocCli($json_object->{'RSocCli'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setNomDep($json_object->{'NomDep'});
            $this->setSiretCli($json_object->{'SiretCli'});
            $this->setSirenCli($json_object->{'SirenCli'});
            $this->setLivNonFact($json_object->{'LivNonFact'});
            $this->setIdAdr($json_object->{'IdAdr'});
            $this->setRSocAdr($json_object->{'RSocAdr'});
            $this->setCorpsAdr($json_object->{'CorpsAdr'});
            $this->setCPAdr($json_object->{'CPAdr'});
            $this->setVilleAdr($json_object->{'VilleAdr'});
            $this->setPaysAdr($json_object->{'PaysAdr'});
            $this->setTypeAdr($json_object->{'TypeAdr'});
            $this->setLibTypeAdr($json_object->{'LibTypeAdr'});
            $this->setMailAdr($json_object->{'MailAdr'});
            $this->setTel1Adr($json_object->{'Tel1Adr'});
            $this->setTel2Adr($json_object->{'Tel2Adr'});
            $this->setFaxAdr($json_object->{'FaxAdr'});
            $this->setComCmrxCli($json_object->{'ComCmrxCli'});
            $this->setIdCpt($json_object->{'IdCpt'});
            $this->setIdTC($json_object->{'IdTC'});
            $this->setCodTC($json_object->{'CodTC'});
            $this->setLibTC($json_object->{'LibTC'});
            $this->setTypeCli($json_object->{'TypeCli'});
            $this->setLibTypeCli($json_object->{'LibTypeCli'});
            $this->setIdCliSoc($json_object->{'IdCliSoc'});
            $this->setIdCSS($json_object->{'IdCSS'});
            $this->setCodSuspCli($json_object->{'CodSuspCli'});
            $this->setLibCodSuspCli($json_object->{'LibCodSuspCli'});
            $this->setCauseSuspCli($json_object->{'CauseSuspCli'});
            $this->setEchRegCli($json_object->{'EchRegCli'});
            $this->setFraisFactCli($json_object->{'FraisFactCli'});
            $this->setJRegCli($json_object->{'JRegCli'});
            $this->setMRegCli($json_object->{'MRegCli'});
            $this->setModeReg($json_object->{'ModeReg'});
            $this->setEcheances($json_object->{'Echeances'});
            $this->setSectGeoCli($json_object->{'SectGeoCli'});
            $this->setLstJourLivCli($json_object->{'LstJourLivCli'});
            $this->setTypeTvaCli($json_object->{'TypeTvaCli'});
            $this->setLibTypeTvaCli($json_object->{'LibTypeTvaCli'});
            $this->setNoComptaCli($json_object->{'NoComptaCli'});
            $this->setCSPCli($json_object->{'CSPCli'});
            $this->setCSP2Cli($json_object->{'CSP2Cli'});
            $this->setTypeLimiteCredit($json_object->{'TypeLimiteCredit'});
            $this->setLimiteCredit($json_object->{'LimiteCredit'});
            $this->setDateLimiteCredit($json_object->{'DateLimiteCredit'});
            $this->setLimiteTmpCredit($json_object->{'LimiteTmpCredit'});
            $this->setDateLimiteTmpCredit($json_object->{'DateLimiteTmpCredit'});
            $this->setMontantAssure($json_object->{'MontantAssure'});
            $this->setDateMontantAssure($json_object->{'DateMontantAssure'});
            $this->setDateDebMontantAssure($json_object->{'DateDebMontantAssure'});
            $this->setDateFinMontantAssure($json_object->{'DateFinMontantAssure'});
            $this->setRisqueInterne($json_object->{'RisqueInterne'});
            $this->setEncoursRetard($json_object->{'EncoursRetard'});
            $this->setEncoursTotal($json_object->{'EncoursTotal'});
            $this->setEncoursDisponible($json_object->{'EncoursDisponible'});
            $this->setEncoursCommande($json_object->{'EncoursCommande'});
            $this->setCalcEncCmdCliSoc($json_object->{'CalcEncCmdCliSoc'});
            $this->setEdPxNetCli($json_object->{'EdPxNetCli'});
            $this->setComConcCli($json_object->{'ComConcCli'});
            $this->setComSfacCliSoc($json_object->{'ComSfacCliSoc'});
            $this->setComLimCliSoc($json_object->{'ComLimCliSoc'});
            $this->setComLimComplCliSoc($json_object->{'ComLimComplCliSoc'});
            $this->setNumTvaCli($json_object->{'NumTvaCli'});
            $this->setFlgAssujettiTvaCli($json_object->{'FlgAssujettiTvaCli'});
            $this->setTypeVCDCli($json_object->{'TypeVCDCli'});
            $this->setTypeObjCli($json_object->{'TypeObjCli'});
            $this->setDateLimFoncCli($json_object->{'DateLimFoncCli'});
            $this->setStrucFactCli($json_object->{'StrucFactCli'});
            $this->setSocieteAssurance($json_object->{'SocieteAssurance'});
            $this->setRelFMCli($json_object->{'RelFMCli'});
            $this->setFinMoisCli($json_object->{'FinMoisCli'});
            $this->setDecalRegCli($json_object->{'DecalRegCli'});
            $this->setJour1factCli($json_object->{'Jour1factCli'});
            $this->setJour2factCli($json_object->{'Jour2factCli'});
            $this->setChiffBLCli($json_object->{'ChiffBLCli'});
            $this->setIdTG($json_object->{'IdTG'});
            $this->setFlgTTCCli($json_object->{'FlgTTCCli'});
            $this->setCodPortCli($json_object->{'CodPortCli'});
            $this->setFlgEncCmdAncCliSoc($json_object->{'FlgEncCmdAncCliSoc'});
            $this->setFlgFacPayCli($json_object->{'FlgFacPayCli'});
            $this->setVFrancoCli($json_object->{'VFrancoCli'});
            $this->setUFrancoCli($json_object->{'UFrancoCli'});
            $this->setTypEdtFacCli($json_object->{'TypEdtFacCli'});
            $this->setCodGroupeCli($json_object->{'CodGroupeCli'});
            $this->setDatSuspCli($json_object->{'DatSuspCli'});
            $this->setFlgComptaCli($json_object->{'FlgComptaCli'});
            $this->setFlgExclureAnoCli($json_object->{'FlgExclureAnoCli'});
            $this->setMotPasseCli($json_object->{'MotPasseCli'});
            $this->setMontFFCliSoc($json_object->{'MontFFCliSoc'});
        }
    }
    
    
    /**
     * @return mixed
     */
    public function getIdCli()
    {
        return $this->IdCli;
    }

    /**
     * @param mixed $IdCli
     */
    public function setIdCli($IdCli)
    {
        $this->IdCli = $IdCli;
    }

    /**
     * @return mixed
     */
    public function getIdSal()
    {
        return $this->IdSal;
    }

    /**
     * @param mixed $IdSal
     */
    public function setIdSal($IdSal)
    {
        $this->IdSal = $IdSal;
    }

    /**
     * @return mixed
     */
    public function getIdSoc()
    {
        return $this->IdSoc;
    }

    /**
     * @param mixed $IdSoc
     */
    public function setIdSoc($IdSoc)
    {
        $this->IdSoc = $IdSoc;
    }

    /**
     * @return mixed
     */
    public function getRgpCli()
    {
        return $this->RgpCli;
    }

    /**
     * @param mixed $RgpCli
     */
    public function setRgpCli($RgpCli)
    {
        $this->RgpCli = $RgpCli;
    }

    /**
     * @return mixed
     */
    public function getNoCli()
    {
        return $this->NoCli;
    }

    /**
     * @param mixed $NoCli
     */
    public function setNoCli($NoCli)
    {
        $this->NoCli = $NoCli;
    }

    /**
     * @return mixed
     */
    public function getCodCli()
    {
        return $this->CodCli;
    }

    /**
     * @param mixed $CodCli
     */
    public function setCodCli($CodCli)
    {
        $this->CodCli = $CodCli;
    }

    /**
     * @return mixed
     */
    public function getRSocCli()
    {
        return $this->RSocCli;
    }

    /**
     * @param mixed $RSocCli
     */
    public function setRSocCli($RSocCli)
    {
        $this->RSocCli = $RSocCli;
    }

    /**
     * @return mixed
     */
    public function getIdDep()
    {
        return $this->IdDep;
    }

    /**
     * @param mixed $IdDep
     */
    public function setIdDep($IdDep)
    {
        $this->IdDep = $IdDep;
    }

    /**
     * @return mixed
     */
    public function getNomDep()
    {
        return $this->NomDep;
    }

    /**
     * @param mixed $NomDep
     */
    public function setNomDep($NomDep)
    {
        $this->NomDep = $NomDep;
    }

    /**
     * @return mixed
     */
    public function getSiretCli()
    {
        return $this->SiretCli;
    }

    /**
     * @param mixed $SiretCli
     */
    public function setSiretCli($SiretCli)
    {
        $this->SiretCli = $SiretCli;
    }

    /**
     * @return mixed
     */
    public function getSirenCli()
    {
        return $this->SirenCli;
    }

    /**
     * @param mixed $SirenCli
     */
    public function setSirenCli($SirenCli)
    {
        $this->SirenCli = $SirenCli;
    }

    /**
     * @return mixed
     */
    public function getLivNonFact()
    {
        return $this->LivNonFact;
    }

    /**
     * @param mixed $LivNonFact
     */
    public function setLivNonFact($LivNonFact)
    {
        $this->LivNonFact = $LivNonFact;
    }

    /**
     * @return mixed
     */
    public function getIdAdr()
    {
        return $this->IdAdr;
    }

    /**
     * @param mixed $IdAdr
     */
    public function setIdAdr($IdAdr)
    {
        $this->IdAdr = $IdAdr;
    }

    /**
     * @return mixed
     */
    public function getRSocAdr()
    {
        return $this->RSocAdr;
    }

    /**
     * @param mixed $RSocAdr
     */
    public function setRSocAdr($RSocAdr)
    {
        $this->RSocAdr = $RSocAdr;
    }

    /**
     * @return mixed
     */
    public function getCorpsAdr()
    {
        return $this->CorpsAdr;
    }

    /**
     * @param mixed $CorpsAdr
     */
    public function setCorpsAdr($CorpsAdr)
    {
        $this->CorpsAdr = $CorpsAdr;
    }

    /**
     * @return mixed
     */
    public function getCPAdr()
    {
        return $this->CPAdr;
    }

    /**
     * @param mixed $CPAdr
     */
    public function setCPAdr($CPAdr)
    {
        $this->CPAdr = $CPAdr;
    }

    /**
     * @return mixed
     */
    public function getVilleAdr()
    {
        return $this->VilleAdr;
    }

    /**
     * @param mixed $VilleAdr
     */
    public function setVilleAdr($VilleAdr)
    {
        $this->VilleAdr = $VilleAdr;
    }

    /**
     * @return mixed
     */
    public function getPaysAdr()
    {
        return $this->PaysAdr;
    }

    /**
     * @param mixed $PaysAdr
     */
    public function setPaysAdr($PaysAdr)
    {
        $this->PaysAdr = $PaysAdr;
    }

    /**
     * @return mixed
     */
    public function getTypeAdr()
    {
        return $this->TypeAdr;
    }

    /**
     * @param mixed $TypeAdr
     */
    public function setTypeAdr($TypeAdr)
    {
        $this->TypeAdr = $TypeAdr;
    }

    /**
     * @return mixed
     */
    public function getLibTypeAdr()
    {
        return $this->LibTypeAdr;
    }

    /**
     * @param mixed $LibTypeAdr
     */
    public function setLibTypeAdr($LibTypeAdr)
    {
        $this->LibTypeAdr = $LibTypeAdr;
    }

    /**
     * @return mixed
     */
    public function getMailAdr()
    {
        return $this->MailAdr;
    }

    /**
     * @param mixed $MailAdr
     */
    public function setMailAdr($MailAdr)
    {
        $this->MailAdr = $MailAdr;
    }

    /**
     * @return mixed
     */
    public function getTel1Adr()
    {
        return $this->Tel1Adr;
    }

    /**
     * @param mixed $Tel1Adr
     */
    public function setTel1Adr($Tel1Adr)
    {
        $this->Tel1Adr = $Tel1Adr;
    }

    /**
     * @return mixed
     */
    public function getTel2Adr()
    {
        return $this->Tel2Adr;
    }

    /**
     * @param mixed $Tel2Adr
     */
    public function setTel2Adr($Tel2Adr)
    {
        $this->Tel2Adr = $Tel2Adr;
    }

    /**
     * @return mixed
     */
    public function getFaxAdr()
    {
        return $this->FaxAdr;
    }

    /**
     * @param mixed $FaxAdr
     */
    public function setFaxAdr($FaxAdr)
    {
        $this->FaxAdr = $FaxAdr;
    }

    /**
     * @return mixed
     */
    public function getComCmrxCli()
    {
        return $this->ComCmrxCli;
    }

    /**
     * @param mixed $ComCmrxCli
     */
    public function setComCmrxCli($ComCmrxCli)
    {
        $this->ComCmrxCli = $ComCmrxCli;
    }

    /**
     * @return mixed
     */
    public function getIdCpt()
    {
        return $this->IdCpt;
    }

    /**
     * @param mixed $IdCpt
     */
    public function setIdCpt($IdCpt)
    {
        $this->IdCpt = $IdCpt;
    }

    /**
     * @return mixed
     */
    public function getIdTC()
    {
        return $this->IdTC;
    }

    /**
     * @param mixed $IdTC
     */
    public function setIdTC($IdTC)
    {
        $this->IdTC = $IdTC;
    }

    /**
     * @return mixed
     */
    public function getCodTC()
    {
        return $this->CodTC;
    }

    /**
     * @param mixed $CodTC
     */
    public function setCodTC($CodTC)
    {
        $this->CodTC = $CodTC;
    }

    /**
     * @return mixed
     */
    public function getLibTC()
    {
        return $this->LibTC;
    }

    /**
     * @param mixed $LibTC
     */
    public function setLibTC($LibTC)
    {
        $this->LibTC = $LibTC;
    }

    /**
     * @return mixed
     */
    public function getTypeCli()
    {
        return $this->TypeCli;
    }

    /**
     * @param mixed $TypeCli
     */
    public function setTypeCli($TypeCli)
    {
        $this->TypeCli = $TypeCli;
    }

    /**
     * @return mixed
     */
    public function getLibTypeCli()
    {
        return $this->LibTypeCli;
    }

    /**
     * @param mixed $LibTypeCli
     */
    public function setLibTypeCli($LibTypeCli)
    {
        $this->LibTypeCli = $LibTypeCli;
    }

    /**
     * @return mixed
     */
    public function getIdCliSoc()
    {
        return $this->IdCliSoc;
    }

    /**
     * @param mixed $IdCliSoc
     */
    public function setIdCliSoc($IdCliSoc)
    {
        $this->IdCliSoc = $IdCliSoc;
    }

    /**
     * @return mixed
     */
    public function getIdCSS()
    {
        return $this->IdCSS;
    }

    /**
     * @param mixed $IdCSS
     */
    public function setIdCSS($IdCSS)
    {
        $this->IdCSS = $IdCSS;
    }

    /**
     * @return mixed
     */
    public function getCodSuspCli()
    {
        return $this->CodSuspCli;
    }

    /**
     * @param mixed $CodSuspCli
     */
    public function setCodSuspCli($CodSuspCli)
    {
        $this->CodSuspCli = $CodSuspCli;
    }

    /**
     * @return mixed
     */
    public function getLibCodSuspCli()
    {
        return $this->LibCodSuspCli;
    }

    /**
     * @param mixed $LibCodSuspCli
     */
    public function setLibCodSuspCli($LibCodSuspCli)
    {
        $this->LibCodSuspCli = $LibCodSuspCli;
    }

    /**
     * @return mixed
     */
    public function getCauseSuspCli()
    {
        return $this->CauseSuspCli;
    }

    /**
     * @param mixed $CauseSuspCli
     */
    public function setCauseSuspCli($CauseSuspCli)
    {
        $this->CauseSuspCli = $CauseSuspCli;
    }

    /**
     * @return mixed
     */
    public function getEchRegCli()
    {
        return $this->EchRegCli;
    }

    /**
     * @param mixed $EchRegCli
     */
    public function setEchRegCli($EchRegCli)
    {
        $this->EchRegCli = $EchRegCli;
    }

    /**
     * @return mixed
     */
    public function getFraisFactCli()
    {
        return $this->FraisFactCli;
    }

    /**
     * @param mixed $FraisFactCli
     */
    public function setFraisFactCli($FraisFactCli)
    {
        $this->FraisFactCli = $FraisFactCli;
    }

    /**
     * @return mixed
     */
    public function getJRegCli()
    {
        return $this->JRegCli;
    }

    /**
     * @param mixed $JRegCli
     */
    public function setJRegCli($JRegCli)
    {
        $this->JRegCli = $JRegCli;
    }

    /**
     * @return mixed
     */
    public function getMRegCli()
    {
        return $this->MRegCli;
    }

    /**
     * @param mixed $MRegCli
     */
    public function setMRegCli($MRegCli)
    {
        $this->MRegCli = $MRegCli;
    }

    /**
     * @return mixed
     */
    public function getModeReg()
    {
        return $this->ModeReg;
    }

    /**
     * @param mixed $ModeReg
     */
    public function setModeReg($ModeReg)
    {
        $this->ModeReg = $ModeReg;
    }

    /**
     * @return mixed
     */
    public function getEcheances()
    {
        return $this->Echeances;
    }

    /**
     * @param mixed $Echeances
     */
    public function setEcheances($Echeances)
    {
        $this->Echeances = $Echeances;
    }

    /**
     * @return mixed
     */
    public function getSectGeoCli()
    {
        return $this->SectGeoCli;
    }

    /**
     * @param mixed $SectGeoCli
     */
    public function setSectGeoCli($SectGeoCli)
    {
        $this->SectGeoCli = $SectGeoCli;
    }

    /**
     * @return mixed
     */
    public function getLstJourLivCli()
    {
        return $this->LstJourLivCli;
    }

    /**
     * @param mixed $LstJourLivCli
     */
    public function setLstJourLivCli($LstJourLivCli)
    {
        $this->LstJourLivCli = $LstJourLivCli;
    }

    /**
     * @return mixed
     */
    public function getTypeTvaCli()
    {
        return $this->TypeTvaCli;
    }

    /**
     * @param mixed $TypeTvaCli
     */
    public function setTypeTvaCli($TypeTvaCli)
    {
        $this->TypeTvaCli = $TypeTvaCli;
    }

    /**
     * @return mixed
     */
    public function getLibTypeTvaCli()
    {
        return $this->LibTypeTvaCli;
    }

    /**
     * @param mixed $LibTypeTvaCli
     */
    public function setLibTypeTvaCli($LibTypeTvaCli)
    {
        $this->LibTypeTvaCli = $LibTypeTvaCli;
    }

    /**
     * @return mixed
     */
    public function getNoComptaCli()
    {
        return $this->NoComptaCli;
    }

    /**
     * @param mixed $NoComptaCli
     */
    public function setNoComptaCli($NoComptaCli)
    {
        $this->NoComptaCli = $NoComptaCli;
    }

    /**
     * @return mixed
     */
    public function getCSPCli()
    {
        return $this->CSPCli;
    }

    /**
     * @param mixed $CSPCli
     */
    public function setCSPCli($CSPCli)
    {
        $this->CSPCli = $CSPCli;
    }

    /**
     * @return mixed
     */
    public function getCSP2Cli()
    {
        return $this->CSP2Cli;
    }

    /**
     * @param mixed $CSP2Cli
     */
    public function setCSP2Cli($CSP2Cli)
    {
        $this->CSP2Cli = $CSP2Cli;
    }

    /**
     * @return mixed
     */
    public function getTypeLimiteCredit()
    {
        return $this->TypeLimiteCredit;
    }

    /**
     * @param mixed $TypeLimiteCredit
     */
    public function setTypeLimiteCredit($TypeLimiteCredit)
    {
        $this->TypeLimiteCredit = $TypeLimiteCredit;
    }

    /**
     * @return mixed
     */
    public function getLimiteCredit()
    {
        return $this->LimiteCredit;
    }

    /**
     * @param mixed $LimiteCredit
     */
    public function setLimiteCredit($LimiteCredit)
    {
        $this->LimiteCredit = $LimiteCredit;
    }

    /**
     * @return mixed
     */
    public function getDateLimiteCredit()
    {
        return $this->DateLimiteCredit;
    }

    /**
     * @param mixed $DateLimiteCredit
     */
    public function setDateLimiteCredit($DateLimiteCredit)
    {
        $this->DateLimiteCredit = $DateLimiteCredit;
    }

    /**
     * @return mixed
     */
    public function getLimiteTmpCredit()
    {
        return $this->LimiteTmpCredit;
    }

    /**
     * @param mixed $LimiteTmpCredit
     */
    public function setLimiteTmpCredit($LimiteTmpCredit)
    {
        $this->LimiteTmpCredit = $LimiteTmpCredit;
    }

    /**
     * @return mixed
     */
    public function getDateLimiteTmpCredit()
    {
        return $this->DateLimiteTmpCredit;
    }

    /**
     * @param mixed $DateLimiteTmpCredit
     */
    public function setDateLimiteTmpCredit($DateLimiteTmpCredit)
    {
        $this->DateLimiteTmpCredit = $DateLimiteTmpCredit;
    }

    /**
     * @return mixed
     */
    public function getMontantAssure()
    {
        return $this->MontantAssure;
    }

    /**
     * @param mixed $MontantAssure
     */
    public function setMontantAssure($MontantAssure)
    {
        $this->MontantAssure = $MontantAssure;
    }

    /**
     * @return mixed
     */
    public function getDateMontantAssure()
    {
        return $this->DateMontantAssure;
    }

    /**
     * @param mixed $DateMontantAssure
     */
    public function setDateMontantAssure($DateMontantAssure)
    {
        $this->DateMontantAssure = $DateMontantAssure;
    }

    /**
     * @return mixed
     */
    public function getDateDebMontantAssure()
    {
        return $this->DateDebMontantAssure;
    }

    /**
     * @param mixed $DateDebMontantAssure
     */
    public function setDateDebMontantAssure($DateDebMontantAssure)
    {
        $this->DateDebMontantAssure = $DateDebMontantAssure;
    }

    /**
     * @return mixed
     */
    public function getDateFinMontantAssure()
    {
        return $this->DateFinMontantAssure;
    }

    /**
     * @param mixed $DateFinMontantAssure
     */
    public function setDateFinMontantAssure($DateFinMontantAssure)
    {
        $this->DateFinMontantAssure = $DateFinMontantAssure;
    }

    /**
     * @return mixed
     */
    public function getRisqueInterne()
    {
        return $this->RisqueInterne;
    }

    /**
     * @param mixed $RisqueInterne
     */
    public function setRisqueInterne($RisqueInterne)
    {
        $this->RisqueInterne = $RisqueInterne;
    }

    /**
     * @return mixed
     */
    public function getEncoursRetard()
    {
        return $this->EncoursRetard;
    }

    /**
     * @param mixed $EncoursRetard
     */
    public function setEncoursRetard($EncoursRetard)
    {
        $this->EncoursRetard = $EncoursRetard;
    }

    /**
     * @return mixed
     */
    public function getEncoursTotal()
    {
        return $this->EncoursTotal;
    }

    /**
     * @param mixed $EncoursTotal
     */
    public function setEncoursTotal($EncoursTotal)
    {
        $this->EncoursTotal = $EncoursTotal;
    }

    /**
     * @return mixed
     */
    public function getEncoursDisponible()
    {
        return $this->EncoursDisponible;
    }

    /**
     * @param mixed $EncoursDisponible
     */
    public function setEncoursDisponible($EncoursDisponible)
    {
        $this->EncoursDisponible = $EncoursDisponible;
    }

    /**
     * @return mixed
     */
    public function getEncoursCommande()
    {
        return $this->EncoursCommande;
    }

    /**
     * @param mixed $EncoursCommande
     */
    public function setEncoursCommande($EncoursCommande)
    {
        $this->EncoursCommande = $EncoursCommande;
    }

    /**
     * @return mixed
     */
    public function getCalcEncCmdCliSoc()
    {
        return $this->CalcEncCmdCliSoc;
    }

    /**
     * @param mixed $CalcEncCmdCliSoc
     */
    public function setCalcEncCmdCliSoc($CalcEncCmdCliSoc)
    {
        $this->CalcEncCmdCliSoc = $CalcEncCmdCliSoc;
    }

    /**
     * @return mixed
     */
    public function getEdPxNetCli()
    {
        return $this->EdPxNetCli;
    }

    /**
     * @param mixed $EdPxNetCli
     */
    public function setEdPxNetCli($EdPxNetCli)
    {
        $this->EdPxNetCli = $EdPxNetCli;
    }

    /**
     * @return mixed
     */
    public function getComConcCli()
    {
        return $this->ComConcCli;
    }

    /**
     * @param mixed $ComConcCli
     */
    public function setComConcCli($ComConcCli)
    {
        $this->ComConcCli = $ComConcCli;
    }

    /**
     * @return mixed
     */
    public function getComSfacCliSoc()
    {
        return $this->ComSfacCliSoc;
    }

    /**
     * @param mixed $ComSfacCliSoc
     */
    public function setComSfacCliSoc($ComSfacCliSoc)
    {
        $this->ComSfacCliSoc = $ComSfacCliSoc;
    }

    /**
     * @return mixed
     */
    public function getComLimCliSoc()
    {
        return $this->ComLimCliSoc;
    }

    /**
     * @param mixed $ComLimCliSoc
     */
    public function setComLimCliSoc($ComLimCliSoc)
    {
        $this->ComLimCliSoc = $ComLimCliSoc;
    }

    /**
     * @return mixed
     */
    public function getComLimComplCliSoc()
    {
        return $this->ComLimComplCliSoc;
    }

    /**
     * @param mixed $ComLimComplCliSoc
     */
    public function setComLimComplCliSoc($ComLimComplCliSoc)
    {
        $this->ComLimComplCliSoc = $ComLimComplCliSoc;
    }

    /**
     * @return mixed
     */
    public function getNumTvaCli()
    {
        return $this->NumTvaCli;
    }

    /**
     * @param mixed $NumTvaCli
     */
    public function setNumTvaCli($NumTvaCli)
    {
        $this->NumTvaCli = $NumTvaCli;
    }

    /**
     * @return boolean
     */
    public function isFlgAssujettiTvaCli()
    {
        return $this->FlgAssujettiTvaCli;
    }

    /**
     * @param boolean $FlgAssujettiTvaCli
     */
    public function setFlgAssujettiTvaCli($FlgAssujettiTvaCli)
    {
        $this->FlgAssujettiTvaCli = $FlgAssujettiTvaCli;
    }

    /**
     * @return mixed
     */
    public function getTypeVCDCli()
    {
        return $this->TypeVCDCli;
    }

    /**
     * @param mixed $TypeVCDCli
     */
    public function setTypeVCDCli($TypeVCDCli)
    {
        $this->TypeVCDCli = $TypeVCDCli;
    }

    /**
     * @return mixed
     */
    public function getTypeObjCli()
    {
        return $this->TypeObjCli;
    }

    /**
     * @param mixed $TypeObjCli
     */
    public function setTypeObjCli($TypeObjCli)
    {
        $this->TypeObjCli = $TypeObjCli;
    }

    /**
     * @return mixed
     */
    public function getDateLimFoncCli()
    {
        return $this->DateLimFoncCli;
    }

    /**
     * @param mixed $DateLimFoncCli
     */
    public function setDateLimFoncCli($DateLimFoncCli)
    {
        $this->DateLimFoncCli = $DateLimFoncCli;
    }

    /**
     * @return mixed
     */
    public function getStrucFactCli()
    {
        return $this->StrucFactCli;
    }

    /**
     * @param mixed $StrucFactCli
     */
    public function setStrucFactCli($StrucFactCli)
    {
        $this->StrucFactCli = $StrucFactCli;
    }

    /**
     * @return boolean
     */
    public function isSocieteAssurance()
    {
        return $this->SocieteAssurance;
    }

    /**
     * @param boolean $SocieteAssurance
     */
    public function setSocieteAssurance($SocieteAssurance)
    {
        $this->SocieteAssurance = $SocieteAssurance;
    }

    /**
     * @return boolean
     */
    public function isRelFMCli()
    {
        return $this->RelFMCli;
    }

    /**
     * @param boolean $RelFMCli
     */
    public function setRelFMCli($RelFMCli)
    {
        $this->RelFMCli = $RelFMCli;
    }

    /**
     * @return boolean
     */
    public function isFinMoisCli()
    {
        return $this->FinMoisCli;
    }

    /**
     * @param boolean $FinMoisCli
     */
    public function setFinMoisCli($FinMoisCli)
    {
        $this->FinMoisCli = $FinMoisCli;
    }

    /**
     * @return mixed
     */
    public function getDecalRegCli()
    {
        return $this->DecalRegCli;
    }

    /**
     * @param mixed $DecalRegCli
     */
    public function setDecalRegCli($DecalRegCli)
    {
        $this->DecalRegCli = $DecalRegCli;
    }

    /**
     * @return mixed
     */
    public function getJour1factCli()
    {
        return $this->Jour1factCli;
    }

    /**
     * @param mixed $Jour1factCli
     */
    public function setJour1factCli($Jour1factCli)
    {
        $this->Jour1factCli = $Jour1factCli;
    }

    /**
     * @return mixed
     */
    public function getJour2factCli()
    {
        return $this->Jour2factCli;
    }

    /**
     * @param mixed $Jour2factCli
     */
    public function setJour2factCli($Jour2factCli)
    {
        $this->Jour2factCli = $Jour2factCli;
    }

    /**
     * @return mixed
     */
    public function getChiffBLCli()
    {
        return $this->ChiffBLCli;
    }

    /**
     * @param mixed $ChiffBLCli
     */
    public function setChiffBLCli($ChiffBLCli)
    {
        $this->ChiffBLCli = $ChiffBLCli;
    }

    /**
     * @return mixed
     */
    public function getIdTG()
    {
        return $this->IdTG;
    }

    /**
     * @param mixed $IdTG
     */
    public function setIdTG($IdTG)
    {
        $this->IdTG = $IdTG;
    }

    /**
     * @return boolean
     */
    public function isFlgTTCCli()
    {
        return $this->FlgTTCCli;
    }

    /**
     * @param boolean $FlgTTCCli
     */
    public function setFlgTTCCli($FlgTTCCli)
    {
        $this->FlgTTCCli = $FlgTTCCli;
    }

    /**
     * @return mixed
     */
    public function getCodPortCli()
    {
        return $this->CodPortCli;
    }

    /**
     * @param mixed $CodPortCli
     */
    public function setCodPortCli($CodPortCli)
    {
        $this->CodPortCli = $CodPortCli;
    }

    /**
     * @return boolean
     */
    public function isFlgEncCmdAncCliSoc()
    {
        return $this->FlgEncCmdAncCliSoc;
    }

    /**
     * @param boolean $FlgEncCmdAncCliSoc
     */
    public function setFlgEncCmdAncCliSoc($FlgEncCmdAncCliSoc)
    {
        $this->FlgEncCmdAncCliSoc = $FlgEncCmdAncCliSoc;
    }

    /**
     * @return boolean
     */
    public function isFlgFacPayCli()
    {
        return $this->FlgFacPayCli;
    }

    /**
     * @param boolean $FlgFacPayCli
     */
    public function setFlgFacPayCli($FlgFacPayCli)
    {
        $this->FlgFacPayCli = $FlgFacPayCli;
    }

    /**
     * @return mixed
     */
    public function getVFrancoCli()
    {
        return $this->VFrancoCli;
    }

    /**
     * @param mixed $VFrancoCli
     */
    public function setVFrancoCli($VFrancoCli)
    {
        $this->VFrancoCli = $VFrancoCli;
    }

    /**
     * @return mixed
     */
    public function getUFrancoCli()
    {
        return $this->UFrancoCli;
    }

    /**
     * @param mixed $UFrancoCli
     */
    public function setUFrancoCli($UFrancoCli)
    {
        $this->UFrancoCli = $UFrancoCli;
    }

    /**
     * @return mixed
     */
    public function getTypEdtFacCli()
    {
        return $this->TypEdtFacCli;
    }

    /**
     * @param mixed $TypEdtFacCli
     */
    public function setTypEdtFacCli($TypEdtFacCli)
    {
        $this->TypEdtFacCli = $TypEdtFacCli;
    }

    /**
     * @return mixed
     */
    public function getCodGroupeCli()
    {
        return $this->CodGroupeCli;
    }

    /**
     * @param mixed $CodGroupeCli
     */
    public function setCodGroupeCli($CodGroupeCli)
    {
        $this->CodGroupeCli = $CodGroupeCli;
    }

    /**
     * @return mixed
     */
    public function getDatSuspCli()
    {
        return $this->DatSuspCli;
    }

    /**
     * @param mixed $DatSuspCli
     */
    public function setDatSuspCli($DatSuspCli)
    {
        $this->DatSuspCli = $DatSuspCli;
    }

    /**
     * @return boolean
     */
    public function isFlgComptaCli()
    {
        return $this->FlgComptaCli;
    }

    /**
     * @param boolean $FlgComptaCli
     */
    public function setFlgComptaCli($FlgComptaCli)
    {
        $this->FlgComptaCli = $FlgComptaCli;
    }

    /**
     * @return boolean
     */
    public function isFlgExclureAnoCli()
    {
        return $this->FlgExclureAnoCli;
    }

    /**
     * @param boolean $FlgExclureAnoCli
     */
    public function setFlgExclureAnoCli($FlgExclureAnoCli)
    {
        $this->FlgExclureAnoCli = $FlgExclureAnoCli;
    }

    /**
     * @return mixed
     */
    public function getMotPasseCli()
    {
        return $this->MotPasseCli;
    }

    /**
     * @param mixed $MotPasseCli
     */
    public function setMotPasseCli($MotPasseCli)
    {
        $this->MotPasseCli = $MotPasseCli;
    }

    /**
     * @return mixed
     */
    public function getMontFFCliSoc()
    {
        return $this->MontFFCliSoc;
    }

    /**
     * @param mixed $MontFFCliSoc
     */
    public function setMontFFCliSoc($MontFFCliSoc)
    {
        $this->MontFFCliSoc = $MontFFCliSoc;
    }

    /**
     * @return string
     */
    public function getLienContacts()
    {
        return $this->LienContacts;
    }

    /**
     * @param string $lien
     */
    public function setLienContacts($lien)
    {
        $this->LienContacts = $lien;
    }

    /**
     * @return mixed
     */
    public function getLienDevis()
    {
        return $this->LienDevis;
    }

    /**
     * @param mixed $LienDevis
     */
    public function setLienDevis($LienDevis)
    {
        $this->LienDevis = $LienDevis;
    }

    /**
     * @return mixed
     */
    public function getLienCommandes()
    {
        return $this->LienCommandes;
    }

    /**
     * @param mixed $LienCommandes
     */
    public function setLienCommandes($LienCommandes)
    {
        $this->LienCommandes = $LienCommandes;
    }

    /**
     * @return mixed
     */
    public function getLienBL()
    {
        return $this->LienBL;
    }

    /**
     * @param mixed $LienBL
     */
    public function setLienBL($LienBL)
    {
        $this->LienBL = $LienBL;
    }

    /**
     * @return mixed
     */
    public function getLienFactures()
    {
        return $this->LienFactures;
    }

    /**
     * @param mixed $LienFactures
     */
    public function setLienFactures($LienFactures)
    {
        $this->LienFactures = $LienFactures;
    }

    /**
     * @return mixed
     */
    public function getLienNbDevisEtatE()
    {
        return $this->LienNbDevisEtatE;
    }

    /**
     * @param mixed $LienNbDevisEtatE
     */
    public function setLienNbDevisEtatE($LienNbDevisEtatE)
    {
        $this->LienNbDevisEtatE = $LienNbDevisEtatE;
    }

    /**
     * @return mixed
     */
    public function getLienNbCommandesEtatE()
    {
        return $this->LienNbCommandesEtatE;
    }

    /**
     * @param mixed $LienNbCommandesEtatE
     */
    public function setLienNbCommandesEtatE($LienNbCommandesEtatE)
    {
        $this->LienNbCommandesEtatE = $LienNbCommandesEtatE;
    }

    /**
     * @return mixed
     */
    public function getLienNbBLEtatE()
    {
        return $this->LienNbBLEtatE;
    }

    /**
     * @param mixed $LienNbBLEtatE
     */
    public function setLienNbBLEtatE($LienNbBLEtatE)
    {
        $this->LienNbBLEtatE = $LienNbBLEtatE;
    }

    /**
     * @return mixed
     */
    public function getLienNbFacturesEtatE()
    {
        return $this->LienNbFacturesEtatE;
    }

    /**
     * @param mixed $LienNbFacturesEtatE
     */
    public function setLienNbFacturesEtatE($LienNbFacturesEtatE)
    {
        $this->LienNbFacturesEtatE = $LienNbFacturesEtatE;
    }

}