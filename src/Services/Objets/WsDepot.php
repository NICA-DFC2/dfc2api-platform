<?php

namespace App\Services\Objets;


class WsDepot
{
    public $IdDep = 0;
    public $NomDep = "";
    public $CodDep = "";
    public $FlgPlateformeDep = false;
    public $FlgActifDep = true;

    public function __toString()
    {
        $string = '{';
        $string .= '"IdDep": '. $this->getIdDep() .', ';
        $string .= '"NomDep": "'. $this->getNomDep() .'", ';
        $string .= '"CodDep": "'. $this->getCodDep() .'", ';

        $val = ($this->isFlgPlateformeDep()) ? 'true' : 'false';
        $string .= '"FlgPlateformeDep": '. $val .', ';

        $val = ($this->isFlgActifDep()) ? 'true' : 'false';
        $string .= '"FlgActifDep": '. $val .' ';

        $string .= '}';

        return $string;
    }

    public function __construct($json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdDep($json_object->{'IdDep'});
            $this->setNomDep($json_object->{'NomDep'});
            $this->setCodDep($json_object->{'CodDep'});
            $this->setFlgPlateformeDep($json_object->{'FlgPlateformeDep'});
            $this->setFlgActifDep($json_object->{'FlgActifDep'});
        }
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
     * @return string
     */
    public function getCodDep()
    {
        return $this->CodDep;
    }

    /**
     * @param string $CodDep
     */
    public function setCodDep($CodDep)
    {
        $this->CodDep = $CodDep;
    }

    /**
     * @return bool
     */
    public function isFlgPlateformeDep()
    {
        return $this->FlgPlateformeDep;
    }

    /**
     * @param bool $FlgPlateformeDep
     */
    public function setFlgPlateformeDep($FlgPlateformeDep)
    {
        $this->FlgPlateformeDep = $FlgPlateformeDep;
    }

    /**
     * @return bool
     */
    public function isFlgActifDep()
    {
        return $this->FlgActifDep;
    }

    /**
     * @param bool $FlgActifDep
     */
    public function setFlgActifDep($FlgActifDep)
    {
        $this->FlgActifDep = $FlgActifDep;
    }

}