<?php

namespace App\Services\Objets;

class CritParam
{
    private $NomPar;
    private $ValPar;
    private $IndPar;
    private $FamPar;

    public function __construct($nomPar, $valPar, $indPar = 1, $famPar = '')
    {
        $this->setNomPar($nomPar);
        $this->setValPar($valPar);
        $this->setIndPar((int)$indPar);
        $this->setFamPar($famPar);
    }

    /**
     * Return a Json object
     * @return string
     */
    public function __toString()
    {
        $string = '{';
        $string .= '"NomPar":"'.$this->getNomPar().'" ,';
        $string .= '"ValPar":"'.(is_array($this->getValPar())) ? json_encode($this->getValPar()) : $this->getValPar().'" ,';
        $string .= '"IndPar":'. $this->getIndPar().' ,';
        $string .= '"FamPar":"'.$this->getFamPar().'" ';
        $string .= '}';

        return $string;

    }


    /**
     * @return mixed
     */
    public function getFamPar()
    {
        return $this->FamPar;
    }

    /**
     * @param mixed $FamPar
     * @return CritParam
     */
    public function setFamPar($FamPar)
    {
        $this->FamPar = $FamPar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomPar()
    {
        return $this->NomPar;
    }

    /**
     * @param mixed $NomPar
     * @return CritParam
     */
    public function setNomPar($NomPar)
    {
        $this->NomPar = $NomPar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIndPar()
    {
        return $this->IndPar;
    }

    /**
     * @param mixed $IndPar
     * @return CritParam
     */
    public function setIndPar($IndPar)
    {
        $this->IndPar = $IndPar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValPar()
    {
        return $this->ValPar;
    }

    /**
     * @param mixed $ValPar
     * @return CritParam
     */
    public function setValPar($ValPar)
    {
        $this->ValPar = $ValPar;
        return $this;
    }



}
