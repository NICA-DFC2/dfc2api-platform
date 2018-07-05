<?php

namespace App\Utils;


class StockDepot
{
    private $IdDep = 0;
    private $NomDep = "";
    private $StkReelAD = 0.0;
    private $StkResAD = 0.0;
    private $StkCmdeAD = 0.0;
    private $CodGesStkAD = "";
    private $StockDisponible = 0.0;
    private $StockDisponibleSoc = 0.0;
    private $StockPratique = 0.0;
    private $StkReelPlat1 = 0.0;

    /**
     * StockDepot constructor.
     */
    public function __construct()
    {
    }

    public function parseObject($json_object=null, $nomDep) {
        if(!is_null($json_object)) {
            $this->setIdDep($json_object->{'IdDep'});
            $this->setNomDep($nomDep);
            $this->setStkReelAD($json_object->{'StkReelAD'});
            $this->setStkResAD($json_object->{'StkResAD'});
            $this->setStkCmdeAD($json_object->{'StkCmdeAD'});
            $this->setCodGesStkAD($json_object->{'CodGesStkAD'});
            $this->setStockDisponible($json_object->{'StockDisponible'});
            $this->setStockDisponibleSoc($json_object->{'StockDisponibleSoc'});
            $this->setStockPratique($json_object->{'StockPratique'});
            $this->setStkReelPlat1($json_object->{'StkReelPlat1'});
        }
    }

    public function parseString()
    {
        return [
            'IdDep' => $this->getIdDep(),
            'NomDep' => $this->getNomDep(),
            'StkReelAD' => $this->getStkReelAD(),
            'StkResAD' => $this->getStkResAD(),
            'StkCmdeAD' => $this->getStkCmdeAD(),
            'CodGesStkAD' => $this->getCodGesStkAD(),
            'StockDisponible' => $this->getStockDisponible(),
            'StockDisponibleSoc' => $this->getStockDisponibleSoc(),
            'StockPratique' => $this->getStockPratique(),
            'StkReelPlat1' => $this->getStkReelPlat1()
        ];
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
    public function getNomDep()
    {
        return $this->NomDep;
    }

    /**
     * @param string $NomDep
     */
    public function setNomDep($NomDep)
    {
        $this->NomDep = $NomDep;
    }


    /**
     * @return float
     */
    public function getStkReelAD()
    {
        return $this->StkReelAD;
    }

    /**
     * @param float $StkReelAD
     */
    public function setStkReelAD($StkReelAD)
    {
        $this->StkReelAD = $StkReelAD;
    }

    /**
     * @return float
     */
    public function getStkResAD()
    {
        return $this->StkResAD;
    }

    /**
     * @param float $StkResAD
     */
    public function setStkResAD($StkResAD)
    {
        $this->StkResAD = $StkResAD;
    }

    /**
     * @return float
     */
    public function getStkCmdeAD()
    {
        return $this->StkCmdeAD;
    }

    /**
     * @param float $StkCmdeAD
     */
    public function setStkCmdeAD($StkCmdeAD)
    {
        $this->StkCmdeAD = $StkCmdeAD;
    }

    /**
     * @return string
     */
    public function getCodGesStkAD()
    {
        return $this->CodGesStkAD;
    }

    /**
     * @param string $CodGesStkAD
     */
    public function setCodGesStkAD($CodGesStkAD)
    {
        $this->CodGesStkAD = $CodGesStkAD;
    }

    /**
     * @return float
     */
    public function getStockDisponible()
    {
        return $this->StockDisponible;
    }

    /**
     * @param float $StockDisponible
     */
    public function setStockDisponible($StockDisponible)
    {
        $this->StockDisponible = $StockDisponible;
    }

    /**
     * @return float
     */
    public function getStockDisponibleSoc()
    {
        return $this->StockDisponibleSoc;
    }

    /**
     * @param float $StockDisponibleSoc
     */
    public function setStockDisponibleSoc($StockDisponibleSoc)
    {
        $this->StockDisponibleSoc = $StockDisponibleSoc;
    }

    /**
     * @return float
     */
    public function getStockPratique()
    {
        return $this->StockPratique;
    }

    /**
     * @param float $StockPratique
     */
    public function setStockPratique($StockPratique)
    {
        $this->StockPratique = $StockPratique;
    }

    /**
     * @return float
     */
    public function getStkReelPlat1()
    {
        return $this->StkReelPlat1;
    }

    /**
     * @param float $StkReelPlat1
     */
    public function setStkReelPlat1($StkReelPlat1)
    {
        $this->StkReelPlat1 = $StkReelPlat1;
    }


}