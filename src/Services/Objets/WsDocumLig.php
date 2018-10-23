<?php

namespace App\Services\Objets;

class WsDocumLig
{
    public $IdDL = 0;
    public $IdDE = 0;
    public $IdDocDL = 0;
    public $IdDocDE = 0;
    public $IdDocSecDE = 0;
    public $IdAD = 0;
    public $NumDL = 0;
    public $NbUStoDL = 0;
    public $UStoDL = 0;
    public $MontHTDL = 0;
    public $MontTTCDL = 0;
    public $PrixNetDL = 0;
    public $NbUVteDL = 0;
    public $UVteDL = 0;
    public $ComDL = "";
    public $CodEcoTaxeDL= "";
    public $CodTgapDL= "";
    public $PoidsUVteDL= 0;
    public $MontTVADL= 0;
    public $MontTgapDL= 0;
    public $MontParafDL= 0;
    public $NbUCondDL= 0;
    public $FlgBonniDL= false;
    public $TypeQteDL= "";
    public $IdPTA= 0;
    public $IdCel= 0;
    public $MontTTCComDL= 0;
    public $MontHTComDL= 0;
    public $NbUVteComDL= 0;
    public $FlgVarDL= false;
    public $NbUStoComDL= 0;
    public $IdTA= 0;
    public $NoAD= 0;
    public $CodAD= "";
    public $CodADDL= "";
    public $RefDL= "";
    public $DesignationAD= "";
    public $Desi2Art= "";
    public $HASH= "";
    public $TypePrixDL= "";
    public $ComCel= "";
    public $IdExtDL = 0;
    public $IdFour = 0;
    public $NbUAchDL = 0;
    public $DateModDL = null;
    public $IdTC = 0;
    public $IdDep = 0;
    public $EtatDL = "";
    public $CodTVADL = "";
    public $UAchDL = "";
    public $TypCvAchVteDL = false;
    public $CvAchVteDL = "";
    public $PrixAchDevDL = 0;
    public $PrixAchDL = 0;
    public $PrixDepConvDL = 0;
    public $PrixDepReelDL = 0;
    public $PrixNetConvDL = 0;
    public $PrixNetReelDL = 0;
    public $PrixRevConvDL = 0;
    public $PrixRevReelDL = 0;
    public $NbDecPNetDL = 0;
    public $NbDecPDepDL = 0;
    public $NbDecPrixRendDL = 0;
    public $NbDecPrixRevDL = 0;
    public $CodDevDL = "";
    public $PoidsUAchDL = 0;
    public $VolUAchDL = 0;
    public $TypePRDL = "";
    public $IdPort = 0;
    public $IdEch = 0;
    public $LargDL = 0;
    public $LongDL = 0;
    public $EpaisDL = 0;
    public $CvStoVteDL = 0;
    public $TypCvStoVteDL = false;
    public $NbUStoCondVteDL = 0;
    public $CodParafDL = "";
    public $CondVteDL = "";
    public $TypeLongDL = "";
    public $MontEcoTaxeDL = 0;
    public $PrixTTCDL = 0;
    public $MontRevConvDL = 0;
    public $MontRevReDL = 0;
    public $MontHTAvecPortDL = 0;
    public $IdTar = 0;
    public $IdTarPre = 0;
    public $TypeTarDL = "";
    public $CodMethDL = "";
    public $TypeSeuTarDL = "";
    public $PRCAutoDL = 0;
    public $PRRAutoDL = 0;
    public $PrixTarDL = 0;
    public $IdTarComp = 0;
    public $IdTarComp2 = 0;
    public $IdCas = 0;
    public $RemValDL = 0;
    public $PrixPubDL = 0;
    public $CoefDL = 0;
    public $Remise1DL = 0;
    public $Remise2DL = 0;
    public $Remise3DL = 0;
    public $ComModPRDL = "";
    public $DateModPRDL = null;
    public $IdUModPRDL = 0;
    public $PrixPortDL = 0;
    public $MargConvDL = 0;
    public $CvVteVteDL = 0;
    public $GrpTarSeuDL = "";
    public $MargReelDL = 0;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdDL($json_object->{'IdDL'});
            $this->setIdDE($json_object->{'IdDE'});
            $this->setIdDocDL($json_object->{'IdDocDL'});
            $this->setIdDocDE($json_object->{'IdDocDE'});
            $this->setIdDocSecDE($json_object->{'IdDocSecDE'});
            $this->setIdAD($json_object->{'IdAD'});
            $this->setNumDL($json_object->{'NumDL'});
            $this->setNbUStoDL($json_object->{'NbUStoDL'});
            $this->setUStoDL($json_object->{'UStoDL'});
            $this->setMontHTDL($json_object->{'MontHTDL'});
            $this->setMontTTCDL($json_object->{'MontTTCDL'});
            $this->setPrixNetDL($json_object->{'PrixNetDL'});
            $this->setNbUVteDL($json_object->{'NbUVteDL'});
            $this->setUVteDL($json_object->{'UVteDL'});
            $this->setComDL($json_object->{'ComDL'});
            $this->setCodEcoTaxeDL($json_object->{'CodEcoTaxeDL'});
            $this->setCodTgapDL($json_object->{'CodTgapDL'});
            $this->setPoidsUVteDL($json_object->{'PoidsUVteDL'});
            $this->setMontTVADL($json_object->{'MontTVADL'});
            $this->setMontTgapDL($json_object->{'MontTgapDL'});
            $this->setMontParafDL($json_object->{'MontParafDL'});
            $this->setNbUCondDL((isset($json_object->{'NbUCondDL'})) ? $json_object->{'NbUCondDL'} : 0);
            $this->setFlgBonniDL($json_object->{'FlgBonniDL'});
            $this->setTypeQteDL($json_object->{'TypeQteDL'});
            $this->setIdPTA($json_object->{'IdPTA'});
            $this->setIdCel($json_object->{'IdCel'});
            $this->setMontTTCComDL($json_object->{'MontTTCComDL'});
            $this->setMontHTComDL($json_object->{'MontHTComDL'});
            $this->setNbUVteComDL($json_object->{'NbUVteComDL'});
            $this->setFlgVarDL($json_object->{'FlgVarDL'});
            $this->setNbUStoComDL($json_object->{'NbUStoComDL'});
            $this->setIdTA($json_object->{'IdTA'});
            $this->setNoAD($json_object->{'NoAD'});
            $this->setCodAD($json_object->{'CodAD'});
            $this->setCodADDL($json_object->{'CodADDL'});
            $this->setRefDL($json_object->{'RefDL'});
            $this->setDesignationAD($json_object->{'DesignationAD'});
            $this->setDesi2Art($json_object->{'Desi2Art'});
            $this->setHASH($json_object->{'HASH'});
            $this->setTypePrixDL($json_object->{'TypePrixDL'});
            $this->setComCel($json_object->{'ComCel'});

            $this->setIdExtDL($json_object->{'IdExtDL'});
            $this->setIdFour($json_object->{'IdFour'});
            $this->setNbUAchDL($json_object->{'NbUAchDL'});
            $this->setDateModDL($json_object->{'DateModDL'});
            $this->setIdTC($json_object->{'IdTC'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setEtatDL($json_object->{'EtatDL'});
            $this->setCodTVADL($json_object->{'CodTVADL'});
            $this->setUAchDL($json_object->{'UAchDL'});
            $this->setTypCvAchVteDL($json_object->{'TypCvAchVteDL'});
            $this->setCvAchVteDL($json_object->{'CvAchVteDL'});
            $this->setPrixAchDevDL($json_object->{'PrixAchDevDL'});
            $this->setPrixAchDL($json_object->{'PrixAchDL'});
            $this->setPrixDepConvDL($json_object->{'PrixDepConvDL'});
            $this->setPrixDepReelDL($json_object->{'PrixDepReelDL'});
            $this->setPrixNetConvDL($json_object->{'PrixNetConvDL'});
            $this->setPrixNetReelDL($json_object->{'PrixNetReelDL'});
            $this->setPrixRevConvDL($json_object->{'PrixRevConvDL'});
            $this->setPrixRevReelDL($json_object->{'PrixRevReelDL'});
            $this->setNbDecPNetDL($json_object->{'NbDecPNetDL'});
            $this->setNbDecPDepDL($json_object->{'NbDecPDepDL'});
            $this->setNbDecPrixRendDL($json_object->{'NbDecPrixRendDL'});
            $this->setNbDecPrixRevDL($json_object->{'NbDecPrixRevDL'});
            $this->setCodDevDL($json_object->{'CodDevDL'});
            $this->setPoidsUAchDL($json_object->{'PoidsUAchDL'});
            $this->setVolUAchDL($json_object->{'VolUAchDL'});
            $this->setTypePRDL($json_object->{'TypePRDL'});
            $this->setIdPort($json_object->{'IdPort'});
            $this->setIdEch($json_object->{'IdEch'});
            $this->setLargDL($json_object->{'LargDL'});
            $this->setLongDL($json_object->{'LongDL'});
            $this->setEpaisDL($json_object->{'EpaisDL'});
            $this->setCvStoVteDL($json_object->{'CvStoVteDL'});
            $this->setTypCvStoVteDL($json_object->{'TypCvStoVteDL'});
            $this->setNbUStoCondVteDL($json_object->{'NbUStoCondVteDL'});
            $this->setCodParafDL($json_object->{'CodParafDL'});
            $this->setCondVteDL($json_object->{'CondVteDL'});
            $this->setTypeLongDL($json_object->{'TypeLongDL'});
            $this->setMontEcoTaxeDL($json_object->{'MontEcoTaxeDL'});
            $this->setPrixTTCDL($json_object->{'PrixTTCDL'});
            $this->setMontRevConvDL($json_object->{'MontRevConvDL'});
            $this->setMontRevReDL($json_object->{'MontRevReDL'});
            $this->setMontHTAvecPortDL($json_object->{'MontHTAvecPortDL'});
            $this->setIdTar($json_object->{'IdTar'});
            $this->setIdTarPre($json_object->{'IdTarPre'});
            $this->setTypeTarDL($json_object->{'TypeTarDL'});
            $this->setCodMethDL($json_object->{'CodMethDL'});
            $this->setTypeSeuTarDL($json_object->{'TypeSeuTarDL'});
            $this->setPRCAutoDL($json_object->{'PRCAutoDL'});
            $this->setPRRAutoDL($json_object->{'PRRAutoDL'});
            $this->setPrixTarDL($json_object->{'PrixTarDL'});
            $this->setIdTarComp($json_object->{'IdTarComp'});
            $this->setIdTarComp2($json_object->{'IdTarComp2'});
            $this->setIdCas($json_object->{'IdCas'});
            $this->setRemValDL($json_object->{'RemValDL'});
            $this->setPrixPubDL($json_object->{'PrixPubDL'});
            $this->setCoefDL($json_object->{'CoefDL'});
            $this->setRemise1DL($json_object->{'Remise1DL'});
            $this->setRemise2DL($json_object->{'Remise2DL'});
            $this->setRemise3DL($json_object->{'Remise3DL'});
            $this->setComModPRDL($json_object->{'ComModPRDL'});
            $this->setDateModPRDL($json_object->{'DateModPRDL'});
            $this->setIdUModPRDL($json_object->{'IdUModPRDL'});
            $this->setPrixPortDL($json_object->{'PrixPortDL'});
            $this->setMargConvDL($json_object->{'MargConvDL'});
            $this->setCvVteVteDL($json_object->{'CvVteVteDL'});
            $this->setGrpTarSeuDL($json_object->{'GrpTarSeuDL'});
            $this->setMargReelDL($json_object->{'MargReelDL'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdDL": '.$this->getIdDL().' ,';
        $string .= '"IdDE": '.$this->getIdDE().' ,';
        $string .= '"IdDocDL": '.$this->getIdDocDL().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"IdDocSecDE": '.$this->getIdDocSecDE().' ,';
        $string .= '"IdAD": '.$this->getIdAD().' ,';
        $string .= '"NumDL": '.$this->getNumDL().' ,';
        $string .= '"NbUStoDL": '.$this->getNbUStoDL().' ,';
        $string .= '"UStoDL": "'.$this->getUStoDL().'" ,';
        $string .= '"MontHTDL": '.$this->getMontHTDL().' ,';
        $string .= '"MontTTCDL": '.$this->getMontTTCDL().' ,';
        $string .= '"PrixNetDL": '.$this->getPrixNetDL().' ,';
        $string .= '"NbUVteDL": '.$this->getNbUVteDL().' ,';
        $string .= '"UVteDL": "'.$this->getUVteDL().'" ,';
        $string .= '"ComDL": "'.$this->getComDL().'" ,';
        $string .= '"CodEcoTaxeDL": "'.$this->getCodEcoTaxeDL().'" ,';
        $string .= '"CodTgapDL": "'.$this->getCodTgapDL().'" ,';
        $string .= '"PoidsUVteDL": '.$this->getPoidsUVteDL().' ,';
        $string .= '"MontTVADL": '.$this->getMontTVADL().' ,';
        $string .= '"MontTgapDL": '.$this->getMontTgapDL().' ,';
        $string .= '"MontParafDL": '.$this->getMontParafDL().' ,';
        $string .= '"NbUCondDL": '.$this->getNbUCondDL().' ,';

        $val = ($this->isFlgBonniDL()) ? 'true' : 'false';
        $string .= '"FlgBonniDL": ' . $val . ' ,';

        $string .= '"TypeQteDL": "'.$this->getTypeQteDL().'" ,';
        $string .= '"IdPTA": '.$this->getIdPTA().' ,';
        $string .= '"IdCel": '.$this->getIdCel().' ,';
        $string .= '"MontTTCComDL": '.$this->getMontTTCComDL().' ,';
        $string .= '"MontHTComDL": '.$this->getMontHTComDL().' ,';
        $string .= '"NbUVteComDL": '.$this->getNbUVteComDL().' ,';

        $val = ($this->isFlgVarDL()) ? 'true' : 'false';
        $string .= '"FlgVarDL": ' . $val . ' ,';

        $string .= '"NbUStoComDL": '.$this->getNbUStoComDL().' ,';
        $string .= '"IdTA": '.$this->getIdTA().' ,';
        $string .= '"NoAD": '.$this->getNoAD().' ,';
        $string .= '"CodAD": "'.$this->getCodAD().'" ,';
        $string .= '"CodADDL": "'.$this->getCodADDL().'" ,';
        $string .= '"RefDL": "'.$this->getRefDL().'" ,';
        $string .= '"DesignationAD": "'.$this->getDesignationAD().'" ,';
        $string .= '"Desi2Art": "'.$this->getDesi2Art().'" ,';
        $string .= '"HASH": "'.$this->getHASH().'" ,';
        $string .= '"TypePrixDL": "'.$this->getTypePrixDL().'" ,';
        $string .= '"ComCel": "'.$this->getComCel().'" ';

        $string .= '"IdExtDL": '.$this->getIdExtDL().' ,';
        $string .= '"IdFour": '.$this->getIdFour().' ,';
        $string .= '"NbUAchDL": '.$this->getNbUAchDL().' ,';
        $string .= '"DateModDL": "'.$this->getDateModDL().'" ,';
        $string .= '"IdTC": '.$this->getIdTC().' ,';
        $string .= '"IdDep": '.$this->getIdDep().' ,';
        $string .= '"EtatDL": "'.$this->getEtatDL().'" ,';
        $string .= '"CodTVADL": "'.$this->getCodTVADL().'" ,';
        $string .= '"UAchDL": "'.$this->getUAchDL().'" ,';

        $val = ($this->isTypCvAchVteDL()) ? 'true' : 'false';
        $string .= '"TypCvAchVteDL": "'.$val.'" ,';

        $string .= '"CvAchVteDL": '.$this->getCvAchVteDL().' ,';
        $string .= '"PrixAchDevDL": '.$this->getPrixAchDevDL().' ,';
        $string .= '"PrixAchDL": '.$this->getPrixAchDL().' ,';
        $string .= '"PrixDepConvDL": '.$this->getPrixDepConvDL().' ,';
        $string .= '"PrixDepReelDL": '.$this->getPrixDepReelDL().' ,';
        $string .= '"PrixNetConvDL": '.$this->getPrixNetConvDL().' ,';
        $string .= '"PrixNetReelDL": '.$this->getPrixNetReelDL().' ,';
        $string .= '"PrixRevConvDL": '.$this->getPrixRevConvDL().' ,';
        $string .= '"PrixRevReelDL": '.$this->getPrixRevReelDL().' ,';
        $string .= '"NbDecPNetDL": '.$this->getNbDecPNetDL().' ,';
        $string .= '"NbDecPDepDL": '.$this->getNbDecPDepDL().' ,';
        $string .= '"NbDecPrixRendDL": '.$this->getNbDecPrixRendDL().' ,';
        $string .= '"NbDecPrixRevDL": '.$this->getNbDecPrixRevDL().' ,';
        $string .= '"CodDevDL": "'.$this->getCodDevDL().'" ,';
        $string .= '"PoidsUAchDL": '.$this->getPoidsUAchDL().' ,';
        $string .= '"VolUAchDL": '.$this->getVolUAchDL().' ,';
        $string .= '"TypePRDL": "'.$this->getTypePRDL().'" ,';
        $string .= '"IdPort": '.$this->getIdPort().' ,';
        $string .= '"IdEch": '.$this->getIdEch().' ,';
        $string .= '"LargDL": '.$this->getLargDL().' ,';
        $string .= '"LongDL": '.$this->getLongDL().' ,';
        $string .= '"EpaisDL": '.$this->getEpaisDL().' ,';
        $string .= '"CvStoVteDL": "'.$this->getCvStoVteDL().'" ,';

        $val = ($this->isTypCvStoVteDL()) ? 'true' : 'false';
        $string .= '"TypCvStoVteDL": "'.$val.'" ,';

        $string .= '"NbUStoCondVteDL": '.$this->getNbUStoCondVteDL().' ,';
        $string .= '"CodParafDL": "'.$this->getCodParafDL().'" ,';
        $string .= '"CondVteDL": "'.$this->getCondVteDL().'" ,';
        $string .= '"TypeLongDL": "'.$this->getTypeLongDL().'" ,';
        $string .= '"MontEcoTaxeDL": '.$this->getMontEcoTaxeDL().' ,';
        $string .= '"PrixTTCDL": '.$this->getPrixTTCDL().' ,';
        $string .= '"MontRevConvDL": '.$this->getMontRevConvDL().' ,';
        $string .= '"MontRevReDL": '.$this->getMontRevReDL().' ,';
        $string .= '"MontHTAvecPortDL": '.$this->getMontHTAvecPortDL().' ,';
        $string .= '"IdTar": '.$this->getIdTar().' ,';
        $string .= '"IdTarPre": '.$this->getIdTarPre().' ,';
        $string .= '"TypeTarDL": "'.$this->getTypeTarDL().'" ,';
        $string .= '"CodMethDL": "'.$this->getCodMethDL().'" ,';
        $string .= '"TypeSeuTarDL": "'.$this->getTypeSeuTarDL().'" ,';
        $string .= '"PRCAutoDL": '.$this->getPRCAutoDL().' ,';
        $string .= '"PRRAutoDL": '.$this->getPRRAutoDL().' ,';
        $string .= '"PrixTarDL": '.$this->getPrixTarDL().' ,';
        $string .= '"IdTarComp": '.$this->getIdTarComp().' ,';
        $string .= '"IdTarComp2": '.$this->getIdTarComp2().' ,';
        $string .= '"IdCas": '.$this->getIdCas().' ,';
        $string .= '"RemValDL": '.$this->getRemValDL().' ,';
        $string .= '"PrixPubDL": '.$this->getPrixPubDL().' ,';
        $string .= '"CoefDL": '.$this->getCoefDL().' ,';
        $string .= '"Remise1DL": '.$this->getRemise1DL().' ,';
        $string .= '"Remise2DL": '.$this->getRemise2DL().' ,';
        $string .= '"Remise3DL": '.$this->getRemise3DL().' ,';
        $string .= '"ComModPRDL": "'.$this->getComModPRDL().'" ,';
        $string .= '"DateModPRDL": "'.$this->getDateModPRDL().'" ,';
        $string .= '"IdUModPRDL": '.$this->getIdUModPRDL().' ,';
        $string .= '"PrixPortDL": '.$this->getPrixPortDL().' ,';
        $string .= '"MargConvDL": '.$this->getMargConvDL().' ,';
        $string .= '"CvVteVteDL": '.$this->getCvVteVteDL().' ,';
        $string .= '"GrpTarSeuDL": "'.$this->getGrpTarSeuDL().'" ,';
        $string .= '"MargReelDL": '.$this->getMargReelDL().' ';
        $string .= '}';

        return $string;
    }

    /**
     * @return int
     */
    public function getIdDL()
    {
        return $this->IdDL;
    }

    /**
     * @param int $IdDL
     */
    public function setIdDL($IdDL)
    {
        $this->IdDL = $IdDL;
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
    public function getIdDocDL()
    {
        return $this->IdDocDL;
    }

    /**
     * @param int $IdDocDL
     */
    public function setIdDocDL($IdDocDL)
    {
        $this->IdDocDL = $IdDocDL;
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
    public function getIdDocSecDE()
    {
        return $this->IdDocSecDE;
    }

    /**
     * @param int $IdDocSecDE
     */
    public function setIdDocSecDE($IdDocSecDE)
    {
        $this->IdDocSecDE = $IdDocSecDE;
    }

    /**
     * @return int
     */
    public function getIdAD()
    {
        return $this->IdAD;
    }

    /**
     * @param int $IdAD
     */
    public function setIdAD($IdAD)
    {
        $this->IdAD = $IdAD;
    }

    /**
     * @return int
     */
    public function getNumDL()
    {
        return $this->NumDL;
    }

    /**
     * @param int $NumDL
     */
    public function setNumDL($NumDL)
    {
        $this->NumDL = $NumDL;
    }

    /**
     * @return int
     */
    public function getNbUStoDL()
    {
        return $this->NbUStoDL;
    }

    /**
     * @param int $NbUStoDL
     */
    public function setNbUStoDL($NbUStoDL)
    {
        $this->NbUStoDL = $NbUStoDL;
    }

    /**
     * @return int
     */
    public function getUStoDL()
    {
        return $this->UStoDL;
    }

    /**
     * @param int $UStoDL
     */
    public function setUStoDL($UStoDL)
    {
        $this->UStoDL = $UStoDL;
    }

    /**
     * @return int
     */
    public function getMontHTDL()
    {
        return $this->MontHTDL;
    }

    /**
     * @param int $MontHTDL
     */
    public function setMontHTDL($MontHTDL)
    {
        $this->MontHTDL = $MontHTDL;
    }

    /**
     * @return int
     */
    public function getMontTTCDL()
    {
        return $this->MontTTCDL;
    }

    /**
     * @param int $MontTTCDL
     */
    public function setMontTTCDL($MontTTCDL)
    {
        $this->MontTTCDL = $MontTTCDL;
    }

    /**
     * @return int
     */
    public function getPrixNetDL()
    {
        return $this->PrixNetDL;
    }

    /**
     * @param int $PrixNetDL
     */
    public function setPrixNetDL($PrixNetDL)
    {
        $this->PrixNetDL = $PrixNetDL;
    }

    /**
     * @return int
     */
    public function getNbUVteDL()
    {
        return $this->NbUVteDL;
    }

    /**
     * @param int $NbUVteDL
     */
    public function setNbUVteDL($NbUVteDL)
    {
        $this->NbUVteDL = $NbUVteDL;
    }

    /**
     * @return int
     */
    public function getUVteDL()
    {
        return $this->UVteDL;
    }

    /**
     * @param int $UVteDL
     */
    public function setUVteDL($UVteDL)
    {
        $this->UVteDL = $UVteDL;
    }

    /**
     * @return string
     */
    public function getComDL()
    {
        return $this->ComDL;
    }

    /**
     * @param string $ComDL
     */
    public function setComDL($ComDL)
    {
        $this->ComDL = $ComDL;
    }

    /**
     * @return string
     */
    public function getCodEcoTaxeDL()
    {
        return $this->CodEcoTaxeDL;
    }

    /**
     * @param string $CodEcoTaxeDL
     */
    public function setCodEcoTaxeDL($CodEcoTaxeDL)
    {
        $this->CodEcoTaxeDL = $CodEcoTaxeDL;
    }

    /**
     * @return string
     */
    public function getCodTgapDL()
    {
        return $this->CodTgapDL;
    }

    /**
     * @param string $CodTgapDL
     */
    public function setCodTgapDL($CodTgapDL)
    {
        $this->CodTgapDL = $CodTgapDL;
    }

    /**
     * @return int
     */
    public function getPoidsUVteDL()
    {
        return $this->PoidsUVteDL;
    }

    /**
     * @param int $PoidsUVteDL
     */
    public function setPoidsUVteDL($PoidsUVteDL)
    {
        $this->PoidsUVteDL = $PoidsUVteDL;
    }

    /**
     * @return int
     */
    public function getMontTVADL()
    {
        return $this->MontTVADL;
    }

    /**
     * @param int $MontTVADL
     */
    public function setMontTVADL($MontTVADL)
    {
        $this->MontTVADL = $MontTVADL;
    }

    /**
     * @return int
     */
    public function getMontTgapDL()
    {
        return $this->MontTgapDL;
    }

    /**
     * @param int $MontTgapDL
     */
    public function setMontTgapDL($MontTgapDL)
    {
        $this->MontTgapDL = $MontTgapDL;
    }

    /**
     * @return int
     */
    public function getMontParafDL()
    {
        return $this->MontParafDL;
    }

    /**
     * @param int $MontParafDL
     */
    public function setMontParafDL($MontParafDL)
    {
        $this->MontParafDL = $MontParafDL;
    }

    /**
     * @return int
     */
    public function getNbUCondDL()
    {
        return $this->NbUCondDL;
    }

    /**
     * @param int $NbUCondDL
     */
    public function setNbUCondDL($NbUCondDL)
    {
        $this->NbUCondDL = $NbUCondDL;
    }

    /**
     * @return bool
     */
    public function isFlgBonniDL()
    {
        return $this->FlgBonniDL;
    }

    /**
     * @param bool $FlgBonniDL
     */
    public function setFlgBonniDL($FlgBonniDL)
    {
        $this->FlgBonniDL = $FlgBonniDL;
    }

    /**
     * @return string
     */
    public function getTypeQteDL()
    {
        return $this->TypeQteDL;
    }

    /**
     * @param string $TypeQteDL
     */
    public function setTypeQteDL($TypeQteDL)
    {
        $this->TypeQteDL = $TypeQteDL;
    }

    /**
     * @return int
     */
    public function getIdPTA()
    {
        return $this->IdPTA;
    }

    /**
     * @param int $IdPTA
     */
    public function setIdPTA($IdPTA)
    {
        $this->IdPTA = $IdPTA;
    }

    /**
     * @return int
     */
    public function getIdCel()
    {
        return $this->IdCel;
    }

    /**
     * @param int $IdCel
     */
    public function setIdCel($IdCel)
    {
        $this->IdCel = $IdCel;
    }

    /**
     * @return int
     */
    public function getMontTTCComDL()
    {
        return $this->MontTTCComDL;
    }

    /**
     * @param int $MontTTCComDL
     */
    public function setMontTTCComDL($MontTTCComDL)
    {
        $this->MontTTCComDL = $MontTTCComDL;
    }

    /**
     * @return int
     */
    public function getMontHTComDL()
    {
        return $this->MontHTComDL;
    }

    /**
     * @param int $MontHTComDL
     */
    public function setMontHTComDL($MontHTComDL)
    {
        $this->MontHTComDL = $MontHTComDL;
    }

    /**
     * @return int
     */
    public function getNbUVteComDL()
    {
        return $this->NbUVteComDL;
    }

    /**
     * @param int $NbUVteComDL
     */
    public function setNbUVteComDL($NbUVteComDL)
    {
        $this->NbUVteComDL = $NbUVteComDL;
    }

    /**
     * @return bool
     */
    public function isFlgVarDL()
    {
        return $this->FlgVarDL;
    }

    /**
     * @param bool $FlgVarDL
     */
    public function setFlgVarDL($FlgVarDL)
    {
        $this->FlgVarDL = $FlgVarDL;
    }

    /**
     * @return int
     */
    public function getNbUStoComDL()
    {
        return $this->NbUStoComDL;
    }

    /**
     * @param int $NbUStoComDL
     */
    public function setNbUStoComDL($NbUStoComDL)
    {
        $this->NbUStoComDL = $NbUStoComDL;
    }

    /**
     * @return int
     */
    public function getIdTA()
    {
        return $this->IdTA;
    }

    /**
     * @param int $IdTA
     */
    public function setIdTA($IdTA)
    {
        $this->IdTA = $IdTA;
    }

    /**
     * @return int
     */
    public function getNoAD()
    {
        return $this->NoAD;
    }

    /**
     * @param int $NoAD
     */
    public function setNoAD($NoAD)
    {
        $this->NoAD = $NoAD;
    }

    /**
     * @return string
     */
    public function getCodAD()
    {
        return $this->CodAD;
    }

    /**
     * @param string $CodAD
     */
    public function setCodAD($CodAD)
    {
        $this->CodAD = $CodAD;
    }

    /**
     * @return string
     */
    public function getCodADDL()
    {
        return $this->CodADDL;
    }

    /**
     * @param string $CodADDL
     */
    public function setCodADDL($CodADDL)
    {
        $this->CodADDL = $CodADDL;
    }

    /**
     * @return string
     */
    public function getRefDL()
    {
        return $this->RefDL;
    }

    /**
     * @param string $RefDL
     */
    public function setRefDL($RefDL)
    {
        $this->RefDL = $RefDL;
    }

    /**
     * @return string
     */
    public function getDesignationAD()
    {
        return $this->DesignationAD;
    }

    /**
     * @param string $DesignationAD
     */
    public function setDesignationAD($DesignationAD)
    {
        $this->DesignationAD = $DesignationAD;
    }

    /**
     * @return string
     */
    public function getDesi2Art()
    {
        return $this->Desi2Art;
    }

    /**
     * @param string $Desi2Art
     */
    public function setDesi2Art($Desi2Art)
    {
        $this->Desi2Art = $Desi2Art;
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
     * @return string
     */
    public function getTypePrixDL()
    {
        return $this->TypePrixDL;
    }

    /**
     * @param string $TypePrixDL
     */
    public function setTypePrixDL($TypePrixDL)
    {
        $this->TypePrixDL = $TypePrixDL;
    }

    /**
     * @return string
     */
    public function getComCel()
    {
        return $this->ComCel;
    }

    /**
     * @param string $ComCel
     */
    public function setComCel($ComCel)
    {
        $this->ComCel = $ComCel;
    }

    /**
     * @return int
     */
    public function getIdExtDL()
    {
        return $this->IdExtDL;
    }

    /**
     * @param int $IdExtDL
     */
    public function setIdExtDL($IdExtDL)
    {
        $this->IdExtDL = $IdExtDL;
    }

    /**
     * @return int
     */
    public function getIdFour()
    {
        return $this->IdFour;
    }

    /**
     * @param int $IdFour
     */
    public function setIdFour($IdFour)
    {
        $this->IdFour = $IdFour;
    }

    /**
     * @return int
     */
    public function getNbUAchDL()
    {
        return $this->NbUAchDL;
    }

    /**
     * @param int $NbUAchDL
     */
    public function setNbUAchDL($NbUAchDL)
    {
        $this->NbUAchDL = $NbUAchDL;
    }

    /**
     * @return null
     */
    public function getDateModDL()
    {
        return $this->DateModDL;
    }

    /**
     * @param null $DateModDL
     */
    public function setDateModDL($DateModDL)
    {
        $this->DateModDL = $DateModDL;
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
     * @return int
     */
    public function getIdDep()
    {
        return $this->IdDep;
    }

    /**
     * @param int $IdDep
     */
    public function setIdDep($IdDep)
    {
        $this->IdDep = $IdDep;
    }

    /**
     * @return string
     */
    public function getEtatDL()
    {
        return $this->EtatDL;
    }

    /**
     * @param string $EtatDL
     */
    public function setEtatDL($EtatDL)
    {
        $this->EtatDL = $EtatDL;
    }

    /**
     * @return string
     */
    public function getCodTVADL()
    {
        return $this->CodTVADL;
    }

    /**
     * @param string $CodTVADL
     */
    public function setCodTVADL($CodTVADL)
    {
        $this->CodTVADL = $CodTVADL;
    }

    /**
     * @return string
     */
    public function getUAchDL()
    {
        return $this->UAchDL;
    }

    /**
     * @param string $UAchDL
     */
    public function setUAchDL($UAchDL)
    {
        $this->UAchDL = $UAchDL;
    }

    /**
     * @return bool
     */
    public function isTypCvAchVteDL()
    {
        return $this->TypCvAchVteDL;
    }

    /**
     * @param bool $TypCvAchVteDL
     */
    public function setTypCvAchVteDL($TypCvAchVteDL)
    {
        $this->TypCvAchVteDL = $TypCvAchVteDL;
    }

    /**
     * @return string
     */
    public function getCvAchVteDL()
    {
        return $this->CvAchVteDL;
    }

    /**
     * @param string $CvAchVteDL
     */
    public function setCvAchVteDL($CvAchVteDL)
    {
        $this->CvAchVteDL = $CvAchVteDL;
    }

    /**
     * @return int
     */
    public function getPrixAchDevDL()
    {
        return $this->PrixAchDevDL;
    }

    /**
     * @param int $PrixAchDevDL
     */
    public function setPrixAchDevDL($PrixAchDevDL)
    {
        $this->PrixAchDevDL = $PrixAchDevDL;
    }

    /**
     * @return int
     */
    public function getPrixAchDL()
    {
        return $this->PrixAchDL;
    }

    /**
     * @param int $PrixAchDL
     */
    public function setPrixAchDL($PrixAchDL)
    {
        $this->PrixAchDL = $PrixAchDL;
    }

    /**
     * @return int
     */
    public function getPrixDepConvDL()
    {
        return $this->PrixDepConvDL;
    }

    /**
     * @param int $PrixDepConvDL
     */
    public function setPrixDepConvDL($PrixDepConvDL)
    {
        $this->PrixDepConvDL = $PrixDepConvDL;
    }

    /**
     * @return int
     */
    public function getPrixDepReelDL()
    {
        return $this->PrixDepReelDL;
    }

    /**
     * @param int $PrixDepReelDL
     */
    public function setPrixDepReelDL($PrixDepReelDL)
    {
        $this->PrixDepReelDL = $PrixDepReelDL;
    }

    /**
     * @return int
     */
    public function getPrixNetConvDL()
    {
        return $this->PrixNetConvDL;
    }

    /**
     * @param int $PrixNetConvDL
     */
    public function setPrixNetConvDL($PrixNetConvDL)
    {
        $this->PrixNetConvDL = $PrixNetConvDL;
    }

    /**
     * @return int
     */
    public function getPrixNetReelDL()
    {
        return $this->PrixNetReelDL;
    }

    /**
     * @param int $PrixNetReelDL
     */
    public function setPrixNetReelDL($PrixNetReelDL)
    {
        $this->PrixNetReelDL = $PrixNetReelDL;
    }

    /**
     * @return int
     */
    public function getPrixRevConvDL()
    {
        return $this->PrixRevConvDL;
    }

    /**
     * @param int $PrixRevConvDL
     */
    public function setPrixRevConvDL($PrixRevConvDL)
    {
        $this->PrixRevConvDL = $PrixRevConvDL;
    }

    /**
     * @return int
     */
    public function getPrixRevReelDL()
    {
        return $this->PrixRevReelDL;
    }

    /**
     * @param int $PrixRevReelDL
     */
    public function setPrixRevReelDL($PrixRevReelDL)
    {
        $this->PrixRevReelDL = $PrixRevReelDL;
    }

    /**
     * @return int
     */
    public function getNbDecPNetDL()
    {
        return $this->NbDecPNetDL;
    }

    /**
     * @param int $NbDecPNetDL
     */
    public function setNbDecPNetDL($NbDecPNetDL)
    {
        $this->NbDecPNetDL = $NbDecPNetDL;
    }

    /**
     * @return int
     */
    public function getNbDecPDepDL()
    {
        return $this->NbDecPDepDL;
    }

    /**
     * @param int $NbDecPDepDL
     */
    public function setNbDecPDepDL($NbDecPDepDL)
    {
        $this->NbDecPDepDL = $NbDecPDepDL;
    }

    /**
     * @return int
     */
    public function getNbDecPrixRendDL()
    {
        return $this->NbDecPrixRendDL;
    }

    /**
     * @param int $NbDecPrixRendDL
     */
    public function setNbDecPrixRendDL($NbDecPrixRendDL)
    {
        $this->NbDecPrixRendDL = $NbDecPrixRendDL;
    }

    /**
     * @return int
     */
    public function getNbDecPrixRevDL()
    {
        return $this->NbDecPrixRevDL;
    }

    /**
     * @param int $NbDecPrixRevDL
     */
    public function setNbDecPrixRevDL($NbDecPrixRevDL)
    {
        $this->NbDecPrixRevDL = $NbDecPrixRevDL;
    }

    /**
     * @return string
     */
    public function getCodDevDL()
    {
        return $this->CodDevDL;
    }

    /**
     * @param string $CodDevDL
     */
    public function setCodDevDL($CodDevDL)
    {
        $this->CodDevDL = $CodDevDL;
    }

    /**
     * @return int
     */
    public function getPoidsUAchDL()
    {
        return $this->PoidsUAchDL;
    }

    /**
     * @param int $PoidsUAchDL
     */
    public function setPoidsUAchDL($PoidsUAchDL)
    {
        $this->PoidsUAchDL = $PoidsUAchDL;
    }

    /**
     * @return int
     */
    public function getVolUAchDL()
    {
        return $this->VolUAchDL;
    }

    /**
     * @param int $VolUAchDL
     */
    public function setVolUAchDL($VolUAchDL)
    {
        $this->VolUAchDL = $VolUAchDL;
    }

    /**
     * @return string
     */
    public function getTypePRDL()
    {
        return $this->TypePRDL;
    }

    /**
     * @param string $TypePRDL
     */
    public function setTypePRDL($TypePRDL)
    {
        $this->TypePRDL = $TypePRDL;
    }

    /**
     * @return int
     */
    public function getIdPort()
    {
        return $this->IdPort;
    }

    /**
     * @param int $IdPort
     */
    public function setIdPort($IdPort)
    {
        $this->IdPort = $IdPort;
    }

    /**
     * @return int
     */
    public function getIdEch()
    {
        return $this->IdEch;
    }

    /**
     * @param int $IdEch
     */
    public function setIdEch($IdEch)
    {
        $this->IdEch = $IdEch;
    }

    /**
     * @return int
     */
    public function getLargDL()
    {
        return $this->LargDL;
    }

    /**
     * @param int $LargDL
     */
    public function setLargDL($LargDL)
    {
        $this->LargDL = $LargDL;
    }

    /**
     * @return int
     */
    public function getLongDL()
    {
        return $this->LongDL;
    }

    /**
     * @param int $LongDL
     */
    public function setLongDL($LongDL)
    {
        $this->LongDL = $LongDL;
    }

    /**
     * @return int
     */
    public function getEpaisDL()
    {
        return $this->EpaisDL;
    }

    /**
     * @param int $EpaisDL
     */
    public function setEpaisDL($EpaisDL)
    {
        $this->EpaisDL = $EpaisDL;
    }

    /**
     * @return int
     */
    public function getCvStoVteDL()
    {
        return $this->CvStoVteDL;
    }

    /**
     * @param int $CvStoVteDL
     */
    public function setCvStoVteDL($CvStoVteDL)
    {
        $this->CvStoVteDL = $CvStoVteDL;
    }

    /**
     * @return bool
     */
    public function isTypCvStoVteDL()
    {
        return $this->TypCvStoVteDL;
    }

    /**
     * @param bool $TypCvStoVteDL
     */
    public function setTypCvStoVteDL($TypCvStoVteDL)
    {
        $this->TypCvStoVteDL = $TypCvStoVteDL;
    }

    /**
     * @return int
     */
    public function getNbUStoCondVteDL()
    {
        return $this->NbUStoCondVteDL;
    }

    /**
     * @param int $NbUStoCondVteDL
     */
    public function setNbUStoCondVteDL($NbUStoCondVteDL)
    {
        $this->NbUStoCondVteDL = $NbUStoCondVteDL;
    }

    /**
     * @return string
     */
    public function getCodParafDL()
    {
        return $this->CodParafDL;
    }

    /**
     * @param string $CodParafDL
     */
    public function setCodParafDL($CodParafDL)
    {
        $this->CodParafDL = $CodParafDL;
    }

    /**
     * @return string
     */
    public function getCondVteDL()
    {
        return $this->CondVteDL;
    }

    /**
     * @param string $CondVteDL
     */
    public function setCondVteDL($CondVteDL)
    {
        $this->CondVteDL = $CondVteDL;
    }

    /**
     * @return string
     */
    public function getTypeLongDL()
    {
        return $this->TypeLongDL;
    }

    /**
     * @param string $TypeLongDL
     */
    public function setTypeLongDL($TypeLongDL)
    {
        $this->TypeLongDL = $TypeLongDL;
    }

    /**
     * @return int
     */
    public function getMontEcoTaxeDL()
    {
        return $this->MontEcoTaxeDL;
    }

    /**
     * @param int $MontEcoTaxeDL
     */
    public function setMontEcoTaxeDL($MontEcoTaxeDL)
    {
        $this->MontEcoTaxeDL = $MontEcoTaxeDL;
    }

    /**
     * @return int
     */
    public function getPrixTTCDL()
    {
        return $this->PrixTTCDL;
    }

    /**
     * @param int $PrixTTCDL
     */
    public function setPrixTTCDL($PrixTTCDL)
    {
        $this->PrixTTCDL = $PrixTTCDL;
    }

    /**
     * @return int
     */
    public function getMontRevConvDL()
    {
        return $this->MontRevConvDL;
    }

    /**
     * @param int $MontRevConvDL
     */
    public function setMontRevConvDL($MontRevConvDL)
    {
        $this->MontRevConvDL = $MontRevConvDL;
    }

    /**
     * @return int
     */
    public function getMontRevReDL()
    {
        return $this->MontRevReDL;
    }

    /**
     * @param int $MontRevReDL
     */
    public function setMontRevReDL($MontRevReDL)
    {
        $this->MontRevReDL = $MontRevReDL;
    }

    /**
     * @return int
     */
    public function getMontHTAvecPortDL()
    {
        return $this->MontHTAvecPortDL;
    }

    /**
     * @param int $MontHTAvecPortDL
     */
    public function setMontHTAvecPortDL($MontHTAvecPortDL)
    {
        $this->MontHTAvecPortDL = $MontHTAvecPortDL;
    }

    /**
     * @return int
     */
    public function getIdTar()
    {
        return $this->IdTar;
    }

    /**
     * @param int $IdTar
     */
    public function setIdTar($IdTar)
    {
        $this->IdTar = $IdTar;
    }

    /**
     * @return int
     */
    public function getIdTarPre()
    {
        return $this->IdTarPre;
    }

    /**
     * @param int $IdTarPre
     */
    public function setIdTarPre($IdTarPre)
    {
        $this->IdTarPre = $IdTarPre;
    }

    /**
     * @return string
     */
    public function getTypeTarDL()
    {
        return $this->TypeTarDL;
    }

    /**
     * @param string $TypeTarDL
     */
    public function setTypeTarDL($TypeTarDL)
    {
        $this->TypeTarDL = $TypeTarDL;
    }

    /**
     * @return string
     */
    public function getCodMethDL()
    {
        return $this->CodMethDL;
    }

    /**
     * @param string $CodMethDL
     */
    public function setCodMethDL($CodMethDL)
    {
        $this->CodMethDL = $CodMethDL;
    }

    /**
     * @return string
     */
    public function getTypeSeuTarDL()
    {
        return $this->TypeSeuTarDL;
    }

    /**
     * @param string $TypeSeuTarDL
     */
    public function setTypeSeuTarDL($TypeSeuTarDL)
    {
        $this->TypeSeuTarDL = $TypeSeuTarDL;
    }

    /**
     * @return int
     */
    public function getPRCAutoDL()
    {
        return $this->PRCAutoDL;
    }

    /**
     * @param int $PRCAutoDL
     */
    public function setPRCAutoDL($PRCAutoDL)
    {
        $this->PRCAutoDL = $PRCAutoDL;
    }

    /**
     * @return int
     */
    public function getPRRAutoDL()
    {
        return $this->PRRAutoDL;
    }

    /**
     * @param int $PRRAutoDL
     */
    public function setPRRAutoDL($PRRAutoDL)
    {
        $this->PRRAutoDL = $PRRAutoDL;
    }

    /**
     * @return int
     */
    public function getPrixTarDL()
    {
        return $this->PrixTarDL;
    }

    /**
     * @param int $PrixTarDL
     */
    public function setPrixTarDL($PrixTarDL)
    {
        $this->PrixTarDL = $PrixTarDL;
    }

    /**
     * @return int
     */
    public function getIdTarComp()
    {
        return $this->IdTarComp;
    }

    /**
     * @param int $IdTarComp
     */
    public function setIdTarComp($IdTarComp)
    {
        $this->IdTarComp = $IdTarComp;
    }

    /**
     * @return int
     */
    public function getIdTarComp2()
    {
        return $this->IdTarComp2;
    }

    /**
     * @param int $IdTarComp2
     */
    public function setIdTarComp2($IdTarComp2)
    {
        $this->IdTarComp2 = $IdTarComp2;
    }

    /**
     * @return int
     */
    public function getIdCas()
    {
        return $this->IdCas;
    }

    /**
     * @param int $IdCas
     */
    public function setIdCas($IdCas)
    {
        $this->IdCas = $IdCas;
    }

    /**
     * @return int
     */
    public function getRemValDL()
    {
        return $this->RemValDL;
    }

    /**
     * @param int $RemValDL
     */
    public function setRemValDL($RemValDL)
    {
        $this->RemValDL = $RemValDL;
    }

    /**
     * @return int
     */
    public function getPrixPubDL()
    {
        return $this->PrixPubDL;
    }

    /**
     * @param int $PrixPubDL
     */
    public function setPrixPubDL($PrixPubDL)
    {
        $this->PrixPubDL = $PrixPubDL;
    }

    /**
     * @return int
     */
    public function getCoefDL()
    {
        return $this->CoefDL;
    }

    /**
     * @param int $CoefDL
     */
    public function setCoefDL($CoefDL)
    {
        $this->CoefDL = $CoefDL;
    }

    /**
     * @return int
     */
    public function getRemise1DL()
    {
        return $this->Remise1DL;
    }

    /**
     * @param int $Remise1DL
     */
    public function setRemise1DL($Remise1DL)
    {
        $this->Remise1DL = $Remise1DL;
    }

    /**
     * @return int
     */
    public function getRemise2DL()
    {
        return $this->Remise2DL;
    }

    /**
     * @param int $Remise2DL
     */
    public function setRemise2DL($Remise2DL)
    {
        $this->Remise2DL = $Remise2DL;
    }

    /**
     * @return int
     */
    public function getRemise3DL()
    {
        return $this->Remise3DL;
    }

    /**
     * @param int $Remise3DL
     */
    public function setRemise3DL($Remise3DL)
    {
        $this->Remise3DL = $Remise3DL;
    }

    /**
     * @return string
     */
    public function getComModPRDL()
    {
        return $this->ComModPRDL;
    }

    /**
     * @param string $ComModPRDL
     */
    public function setComModPRDL($ComModPRDL)
    {
        $this->ComModPRDL = $ComModPRDL;
    }

    /**
     * @return null
     */
    public function getDateModPRDL()
    {
        return $this->DateModPRDL;
    }

    /**
     * @param null $DateModPRDL
     */
    public function setDateModPRDL($DateModPRDL)
    {
        $this->DateModPRDL = $DateModPRDL;
    }

    /**
     * @return int
     */
    public function getIdUModPRDL()
    {
        return $this->IdUModPRDL;
    }

    /**
     * @param int $IdUModPRDL
     */
    public function setIdUModPRDL($IdUModPRDL)
    {
        $this->IdUModPRDL = $IdUModPRDL;
    }

    /**
     * @return int
     */
    public function getPrixPortDL()
    {
        return $this->PrixPortDL;
    }

    /**
     * @param int $PrixPortDL
     */
    public function setPrixPortDL($PrixPortDL)
    {
        $this->PrixPortDL = $PrixPortDL;
    }

    /**
     * @return int
     */
    public function getMargConvDL()
    {
        return $this->MargConvDL;
    }

    /**
     * @param int $MargConvDL
     */
    public function setMargConvDL($MargConvDL)
    {
        $this->MargConvDL = $MargConvDL;
    }

    /**
     * @return int
     */
    public function getCvVteVteDL()
    {
        return $this->CvVteVteDL;
    }

    /**
     * @param int $CvVteVteDL
     */
    public function setCvVteVteDL($CvVteVteDL)
    {
        $this->CvVteVteDL = $CvVteVteDL;
    }

    /**
     * @return string
     */
    public function getGrpTarSeuDL()
    {
        return $this->GrpTarSeuDL;
    }

    /**
     * @param string $GrpTarSeuDL
     */
    public function setGrpTarSeuDL($GrpTarSeuDL)
    {
        $this->GrpTarSeuDL = $GrpTarSeuDL;
    }

    /**
     * @return int
     */
    public function getMargReelDL()
    {
        return $this->MargReelDL;
    }

    /**
     * @param int $MargReelDL
     */
    public function setMargReelDL($MargReelDL)
    {
        $this->MargReelDL = $MargReelDL;
    }

}