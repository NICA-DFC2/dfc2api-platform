<?php

namespace App\Utils\Extensions;


use App\Services\Objets\WsDocumLig;

class DocumentLigne
{
    private $IdDL = 0;
    private $IdDE = 0;
    private $IdDocDL = 0;
    public $IdDocDE = 0;
    private $IdDocSecDE = 0;
    private $IdAD = 0;
    private $NumDL = 0;
    private $NbUStoDL = 0;
    private $UStoDL = 0;
    private $MontHTDL = 0;
    private $MontTTCDL = 0;
    private $PrixNetDL = 0;
    private $NbUVteDL = 0;
    private $UVteDL = 0;
    private $ComDL = "";
    private $CodEcoTaxeDL= "";
    private $CodTgapDL= "";
    private $PoidsUVteDL= 0;
    private $MontTVADL= 0;
    private $MontTgapDL= 0;
    private $MontParafDL= 0;
    private $NbUCondDL= 0;
    private $FlgBonniDL= false;
    private $TypeQteDL= "";
    private $IdPTA= 0;
    private $IdCel= 0;
    private $MontTTCComDL= 0;
    private $MontHTComDL= 0;
    private $NbUVteComDL= 0;
    private $FlgVarDL= false;
    private $NbUStoComDL= 0;
    private $IdTA= 0;
    private $NoAD= 0;
    private $CodAD= "";
    private $CodADDL= "";
    private $RefDL= "";
    private $DesignationAD= "";
    private $Desi2Art= "";
    private $HASH= "";
    private $TypePrixDL= "";
    private $ComCel= "";
    private $IdExtDL = 0;
    private $IdFour = 0;
    private $NbUAchDL = 0;
    private $DateModDL = null;
    private $IdTC = 0;
    private $IdDep = 0;
    private $EtatDL = "";
    private $CodTVADL = "";
    private $UAchDL = "";
    private $TypCvAchVteDL = false;
    private $CvAchVteDL = "";
    private $PrixAchDevDL = 0;
    private $PrixAchDL = 0;
    private $PrixDepConvDL = 0;
    private $PrixDepReelDL = 0;
    private $PrixNetConvDL = 0;
    private $PrixNetReelDL = 0;
    private $PrixRevConvDL = 0;
    private $PrixRevReelDL = 0;
    private $NbDecPNetDL = 0;
    private $NbDecPDepDL = 0;
    private $NbDecPrixRendDL = 0;
    private $NbDecPrixRevDL = 0;
    private $CodDevDL = "";
    private $PoidsUAchDL = 0;
    private $VolUAchDL = 0;
    private $TypePRDL = "";
    private $IdPort = 0;
    private $IdEch = 0;
    private $LargDL = 0;
    private $LongDL = 0;
    private $EpaisDL = 0;
    private $CvStoVteDL = 0;
    private $TypCvStoVteDL = false;
    private $NbUStoCondVteDL = 0;
    private $CodParafDL = "";
    private $CondVteDL = "";
    private $TypeLongDL = "";
    private $MontEcoTaxeDL = 0;
    private $PrixTTCDL = 0;
    private $MontRevConvDL = 0;
    private $MontRevReDL = 0;
    private $MontHTAvecPortDL = 0;
    private $IdTar = 0;
    private $IdTarPre = 0;
    private $TypeTarDL = "";
    private $CodMethDL = "";
    private $TypeSeuTarDL = "";
    private $PRCAutoDL = 0;
    private $PRRAutoDL = 0;
    private $PrixTarDL = 0;
    private $IdTarComp = 0;
    private $IdTarComp2 = 0;
    private $IdCas = 0;
    private $RemValDL = 0;
    private $PrixPubDL = 0;
    private $CoefDL = 0;
    private $Remise1DL = 0;
    private $Remise2DL = 0;
    private $Remise3DL = 0;
    private $ComModPRDL = "";
    private $DateModPRDL = null;
    private $IdUModPRDL = 0;
    private $PrixPortDL = 0;
    private $MargConvDL = 0;
    private $CvVteVteDL = 0;
    private $GrpTarSeuDL = "";
    private $MargReelDL = 0;
    private $IsFilled = false;


    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     *
     * @param WsDocumLig $object
     */
    public function parseObject(WsDocumLig $object) {
        $this->setIsFilled(false);
        if(!is_null($object)) {
            $this->setIdDL($object->{'IdDL'});
            $this->setIdDE($object->{'IdDE'});
            $this->setIdDocDL($object->{'IdDocDL'});
            $this->setIdDocDE($object->{'IdDocDE'});
            $this->setIdDocSecDE($object->{'IdDocSecDE'});
            $this->setIdAD($object->{'IdAD'});
            $this->setNumDL($object->{'NumDL'});
            $this->setNbUStoDL($object->{'NbUStoDL'});
            $this->setUStoDL($object->{'UStoDL'});
            $this->setMontHTDL($object->{'MontHTDL'});
            $this->setMontTTCDL($object->{'MontTTCDL'});
            $this->setPrixNetDL($object->{'PrixNetDL'});
            $this->setNbUVteDL($object->{'NbUVteDL'});
            $this->setUVteDL($object->{'UVteDL'});
            $this->setComDL($object->{'ComDL'});
            $this->setCodEcoTaxeDL($object->{'CodEcoTaxeDL'});
            $this->setCodTgapDL($object->{'CodTgapDL'});
            $this->setPoidsUVteDL($object->{'PoidsUVteDL'});
            $this->setMontTVADL($object->{'MontTVADL'});
            $this->setMontTgapDL($object->{'MontTgapDL'});
            $this->setMontParafDL($object->{'MontParafDL'});
            $this->setNbUCondDL($object->{'NbUCondDL'});
            $this->setFlgBonniDL($object->{'FlgBonniDL'});
            $this->setTypeQteDL($object->{'TypeQteDL'});
            $this->setIdPTA($object->{'IdPTA'});
            $this->setIdCel($object->{'IdCel'});
            $this->setMontTTCComDL($object->{'MontTTCComDL'});
            $this->setMontHTComDL($object->{'MontHTComDL'});
            $this->setNbUVteComDL($object->{'NbUVteComDL'});
            $this->setFlgVarDL($object->{'FlgVarDL'});
            $this->setNbUStoComDL($object->{'NbUStoComDL'});
            $this->setIdTA($object->{'IdTA'});
            $this->setNoAD($object->{'NoAD'});
            $this->setCodAD($object->{'CodAD'});
            $this->setCodADDL($object->{'CodADDL'});
            $this->setRefDL($object->{'RefDL'});
            $this->setDesignationAD($object->{'DesignationAD'});
            $this->setDesi2Art($object->{'Desi2Art'});
            $this->setHASH($object->{'HASH'});
            $this->setTypePrixDL($object->{'TypePrixDL'});
            $this->setComCel($object->{'ComCel'});
            $this->setIdExtDL($object->{'IdExtDL'});
            $this->setIdFour($object->{'IdFour'});
            $this->setNbUAchDL($object->{'NbUAchDL'});
            $this->setDateModDL($object->{'DateModDL'});
            $this->setIdTC($object->{'IdTC'});
            $this->setIdDep($object->{'IdDep'});
            $this->setEtatDL($object->{'EtatDL'});
            $this->setCodTVADL($object->{'CodTVADL'});
            $this->setUAchDL($object->{'UAchDL'});
            $this->setTypCvAchVteDL($object->{'TypCvAchVteDL'});
            $this->setCvAchVteDL($object->{'CvAchVteDL'});
            $this->setPrixAchDevDL($object->{'PrixAchDevDL'});
            $this->setPrixAchDL($object->{'PrixAchDL'});
            $this->setPrixDepConvDL($object->{'PrixDepConvDL'});
            $this->setPrixDepReelDL($object->{'PrixDepReelDL'});
            $this->setPrixNetConvDL($object->{'PrixNetConvDL'});
            $this->setPrixNetReelDL($object->{'PrixNetReelDL'});
            $this->setPrixRevConvDL($object->{'PrixRevConvDL'});
            $this->setPrixRevReelDL($object->{'PrixRevReelDL'});
            $this->setNbDecPNetDL($object->{'NbDecPNetDL'});
            $this->setNbDecPDepDL($object->{'NbDecPDepDL'});
            $this->setNbDecPrixRendDL($object->{'NbDecPrixRendDL'});
            $this->setNbDecPrixRevDL($object->{'NbDecPrixRevDL'});
            $this->setCodDevDL($object->{'CodDevDL'});
            $this->setPoidsUAchDL($object->{'PoidsUAchDL'});
            $this->setVolUAchDL($object->{'VolUAchDL'});
            $this->setTypePRDL($object->{'TypePRDL'});
            $this->setIdPort($object->{'IdPort'});
            $this->setIdEch($object->{'IdEch'});
            $this->setLargDL($object->{'LargDL'});
            $this->setLongDL($object->{'LongDL'});
            $this->setEpaisDL($object->{'EpaisDL'});
            $this->setCvStoVteDL($object->{'CvStoVteDL'});
            $this->setTypCvStoVteDL($object->{'TypCvStoVteDL'});
            $this->setNbUStoCondVteDL($object->{'NbUStoCondVteDL'});
            $this->setCodParafDL($object->{'CodParafDL'});
            $this->setCondVteDL($object->{'CondVteDL'});
            $this->setTypeLongDL($object->{'TypeLongDL'});
            $this->setMontEcoTaxeDL($object->{'MontEcoTaxeDL'});
            $this->setPrixTTCDL($object->{'PrixTTCDL'});
            $this->setMontRevConvDL($object->{'MontRevConvDL'});
            $this->setMontRevReDL($object->{'MontRevReDL'});
            $this->setMontHTAvecPortDL($object->{'MontHTAvecPortDL'});
            $this->setIdTar($object->{'IdTar'});
            $this->setIdTarPre($object->{'IdTarPre'});
            $this->setTypeTarDL($object->{'TypeTarDL'});
            $this->setCodMethDL($object->{'CodMethDL'});
            $this->setTypeSeuTarDL($object->{'TypeSeuTarDL'});
            $this->setPRCAutoDL($object->{'PRCAutoDL'});
            $this->setPRRAutoDL($object->{'PRRAutoDL'});
            $this->setPrixTarDL($object->{'PrixTarDL'});
            $this->setIdTarComp($object->{'IdTarComp'});
            $this->setIdTarComp2($object->{'IdTarComp2'});
            $this->setIdCas($object->{'IdCas'});
            $this->setRemValDL($object->{'RemValDL'});
            $this->setPrixPubDL($object->{'PrixPubDL'});
            $this->setCoefDL($object->{'CoefDL'});
            $this->setRemise1DL($object->{'Remise1DL'});
            $this->setRemise2DL($object->{'Remise2DL'});
            $this->setRemise3DL($object->{'Remise3DL'});
            $this->setComModPRDL($object->{'ComModPRDL'});
            $this->setDateModPRDL($object->{'DateModPRDL'});
            $this->setIdUModPRDL($object->{'IdUModPRDL'});
            $this->setPrixPortDL($object->{'PrixPortDL'});
            $this->setMargConvDL($object->{'MargConvDL'});
            $this->setCvVteVteDL($object->{'CvVteVteDL'});
            $this->setGrpTarSeuDL($object->{'GrpTarSeuDL'});
            $this->setMargReelDL($object->{'MargReelDL'});
            $this->setIsFilled(true);
        }
        return $this;
    }


    /**
     * @return boolean
     */
    public function isFilled()
    {
        return $this->IsFilled;
    }

    /**
     * @param boolean $isFilled
     */
    public function setIsFilled($isFilled)
    {
        $this->IsFilled = $isFilled;
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