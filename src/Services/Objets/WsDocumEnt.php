<?php

namespace App\Services\Objets;

class WsDocumEnt
{
    public $FamDocDE = "";
    public $IdDE = 0;
    public $IdDocDE = 0;
    public $NumDE = 0;
    public $DateDE = null;
    public $IdSoc = 0;
    public $EtatDE = "";
    public $TypeDE = "";
    public $RefDE = "";
    public $MontTTCDE = 0;
    public $MontHTDE = 0;
    public $ComDE = "";
    public $AnnotDE = "";
    public $FlgValidDE = false;
    public $MotsClesAutoDE = "";
    public $EchRegDE = "";
    public $FinMoisDE = false;
    public $DecalRegDE = "";
    public $JRegDE = 0;
    public $MRegDE = "";
    public $FlgTTCDE = false;
    public $RemDE = 0;
    public $TypeTvaDE = "";
    public $IdDepCre = 0;
    public $IdDepLiv = 0;
    public $CodDepCre = "";
    public $CodDepLiv = "";
    public $CodPortDE = "";
    public $IdCam = 0;
    public $CodCam = "";
    public $LibCam = "";
    public $DateCreDE = null;
    public $HeureCreDE = 0;
    public $DateModDE = null;
    public $IdDUCre = 0;
    public $IdDUMod = 0;
    public $MontTvaDE = 0;
    public $MontTgapDE = 0;
    public $MontParafDE = 0;
    public $MontHTApRemDE = 0;
    public $MontTvaApRemDE = 0;
    public $MontParafApRemDE = 0;
    public $MontTTCApRemDE = 0;
    public $MontHTMarDE = 0;
    public $MontRevReMarDE = 0;
    public $MontRevConvMarDE = 0;
    public $MontEcoTaxeDE = 0;
    public $MontHTAvecPortDE = 0;
    public $MontRevReDE = 0;
    public $MontRevConvDE = 0;
    public $TotPoidsDE = 0;
    public $ComLivDE = "";
    public $ZoneLivDE = "";
    public $FlgTva2DE = false;
    public $TotRegDE = 0;
    public $MontHTExtDE = 0;
    public $MontTVAExtDE = 0;
    public $MontTTCExtDE = 0;
    public $DateRegDE = null;
    public $RSocDE = "";
    public $DateHeureEditDE = null;
    public $CodRgpt = "";
    public $HASH = "";
    public $IdCli = 0;
    public $NoCli = 0;
    public $CodCli = "";
    public $NoComptaCli = "";
    public $RSocCli = "";
    public $RSocLivDE = "";
    public $AdrLivDE = "";
    public $CPLivDE = "";
    public $VilleLivDE = "";
    public $PaysLivDE = "";
    public $TelLivDE = "";
    public $FaxLivDE = "";
    public $MailLivDE = "";
    public $RSocFacDE = "";
    public $AdrFacDE = "";
    public $CPFacDE = "";
    public $VilleFacDE = "";
    public $PaysFacDE = "";
    public $TelFacDE = "";
    public $FaxFacDE = "";
    public $MailFacDE = "";
    public $IdSalVend = 0;
    public $CodSalVend = "";
    public $IdSalRep = 0;
    public $CodSalRep = "";
    public $IdCha = 0;
    public $CodCha = "";
    public $LibCha = "";
    public $AdrCha = "";
    public $CPCha = "";
    public $VilleCha = "";
    public $MontPortDE = 0;
    public $DateLivDE = null;
    public $IdTC = 0;
    public $PrisParDE = "";
    public $DateReacDE = null;
    public $FlgPFDE = false;
    public $CodOrigDE = "";
    public $DateCloDE = null;
    public $DateRelDE = null;
    public $IdSalRel = 0;
    public $NatDE = "";
    public $DateRealDE = null;
    public $DateFacDE = null;
    public $CodTvaDE = array();
    public $BaseHTDE = array();
    public $BaseTvaDE = array();
    public $BaseTgapDE = array();
    public $BaseParafDE = array();
    public $MontTgapTableDE = array();
    public $MontParafTableDE = array();
    public $MontTvaTableDE = array();

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {
        if(!is_null($json_object)) {
            if(isset($json_object->{'DateDE'})) {
                $this->setDateDE($json_object->{'DateDE'});
            }
            $this->setFamDocDE($json_object->{'FamDocDE'});
            $this->setIdDE($json_object->{'IdDE'});
            $this->setIdDocDE($json_object->{'IdDocDE'});
            $this->setNumDE($json_object->{'NumDE'});
            $this->setDateDE($json_object->{'DateDE'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setEtatDE($json_object->{'EtatDE'});
            $this->setTypeDE($json_object->{'TypeDE'});
            $this->setRefDE($json_object->{'RefDE'});
            $this->setMontTTCDE($json_object->{'MontTTCDE'});
            $this->setMontHTDE($json_object->{'MontHTDE'});
            $this->setComDE($json_object->{'ComDE'});
            $this->setAnnotDE($json_object->{'AnnotDE'});
            $this->setFlgValidDE($json_object->{'FlgValidDE'});
            $this->setMotsClesAutoDE($json_object->{'MotsClesAutoDE'});
            $this->setEchRegDE($json_object->{'EchRegDE'});
            $this->setFinMoisDE($json_object->{'FinMoisDE'});
            $this->setDecalRegDE($json_object->{'DecalRegDE'});
            $this->setJRegDE($json_object->{'JRegDE'});
            $this->setMRegDE($json_object->{'MRegDE'});
            $this->setFlgTTCDE($json_object->{'FlgTTCDE'});
            $this->setRemDE($json_object->{'RemDE'});
            $this->setTypeTvaDE($json_object->{'TypeTvaDE'});
            $this->setIdDepCre($json_object->{'IdDepCre'});
            $this->setIdDepLiv($json_object->{'IdDepLiv'});
            $this->setCodDepCre($json_object->{'CodDepCre'});
            $this->setCodDepLiv($json_object->{'CodDepLiv'});
            $this->setCodPortDE($json_object->{'CodPortDE'});
            $this->setIdCam($json_object->{'IdCam'});
            $this->setCodCam($json_object->{'CodCam'});
            $this->setLibCam($json_object->{'LibCam'});
            $this->setDateCreDE($json_object->{'DateCreDE'});
            $this->setHeureCreDE($json_object->{'HeureCreDE'});
            $this->setDateModDE($json_object->{'DateModDE'});
            $this->setIdDUCre($json_object->{'IdDUCre'});
            $this->setIdDUMod($json_object->{'IdDUMod'});
            $this->setMontTvaDE($json_object->{'MontTvaDE'});
            $this->setMontTgapDE($json_object->{'MontTgapDE'});
            $this->setMontParafDE($json_object->{'MontParafDE'});
            $this->setMontHTApRemDE($json_object->{'MontHTApRemDE'});
            $this->setMontTvaApRemDE($json_object->{'MontTvaApRemDE'});
            $this->setMontParafApRemDE($json_object->{'MontParafApRemDE'});
            $this->setMontTTCApRemDE($json_object->{'MontTTCApRemDE'});
            $this->setMontHTMarDE($json_object->{'MontHTMarDE'});
            $this->setMontRevReMarDE($json_object->{'MontRevReMarDE'});
            $this->setMontRevConvMarDE($json_object->{'MontRevConvMarDE'});
            $this->setMontEcoTaxeDE($json_object->{'MontEcoTaxeDE'});
            $this->setMontHTAvecPortDE($json_object->{'MontHTAvecPortDE'});
            $this->setMontRevReDE($json_object->{'MontRevReDE'});
            $this->setMontRevConvDE($json_object->{'MontRevConvDE'});
            $this->setTotPoidsDE($json_object->{'TotPoidsDE'});
            $this->setComLivDE($json_object->{'ComLivDE'});
            $this->setZoneLivDE($json_object->{'ZoneLivDE'});
            $this->setFlgTva2DE($json_object->{'FlgTva2DE'});
            $this->setTotRegDE($json_object->{'TotRegDE'});
            $this->setMontHTExtDE($json_object->{'MontHTExtDE'});
            $this->setMontTVAExtDE($json_object->{'MontTVAExtDE'});
            $this->setMontTTCExtDE($json_object->{'MontTTCExtDE'});
            $this->setDateRegDE($json_object->{'DateRegDE'});
            $this->setRSocDE($json_object->{'RSocDE'});
            $this->setDateHeureEditDE($json_object->{'DateHeureEditDE'});
            $this->setCodRgpt($json_object->{'CodRgpt'});
            $this->setHASH($json_object->{'HASH'});
            $this->setIdCli($json_object->{'IdCli'});
            $this->setNoCli($json_object->{'NoCli'});
            $this->setCodCli($json_object->{'CodCli'});
            $this->setNoComptaCli($json_object->{'NoComptaCli'});
            $this->setRSocCli($json_object->{'RSocCli'});
            $this->setRSocLivDE($json_object->{'RSocLivDE'});
            $this->setAdrLivDE($json_object->{'AdrLivDE'});
            $this->setCPLivDE($json_object->{'CPLivDE'});
            $this->setVilleLivDE($json_object->{'VilleLivDE'});
            $this->setPaysLivDE($json_object->{'PaysLivDE'});
            $this->setTelLivDE($json_object->{'TelLivDE'});
            $this->setFaxLivDE($json_object->{'FaxLivDE'});
            $this->setMailLivDE($json_object->{'MailLivDE'});
            $this->setRSocFacDE($json_object->{'RSocFacDE'});
            $this->setAdrFacDE($json_object->{'AdrFacDE'});
            $this->setCPFacDE($json_object->{'CPFacDE'});
            $this->setVilleFacDE($json_object->{'VilleFacDE'});
            $this->setPaysFacDE($json_object->{'PaysFacDE'});
            $this->setTelFacDE($json_object->{'TelFacDE'});
            $this->setFaxFacDE($json_object->{'FaxFacDE'});
            $this->setMailFacDE($json_object->{'MailFacDE'});
            $this->setIdSalVend($json_object->{'IdSalVend'});
            $this->setCodSalVend($json_object->{'CodSalVend'});
            $this->setIdSalRep($json_object->{'IdSalRep'});
            $this->setCodSalRep($json_object->{'CodSalRep'});
            $this->setIdCha($json_object->{'IdCha'});
            $this->setCodCha($json_object->{'CodCha'});
            $this->setLibCha($json_object->{'LibCha'});
            $this->setAdrCha($json_object->{'AdrCha'});
            $this->setCPCha($json_object->{'CPCha'});
            $this->setVilleCha($json_object->{'VilleCha'});
            $this->setMontPortDE($json_object->{'MontPortDE'});
            $this->setDateLivDE($json_object->{'DateLivDE'});
            $this->setIdTC($json_object->{'IdTC'});
            $this->setPrisParDE($json_object->{'PrisParDE'});
            $this->setDateReacDE($json_object->{'DateReacDE'});
            $this->setFlgPFDE($json_object->{'FlgPFDE'});
            $this->setCodOrigDE($json_object->{'CodOrigDE'});
            $this->setDateCloDE($json_object->{'DateCloDE'});

            //DEVIS
            if(property_exists($json_object, 'DateRelDE')) {
                $this->setDateRelDE($json_object->{'DateRelDE'});
            }
            if(property_exists($json_object, 'IdSalRel')) {
                $this->setIdSalRel($json_object->{'IdSalRel'});
            }
            if(property_exists($json_object, 'NatDE')) {
                $this->setNatDE($json_object->{'NatDE'});
            }
            if(property_exists($json_object, 'DateRealDE')) {
                $this->setDateRealDE($json_object->{'DateRealDE'});
            }

            //BL
            if(property_exists($json_object, 'DateFacDE')) {
                $this->setDateFacDE($json_object->{'DateFacDE'});
            }

            //FACCLI
            if(property_exists($json_object, 'CodTvaDE')) {
                $this->setCodTvaDE($json_object->{'CodTvaDE'});
            }
            if(property_exists($json_object, 'BaseHTDE')) {
                $this->setBaseHTDE($json_object->{'BaseHTDE'});
            }
            if(property_exists($json_object, 'BaseTvaDE')) {
                $this->setBaseTvaDE($json_object->{'BaseTvaDE'});
            }
            if(property_exists($json_object, 'BaseTgapDE')) {
                $this->setBaseTgapDE($json_object->{'BaseTgapDE'});
            }
            if(property_exists($json_object, 'BaseParafDE')) {
                $this->setBaseParafDE($json_object->{'BaseParafDE'});
            }
            if(property_exists($json_object, 'MontTgapTableDE')) {
                $this->setMontTgapTableDE($json_object->{'MontTgapTableDE'});
            }
            if(property_exists($json_object, 'MontParafTableDE')) {
                $this->setMontParafTableDE($json_object->{'MontParafTableDE'});
            }
            if(property_exists($json_object, 'MontTvaTableDE')) {
                $this->setMontTvaTableDE($json_object->{'MontTvaTableDE'});
            }
        }
    }

    /**
     * __toString
     * Retourne un JSON de l'objet
     */
    public function __toString()
    {
        $string = '{';
        $string .= '"FamDocDE": "'.$this->getFamDocDE().'" ,';
        $string .= '"IdDE": '.$this->getIdDE().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"NumDE": '.$this->getNumDE().' ,';
        $string .= '"DateDE": "'.date_format($this->getDateDE(), 'Y-m-d').'" ,';
        $string .= '"IdSoc": '.$this->getIdSoc().' ,';
        $string .= '"EtatDE": "'.$this->getEtatDE().'" ,';
        $string .= '"TypeDE": "'.$this->getTypeDE().'" ,';
        $string .= '"RefDE": "'.$this->getRefDE().'" ,';
        $string .= '"MontTTCDE": '.$this->getMontTTCDE().' ,';
        $string .= '"MontHTDE": '.$this->getMontHTDE().' ,';
        $string .= '"ComDE": "'.$this->getComDE().'" ,';
        $string .= '"AnnotDE": "'.$this->getAnnotDE().'" ,';

        $val = ($this->isFlgValidDE()) ? 'true' : 'false';
        $string .= '"FlgValidDE": '.$val.' ,';

        $string .= '"MotsClesAutoDE": "'.$this->getMotsClesAutoDE().'" ,';
        $string .= '"EchRegDE": "'.$this->getEchRegDE().'" ,';

        $val = ($this->isFinMoisDE()) ? 'true' : 'false';
        $string .= '"FinMoisDE": '.$val.' ,';

        $string .= '"DecalRegDE": "'.$this->getDecalRegDE().'" ,';
        $string .= '"JRegDE": '.$this->getJRegDE().' ,';
        $string .= '"MRegDE": "'.$this->getMRegDE().'" ,';

        $val = ($this->isFlgTTCDE()) ? 'true' : 'false';
        $string .= '"FlgTTCDE": '.$val.' ,';

        $string .= '"RemDE": '.$this->getRemDE().' ,';
        $string .= '"TypeTvaDE": "'.$this->getTypeTvaDE().'" ,';
        $string .= '"IdDepCre": '.$this->getIdDepCre().' ,';
        $string .= '"IdDepLiv": '.$this->getIdDepLiv().' ,';
        $string .= '"CodDepCre": "'.$this->getCodDepCre().'" ,';
        $string .= '"CodDepLiv": "'.$this->getCodDepLiv().'" ,';
        $string .= '"CodPortDE": "'.$this->getCodPortDE().'" ,';
        $string .= '"IdCam": '.$this->getIdCam().' ,';
        $string .= '"CodCam": "'.$this->getCodCam().'" ,';
        $string .= '"LibCam": "'.$this->getLibCam().'" ,';
        $string .= '"DateCreDE": "'.date_format($this->getDateCreDE(), 'Y-m-d').'" ,';
        $string .= '"HeureCreDE": '.$this->getHeureCreDE().' ,';
        $string .= '"DateModDE": "'.date_format($this->getDateModDE(), 'Y-m-d').'" ,';
        $string .= '"IdDUCre": '.$this->getIdDUCre().' ,';
        $string .= '"IdDUMod": '.$this->getIdDUMod().' ,';
        $string .= '"MontTvaDE": '.$this->getMontTvaDE().' ,';
        $string .= '"MontTgapDE": '.$this->getMontTgapDE().' ,';
        $string .= '"MontParafDE": '.$this->getMontParafDE().' ,';
        $string .= '"MontHTApRemDE": '.$this->getMontHTApRemDE().' ,';
        $string .= '"MontTvaApRemDE": '.$this->getMontTvaApRemDE().' ,';
        $string .= '"MontParafApRemDE": '.$this->getMontParafApRemDE().' ,';
        $string .= '"MontTTCApRemDE": '.$this->getMontTTCApRemDE().' ,';
        $string .= '"MontHTMarDE": '.$this->getMontHTMarDE().' ,';
        $string .= '"MontRevReMarDE": '.$this->getMontRevReMarDE().' ,';
        $string .= '"MontRevConvMarDE": '.$this->getMontRevConvMarDE().' ,';
        $string .= '"MontEcoTaxeDE": '.$this->getMontEcoTaxeDE().' ,';
        $string .= '"MontHTAvecPortDE": '.$this->getMontHTAvecPortDE().' ,';
        $string .= '"MontRevReDE": '.$this->getMontRevReDE().' ,';
        $string .= '"MontRevConvDE": '.$this->getMontRevConvDE().' ,';
        $string .= '"TotPoidsDE": '.$this->getTotPoidsDE().' ,';
        $string .= '"ComLivDE": "'.$this->getComLivDE().'" ,';
        $string .= '"ZoneLivDE": "'.$this->getZoneLivDE().'" ,';

        $val = ($this->isFlgTva2DE()) ? 'true' : 'false';
        $string .= '"FlgTva2DE": '.$val.' ,';

        $string .= '"TotRegDE": '.$this->getTotRegDE().' ,';
        $string .= '"MontHTExtDE": '.$this->getMontHTExtDE().' ,';
        $string .= '"MontTVAExtDE": '.$this->getMontTVAExtDE().' ,';
        $string .= '"MontTTCExtDE": '.$this->getMontTTCExtDE().' ,';
        $string .= '"DateRegDE": "'.date_format($this->getDateRegDE(), 'Y-m-d').'" ,';
        $string .= '"RSocDE": "'.$this->getRSocDE().'" ,';
        $string .= '"DateHeureEditDE": '.$this->getDateHeureEditDE().' ,';
        $string .= '"CodRgpt": "'.$this->getCodRgpt().'" ,';
        $string .= '"HASH": "'.$this->getHASH().'" ,';
        $string .= '"IdCli": '.$this->getIdCli().' ,';
        $string .= '"NoCli": '.$this->getNoCli().' ,';
        $string .= '"CodCli": "'.$this->getCodCli().'" ,';
        $string .= '"NoComptaCli": "'.$this->getNoComptaCli().'" ,';
        $string .= '"RSocCli": "'.$this->getRSocCli().'" ,';
        $string .= '"RSocLivDE": "'.$this->getRSocLivDE().'" ,';
        $string .= '"AdrLivDE": "'.$this->getAdrLivDE().'" ,';
        $string .= '"CPLivDE": "'.$this->getCPLivDE().'" ,';
        $string .= '"VilleLivDE": "'.$this->getVilleLivDE().'" ,';
        $string .= '"PaysLivDE": "'.$this->getPaysLivDE().'" ,';
        $string .= '"TelLivDE": "'.$this->getTelLivDE().'" ,';
        $string .= '"FaxLivDE": "'.$this->getFaxLivDE().'" ,';
        $string .= '"MailLivDE": "'.$this->getMailLivDE().'" ,';
        $string .= '"RSocFacDE": "'.$this->getRSocFacDE().'" ,';
        $string .= '"AdrFacDE": "'.$this->getAdrFacDE().'" ,';
        $string .= '"CPFacDE": "'.$this->getCPFacDE().'" ,';
        $string .= '"VilleFacDE": "'.$this->getVilleFacDE().'" ,';
        $string .= '"PaysFacDE": "'.$this->getPaysFacDE().'" ,';
        $string .= '"TelFacDE": "'.$this->getTelFacDE().'" ,';
        $string .= '"FaxFacDE": "'.$this->getFaxFacDE().'" ,';
        $string .= '"MailFacDE": "'.$this->getMailFacDE().'" ,';
        $string .= '"IdSalVend": '.$this->getIdSalVend().' ,';
        $string .= '"CodSalVend": "'.$this->getCodSalVend().'" ,';
        $string .= '"IdSalRep": '.$this->getIdSalRep().' ,';
        $string .= '"CodSalRep": "'.$this->getCodSalRep().'" ,';
        $string .= '"IdCha": '.$this->getIdCha().' ,';
        $string .= '"CodCha": "'.$this->getCodCha().'" ,';
        $string .= '"LibCha": "'.$this->getLibCha().'" ,';
        $string .= '"AdrCha": "'.$this->getAdrCha().'" ,';
        $string .= '"CPCha": "'.$this->getCPCha().'" ,';
        $string .= '"VilleCha": "'.$this->getVilleCha().'" ,';
        $string .= '"MontPortDE": '.$this->getMontPortDE().' ,';
        $string .= '"DateLivDE": "'.date_format($this->getDateLivDE(), 'Y-m-d').'" ,';
        $string .= '"IdTC": '.$this->getIdTC().' ,';
        $string .= '"PrisParDE": "'.$this->getPrisParDE().'" ,';
        $string .= '"DateReacDE": "'.date_format($this->getDateReacDE(), 'Y-m-d').'" ,';

        $val = ($this->isFlgPFDE()) ? 'true' : 'false';
        $string .= '"FlgPFDE": '.$val.' ,';

        $string .= '"CodOrigDE": "'.$this->getCodOrigDE().'" ,';
        $string .= '"DateCloDE": "'.date_format($this->getDateCloDE(), 'Y-m-d').'" ,';

        //DEVIS
        $string .= '"DateRelDE": "'.date_format($this->getDateRelDE(), 'Y-m-d').'" ,';
        $string .= '"IdSalRel": '.$this->getIdSalRel().' ,';
        $string .= '"NatDE": "'.$this->getNatDE().'" ,';
        $string .= '"DateRealDE": "'.date_format($this->getDateRealDE(), 'Y-m-d').'" ,';

        //BL
        $string .= '"DateFacDE": "'.date_format($this->getDateFacDE(), 'Y-m-d').'" ,';

        //FACCLI
        $string .= '"CodTvaDE": '.$this->getCodTvaDE().' ,';
        $string .= '"BaseHTDE": '.$this->getBaseHTDE().' ,';
        $string .= '"BaseTvaDE": '.$this->getBaseTvaDE().' ,';
        $string .= '"BaseTgapDE": '.$this->getBaseTgapDE().' ,';
        $string .= '"BaseParafDE": '.$this->getBaseParafDE().' ,';
        $string .= '"MontTgapTableDE": '.$this->getMontTgapTableDE().' ,';
        $string .= '"MontParafTableDE": '.$this->getMontParafTableDE().' ,';
        $string .= '"MontTvaTableDE": '.$this->getMontTvaTableDE().' ,';
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

    /**
     * @return null
     */
    public function getDateRelDE()
    {
        return $this->DateRelDE;
    }

    /**
     * @param null $DateRelDE
     */
    public function setDateRelDE($DateRelDE)
    {
        $this->DateRelDE = $DateRelDE;
    }

    /**
     * @return int
     */
    public function getIdSalRel()
    {
        return $this->IdSalRel;
    }

    /**
     * @param int $IdSalRel
     */
    public function setIdSalRel($IdSalRel)
    {
        $this->IdSalRel = $IdSalRel;
    }

    /**
     * @return string
     */
    public function getNatDE()
    {
        return $this->NatDE;
    }

    /**
     * @param string $NatDE
     */
    public function setNatDE($NatDE)
    {
        $this->NatDE = $NatDE;
    }

    /**
     * @return null
     */
    public function getDateRealDE()
    {
        return $this->DateRealDE;
    }

    /**
     * @param null $DateRealDE
     */
    public function setDateRealDE($DateRealDE)
    {
        $this->DateRealDE = $DateRealDE;
    }

    /**
     * @return null
     */
    public function getDateFacDE()
    {
        return $this->DateFacDE;
    }

    /**
     * @param null $DateFacDE
     */
    public function setDateFacDE($DateFacDE)
    {
        $this->DateFacDE = $DateFacDE;
    }

    /**
     * @return array
     */
    public function getCodTvaDE()
    {
        return $this->CodTvaDE;
    }

    /**
     * @param array $CodTvaDE
     */
    public function setCodTvaDE($CodTvaDE)
    {
        $this->CodTvaDE = $CodTvaDE;
    }

    /**
     * @return array
     */
    public function getBaseHTDE()
    {
        return $this->BaseHTDE;
    }

    /**
     * @param array $BaseHTDE
     */
    public function setBaseHTDE($BaseHTDE)
    {
        $this->BaseHTDE = $BaseHTDE;
    }

    /**
     * @return array
     */
    public function getBaseTvaDE()
    {
        return $this->BaseTvaDE;
    }

    /**
     * @param array $BaseTvaDE
     */
    public function setBaseTvaDE($BaseTvaDE)
    {
        $this->BaseTvaDE = $BaseTvaDE;
    }

    /**
     * @return array
     */
    public function getBaseTgapDE()
    {
        return $this->BaseTgapDE;
    }

    /**
     * @param array $BaseTgapDE
     */
    public function setBaseTgapDE($BaseTgapDE)
    {
        $this->BaseTgapDE = $BaseTgapDE;
    }

    /**
     * @return array
     */
    public function getBaseParafDE()
    {
        return $this->BaseParafDE;
    }

    /**
     * @param array $BaseParafDE
     */
    public function setBaseParafDE($BaseParafDE)
    {
        $this->BaseParafDE = $BaseParafDE;
    }

    /**
     * @return array
     */
    public function getMontTgapTableDE()
    {
        return $this->MontTgapTableDE;
    }

    /**
     * @param array $MontTgapTableDE
     */
    public function setMontTgapTableDE($MontTgapTableDE)
    {
        $this->MontTgapTableDE = $MontTgapTableDE;
    }

    /**
     * @return array
     */
    public function getMontParafTableDE()
    {
        return $this->MontParafTableDE;
    }

    /**
     * @param array $MontParafTableDE
     */
    public function setMontParafTableDE($MontParafTableDE)
    {
        $this->MontParafTableDE = $MontParafTableDE;
    }

    /**
     * @return array
     */
    public function getMontTvaTableDE()
    {
        return $this->MontTvaTableDE;
    }

    /**
     * @param array $MontTvaTableDE
     */
    public function setMontTvaTableDE($MontTvaTableDE)
    {
        $this->MontTvaTableDE = $MontTvaTableDE;
    }

}