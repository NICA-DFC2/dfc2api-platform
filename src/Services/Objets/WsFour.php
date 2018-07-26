<?php

namespace App\Services\Objets;


class WsFour
{
    public $IdFour;
    public $ActFour;
    public $AncCodFour;
    public $APEFour;
    public $CapitalFour;
    public $CodCentraleFour;
    public $CodCliFour;
    public $CodFour;
    public $CodGroupeFour;
    public $CodPaysFour;
    public $CodSectFour;
    public $CodSuiviFour;
    public $CodSuspFour;
    public $CollectifFour;
    public $ComFour;
    public $DateCreFour;
    public $DatModFour;
    public $DelaiFour;
    public $DelaiNbJPaiEscFour;
    public $EchRegFour;
    public $FinMoisDelaiEscFour = false;
    public $FinMoisFour = false;
    public $FlgARFour = false;
    public $FlgComptaFour = false;
    public $FlgDEBFour = false;
    public $FlgReliquatFour = false;
    public $FlgTvaEncFour = false;
    public $FormJurFour;
    public $FraisFacAchFour = false;
    public $FreqAchFour;
    public $GLNFour;
    public $IdAdr;
    public $IdCpt;
    public $IdDep;
    public $IdFactFour;
    public $IdPayFour;
    public $IdUCre;
    public $IdUMod;
    public $JRegFour;
    public $LstIdSocDepFour;
    public $LstIdUBlocFour;
    public $LstJoursLivFour;
    public $LstVentilFour;
    public $MinCmdFour;
    public $MontPortAutoFour;
    public $MotsClesAutoFour;
    public $MotsClesFour;
    public $MRegFour;
    public $NbJrSecuFour;
    public $NoComptaFour;
    public $NoFour;
    public $NumTvaFour;
    public $PriseChargeSavFour;
    public $RgpFour;
    public $RSocFacFour;
    public $RSocFour;
    public $RSocUsFour;
    public $SiretFour;
    public $SiteWebFour;
    public $TauxEscFour;
    public $TypeEdiFour;
    public $TypeFour;
    public $TypeTvaFour;
    public $UFranco2Four;
    public $UFrancoFour;
    public $VFranco2Four;
    public $VFrancoFour;


    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdFour($json_object->{'IdFour'});
            $this->setActFour($json_object->{'ActFour'});
            $this->setAncCodFour($json_object->{'AncCodFour'});
            $this->setAPEFour($json_object->{'APEFour'});
            $this->setCapitalFour($json_object->{'CapitalFour'});
            $this->setCodCentraleFour($json_object->{'CodCentraleFour'});
            $this->setCodCliFour($json_object->{'CodCliFour'});
            $this->setCodFour($json_object->{'CodFour'});
            $this->setCodGroupeFour($json_object->{'CodGroupeFour'});
            $this->setCodPaysFour($json_object->{'CodPaysFour'});
            $this->setCodSectFour($json_object->{'CodSectFour'});
            $this->setCodSuiviFour($json_object->{'CodSuiviFour'});
            $this->setCodSuspFour($json_object->{'CodSuspFour'});
            $this->setCollectifFour($json_object->{'CollectifFour'});
            $this->setComFour($json_object->{'ComFour'});
            $this->setDateCreFour($json_object->{'DateCreFour'});
            $this->setDatModFour($json_object->{'DatModFour'});
            $this->setDelaiFour($json_object->{'DelaiFour'});
            $this->setDelaiNbJPaiEscFour($json_object->{'DelaiNbJPaiEscFour'});
            $this->setEchRegFour($json_object->{'EchRegFour'});
            $this->setFinMoisDelaiEscFour($json_object->{'FinMoisDelaiEscFour'});
            $this->setFinMoisFour($json_object->{'FinMoisFour'});
            $this->setFlgARFour($json_object->{'FlgARFour'});
            $this->setFlgComptaFour($json_object->{'FlgComptaFour'});
            $this->setFlgDEBFour($json_object->{'FlgDEBFour'});
            $this->setFlgReliquatFour($json_object->{'FlgReliquatFour'});
            $this->setFlgTvaEncFour($json_object->{'FlgTvaEncFour'});
            $this->setFormJurFour($json_object->{'FormJurFour'});
            $this->setFraisFacAchFour($json_object->{'FraisFacAchFour'});
            $this->setFreqAchFour($json_object->{'FreqAchFour'});
            $this->setGLNFour($json_object->{'GLNFour'});
            $this->setIdAdr($json_object->{'IdAdr'});
            $this->setIdCpt($json_object->{'IdCpt'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setIdFactFour($json_object->{'IdFactFour'});
            $this->setIdPayFour($json_object->{'IdPayFour'});
            $this->setIdUCre($json_object->{'IdUCre'});
            $this->setIdUMod($json_object->{'IdUMod'});
            $this->setJRegFour($json_object->{'JRegFour'});
            $this->setLstIdSocDepFour($json_object->{'LstIdSocDepFour'});
            $this->setLstIdUBlocFour($json_object->{'LstIdUBlocFour'});
            $this->setLstJoursLivFour($json_object->{'LstJoursLivFour'});
            $this->setLstVentilFour($json_object->{'LstVentilFour'});
            $this->setMinCmdFour($json_object->{'MinCmdFour'});
            $this->setMontPortAutoFour($json_object->{'MontPortAutoFour'});
            $this->setMotsClesAutoFour($json_object->{'MotsClesAutoFour'});
            $this->setMotsClesFour($json_object->{'MotsClesFour'});
            $this->setMRegFour($json_object->{'MRegFour'});
            $this->setNbJrSecuFour($json_object->{'NbJrSecuFour'});
            $this->setNoComptaFour($json_object->{'NoComptaFour'});
            $this->setNoFour($json_object->{'NoFour'});
            $this->setNumTvaFour($json_object->{'NumTvaFour'});
            $this->setPriseChargeSavFour($json_object->{'PriseChargeSavFour'});
            $this->setRgpFour($json_object->{'RgpFour'});
            $this->setRSocFacFour($json_object->{'RSocFacFour'});
            $this->setRSocFour($json_object->{'RSocFour'});
            $this->setRSocUsFour($json_object->{'RSocUsFour'});
            $this->setSiretFour($json_object->{'SiretFour'});
            $this->setSiteWebFour($json_object->{'SiteWebFour'});
            $this->setTauxEscFour($json_object->{'TauxEscFour'});
            $this->setTypeEdiFour($json_object->{'TypeEdiFour'});
            $this->setTypeFour($json_object->{'TypeFour'});
            $this->setTypeTvaFour($json_object->{'TypeTvaFour'});
            $this->setUFranco2Four($json_object->{'UFranco2Four'});
            $this->setUFrancoFour($json_object->{'UFrancoFour'});
            $this->setVFranco2Four($json_object->{'VFranco2Four'});
            $this->setVFrancoFour($json_object->{'VFrancoFour'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdFour": '.$this->getIdFour().' ,';
        $string .= '"ActFour": "'.$this->getActFour().'" ,';
        $string .= '"AncCodFour": "'.$this->getAncCodFour().'" ,';
        $string .= '"APEFour": "'.$this->getAPEFour().'" ,';
        $string .= '"CapitalFour": '.$this->getCapitalFour().' ,';
        $string .= '"CodCentraleFour": "'.$this->getCodCentraleFour().'" ,';
        $string .= '"CodCliFour": "'.$this->getCodCliFour().'" ,';
        $string .= '"CodFour": "'.$this->getCodFour().'" ,';
        $string .= '"CodGroupeFour": "'.$this->getCodGroupeFour().'" ,';
        $string .= '"CodPaysFour": "'.$this->getCodPaysFour().'" ,';
        $string .= '"CodSectFour": "'.$this->getCodSectFour().'" ,';
        $string .= '"CodSuiviFour": "'.$this->getCodSuiviFour().'" ,';
        $string .= '"CodSuspFour": "'.$this->getCodSuspFour().'" ,';
        $string .= '"CollectifFour": "'.$this->getCollectifFour().'" ,';
        $string .= '"ComFour": "'.$this->getComFour().'" ,';
        $string .= '"DateCreFour": "'.$this->getDateCreFour().'" ,';
        $string .= '"DatModFour": "'.$this->getDatModFour().'" ,';
        $string .= '"DelaiFour": '.$this->getDelaiFour().' ,';
        $string .= '"DelaiNbJPaiEscFour": '.$this->getDelaiNbJPaiEscFour().' ,';
        $string .= '"EchRegFour": "'.$this->getEchRegFour().'" ,';
        $string .= '"FinMoisDelaiEscFour": "'.$this->isFinMoisDelaiEscFour().'" ,';
        $string .= '"FinMoisFour": "'.$this->isFinMoisFour().'" ,';
        $string .= '"FlgARFour": "'.$this->isFlgARFour().'" ,';
        $string .= '"FlgComptaFour": "'.$this->isFlgComptaFour().'" ,';
        $string .= '"FlgDEBFour": "'.$this->isFlgDEBFour().'" ,';
        $string .= '"FlgReliquatFour": "'.$this->isFlgReliquatFour().'" ,';
        $string .= '"FlgTvaEncFour": "'.$this->isFlgTvaEncFour().'" ,';
        $string .= '"FormJurFour": "'.$this->getFormJurFour().'" ,';
        $string .= '"FraisFacAchFour": "'.$this->isFraisFacAchFour().'" ,';
        $string .= '"FreqAchFour": "'.$this->getFreqAchFour().'" ,';
        $string .= '"GLNFour": "'.$this->getGLNFour().'" ,';
        $string .= '"IdAdr": '.$this->getIdAdr().' ,';
        $string .= '"IdCpt": '.$this->getIdCpt().' ,';
        $string .= '"IdDep": '.$this->getIdDep().' ,';
        $string .= '"IdFactFour": "'.$this->getIdFactFour().' ,';
        $string .= '"IdPayFour": '.$this->getIdPayFour().' ,';
        $string .= '"IdUCre": '.$this->getIdUCre().' ,';
        $string .= '"IdUMod": '.$this->getIdUMod().' ,';
        $string .= '"JRegFour": '.$this->getJRegFour().' ,';
        $string .= '"LstIdSocDepFour": "'.$this->getLstIdSocDepFour().'" ,';
        $string .= '"LstIdUBlocFour": "'.$this->getLstIdUBlocFour().'" ,';
        $string .= '"LstJoursLivFour": "'.$this->getLstJoursLivFour().'" ,';
        $string .= '"LstVentilFour": "'.$this->getLstVentilFour().'" ,';
        $string .= '"MinCmdFour": '.$this->getMinCmdFour().' ,';
        $string .= '"MontPortAutoFour": '.$this->getMontPortAutoFour().' ,';
        $string .= '"MotsClesAutoFour": "'.$this->getMotsClesAutoFour().'" ,';
        $string .= '"MotsClesFour": "'.$this->getMotsClesFour().'" ,';
        $string .= '"MRegFour": "'.$this->getMRegFour().'" ,';
        $string .= '"NbJrSecuFour": '.$this->getNbJrSecuFour().' ,';
        $string .= '"NoComptaFour": "'.$this->getNoComptaFour().'" ,';
        $string .= '"NoFour": '.$this->getNoFour().' ,';
        $string .= '"NumTvaFour": "'.$this->getNumTvaFour().'" ,';
        $string .= '"PriseChargeSavFour": "'.$this->getPriseChargeSavFour().'" ,';
        $string .= '"RgpFour": "'.$this->getRgpFour().'" ,';
        $string .= '"RSocFacFour": "'.$this->getRSocFacFour().'" ,';
        $string .= '"RSocFour": "'.$this->getRSocFour().'" ,';
        $string .= '"RSocUsFour": "'.$this->getRSocUsFour().'" ,';
        $string .= '"SiretFour": "'.$this->getSiretFour().'" ,';
        $string .= '"SiteWebFour": "'.$this->getSiteWebFour().'" ,';
        $string .= '"TauxEscFour": '.$this->getTauxEscFour().' ,';
        $string .= '"TypeEdiFour": "'.$this->getTypeEdiFour().'" ,';
        $string .= '"TypeFour": "'.$this->getTypeFour().'" ,';
        $string .= '"TypeTvaFour": "'.$this->getTypeTvaFour().'" ,';
        $string .= '"UFranco2Four": "'.$this->getUFranco2Four().'" ,';
        $string .= '"UFrancoFour": "'.$this->getUFrancoFour().'" ,';
        $string .= '"VFranco2Four": '.$this->getVFranco2Four().' ,';
        $string .= '"VFrancoFour": '.$this->getVFrancoFour().' ';
        $string .= '}';

        return $string;
    }

    /**
     * @return mixed
     */
    public function getIdFour()
    {
        return $this->IdFour;
    }

    /**
     * @param mixed $IdFour
     */
    public function setIdFour($IdFour)
    {
        $this->IdFour = $IdFour;
    }

    /**
     * @return mixed
     */
    public function getActFour()
    {
        return $this->ActFour;
    }

    /**
     * @param mixed $ActFour
     */
    public function setActFour($ActFour)
    {
        $this->ActFour = $ActFour;
    }

    /**
     * @return mixed
     */
    public function getAncCodFour()
    {
        return $this->AncCodFour;
    }

    /**
     * @param mixed $AncCodFour
     */
    public function setAncCodFour($AncCodFour)
    {
        $this->AncCodFour = $AncCodFour;
    }

    /**
     * @return mixed
     */
    public function getAPEFour()
    {
        return $this->APEFour;
    }

    /**
     * @param mixed $APEFour
     */
    public function setAPEFour($APEFour)
    {
        $this->APEFour = $APEFour;
    }

    /**
     * @return mixed
     */
    public function getCapitalFour()
    {
        return $this->CapitalFour;
    }

    /**
     * @param mixed $CapitalFour
     */
    public function setCapitalFour($CapitalFour)
    {
        $this->CapitalFour = $CapitalFour;
    }

    /**
     * @return mixed
     */
    public function getCodCentraleFour()
    {
        return $this->CodCentraleFour;
    }

    /**
     * @param mixed $CodCentraleFour
     */
    public function setCodCentraleFour($CodCentraleFour)
    {
        $this->CodCentraleFour = $CodCentraleFour;
    }

    /**
     * @return mixed
     */
    public function getCodCliFour()
    {
        return $this->CodCliFour;
    }

    /**
     * @param mixed $CodCliFour
     */
    public function setCodCliFour($CodCliFour)
    {
        $this->CodCliFour = $CodCliFour;
    }

    /**
     * @return mixed
     */
    public function getCodFour()
    {
        return $this->CodFour;
    }

    /**
     * @param mixed $CodFour
     */
    public function setCodFour($CodFour)
    {
        $this->CodFour = $CodFour;
    }

    /**
     * @return mixed
     */
    public function getCodGroupeFour()
    {
        return $this->CodGroupeFour;
    }

    /**
     * @param mixed $CodGroupeFour
     */
    public function setCodGroupeFour($CodGroupeFour)
    {
        $this->CodGroupeFour = $CodGroupeFour;
    }

    /**
     * @return mixed
     */
    public function getCodPaysFour()
    {
        return $this->CodPaysFour;
    }

    /**
     * @param mixed $CodPaysFour
     */
    public function setCodPaysFour($CodPaysFour)
    {
        $this->CodPaysFour = $CodPaysFour;
    }

    /**
     * @return mixed
     */
    public function getCodSectFour()
    {
        return $this->CodSectFour;
    }

    /**
     * @param mixed $CodSectFour
     */
    public function setCodSectFour($CodSectFour)
    {
        $this->CodSectFour = $CodSectFour;
    }

    /**
     * @return mixed
     */
    public function getCodSuiviFour()
    {
        return $this->CodSuiviFour;
    }

    /**
     * @param mixed $CodSuiviFour
     */
    public function setCodSuiviFour($CodSuiviFour)
    {
        $this->CodSuiviFour = $CodSuiviFour;
    }

    /**
     * @return mixed
     */
    public function getCodSuspFour()
    {
        return $this->CodSuspFour;
    }

    /**
     * @param mixed $CodSuspFour
     */
    public function setCodSuspFour($CodSuspFour)
    {
        $this->CodSuspFour = $CodSuspFour;
    }

    /**
     * @return mixed
     */
    public function getCollectifFour()
    {
        return $this->CollectifFour;
    }

    /**
     * @param mixed $CollectifFour
     */
    public function setCollectifFour($CollectifFour)
    {
        $this->CollectifFour = $CollectifFour;
    }

    /**
     * @return mixed
     */
    public function getComFour()
    {
        return $this->ComFour;
    }

    /**
     * @param mixed $ComFour
     */
    public function setComFour($ComFour)
    {
        $this->ComFour = $ComFour;
    }

    /**
     * @return mixed
     */
    public function getDateCreFour()
    {
        return $this->DateCreFour;
    }

    /**
     * @param mixed $DateCreFour
     */
    public function setDateCreFour($DateCreFour)
    {
        $this->DateCreFour = $DateCreFour;
    }

    /**
     * @return mixed
     */
    public function getDatModFour()
    {
        return $this->DatModFour;
    }

    /**
     * @param mixed $DatModFour
     */
    public function setDatModFour($DatModFour)
    {
        $this->DatModFour = $DatModFour;
    }

    /**
     * @return mixed
     */
    public function getDelaiFour()
    {
        return $this->DelaiFour;
    }

    /**
     * @param mixed $DelaiFour
     */
    public function setDelaiFour($DelaiFour)
    {
        $this->DelaiFour = $DelaiFour;
    }

    /**
     * @return mixed
     */
    public function getDelaiNbJPaiEscFour()
    {
        return $this->DelaiNbJPaiEscFour;
    }

    /**
     * @param mixed $DelaiNbJPaiEscFour
     */
    public function setDelaiNbJPaiEscFour($DelaiNbJPaiEscFour)
    {
        $this->DelaiNbJPaiEscFour = $DelaiNbJPaiEscFour;
    }

    /**
     * @return mixed
     */
    public function getEchRegFour()
    {
        return $this->EchRegFour;
    }

    /**
     * @param mixed $EchRegFour
     */
    public function setEchRegFour($EchRegFour)
    {
        $this->EchRegFour = $EchRegFour;
    }

    /**
     * @return bool
     */
    public function isFinMoisDelaiEscFour()
    {
        return $this->FinMoisDelaiEscFour;
    }

    /**
     * @param bool $FinMoisDelaiEscFour
     */
    public function setFinMoisDelaiEscFour(bool $FinMoisDelaiEscFour)
    {
        $this->FinMoisDelaiEscFour = $FinMoisDelaiEscFour;
    }

    /**
     * @return bool
     */
    public function isFinMoisFour()
    {
        return $this->FinMoisFour;
    }

    /**
     * @param bool $FinMoisFour
     */
    public function setFinMoisFour(bool $FinMoisFour)
    {
        $this->FinMoisFour = $FinMoisFour;
    }

    /**
     * @return bool
     */
    public function isFlgARFour()
    {
        return $this->FlgARFour;
    }

    /**
     * @param bool $FlgARFour
     */
    public function setFlgARFour(bool $FlgARFour)
    {
        $this->FlgARFour = $FlgARFour;
    }

    /**
     * @return bool
     */
    public function isFlgComptaFour()
    {
        return $this->FlgComptaFour;
    }

    /**
     * @param bool $FlgComptaFour
     */
    public function setFlgComptaFour(bool $FlgComptaFour)
    {
        $this->FlgComptaFour = $FlgComptaFour;
    }

    /**
     * @return bool
     */
    public function isFlgDEBFour()
    {
        return $this->FlgDEBFour;
    }

    /**
     * @param bool $FlgDEBFour
     */
    public function setFlgDEBFour(bool $FlgDEBFour)
    {
        $this->FlgDEBFour = $FlgDEBFour;
    }

    /**
     * @return bool
     */
    public function isFlgReliquatFour()
    {
        return $this->FlgReliquatFour;
    }

    /**
     * @param bool $FlgReliquatFour
     */
    public function setFlgReliquatFour(bool $FlgReliquatFour)
    {
        $this->FlgReliquatFour = $FlgReliquatFour;
    }

    /**
     * @return bool
     */
    public function isFlgTvaEncFour()
    {
        return $this->FlgTvaEncFour;
    }

    /**
     * @param bool $FlgTvaEncFour
     */
    public function setFlgTvaEncFour(bool $FlgTvaEncFour)
    {
        $this->FlgTvaEncFour = $FlgTvaEncFour;
    }

    /**
     * @return mixed
     */
    public function getFormJurFour()
    {
        return $this->FormJurFour;
    }

    /**
     * @param mixed $FormJurFour
     */
    public function setFormJurFour($FormJurFour)
    {
        $this->FormJurFour = $FormJurFour;
    }

    /**
     * @return bool
     */
    public function isFraisFacAchFour()
    {
        return $this->FraisFacAchFour;
    }

    /**
     * @param bool $FraisFacAchFour
     */
    public function setFraisFacAchFour(bool $FraisFacAchFour)
    {
        $this->FraisFacAchFour = $FraisFacAchFour;
    }

    /**
     * @return mixed
     */
    public function getFreqAchFour()
    {
        return $this->FreqAchFour;
    }

    /**
     * @param mixed $FreqAchFour
     */
    public function setFreqAchFour($FreqAchFour)
    {
        $this->FreqAchFour = $FreqAchFour;
    }

    /**
     * @return mixed
     */
    public function getGLNFour()
    {
        return $this->GLNFour;
    }

    /**
     * @param mixed $GLNFour
     */
    public function setGLNFour($GLNFour)
    {
        $this->GLNFour = $GLNFour;
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
    public function getIdFactFour()
    {
        return $this->IdFactFour;
    }

    /**
     * @param mixed $IdFactFour
     */
    public function setIdFactFour($IdFactFour)
    {
        $this->IdFactFour = $IdFactFour;
    }

    /**
     * @return mixed
     */
    public function getIdPayFour()
    {
        return $this->IdPayFour;
    }

    /**
     * @param mixed $IdPayFour
     */
    public function setIdPayFour($IdPayFour)
    {
        $this->IdPayFour = $IdPayFour;
    }

    /**
     * @return mixed
     */
    public function getIdUCre()
    {
        return $this->IdUCre;
    }

    /**
     * @param mixed $IdUCre
     */
    public function setIdUCre($IdUCre)
    {
        $this->IdUCre = $IdUCre;
    }

    /**
     * @return mixed
     */
    public function getIdUMod()
    {
        return $this->IdUMod;
    }

    /**
     * @param mixed $IdUMod
     */
    public function setIdUMod($IdUMod)
    {
        $this->IdUMod = $IdUMod;
    }

    /**
     * @return mixed
     */
    public function getJRegFour()
    {
        return $this->JRegFour;
    }

    /**
     * @param mixed $JRegFour
     */
    public function setJRegFour($JRegFour)
    {
        $this->JRegFour = $JRegFour;
    }

    /**
     * @return mixed
     */
    public function getLstIdSocDepFour()
    {
        return $this->LstIdSocDepFour;
    }

    /**
     * @param mixed $LstIdSocDepFour
     */
    public function setLstIdSocDepFour($LstIdSocDepFour)
    {
        $this->LstIdSocDepFour = $LstIdSocDepFour;
    }

    /**
     * @return mixed
     */
    public function getLstIdUBlocFour()
    {
        return $this->LstIdUBlocFour;
    }

    /**
     * @param mixed $LstIdUBlocFour
     */
    public function setLstIdUBlocFour($LstIdUBlocFour)
    {
        $this->LstIdUBlocFour = $LstIdUBlocFour;
    }

    /**
     * @return mixed
     */
    public function getLstJoursLivFour()
    {
        return $this->LstJoursLivFour;
    }

    /**
     * @param mixed $LstJoursLivFour
     */
    public function setLstJoursLivFour($LstJoursLivFour)
    {
        $this->LstJoursLivFour = $LstJoursLivFour;
    }

    /**
     * @return mixed
     */
    public function getLstVentilFour()
    {
        return $this->LstVentilFour;
    }

    /**
     * @param mixed $LstVentilFour
     */
    public function setLstVentilFour($LstVentilFour)
    {
        $this->LstVentilFour = $LstVentilFour;
    }

    /**
     * @return mixed
     */
    public function getMinCmdFour()
    {
        return $this->MinCmdFour;
    }

    /**
     * @param mixed $MinCmdFour
     */
    public function setMinCmdFour($MinCmdFour)
    {
        $this->MinCmdFour = $MinCmdFour;
    }

    /**
     * @return mixed
     */
    public function getMontPortAutoFour()
    {
        return $this->MontPortAutoFour;
    }

    /**
     * @param mixed $MontPortAutoFour
     */
    public function setMontPortAutoFour($MontPortAutoFour)
    {
        $this->MontPortAutoFour = $MontPortAutoFour;
    }

    /**
     * @return mixed
     */
    public function getMotsClesAutoFour()
    {
        return $this->MotsClesAutoFour;
    }

    /**
     * @param mixed $MotsClesAutoFour
     */
    public function setMotsClesAutoFour($MotsClesAutoFour)
    {
        $this->MotsClesAutoFour = $MotsClesAutoFour;
    }

    /**
     * @return mixed
     */
    public function getMotsClesFour()
    {
        return $this->MotsClesFour;
    }

    /**
     * @param mixed $MotsClesFour
     */
    public function setMotsClesFour($MotsClesFour)
    {
        $this->MotsClesFour = $MotsClesFour;
    }

    /**
     * @return mixed
     */
    public function getMRegFour()
    {
        return $this->MRegFour;
    }

    /**
     * @param mixed $MRegFour
     */
    public function setMRegFour($MRegFour)
    {
        $this->MRegFour = $MRegFour;
    }

    /**
     * @return mixed
     */
    public function getNbJrSecuFour()
    {
        return $this->NbJrSecuFour;
    }

    /**
     * @param mixed $NbJrSecuFour
     */
    public function setNbJrSecuFour($NbJrSecuFour)
    {
        $this->NbJrSecuFour = $NbJrSecuFour;
    }

    /**
     * @return mixed
     */
    public function getNoComptaFour()
    {
        return $this->NoComptaFour;
    }

    /**
     * @param mixed $NoComptaFour
     */
    public function setNoComptaFour($NoComptaFour)
    {
        $this->NoComptaFour = $NoComptaFour;
    }

    /**
     * @return mixed
     */
    public function getNoFour()
    {
        return $this->NoFour;
    }

    /**
     * @param mixed $NoFour
     */
    public function setNoFour($NoFour)
    {
        $this->NoFour = $NoFour;
    }

    /**
     * @return mixed
     */
    public function getNumTvaFour()
    {
        return $this->NumTvaFour;
    }

    /**
     * @param mixed $NumTvaFour
     */
    public function setNumTvaFour($NumTvaFour)
    {
        $this->NumTvaFour = $NumTvaFour;
    }

    /**
     * @return mixed
     */
    public function getPriseChargeSavFour()
    {
        return $this->PriseChargeSavFour;
    }

    /**
     * @param mixed $PriseChargeSavFour
     */
    public function setPriseChargeSavFour($PriseChargeSavFour)
    {
        $this->PriseChargeSavFour = $PriseChargeSavFour;
    }

    /**
     * @return mixed
     */
    public function getRgpFour()
    {
        return $this->RgpFour;
    }

    /**
     * @param mixed $RgpFour
     */
    public function setRgpFour($RgpFour)
    {
        $this->RgpFour = $RgpFour;
    }

    /**
     * @return mixed
     */
    public function getRSocFacFour()
    {
        return $this->RSocFacFour;
    }

    /**
     * @param mixed $RSocFacFour
     */
    public function setRSocFacFour($RSocFacFour)
    {
        $this->RSocFacFour = $RSocFacFour;
    }

    /**
     * @return mixed
     */
    public function getRSocFour()
    {
        return $this->RSocFour;
    }

    /**
     * @param mixed $RSocFour
     */
    public function setRSocFour($RSocFour)
    {
        $this->RSocFour = $RSocFour;
    }

    /**
     * @return mixed
     */
    public function getRSocUsFour()
    {
        return $this->RSocUsFour;
    }

    /**
     * @param mixed $RSocUsFour
     */
    public function setRSocUsFour($RSocUsFour)
    {
        $this->RSocUsFour = $RSocUsFour;
    }

    /**
     * @return mixed
     */
    public function getSiretFour()
    {
        return $this->SiretFour;
    }

    /**
     * @param mixed $SiretFour
     */
    public function setSiretFour($SiretFour)
    {
        $this->SiretFour = $SiretFour;
    }

    /**
     * @return mixed
     */
    public function getSiteWebFour()
    {
        return $this->SiteWebFour;
    }

    /**
     * @param mixed $SiteWebFour
     */
    public function setSiteWebFour($SiteWebFour)
    {
        $this->SiteWebFour = $SiteWebFour;
    }

    /**
     * @return mixed
     */
    public function getTauxEscFour()
    {
        return $this->TauxEscFour;
    }

    /**
     * @param mixed $TauxEscFour
     */
    public function setTauxEscFour($TauxEscFour)
    {
        $this->TauxEscFour = $TauxEscFour;
    }

    /**
     * @return mixed
     */
    public function getTypeEdiFour()
    {
        return $this->TypeEdiFour;
    }

    /**
     * @param mixed $TypeEdiFour
     */
    public function setTypeEdiFour($TypeEdiFour)
    {
        $this->TypeEdiFour = $TypeEdiFour;
    }

    /**
     * @return mixed
     */
    public function getTypeFour()
    {
        return $this->TypeFour;
    }

    /**
     * @param mixed $TypeFour
     */
    public function setTypeFour($TypeFour)
    {
        $this->TypeFour = $TypeFour;
    }

    /**
     * @return mixed
     */
    public function getTypeTvaFour()
    {
        return $this->TypeTvaFour;
    }

    /**
     * @param mixed $TypeTvaFour
     */
    public function setTypeTvaFour($TypeTvaFour)
    {
        $this->TypeTvaFour = $TypeTvaFour;
    }

    /**
     * @return mixed
     */
    public function getUFranco2Four()
    {
        return $this->UFranco2Four;
    }

    /**
     * @param mixed $UFranco2Four
     */
    public function setUFranco2Four($UFranco2Four)
    {
        $this->UFranco2Four = $UFranco2Four;
    }

    /**
     * @return mixed
     */
    public function getUFrancoFour()
    {
        return $this->UFrancoFour;
    }

    /**
     * @param mixed $UFrancoFour
     */
    public function setUFrancoFour($UFrancoFour)
    {
        $this->UFrancoFour = $UFrancoFour;
    }

    /**
     * @return mixed
     */
    public function getVFranco2Four()
    {
        return $this->VFranco2Four;
    }

    /**
     * @param mixed $VFranco2Four
     */
    public function setVFranco2Four($VFranco2Four)
    {
        $this->VFranco2Four = $VFranco2Four;
    }

    /**
     * @return mixed
     */
    public function getVFrancoFour()
    {
        return $this->VFrancoFour;
    }

    /**
     * @param mixed $VFrancoFour
     */
    public function setVFrancoFour($VFrancoFour)
    {
        $this->VFrancoFour = $VFrancoFour;
    }
    
    
    
}