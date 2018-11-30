<?php

namespace App\Services\Objets;


class WsStock
{
    public $IdDep = 0;
    public $StkReelAD = 0.0;
    public $StkResAD = 0.0;
    public $StkCmdeAD = 0.0;
    public $CodGesStkAD = "";
    public $EtatStockAD = "";
    public $StockDisponible = 0.0;
    public $StockDisponibleSoc = 0.0;
    public $StockPratique = 0.0;
    public $StkReelPlat1 = 0.0;

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

    public function __toString()
    {
        $string = '{';
        $string .= '"IdDep": '. $this->getIdDep() .', ';
        $string .= '"StkReelAD": '. $this->getStkReelAD() .', ';
        $string .= '"StkResAD": '. $this->getStkResAD() .', ';
        $string .= '"StkCmdeAD": '. $this->getStkCmdeAD() .', ';
        $string .= '"CodGesStkAD": "'. $this->getCodGesStkAD() .'", ';
        $string .= '"EtatStockAD": "'. $this->getEtatStockAD() .'", ';
        $string .= '"StockDisponible": '. $this->getStockDisponible() .', ';
        $string .= '"StockDisponibleSoc": '. $this->getStockDisponibleSoc() .', ';
        //$string .= '"StockPratique": '. $this->getStockPratique() .', ';
        $string .= '"StkReelPlat1": '. $this->getStkReelPlat1() .' ';
        $string .= '}';

        return $string;
    }

    public function _construct($json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdDep($json_object->{'IdDep'});
            $this->setStkReelAD($json_object->{'StkReelAD'});
            $this->setStkResAD($json_object->{'StkResAD'});
            $this->setStkCmdeAD($json_object->{'StkCmdeAD'});
            $this->setCodGesStkAD($json_object->{'CodGesStkAD'});
            $this->setEtatStockAD($json_object->{'EtatStockAD'});
            $this->setStockDisponible($json_object->{'StockDisponible'});
            $this->setStockDisponibleSoc($json_object->{'StockDisponibleSoc'});
            //$this->setStockPratique($json_object->{'StockPratique'});
            $this->setStkReelPlat1($json_object->{'StkReelPlat1'});
        }
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

}