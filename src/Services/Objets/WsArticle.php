<?php

namespace App\Services\Objets;


class WsArticle
{
    private $IdAD = 0;
    private $IdArt = 0;
    private $IdSoc = 0;
    private $IdDep = 0;
    private $IdIC = 0;
    private $NoAD = 0;
    private $CodAD = "";
    private $DesiAutoAD = "";
    private $ValNivAD = "";
    private $StkReelAD = 0.0;
    private $StkResAD = 0.0;
    private $StkCmdeAD = 0.0;
    private $CodGesStkAD = "";
    private $EtatStockAD = "";
    private $StockDisponible = 0.0;
    private $StockDisponibleSoc = 0.0;
    private $StockPratique = 0.0;
    private $StkReelPlat1 = 0.0;
    private $QteCIDSsCFAD = 0;
    private $UVteArt = "";
    private $UStoArt = "";
    private $CvStoVteAD = 0.0;
    private $TypCvStoVteAD = false;
    private $NbUStoCondVteAD = 0;
    private $PoidsUVteArt = 0.0;
    private $NbUVteUCondVte = 0.0;
    private $PrixPubUCondVte = 0.0;
    private $PrixNetUCondVte = 0.0;
    private $NbUStoUVte = 0;
    private $NbUVteUSto = 0;

    private $NbrDecArt = 0.0;
    private $LongAD = 0.0;
    private $LargAD = 0.0;
    private $EpaisAD = 0.0;
    private $CondVteAD = "";
    private $FlgDecondAD = false;
    private $Desi2Art = "";
    private $IdFour = 0;
    private $NomDep = "";
    private $CodSuspAD = "";
    private $MultimediaArt = "";
    private $ComTechAD = "";
    private $DocLie = "";
    private $GenCodAD = "";
    private $CodEcoTaxeAD = "";
    private $MtEcoTaxe = 0.0;
    private $ValEcoTaxe = 0.0;
    private $IdDepPlat = 0;
    private $IdADF = 0;
    private $CodADF = "";
    private $GenCod1ADF = "";
    private $GenCod2ADF = "";
    private $CodCatAD = "";

    private $PrixNet = 0.0;
    private $PrixPubCli = 0.0;
    private $PrixPubAD = 0.0;
    private $TypeTarif = "";
    private $PrixRevConvAD = 0.0;
    private $PrixRevReelAD = 0.0;
    private $CoefPRRAD = 0.0;
    private $CoefPRCAD = 0.0;
    private $MargeReelleAD = 0.0;
    private $MargeConvAD = 0.0;

    // stocks
    private $Stocks = null;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct() {
        $ctp = func_num_args();
        $args = func_get_args();

        switch($ctp)
        {
            case 1:
                $this->_construct($args[0]);
                break;
            default:
                $this->_construct();
                break;
        }
    }

    public function __toString() {
        $string = '{';
        $string .= '"IdAD": '. $this->getIdAD() .', ';
        $string .= '"IdArt": '. $this->getIdArt() .', ';
        $string .= '"IdSoc": '. $this->getIdSoc() .', ';
        $string .= '"IdDep": '. $this->getIdDep() .', ';
        $string .= '"IdIC": '. $this->getIdIC() .', ';
        $string .= '"NoAD": '. $this->getNoAD() .', ';
        $string .= '"CodAD": "'. $this->getCodAD() .'", ';
        $string .= '"DesiAutoAD": "'. $this->getDesiAutoAD() .'", ';
        $string .= '"ValNivAD": "'. $this->getValNivAD() .'", ';
        $string .= '"StkReelAD": '. $this->getStkReelAD() .', ';
        $string .= '"StkResAD": '. $this->getStkResAD() .', ';
        $string .= '"StkCmdeAD": '. $this->getStkCmdeAD() .', ';
        $string .= '"CodGesStkAD": "'. $this->getCodGesStkAD() .'", ';
        $string .= '"EtatStockAD": "'. $this->getEtatStockAD() .'", ';
        $string .= '"StockDisponible": '. $this->getStockDisponible() .', ';
        $string .= '"StockDisponibleSoc": '. $this->getStockDisponibleSoc() .', ';
        $string .= '"StockPratique": '. $this->getStockPratique() .', ';
        $string .= '"StkReelPlat1": '. $this->getStkReelPlat1() .', ';
        $string .= '"QteCIDSsCFAD": '. $this->getQteCIDSsCFAD() .', ';
        $string .= '"UVteArt": "'. $this->getUVteArt() .'", ';
        $string .= '"UStoArt": "'. $this->getUStoArt() .'", ';
        $string .= '"CvStoVteAD": '. $this->getCvStoVteAD() .', ';

        $val = ($this->getTypCvStoVteAD()) ? 'true' : 'false';
        $string .= '"TypCvStoVteAD": '. $val .', ';

        $string .= '"NbUStoCondVteAD": "'. $this->getNbUStoCondVteAD() .'", ';
        $string .= '"PoidsUVteArt": "'. $this->getPoidsUVteArt() .'", ';
        $string .= '"NbUVteUCondVte": '. $this->getNbUVteUCondVte() .', ';
        $string .= '"PrixPubUCondVte": '. $this->getPrixPubUCondVte() .', ';
        $string .= '"PrixNetUCondVte": '. $this->getPrixNetUCondVte() .', ';
        $string .= '"NbUStoUVte": '. $this->getNbUStoUVte() .', ';
        $string .= '"NbUVteUSto": '. $this->getNbUVteUSto() .', ';
        $string .= '"NbrDecArt": '. $this->getNbrDecArt() .', ';
        $string .= '"LongAD": '. $this->getLongAD() .', ';
        $string .= '"LargAD": '. $this->getLargAD() .', ';
        $string .= '"EpaisAD": '. $this->getEpaisAD() .', ';
        $string .= '"CondVteAD": "'. $this->getCondVteAD() .'", ';

        $val = ($this->getFlgDecondAD()) ? 'true' : 'false';
        $string .= '"FlgDecondAD": "'. $val .'", ';

        $string .= '"Desi2Art": "'. $this->getDesi2Art() .'", ';
        $string .= '"IdFour": '. $this->getIdFour() .', ';
        $string .= '"NomDep": "'. $this->getNomDep() .'", ';
        $string .= '"CodSuspAD": "'. $this->getCodSuspAD() .'", ';
        $string .= '"MultimediaArt": "'. $this->getMultimediaArt() .'", ';
        $string .= '"ComTechAD": "'. $this->getComTechAD() .'", ';
        $string .= '"DocLie": "'. $this->getDocLie() .'", ';
        $string .= '"GenCodAD": "'. $this->getGenCodAD() .'", ';
        $string .= '"CodEcoTaxeAD": "'. $this->getCodEcoTaxeAD() .'", ';
        $string .= '"MtEcoTaxe": "'. $this->getMtEcoTaxe() .'", ';
        $string .= '"ValEcoTaxe": '. $this->getValEcoTaxe() .', ';
        $string .= '"IdDepPlat": '. $this->getIdDepPlat() .', ';
        $string .= '"IdADF": '. $this->getIdADF() .', ';
        $string .= '"CodADF": "'. $this->getCodADF() .'", ';
        $string .= '"GenCod1ADF": "'. $this->getGenCod1ADF() .'", ';
        $string .= '"GenCod2ADF": "'. $this->getGenCod2ADF() .'", ';
        $string .= '"CodCatAD": "'. $this->getCodCatAD() .'", ';
        $string .= '"PrixNet": '. $this->getPrixNet() .', ';
        $string .= '"PrixPubCli": '. $this->getPrixPubCli() .', ';
        $string .= '"PrixPubAD": '. $this->getPrixPubAD() .', ';
        $string .= '"TypeTarif": "'. $this->getTypeTarif() .'", ';
        $string .= '"PrixRevConvAD": '. $this->getPrixRevConvAD() .', ';
        $string .= '"PrixRevReelAD": '. $this->getPrixRevReelAD() .', ';
        $string .= '"CoefPRRAD": '. $this->getCoefPRRAD() .', ';
        $string .= '"CoefPRCAD": '. $this->getCoefPRCAD() .', ';
        $string .= '"MargeReelleAD": '. $this->getMargeReelleAD() .', ';
        $string .= '"MargeConvAD": '. $this->getMargeConvAD();

        if(!is_null($this->getStocks())) {
            $string .= ', "Stocks": '. $this->getStocks()->__toString();
        }

        $string .= '}';

        return $string;
    }

    public function _construct($json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdAD($json_object->{'IdAD'});
            $this->setIdArt($json_object->{'IdArt'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setIdIC($json_object->{'IdIC'});
            $this->setNoAD($json_object->{'NoAD'});
            $this->setCodAD($json_object->{'CodAD'});
            $this->setDesiAutoAD($json_object->{'DesiAutoAD'});
            $this->setValNivAD($json_object->{'ValNivAD'});
            $this->setStkReelAD($json_object->{'StkReelAD'});
            $this->setStkResAD($json_object->{'StkResAD'});
            $this->setStkCmdeAD($json_object->{'StkCmdeAD'});
            $this->setCodGesStkAD($json_object->{'CodGesStkAD'});
            $this->setEtatStockAD($json_object->{'EtatStockAD'});
            $this->setStockDisponible($json_object->{'StockDisponible'});
            $this->setStockDisponibleSoc($json_object->{'StockDisponibleSoc'});
            $this->setStockPratique($json_object->{'StockPratique'});
            $this->setStkReelPlat1($json_object->{'StkReelPlat1'});
            $this->setQteCIDSsCFAD($json_object->{'QteCIDSsCFAD'});
            $this->setUVteArt($json_object->{'UVteArt'});
            $this->setUStoArt($json_object->{'UStoArt'});
            $this->setCvStoVteAD($json_object->{'CvStoVteAD'});
            $this->setTypCvStoVteAD($json_object->{'TypCvStoVteAD'});
            $this->setNbUStoCondVteAD($json_object->{'NbUStoCondVteAD'});
            $this->setPoidsUVteArt($json_object->{'PoidsUVteArt'});
            $this->setNbUVteUCondVte($json_object->{'NbUVteUCondVte'});
            $this->setPrixPubUCondVte($json_object->{'PrixPubUCondVte'});
            $this->setPrixNetUCondVte($json_object->{'PrixNetUCondVte'});
            $this->setNbUStoUVte($json_object->{'NbUStoUVte'});
            $this->setNbUVteUSto($json_object->{'NbUVteUSto'});

            // Champs qui n'existe pas dans les articles de ttStock
            if (isset($json_object->{'NbrDecArt'})) {
                $this->setNbrDecArt($json_object->{'NbrDecArt'});
                $this->setLongAD($json_object->{'LongAD'});
                $this->setLargAD($json_object->{'LargAD'});
                $this->setEpaisAD($json_object->{'EpaisAD'});
                $this->setCondVteAD($json_object->{'CondVteAD'});
                $this->setFlgDecondAD($json_object->{'FlgDecondAD'});
                $this->setDesi2Art($json_object->{'Desi2Art'});
                $this->setIdFour($json_object->{'IdFour'});
                $this->setNomDep($json_object->{'NomDep'});
                $this->setCodSuspAD($json_object->{'CodSuspAD'});
                $this->setMultimediaArt($json_object->{'MultimediaArt'});
                $this->setComTechAD($json_object->{'ComTechAD'});
                $this->setDocLie($json_object->{'DocLie'});
                $this->setGenCodAD($json_object->{'GenCodAD'});
                $this->setCodEcoTaxeAD($json_object->{'CodEcoTaxeAD'});
                $this->setMtEcoTaxe($json_object->{'MtEcoTaxe'});
                $this->setValEcoTaxe($json_object->{'ValEcoTaxe'});
                $this->setIdDepPlat($json_object->{'IdDepPlat'});
                $this->setIdADF($json_object->{'IdADF'});
                $this->setCodADF($json_object->{'CodADF'});
                $this->setGenCod1ADF($json_object->{'GenCod1ADF'});
                $this->setGenCod2ADF($json_object->{'GenCod2ADF'});
                $this->setCodCatAD($json_object->{'CodCatAD'});
            }

            $this->setPrixNet($json_object->{'PrixNet'});
            $this->setPrixPubCli($json_object->{'PrixPubCli'});
            $this->setPrixPubAD($json_object->{'PrixPubAD'});
            $this->setTypeTarif($json_object->{'TypeTarif'});
            $this->setPrixRevConvAD($json_object->{'PrixRevConvAD'});
            $this->setPrixRevReelAD($json_object->{'PrixRevReelAD'});
            $this->setCoefPRRAD($json_object->{'CoefPRRAD'});
            $this->setCoefPRCAD($json_object->{'CoefPRCAD'});
            $this->setMargeReelleAD($json_object->{'MargeReelleAD'});
            $this->setMargeConvAD($json_object->{'MargeConvAD'});
        }
    }

    /**
     * @return mixed
     */
    public function getIdAD()
    {
        return $this->IdAD;
    }

    /**
     * @param mixed $IdAD
     */
    public function setIdAD($IdAD)
    {
        $this->IdAD = $IdAD;
    }

    /**
     * @return mixed
     */
    public function getIdArt()
    {
        return $this->IdArt;
    }

    /**
     * @param mixed $IdArt
     */
    public function setIdArt($IdArt)
    {
        $this->IdArt = $IdArt;
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
    public function getIdIC()
    {
        return $this->IdIC;
    }

    /**
     * @param mixed $IdIC
     */
    public function setIdIC($IdIC)
    {
        $this->IdIC = $IdIC;
    }

    /**
     * @return mixed
     */
    public function getNoAD()
    {
        return $this->NoAD;
    }

    /**
     * @param mixed $NoAD
     */
    public function setNoAD($NoAD)
    {
        $this->NoAD = $NoAD;
    }

    /**
     * @return mixed
     */
    public function getCodAD()
    {
        return $this->CodAD;
    }

    /**
     * @param mixed $CodAD
     */
    public function setCodAD($CodAD)
    {
        $this->CodAD = $CodAD;
    }

    /**
     * @return mixed
     */
    public function getDesiAutoAD()
    {
        return $this->DesiAutoAD;
    }

    /**
     * @param mixed $DesiAutoAD
     */
    public function setDesiAutoAD($DesiAutoAD)
    {
        $this->DesiAutoAD = $DesiAutoAD;
    }

    /**
     * @return mixed
     */
    public function getValNivAD()
    {
        return $this->ValNivAD;
    }

    /**
     * @param mixed $ValNivAD
     */
    public function setValNivAD($ValNivAD)
    {
        $this->ValNivAD = $ValNivAD;
    }

    /**
     * @return mixed
     */
    public function getStkReelAD()
    {
        return $this->StkReelAD;
    }

    /**
     * @param mixed $StkReelAD
     */
    public function setStkReelAD($StkReelAD)
    {
        $this->StkReelAD = $StkReelAD;
    }

    /**
     * @return mixed
     */
    public function getStkResAD()
    {
        return $this->StkResAD;
    }

    /**
     * @param mixed $StkResAD
     */
    public function setStkResAD($StkResAD)
    {
        $this->StkResAD = $StkResAD;
    }

    /**
     * @return mixed
     */
    public function getStkCmdeAD()
    {
        return $this->StkCmdeAD;
    }

    /**
     * @param mixed $StkCmdeAD
     */
    public function setStkCmdeAD($StkCmdeAD)
    {
        $this->StkCmdeAD = $StkCmdeAD;
    }

    /**
     * @return mixed
     */
    public function getCodGesStkAD()
    {
        return $this->CodGesStkAD;
    }

    /**
     * @param mixed $CodGesStkAD
     */
    public function setCodGesStkAD($CodGesStkAD)
    {
        $this->CodGesStkAD = $CodGesStkAD;
    }

    /**
     * @return mixed
     */
    public function getEtatStockAD()
    {
        return $this->EtatStockAD;
    }

    /**
     * @param mixed $EtatStockAD
     */
    public function setEtatStockAD($EtatStockAD)
    {
        $this->EtatStockAD = $EtatStockAD;
    }

    /**
     * @return mixed
     */
    public function getStockDisponible()
    {
        return $this->StockDisponible;
    }

    /**
     * @param mixed $StockDisponible
     */
    public function setStockDisponible($StockDisponible)
    {
        $this->StockDisponible = $StockDisponible;
    }

    /**
     * @return mixed
     */
    public function getStockDisponibleSoc()
    {
        return $this->StockDisponibleSoc;
    }

    /**
     * @param mixed $StockDisponibleSoc
     */
    public function setStockDisponibleSoc($StockDisponibleSoc)
    {
        $this->StockDisponibleSoc = $StockDisponibleSoc;
    }

    /**
     * @return mixed
     */
    public function getStockPratique()
    {
        return $this->StockPratique;
    }

    /**
     * @param mixed $StockPratique
     */
    public function setStockPratique($StockPratique)
    {
        $this->StockPratique = $StockPratique;
    }

    /**
     * @return mixed
     */
    public function getStkReelPlat1()
    {
        return $this->StkReelPlat1;
    }

    /**
     * @param mixed $StkReelPlat1
     */
    public function setStkReelPlat1($StkReelPlat1)
    {
        $this->StkReelPlat1 = $StkReelPlat1;
    }

    /**
     * @return mixed
     */
    public function getQteCIDSsCFAD()
    {
        return $this->QteCIDSsCFAD;
    }

    /**
     * @param mixed $QteCIDSsCFAD
     */
    public function setQteCIDSsCFAD($QteCIDSsCFAD)
    {
        $this->QteCIDSsCFAD = $QteCIDSsCFAD;
    }

    /**
     * @return mixed
     */
    public function getUVteArt()
    {
        return $this->UVteArt;
    }

    /**
     * @param mixed $UVteArt
     */
    public function setUVteArt($UVteArt)
    {
        $this->UVteArt = $UVteArt;
    }

    /**
     * @return mixed
     */
    public function getUStoArt()
    {
        return $this->UStoArt;
    }

    /**
     * @param mixed $UStoArt
     */
    public function setUStoArt($UStoArt)
    {
        $this->UStoArt = $UStoArt;
    }

    /**
     * @return mixed
     */
    public function getCvStoVteAD()
    {
        return $this->CvStoVteAD;
    }

    /**
     * @param mixed $CvStoVteAD
     */
    public function setCvStoVteAD($CvStoVteAD)
    {
        $this->CvStoVteAD = $CvStoVteAD;
    }

    /**
     * @return mixed
     */
    public function getTypCvStoVteAD()
    {
        return $this->TypCvStoVteAD;
    }

    /**
     * @param mixed $TypCvStoVteAD
     */
    public function setTypCvStoVteAD($TypCvStoVteAD)
    {
        $this->TypCvStoVteAD = $TypCvStoVteAD;
    }

    /**
     * @return mixed
     */
    public function getNbUStoCondVteAD()
    {
        return $this->NbUStoCondVteAD;
    }

    /**
     * @param mixed $NbUStoCondVteAD
     */
    public function setNbUStoCondVteAD($NbUStoCondVteAD)
    {
        $this->NbUStoCondVteAD = $NbUStoCondVteAD;
    }

    /**
     * @return mixed
     */
    public function getPoidsUVteArt()
    {
        return $this->PoidsUVteArt;
    }

    /**
     * @param mixed $PoidsUVteArt
     */
    public function setPoidsUVteArt($PoidsUVteArt)
    {
        $this->PoidsUVteArt = $PoidsUVteArt;
    }

    /**
     * @return mixed
     */
    public function getNbUVteUCondVte()
    {
        return $this->NbUVteUCondVte;
    }

    /**
     * @param mixed $NbUVteUCondVte
     */
    public function setNbUVteUCondVte($NbUVteUCondVte)
    {
        $this->NbUVteUCondVte = $NbUVteUCondVte;
    }

    /**
     * @return mixed
     */
    public function getPrixPubUCondVte()
    {
        return $this->PrixPubUCondVte;
    }

    /**
     * @param mixed $PrixPubUCondVte
     */
    public function setPrixPubUCondVte($PrixPubUCondVte)
    {
        $this->PrixPubUCondVte = $PrixPubUCondVte;
    }

    /**
     * @return mixed
     */
    public function getPrixNetUCondVte()
    {
        return $this->PrixNetUCondVte;
    }

    /**
     * @param mixed $PrixNetUCondVte
     */
    public function setPrixNetUCondVte($PrixNetUCondVte)
    {
        $this->PrixNetUCondVte = $PrixNetUCondVte;
    }

    /**
     * @return mixed
     */
    public function getNbUStoUVte()
    {
        return $this->NbUStoUVte;
    }

    /**
     * @param mixed $NbUStoUVte
     */
    public function setNbUStoUVte($NbUStoUVte)
    {
        $this->NbUStoUVte = $NbUStoUVte;
    }

    /**
     * @return mixed
     */
    public function getNbUVteUSto()
    {
        return $this->NbUVteUSto;
    }

    /**
     * @param mixed $NbUVteUSto
     */
    public function setNbUVteUSto($NbUVteUSto)
    {
        $this->NbUVteUSto = $NbUVteUSto;
    }

    /**
     * @return mixed
     */
    public function getNbrDecArt()
    {
        return $this->NbrDecArt;
    }

    /**
     * @param mixed $NbrDecArt
     */
    public function setNbrDecArt($NbrDecArt)
    {
        $this->NbrDecArt = $NbrDecArt;
    }

    /**
     * @return mixed
     */
    public function getLongAD()
    {
        return $this->LongAD;
    }

    /**
     * @param mixed $LongAD
     */
    public function setLongAD($LongAD)
    {
        $this->LongAD = $LongAD;
    }

    /**
     * @return mixed
     */
    public function getLargAD()
    {
        return $this->LargAD;
    }

    /**
     * @param mixed $LargAD
     */
    public function setLargAD($LargAD)
    {
        $this->LargAD = $LargAD;
    }

    /**
     * @return mixed
     */
    public function getEpaisAD()
    {
        return $this->EpaisAD;
    }

    /**
     * @param mixed $EpaisAD
     */
    public function setEpaisAD($EpaisAD)
    {
        $this->EpaisAD = $EpaisAD;
    }

    /**
     * @return mixed
     */
    public function getCondVteAD()
    {
        return $this->CondVteAD;
    }

    /**
     * @param mixed $CondVteAD
     */
    public function setCondVteAD($CondVteAD)
    {
        $this->CondVteAD = $CondVteAD;
    }

    /**
     * @return mixed
     */
    public function getFlgDecondAD()
    {
        return $this->FlgDecondAD;
    }

    /**
     * @param mixed $FlgDecondAD
     */
    public function setFlgDecondAD($FlgDecondAD)
    {
        $this->FlgDecondAD = $FlgDecondAD;
    }

    /**
     * @return mixed
     */
    public function getDesi2Art()
    {
        return $this->Desi2Art;
    }

    /**
     * @param mixed $Desi2Art
     */
    public function setDesi2Art($Desi2Art)
    {
        $this->Desi2Art = $Desi2Art;
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
    public function getCodSuspAD()
    {
        return $this->CodSuspAD;
    }

    /**
     * @param mixed $CodSuspAD
     */
    public function setCodSuspAD($CodSuspAD)
    {
        $this->CodSuspAD = $CodSuspAD;
    }

    /**
     * @return mixed
     */
    public function getMultimediaArt()
    {
        return $this->MultimediaArt;
    }

    /**
     * @param mixed $MultimediaArt
     */
    public function setMultimediaArt($MultimediaArt)
    {
        $this->MultimediaArt = $MultimediaArt;
    }

    /**
     * @return mixed
     */
    public function getComTechAD()
    {
        return $this->ComTechAD;
    }

    /**
     * @param mixed $ComTechAD
     */
    public function setComTechAD($ComTechAD)
    {
        $this->ComTechAD = $ComTechAD;
    }

    /**
     * @return mixed
     */
    public function getDocLie()
    {
        return $this->DocLie;
    }

    /**
     * @param mixed $DocLie
     */
    public function setDocLie($DocLie)
    {
        $this->DocLie = $DocLie;
    }

    /**
     * @return mixed
     */
    public function getGenCodAD()
    {
        return $this->GenCodAD;
    }

    /**
     * @param mixed $GenCodAD
     */
    public function setGenCodAD($GenCodAD)
    {
        $this->GenCodAD = $GenCodAD;
    }

    /**
     * @return mixed
     */
    public function getCodEcoTaxeAD()
    {
        return $this->CodEcoTaxeAD;
    }

    /**
     * @param mixed $CodEcoTaxeAD
     */
    public function setCodEcoTaxeAD($CodEcoTaxeAD)
    {
        $this->CodEcoTaxeAD = $CodEcoTaxeAD;
    }

    /**
     * @return mixed
     */
    public function getMtEcoTaxe()
    {
        return $this->MtEcoTaxe;
    }

    /**
     * @param mixed $MtEcoTaxe
     */
    public function setMtEcoTaxe($MtEcoTaxe)
    {
        $this->MtEcoTaxe = $MtEcoTaxe;
    }

    /**
     * @return mixed
     */
    public function getValEcoTaxe()
    {
        return $this->ValEcoTaxe;
    }

    /**
     * @param mixed $ValEcoTaxe
     */
    public function setValEcoTaxe($ValEcoTaxe)
    {
        $this->ValEcoTaxe = $ValEcoTaxe;
    }

    /**
     * @return mixed
     */
    public function getIdDepPlat()
    {
        return $this->IdDepPlat;
    }

    /**
     * @param mixed $IdDepPlat
     */
    public function setIdDepPlat($IdDepPlat)
    {
        $this->IdDepPlat = $IdDepPlat;
    }

    /**
     * @return mixed
     */
    public function getIdADF()
    {
        return $this->IdADF;
    }

    /**
     * @param mixed $IdADF
     */
    public function setIdADF($IdADF)
    {
        $this->IdADF = $IdADF;
    }

    /**
     * @return mixed
     */
    public function getCodADF()
    {
        return $this->CodADF;
    }

    /**
     * @param mixed $CodADF
     */
    public function setCodADF($CodADF)
    {
        $this->CodADF = $CodADF;
    }

    /**
     * @return mixed
     */
    public function getGenCod1ADF()
    {
        return $this->GenCod1ADF;
    }

    /**
     * @param mixed $GenCod1ADF
     */
    public function setGenCod1ADF($GenCod1ADF)
    {
        $this->GenCod1ADF = $GenCod1ADF;
    }

    /**
     * @return mixed
     */
    public function getGenCod2ADF()
    {
        return $this->GenCod2ADF;
    }

    /**
     * @param mixed $GenCod2ADF
     */
    public function setGenCod2ADF($GenCod2ADF)
    {
        $this->GenCod2ADF = $GenCod2ADF;
    }

    /**
     * @return mixed
     */
    public function getCodCatAD()
    {
        return $this->CodCatAD;
    }

    /**
     * @param mixed $CodCatAD
     */
    public function setCodCatAD($CodCatAD)
    {
        $this->CodCatAD = $CodCatAD;
    }

    /**
     * @return mixed
     */
    public function getPrixNet()
    {
        return $this->PrixNet;
    }

    /**
     * @param mixed $PrixNet
     */
    public function setPrixNet($PrixNet)
    {
        $this->PrixNet = $PrixNet;
    }

    /**
     * @return mixed
     */
    public function getPrixPubCli()
    {
        return $this->PrixPubCli;
    }

    /**
     * @param mixed $PrixPubCli
     */
    public function setPrixPubCli($PrixPubCli)
    {
        $this->PrixPubCli = $PrixPubCli;
    }

    /**
     * @return mixed
     */
    public function getPrixPubAD()
    {
        return $this->PrixPubAD;
    }

    /**
     * @param mixed $PrixPubAD
     */
    public function setPrixPubAD($PrixPubAD)
    {
        $this->PrixPubAD = $PrixPubAD;
    }

    /**
     * @return mixed
     */
    public function getTypeTarif()
    {
        return $this->TypeTarif;
    }

    /**
     * @param mixed $TypeTarif
     */
    public function setTypeTarif($TypeTarif)
    {
        $this->TypeTarif = $TypeTarif;
    }

    /**
     * @return mixed
     */
    public function getPrixRevConvAD()
    {
        return $this->PrixRevConvAD;
    }

    /**
     * @param mixed $PrixRevConvAD
     */
    public function setPrixRevConvAD($PrixRevConvAD)
    {
        $this->PrixRevConvAD = $PrixRevConvAD;
    }

    /**
     * @return mixed
     */
    public function getPrixRevReelAD()
    {
        return $this->PrixRevReelAD;
    }

    /**
     * @param mixed $PrixRevReelAD
     */
    public function setPrixRevReelAD($PrixRevReelAD)
    {
        $this->PrixRevReelAD = $PrixRevReelAD;
    }

    /**
     * @return mixed
     */
    public function getCoefPRRAD()
    {
        return $this->CoefPRRAD;
    }

    /**
     * @param mixed $CoefPRRAD
     */
    public function setCoefPRRAD($CoefPRRAD)
    {
        $this->CoefPRRAD = $CoefPRRAD;
    }

    /**
     * @return mixed
     */
    public function getCoefPRCAD()
    {
        return $this->CoefPRCAD;
    }

    /**
     * @param mixed $CoefPRCAD
     */
    public function setCoefPRCAD($CoefPRCAD)
    {
        $this->CoefPRCAD = $CoefPRCAD;
    }

    /**
     * @return mixed
     */
    public function getMargeReelleAD()
    {
        return $this->MargeReelleAD;
    }

    /**
     * @param mixed $MargeReelleAD
     */
    public function setMargeReelleAD($MargeReelleAD)
    {
        $this->MargeReelleAD = $MargeReelleAD;
    }

    /**
     * @return mixed
     */
    public function getMargeConvAD()
    {
        return $this->MargeConvAD;
    }

    /**
     * @param mixed $MargeConvAD
     */
    public function setMargeConvAD($MargeConvAD)
    {
        $this->MargeConvAD = $MargeConvAD;
    }

    /**
     * @return mixed
     */
    public function getStocks()
    {
        return $this->Stocks;
    }

    /**
     * @param mixed $Stocks
     */
    public function setStocks($Stocks)
    {
        $this->Stocks = $Stocks;
    }
    
    
}