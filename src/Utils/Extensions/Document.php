<?php

namespace App\Utils\Extensions;

use App\Services\Objets\WsDocumEnt;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

class Document
{
    private $FamDocDE = "";
    private $IdDE = 0;
    public $IdDocDE = 0;
    private $NumDE = 0;
    private $DateDE = null;
    private $IdSoc = 0;
    private $EtatDE = "";
    private $TypeDE = "";
    private $RefDE = "";
    private $MontTTCDE = 0;
    private $MontHTDE = 0;
    private $ComDE = "";
    private $AnnotDE = "";
    private $FlgValidDE = false;
    private $MotsClesAutoDE = "";
    private $EchRegDE = "";
    private $FinMoisDE = false;
    private $DecalRegDE = "";
    private $JRegDE = 0;
    private $MRegDE = "";
    private $FlgTTCDE = false;
    private $RemDE = 0;
    private $TypeTvaDE = "";
    private $IdDepCre = 0;
    private $IdDepLiv = 0;
    private $CodDepCre = "";
    private $CodDepLiv = "";
    private $CodPortDE = "";
    private $IdCam = 0;
    private $CodCam = "";
    private $LibCam = "";
    private $DateCreDE = null;
    private $HeureCreDE = 0;
    private $DateModDE = null;
    private $IdDUCre = 0;
    private $IdDUMod = 0;
    private $MontTvaDE = 0;
    private $MontTgapDE = 0;
    private $MontParafDE = 0;
    private $MontHTApRemDE = 0;
    private $MontTvaApRemDE = 0;
    private $MontParafApRemDE = 0;
    private $MontTTCApRemDE = 0;
    private $MontHTMarDE = 0;
    private $MontRevReMarDE = 0;
    private $MontRevConvMarDE = 0;
    private $MontEcoTaxeDE = 0;
    private $MontHTAvecPortDE = 0;
    private $MontRevReDE = 0;
    private $MontRevConvDE = 0;
    private $TotPoidsDE = 0;
    private $ComLivDE = "";
    private $ZoneLivDE = "";
    private $FlgTva2DE = false;
    private $TotRegDE = 0;
    private $MontHTExtDE = 0;
    private $MontTVAExtDE = 0;
    private $MontTTCExtDE = 0;
    private $DateRegDE = null;
    private $RSocDE = "";
    private $DateHeureEditDE = null;
    private $CodRgpt = "";
    private $HASH = "";
    private $IdCli = 0;
    private $NoCli = 0;
    private $CodCli = "";
    private $NoComptaCli = "";
    private $RSocCli = "";
    private $RSocLivDE = "";
    private $AdrLivDE = "";
    private $CPLivDE = "";
    private $VilleLivDE = "";
    private $PaysLivDE = "";
    private $TelLivDE = "";
    private $FaxLivDE = "";
    private $MailLivDE = "";
    private $RSocFacDE = "";
    private $AdrFacDE = "";
    private $CPFacDE = "";
    private $VilleFacDE = "";
    private $PaysFacDE = "";
    private $TelFacDE = "";
    private $FaxFacDE = "";
    private $MailFacDE = "";
    private $IdSalVend = 0;
    private $CodSalVend = "";
    private $IdSalRep = 0;
    private $CodSalRep = "";
    private $IdCha = 0;
    private $CodCha = "";
    private $LibCha = "";
    private $AdrCha = "";
    private $CPCha = "";
    private $VilleCha = "";
    private $MontPortDE = 0;
    private $DateLivDE = null;
    private $IdTC = 0;
    private $PrisParDE = "";
    private $DateReacDE = null;
    private $FlgPFDE = false;
    private $CodOrigDE = "";
    private $DateCloDE = null;

    private $Edition = null;
    private $Lignes = null;

    /**
     * Document constructor.
     */
    public function __construct()
    {
        $this->Lignes = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|null
     */
    public function getLignes()
    {
        return $this->Lignes;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getLigne($i)
    {
        return $this->Lignes->get($i);
    }

    /**
     * @param mixed $ligne
     */
    public function setLignes($ligne)
    {
        $this->Lignes->add($ligne);
    }

    /**
     * @return null
     */
    public function getEdition()
    {
        return $this->Edition;
    }

    /**
     * @param null $Edition
     */
    public function setEdition($Edition)
    {
        $this->Edition = $Edition;
    }



    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsDocumEnt $object) {

        if(!is_null($object)) {
            if(isset($object->{'DateDE'})) {
                $this->setDateDE($object->{'DateDE'});
            }
            $this->setFamDocDE($object->{'FamDocDE'});
            $this->setIdDE($object->{'IdDE'});
            $this->setIdDocDE($object->{'IdDocDE'});
            $this->setNumDE($object->{'NumDE'});
            $this->setDateDE($object->{'DateDE'});
            $this->setIdSoc($object->{'IdSoc'});
            $this->setEtatDE($object->{'EtatDE'});
            $this->setTypeDE($object->{'TypeDE'});
            $this->setRefDE($object->{'RefDE'});
            $this->setMontTTCDE($object->{'MontTTCDE'});
            $this->setMontHTDE($object->{'MontHTDE'});
            $this->setComDE($object->{'ComDE'});
            $this->setAnnotDE($object->{'AnnotDE'});
            $this->setFlgValidDE($object->{'FlgValidDE'});
            $this->setMotsClesAutoDE($object->{'MotsClesAutoDE'});
            $this->setEchRegDE($object->{'EchRegDE'});
            $this->setFinMoisDE($object->{'FinMoisDE'});
            $this->setDecalRegDE($object->{'DecalRegDE'});
            $this->setJRegDE($object->{'JRegDE'});
            $this->setMRegDE($object->{'MRegDE'});
            $this->setFlgTTCDE($object->{'FlgTTCDE'});
            $this->setRemDE($object->{'RemDE'});
            $this->setTypeTvaDE($object->{'TypeTvaDE'});
            $this->setIdDepCre($object->{'IdDepCre'});
            $this->setIdDepLiv($object->{'IdDepLiv'});
            $this->setCodDepCre($object->{'CodDepCre'});
            $this->setCodDepLiv($object->{'CodDepLiv'});
            $this->setCodPortDE($object->{'CodPortDE'});
            $this->setIdCam($object->{'IdCam'});
            $this->setCodCam($object->{'CodCam'});
            $this->setLibCam($object->{'LibCam'});
            $this->setDateCreDE($object->{'DateCreDE'});
            $this->setHeureCreDE($object->{'HeureCreDE'});
            $this->setDateModDE($object->{'DateModDE'});
            $this->setIdDUCre($object->{'IdDUCre'});
            $this->setIdDUMod($object->{'IdDUMod'});
            $this->setMontTvaDE($object->{'MontTvaDE'});
            $this->setMontTgapDE($object->{'MontTgapDE'});
            $this->setMontParafDE($object->{'MontParafDE'});
            $this->setMontHTApRemDE($object->{'MontHTApRemDE'});
            $this->setMontTvaApRemDE($object->{'MontTvaApRemDE'});
            $this->setMontParafApRemDE($object->{'MontParafApRemDE'});
            $this->setMontTTCApRemDE($object->{'MontTTCApRemDE'});
            $this->setMontHTMarDE($object->{'MontHTMarDE'});
            $this->setMontRevReMarDE($object->{'MontRevReMarDE'});
            $this->setMontRevConvMarDE($object->{'MontRevConvMarDE'});
            $this->setMontEcoTaxeDE($object->{'MontEcoTaxeDE'});
            $this->setMontHTAvecPortDE($object->{'MontHTAvecPortDE'});
            $this->setMontRevReDE($object->{'MontRevReDE'});
            $this->setMontRevConvDE($object->{'MontRevConvDE'});
            $this->setTotPoidsDE($object->{'TotPoidsDE'});
            $this->setComLivDE($object->{'ComLivDE'});
            $this->setZoneLivDE($object->{'ZoneLivDE'});
            $this->setFlgTva2DE($object->{'FlgTva2DE'});
            $this->setTotRegDE($object->{'TotRegDE'});
            $this->setMontHTExtDE($object->{'MontHTExtDE'});
            $this->setMontTVAExtDE($object->{'MontTVAExtDE'});
            $this->setMontTTCExtDE($object->{'MontTTCExtDE'});
            $this->setDateRegDE($object->{'DateRegDE'});
            $this->setRSocDE($object->{'RSocDE'});
            $this->setDateHeureEditDE($object->{'DateHeureEditDE'});
            $this->setCodRgpt($object->{'CodRgpt'});
            $this->setHASH($object->{'HASH'});
            $this->setIdCli($object->{'IdCli'});
            $this->setNoCli($object->{'NoCli'});
            $this->setCodCli($object->{'CodCli'});
            $this->setNoComptaCli($object->{'NoComptaCli'});
            $this->setRSocCli($object->{'RSocCli'});
            $this->setRSocLivDE($object->{'RSocLivDE'});
            $this->setAdrLivDE($object->{'AdrLivDE'});
            $this->setCPLivDE($object->{'CPLivDE'});
            $this->setVilleLivDE($object->{'VilleLivDE'});
            $this->setPaysLivDE($object->{'PaysLivDE'});
            $this->setTelLivDE($object->{'TelLivDE'});
            $this->setFaxLivDE($object->{'FaxLivDE'});
            $this->setMailLivDE($object->{'MailLivDE'});
            $this->setRSocFacDE($object->{'RSocFacDE'});
            $this->setAdrFacDE($object->{'AdrFacDE'});
            $this->setCPFacDE($object->{'CPFacDE'});
            $this->setVilleFacDE($object->{'VilleFacDE'});
            $this->setPaysFacDE($object->{'PaysFacDE'});
            $this->setTelFacDE($object->{'TelFacDE'});
            $this->setFaxFacDE($object->{'FaxFacDE'});
            $this->setMailFacDE($object->{'MailFacDE'});
            $this->setIdSalVend($object->{'IdSalVend'});
            $this->setCodSalVend($object->{'CodSalVend'});
            $this->setIdSalRep($object->{'IdSalRep'});
            $this->setCodSalRep($object->{'CodSalRep'});
            $this->setIdCha($object->{'IdCha'});
            $this->setCodCha($object->{'CodCha'});
            $this->setLibCha($object->{'LibCha'});
            $this->setAdrCha($object->{'AdrCha'});
            $this->setCPCha($object->{'CPCha'});
            $this->setVilleCha($object->{'VilleCha'});
            $this->setMontPortDE($object->{'MontPortDE'});
            $this->setDateLivDE($object->{'DateLivDE'});
            $this->setIdTC($object->{'IdTC'});
            $this->setPrisParDE($object->{'PrisParDE'});
            $this->setDateReacDE($object->{'DateReacDE'});
            $this->setFlgPFDE($object->{'FlgPFDE'});
            $this->setCodOrigDE($object->{'CodOrigDE'});
            $this->setDateCloDE($object->{'DateCloDE'});
        }
    }

    /**
     * parseJson
     * Convertion de l'objet en une structure JSON personnalisée
     */
    public function parseJson()
    {
        $string = '{';
        $string .= '"IdDE": '.$this->getIdDE().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"NumDE": '.$this->getNumDE().' ,';
        $string .= '"DateDE": "'.$this->getDateDE().'" ,';
        $string .= '"IdCli": '.$this->getIdCli().' ,';
        $string .= '"IdSoc": '.$this->getIdSoc().' ,';
        $string .= '"EtatDE": "'.$this->getEtatDE().'" ,';
        $string .= '"TypeDE": "'.$this->getTypeDE().'" ,';
        $string .= '"RefDE": "'.$this->getRefDE().'" ,';
        $string .= '"MontTTCDE": '.$this->getMontTTCDE().' ,';
        $string .= '"MontHTDE": '.$this->getMontHTDE().' ,';
        $string .= '"ComDE": "'.$this->getComDE().'" ,';
        $string .= '"DateLivrDE": "'.$this->getDateLivrDE().'" ,';
        $string .= '"IdFac": '.$this->getIdFac().' ,';
        $string .= '"IdDepLiv": '.$this->getIdDepLiv().' ,';

        $val = ($this->getFlgValidDE()) ? 'true' : 'false';
        $string .= '"FlgValidDE": '.$val.' ,';

        $string .= '"MotsClesAutoDE": "'.$this->getMotsClesAutoDE().'"';
        $string .= '}';

        return $string;
    }

    /**
     * @return string
     */
    public function getFamDocDE()
    {
        return $this->FamDocDE;
    }

    /**
     * @param string $FamDocDE
     */
    public function setFamDocDE($FamDocDE)
    {
        $this->FamDocDE = $FamDocDE;
    }

    /**
     * @return int
     */
    public function getIdDE()
    {
        return $this->IdDE;
    }

    /**
     * @param int $IdDE
     */
    public function setIdDE($IdDE)
    {
        $this->IdDE = $IdDE;
    }

    /**
     * @return int
     */
    public function getIdDocDE()
    {
        return $this->IdDocDE;
    }

    /**
     * @param int $IdDocDE
     */
    public function setIdDocDE($IdDocDE)
    {
        $this->IdDocDE = $IdDocDE;
    }

    /**
     * @return int
     */
    public function getNumDE()
    {
        return $this->NumDE;
    }

    /**
     * @param int $NumDE
     */
    public function setNumDE($NumDE)
    {
        $this->NumDE = $NumDE;
    }

    /**
     * @return null
     */
    public function getDateDE()
    {
        return $this->DateDE;
    }

    /**
     * @param null $DateDE
     */
    public function setDateDE($DateDE)
    {
        $this->DateDE = $DateDE;
    }

    /**
     * @return int
     */
    public function getIdSoc()
    {
        return $this->IdSoc;
    }

    /**
     * @param int $IdSoc
     */
    public function setIdSoc($IdSoc)
    {
        $this->IdSoc = $IdSoc;
    }

    /**
     * @return string
     */
    public function getEtatDE()
    {
        return $this->EtatDE;
    }

    /**
     * @param string $EtatDE
     */
    public function setEtatDE($EtatDE)
    {
        $this->EtatDE = $EtatDE;
    }

    /**
     * @return string
     */
    public function getTypeDE()
    {
        return $this->TypeDE;
    }

    /**
     * @param string $TypeDE
     */
    public function setTypeDE($TypeDE)
    {
        $this->TypeDE = $TypeDE;
    }

    /**
     * @return string
     */
    public function getRefDE()
    {
        return $this->RefDE;
    }

    /**
     * @param string $RefDE
     */
    public function setRefDE($RefDE)
    {
        $this->RefDE = $RefDE;
    }

    /**
     * @return int
     */
    public function getMontTTCDE()
    {
        return $this->MontTTCDE;
    }

    /**
     * @param int $MontTTCDE
     */
    public function setMontTTCDE($MontTTCDE)
    {
        $this->MontTTCDE = $MontTTCDE;
    }

    /**
     * @return int
     */
    public function getMontHTDE()
    {
        return $this->MontHTDE;
    }

    /**
     * @param int $MontHTDE
     */
    public function setMontHTDE($MontHTDE)
    {
        $this->MontHTDE = $MontHTDE;
    }

    /**
     * @return string
     */
    public function getComDE()
    {
        return $this->ComDE;
    }

    /**
     * @param string $ComDE
     */
    public function setComDE($ComDE)
    {
        $this->ComDE = $ComDE;
    }

    /**
     * @return string
     */
    public function getAnnotDE()
    {
        return $this->AnnotDE;
    }

    /**
     * @param string $AnnotDE
     */
    public function setAnnotDE($AnnotDE)
    {
        $this->AnnotDE = $AnnotDE;
    }

    /**
     * @return bool
     */
    public function isFlgValidDE()
    {
        return $this->FlgValidDE;
    }

    /**
     * @param bool $FlgValidDE
     */
    public function setFlgValidDE($FlgValidDE)
    {
        $this->FlgValidDE = $FlgValidDE;
    }

    /**
     * @return string
     */
    public function getMotsClesAutoDE()
    {
        return $this->MotsClesAutoDE;
    }

    /**
     * @param string $MotsClesAutoDE
     */
    public function setMotsClesAutoDE($MotsClesAutoDE)
    {
        $this->MotsClesAutoDE = $MotsClesAutoDE;
    }

    /**
     * @return string
     */
    public function getEchRegDE()
    {
        return $this->EchRegDE;
    }

    /**
     * @param string $EchRegDE
     */
    public function setEchRegDE($EchRegDE)
    {
        $this->EchRegDE = $EchRegDE;
    }

    /**
     * @return bool
     */
    public function isFinMoisDE()
    {
        return $this->FinMoisDE;
    }

    /**
     * @param bool $FinMoisDE
     */
    public function setFinMoisDE($FinMoisDE)
    {
        $this->FinMoisDE = $FinMoisDE;
    }

    /**
     * @return string
     */
    public function getDecalRegDE()
    {
        return $this->DecalRegDE;
    }

    /**
     * @param string $DecalRegDE
     */
    public function setDecalRegDE($DecalRegDE)
    {
        $this->DecalRegDE = $DecalRegDE;
    }

    /**
     * @return int
     */
    public function getJRegDE()
    {
        return $this->JRegDE;
    }

    /**
     * @param int $JRegDE
     */
    public function setJRegDE($JRegDE)
    {
        $this->JRegDE = $JRegDE;
    }

    /**
     * @return string
     */
    public function getMRegDE()
    {
        return $this->MRegDE;
    }

    /**
     * @param string $MRegDE
     */
    public function setMRegDE($MRegDE)
    {
        $this->MRegDE = $MRegDE;
    }

    /**
     * @return bool
     */
    public function isFlgTTCDE()
    {
        return $this->FlgTTCDE;
    }

    /**
     * @param bool $FlgTTCDE
     */
    public function setFlgTTCDE($FlgTTCDE)
    {
        $this->FlgTTCDE = $FlgTTCDE;
    }

    /**
     * @return int
     */
    public function getRemDE()
    {
        return $this->RemDE;
    }

    /**
     * @param int $RemDE
     */
    public function setRemDE($RemDE)
    {
        $this->RemDE = $RemDE;
    }

    /**
     * @return string
     */
    public function getTypeTvaDE()
    {
        return $this->TypeTvaDE;
    }

    /**
     * @param string $TypeTvaDE
     */
    public function setTypeTvaDE($TypeTvaDE)
    {
        $this->TypeTvaDE = $TypeTvaDE;
    }

    /**
     * @return int
     */
    public function getIdDepCre()
    {
        return $this->IdDepCre;
    }

    /**
     * @param int $IdDepCre
     */
    public function setIdDepCre($IdDepCre)
    {
        $this->IdDepCre = $IdDepCre;
    }

    /**
     * @return int
     */
    public function getIdDepLiv()
    {
        return $this->IdDepLiv;
    }

    /**
     * @param int $IdDepLiv
     */
    public function setIdDepLiv($IdDepLiv)
    {
        $this->IdDepLiv = $IdDepLiv;
    }

    /**
     * @return string
     */
    public function getCodDepCre()
    {
        return $this->CodDepCre;
    }

    /**
     * @param string $CodDepCre
     */
    public function setCodDepCre($CodDepCre)
    {
        $this->CodDepCre = $CodDepCre;
    }

    /**
     * @return string
     */
    public function getCodDepLiv()
    {
        return $this->CodDepLiv;
    }

    /**
     * @param string $CodDepLiv
     */
    public function setCodDepLiv($CodDepLiv)
    {
        $this->CodDepLiv = $CodDepLiv;
    }

    /**
     * @return string
     */
    public function getCodPortDE()
    {
        return $this->CodPortDE;
    }

    /**
     * @param string $CodPortDE
     */
    public function setCodPortDE($CodPortDE)
    {
        $this->CodPortDE = $CodPortDE;
    }

    /**
     * @return int
     */
    public function getIdCam()
    {
        return $this->IdCam;
    }

    /**
     * @param int $IdCam
     */
    public function setIdCam($IdCam)
    {
        $this->IdCam = $IdCam;
    }

    /**
     * @return string
     */
    public function getCodCam()
    {
        return $this->CodCam;
    }

    /**
     * @param string $CodCam
     */
    public function setCodCam($CodCam)
    {
        $this->CodCam = $CodCam;
    }

    /**
     * @return string
     */
    public function getLibCam()
    {
        return $this->LibCam;
    }

    /**
     * @param string $LibCam
     */
    public function setLibCam($LibCam)
    {
        $this->LibCam = $LibCam;
    }

    /**
     * @return null
     */
    public function getDateCreDE()
    {
        return $this->DateCreDE;
    }

    /**
     * @param null $DateCreDE
     */
    public function setDateCreDE($DateCreDE)
    {
        $this->DateCreDE = $DateCreDE;
    }

    /**
     * @return int
     */
    public function getHeureCreDE()
    {
        return $this->HeureCreDE;
    }

    /**
     * @param int $HeureCreDE
     */
    public function setHeureCreDE($HeureCreDE)
    {
        $this->HeureCreDE = $HeureCreDE;
    }

    /**
     * @return null
     */
    public function getDateModDE()
    {
        return $this->DateModDE;
    }

    /**
     * @param null $DateModDE
     */
    public function setDateModDE($DateModDE)
    {
        $this->DateModDE = $DateModDE;
    }

    /**
     * @return int
     */
    public function getIdDUCre()
    {
        return $this->IdDUCre;
    }

    /**
     * @param int $IdDUCre
     */
    public function setIdDUCre($IdDUCre)
    {
        $this->IdDUCre = $IdDUCre;
    }

    /**
     * @return int
     */
    public function getIdDUMod()
    {
        return $this->IdDUMod;
    }

    /**
     * @param int $IdDUMod
     */
    public function setIdDUMod($IdDUMod)
    {
        $this->IdDUMod = $IdDUMod;
    }

    /**
     * @return int
     */
    public function getMontTvaDE()
    {
        return $this->MontTvaDE;
    }

    /**
     * @param int $MontTvaDE
     */
    public function setMontTvaDE($MontTvaDE)
    {
        $this->MontTvaDE = $MontTvaDE;
    }

    /**
     * @return int
     */
    public function getMontTgapDE()
    {
        return $this->MontTgapDE;
    }

    /**
     * @param int $MontTgapDE
     */
    public function setMontTgapDE($MontTgapDE)
    {
        $this->MontTgapDE = $MontTgapDE;
    }

    /**
     * @return int
     */
    public function getMontParafDE()
    {
        return $this->MontParafDE;
    }

    /**
     * @param int $MontParafDE
     */
    public function setMontParafDE($MontParafDE)
    {
        $this->MontParafDE = $MontParafDE;
    }

    /**
     * @return int
     */
    public function getMontHTApRemDE()
    {
        return $this->MontHTApRemDE;
    }

    /**
     * @param int $MontHTApRemDE
     */
    public function setMontHTApRemDE($MontHTApRemDE)
    {
        $this->MontHTApRemDE = $MontHTApRemDE;
    }

    /**
     * @return int
     */
    public function getMontTvaApRemDE()
    {
        return $this->MontTvaApRemDE;
    }

    /**
     * @param int $MontTvaApRemDE
     */
    public function setMontTvaApRemDE($MontTvaApRemDE)
    {
        $this->MontTvaApRemDE = $MontTvaApRemDE;
    }

    /**
     * @return int
     */
    public function getMontParafApRemDE()
    {
        return $this->MontParafApRemDE;
    }

    /**
     * @param int $MontParafApRemDE
     */
    public function setMontParafApRemDE($MontParafApRemDE)
    {
        $this->MontParafApRemDE = $MontParafApRemDE;
    }

    /**
     * @return int
     */
    public function getMontTTCApRemDE()
    {
        return $this->MontTTCApRemDE;
    }

    /**
     * @param int $MontTTCApRemDE
     */
    public function setMontTTCApRemDE($MontTTCApRemDE)
    {
        $this->MontTTCApRemDE = $MontTTCApRemDE;
    }

    /**
     * @return int
     */
    public function getMontHTMarDE()
    {
        return $this->MontHTMarDE;
    }

    /**
     * @param int $MontHTMarDE
     */
    public function setMontHTMarDE($MontHTMarDE)
    {
        $this->MontHTMarDE = $MontHTMarDE;
    }

    /**
     * @return int
     */
    public function getMontRevReMarDE()
    {
        return $this->MontRevReMarDE;
    }

    /**
     * @param int $MontRevReMarDE
     */
    public function setMontRevReMarDE($MontRevReMarDE)
    {
        $this->MontRevReMarDE = $MontRevReMarDE;
    }

    /**
     * @return int
     */
    public function getMontRevConvMarDE()
    {
        return $this->MontRevConvMarDE;
    }

    /**
     * @param int $MontRevConvMarDE
     */
    public function setMontRevConvMarDE($MontRevConvMarDE)
    {
        $this->MontRevConvMarDE = $MontRevConvMarDE;
    }

    /**
     * @return int
     */
    public function getMontEcoTaxeDE()
    {
        return $this->MontEcoTaxeDE;
    }

    /**
     * @param int $MontEcoTaxeDE
     */
    public function setMontEcoTaxeDE($MontEcoTaxeDE)
    {
        $this->MontEcoTaxeDE = $MontEcoTaxeDE;
    }

    /**
     * @return int
     */
    public function getMontHTAvecPortDE()
    {
        return $this->MontHTAvecPortDE;
    }

    /**
     * @param int $MontHTAvecPortDE
     */
    public function setMontHTAvecPortDE($MontHTAvecPortDE)
    {
        $this->MontHTAvecPortDE = $MontHTAvecPortDE;
    }

    /**
     * @return int
     */
    public function getMontRevReDE()
    {
        return $this->MontRevReDE;
    }

    /**
     * @param int $MontRevReDE
     */
    public function setMontRevReDE($MontRevReDE)
    {
        $this->MontRevReDE = $MontRevReDE;
    }

    /**
     * @return int
     */
    public function getMontRevConvDE()
    {
        return $this->MontRevConvDE;
    }

    /**
     * @param int $MontRevConvDE
     */
    public function setMontRevConvDE($MontRevConvDE)
    {
        $this->MontRevConvDE = $MontRevConvDE;
    }

    /**
     * @return int
     */
    public function getTotPoidsDE()
    {
        return $this->TotPoidsDE;
    }

    /**
     * @param int $TotPoidsDE
     */
    public function setTotPoidsDE($TotPoidsDE)
    {
        $this->TotPoidsDE = $TotPoidsDE;
    }

    /**
     * @return string
     */
    public function getComLivDE()
    {
        return $this->ComLivDE;
    }

    /**
     * @param string $ComLivDE
     */
    public function setComLivDE($ComLivDE)
    {
        $this->ComLivDE = $ComLivDE;
    }

    /**
     * @return string
     */
    public function getZoneLivDE()
    {
        return $this->ZoneLivDE;
    }

    /**
     * @param string $ZoneLivDE
     */
    public function setZoneLivDE($ZoneLivDE)
    {
        $this->ZoneLivDE = $ZoneLivDE;
    }

    /**
     * @return bool
     */
    public function isFlgTva2DE()
    {
        return $this->FlgTva2DE;
    }

    /**
     * @param bool $FlgTva2DE
     */
    public function setFlgTva2DE($FlgTva2DE)
    {
        $this->FlgTva2DE = $FlgTva2DE;
    }

    /**
     * @return int
     */
    public function getTotRegDE()
    {
        return $this->TotRegDE;
    }

    /**
     * @param int $TotRegDE
     */
    public function setTotRegDE($TotRegDE)
    {
        $this->TotRegDE = $TotRegDE;
    }

    /**
     * @return int
     */
    public function getMontHTExtDE()
    {
        return $this->MontHTExtDE;
    }

    /**
     * @param int $MontHTExtDE
     */
    public function setMontHTExtDE($MontHTExtDE)
    {
        $this->MontHTExtDE = $MontHTExtDE;
    }

    /**
     * @return int
     */
    public function getMontTVAExtDE()
    {
        return $this->MontTVAExtDE;
    }

    /**
     * @param int $MontTVAExtDE
     */
    public function setMontTVAExtDE($MontTVAExtDE)
    {
        $this->MontTVAExtDE = $MontTVAExtDE;
    }

    /**
     * @return int
     */
    public function getMontTTCExtDE()
    {
        return $this->MontTTCExtDE;
    }

    /**
     * @param int $MontTTCExtDE
     */
    public function setMontTTCExtDE($MontTTCExtDE)
    {
        $this->MontTTCExtDE = $MontTTCExtDE;
    }

    /**
     * @return null
     */
    public function getDateRegDE()
    {
        return $this->DateRegDE;
    }

    /**
     * @param null $DateRegDE
     */
    public function setDateRegDE($DateRegDE)
    {
        $this->DateRegDE = $DateRegDE;
    }

    /**
     * @return string
     */
    public function getRSocDE()
    {
        return $this->RSocDE;
    }

    /**
     * @param string $RSocDE
     */
    public function setRSocDE($RSocDE)
    {
        $this->RSocDE = $RSocDE;
    }

    /**
     * @return null
     */
    public function getDateHeureEditDE()
    {
        return $this->DateHeureEditDE;
    }

    /**
     * @param null $DateHeureEditDE
     */
    public function setDateHeureEditDE($DateHeureEditDE)
    {
        $this->DateHeureEditDE = $DateHeureEditDE;
    }

    /**
     * @return string
     */
    public function getCodRgpt()
    {
        return $this->CodRgpt;
    }

    /**
     * @param string $CodRgpt
     */
    public function setCodRgpt($CodRgpt)
    {
        $this->CodRgpt = $CodRgpt;
    }

    /**
     * @return string
     */
    public function getHASH()
    {
        return $this->HASH;
    }

    /**
     * @param string $HASH
     */
    public function setHASH($HASH)
    {
        $this->HASH = $HASH;
    }

    /**
     * @return int
     */
    public function getIdCli()
    {
        return $this->IdCli;
    }

    /**
     * @param int $IdCli
     */
    public function setIdCli($IdCli)
    {
        $this->IdCli = $IdCli;
    }

    /**
     * @return int
     */
    public function getNoCli()
    {
        return $this->NoCli;
    }

    /**
     * @param int $NoCli
     */
    public function setNoCli($NoCli)
    {
        $this->NoCli = $NoCli;
    }

    /**
     * @return string
     */
    public function getCodCli()
    {
        return $this->CodCli;
    }

    /**
     * @param string $CodCli
     */
    public function setCodCli($CodCli)
    {
        $this->CodCli = $CodCli;
    }

    /**
     * @return string
     */
    public function getNoComptaCli()
    {
        return $this->NoComptaCli;
    }

    /**
     * @param string $NoComptaCli
     */
    public function setNoComptaCli($NoComptaCli)
    {
        $this->NoComptaCli = $NoComptaCli;
    }

    /**
     * @return string
     */
    public function getRSocCli()
    {
        return $this->RSocCli;
    }

    /**
     * @param string $RSocCli
     */
    public function setRSocCli($RSocCli)
    {
        $this->RSocCli = $RSocCli;
    }

    /**
     * @return string
     */
    public function getRSocLivDE()
    {
        return $this->RSocLivDE;
    }

    /**
     * @param string $RSocLivDE
     */
    public function setRSocLivDE($RSocLivDE)
    {
        $this->RSocLivDE = $RSocLivDE;
    }

    /**
     * @return string
     */
    public function getAdrLivDE()
    {
        return $this->AdrLivDE;
    }

    /**
     * @param string $AdrLivDE
     */
    public function setAdrLivDE($AdrLivDE)
    {
        $this->AdrLivDE = $AdrLivDE;
    }

    /**
     * @return string
     */
    public function getCPLivDE()
    {
        return $this->CPLivDE;
    }

    /**
     * @param string $CPLivDE
     */
    public function setCPLivDE($CPLivDE)
    {
        $this->CPLivDE = $CPLivDE;
    }

    /**
     * @return string
     */
    public function getVilleLivDE()
    {
        return $this->VilleLivDE;
    }

    /**
     * @param string $VilleLivDE
     */
    public function setVilleLivDE($VilleLivDE)
    {
        $this->VilleLivDE = $VilleLivDE;
    }

    /**
     * @return string
     */
    public function getPaysLivDE()
    {
        return $this->PaysLivDE;
    }

    /**
     * @param string $PaysLivDE
     */
    public function setPaysLivDE($PaysLivDE)
    {
        $this->PaysLivDE = $PaysLivDE;
    }

    /**
     * @return string
     */
    public function getTelLivDE()
    {
        return $this->TelLivDE;
    }

    /**
     * @param string $TelLivDE
     */
    public function setTelLivDE($TelLivDE)
    {
        $this->TelLivDE = $TelLivDE;
    }

    /**
     * @return string
     */
    public function getFaxLivDE()
    {
        return $this->FaxLivDE;
    }

    /**
     * @param string $FaxLivDE
     */
    public function setFaxLivDE($FaxLivDE)
    {
        $this->FaxLivDE = $FaxLivDE;
    }

    /**
     * @return string
     */
    public function getMailLivDE()
    {
        return $this->MailLivDE;
    }

    /**
     * @param string $MailLivDE
     */
    public function setMailLivDE($MailLivDE)
    {
        $this->MailLivDE = $MailLivDE;
    }

    /**
     * @return string
     */
    public function getRSocFacDE()
    {
        return $this->RSocFacDE;
    }

    /**
     * @param string $RSocFacDE
     */
    public function setRSocFacDE($RSocFacDE)
    {
        $this->RSocFacDE = $RSocFacDE;
    }

    /**
     * @return string
     */
    public function getAdrFacDE()
    {
        return $this->AdrFacDE;
    }

    /**
     * @param string $AdrFacDE
     */
    public function setAdrFacDE($AdrFacDE)
    {
        $this->AdrFacDE = $AdrFacDE;
    }

    /**
     * @return string
     */
    public function getCPFacDE()
    {
        return $this->CPFacDE;
    }

    /**
     * @param string $CPFacDE
     */
    public function setCPFacDE($CPFacDE)
    {
        $this->CPFacDE = $CPFacDE;
    }

    /**
     * @return string
     */
    public function getVilleFacDE()
    {
        return $this->VilleFacDE;
    }

    /**
     * @param string $VilleFacDE
     */
    public function setVilleFacDE($VilleFacDE)
    {
        $this->VilleFacDE = $VilleFacDE;
    }

    /**
     * @return string
     */
    public function getPaysFacDE()
    {
        return $this->PaysFacDE;
    }

    /**
     * @param string $PaysFacDE
     */
    public function setPaysFacDE($PaysFacDE)
    {
        $this->PaysFacDE = $PaysFacDE;
    }

    /**
     * @return string
     */
    public function getTelFacDE()
    {
        return $this->TelFacDE;
    }

    /**
     * @param string $TelFacDE
     */
    public function setTelFacDE($TelFacDE)
    {
        $this->TelFacDE = $TelFacDE;
    }

    /**
     * @return string
     */
    public function getFaxFacDE()
    {
        return $this->FaxFacDE;
    }

    /**
     * @param string $FaxFacDE
     */
    public function setFaxFacDE($FaxFacDE)
    {
        $this->FaxFacDE = $FaxFacDE;
    }

    /**
     * @return string
     */
    public function getMailFacDE()
    {
        return $this->MailFacDE;
    }

    /**
     * @param string $MailFacDE
     */
    public function setMailFacDE($MailFacDE)
    {
        $this->MailFacDE = $MailFacDE;
    }

    /**
     * @return int
     */
    public function getIdSalVend()
    {
        return $this->IdSalVend;
    }

    /**
     * @param int $IdSalVend
     */
    public function setIdSalVend($IdSalVend)
    {
        $this->IdSalVend = $IdSalVend;
    }

    /**
     * @return string
     */
    public function getCodSalVend()
    {
        return $this->CodSalVend;
    }

    /**
     * @param string $CodSalVend
     */
    public function setCodSalVend($CodSalVend)
    {
        $this->CodSalVend = $CodSalVend;
    }

    /**
     * @return int
     */
    public function getIdSalRep()
    {
        return $this->IdSalRep;
    }

    /**
     * @param int $IdSalRep
     */
    public function setIdSalRep($IdSalRep)
    {
        $this->IdSalRep = $IdSalRep;
    }

    /**
     * @return string
     */
    public function getCodSalRep()
    {
        return $this->CodSalRep;
    }

    /**
     * @param string $CodSalRep
     */
    public function setCodSalRep($CodSalRep)
    {
        $this->CodSalRep = $CodSalRep;
    }

    /**
     * @return int
     */
    public function getIdCha()
    {
        return $this->IdCha;
    }

    /**
     * @param int $IdCha
     */
    public function setIdCha($IdCha)
    {
        $this->IdCha = $IdCha;
    }

    /**
     * @return string
     */
    public function getCodCha()
    {
        return $this->CodCha;
    }

    /**
     * @param string $CodCha
     */
    public function setCodCha($CodCha)
    {
        $this->CodCha = $CodCha;
    }

    /**
     * @return string
     */
    public function getLibCha()
    {
        return $this->LibCha;
    }

    /**
     * @param string $LibCha
     */
    public function setLibCha($LibCha)
    {
        $this->LibCha = $LibCha;
    }

    /**
     * @return string
     */
    public function getAdrCha()
    {
        return $this->AdrCha;
    }

    /**
     * @param string $AdrCha
     */
    public function setAdrCha($AdrCha)
    {
        $this->AdrCha = $AdrCha;
    }

    /**
     * @return string
     */
    public function getCPCha()
    {
        return $this->CPCha;
    }

    /**
     * @param string $CPCha
     */
    public function setCPCha($CPCha)
    {
        $this->CPCha = $CPCha;
    }

    /**
     * @return string
     */
    public function getVilleCha()
    {
        return $this->VilleCha;
    }

    /**
     * @param string $VilleCha
     */
    public function setVilleCha($VilleCha)
    {
        $this->VilleCha = $VilleCha;
    }

    /**
     * @return int
     */
    public function getMontPortDE()
    {
        return $this->MontPortDE;
    }

    /**
     * @param int $MontPortDE
     */
    public function setMontPortDE($MontPortDE)
    {
        $this->MontPortDE = $MontPortDE;
    }

    /**
     * @return null
     */
    public function getDateLivDE()
    {
        return $this->DateLivDE;
    }

    /**
     * @param null $DateLivDE
     */
    public function setDateLivDE($DateLivDE)
    {
        $this->DateLivDE = $DateLivDE;
    }

    /**
     * @return int
     */
    public function getIdTC()
    {
        return $this->IdTC;
    }

    /**
     * @param int $IdTC
     */
    public function setIdTC($IdTC)
    {
        $this->IdTC = $IdTC;
    }

    /**
     * @return string
     */
    public function getPrisParDE()
    {
        return $this->PrisParDE;
    }

    /**
     * @param string $PrisParDE
     */
    public function setPrisParDE($PrisParDE)
    {
        $this->PrisParDE = $PrisParDE;
    }

    /**
     * @return null
     */
    public function getDateReacDE()
    {
        return $this->DateReacDE;
    }

    /**
     * @param null $DateReacDE
     */
    public function setDateReacDE($DateReacDE)
    {
        $this->DateReacDE = $DateReacDE;
    }

    /**
     * @return bool
     */
    public function isFlgPFDE()
    {
        return $this->FlgPFDE;
    }

    /**
     * @param bool $FlgPFDE
     */
    public function setFlgPFDE($FlgPFDE)
    {
        $this->FlgPFDE = $FlgPFDE;
    }

    /**
     * @return string
     */
    public function getCodOrigDE()
    {
        return $this->CodOrigDE;
    }

    /**
     * @param string $CodOrigDE
     */
    public function setCodOrigDE($CodOrigDE)
    {
        $this->CodOrigDE = $CodOrigDE;
    }

    /**
     * @return null
     */
    public function getDateCloDE()
    {
        return $this->DateCloDE;
    }

    /**
     * @param null $DateCloDE
     */
    public function setDateCloDE($DateCloDE)
    {
        $this->DateCloDE = $DateCloDE;
    }
    
}