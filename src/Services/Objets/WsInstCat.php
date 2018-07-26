<?php

namespace App\Services\Objets;


class WsInstCat
{
    public $IdBranche;
    public $IdIC;
    public $CodIC;
    public $IdCat;
    public $IdICP;
    public $NomIC;
    public $TriNoOrdreIC;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdBranche($json_object->{'IdBranche'});
            $this->setIdIC($json_object->{'IdIC'});
            $this->setCodIC($json_object->{'CodIC'});
            $this->setIdCat($json_object->{'IdCat'});
            $this->setIdICP((is_null($json_object->{'IdICP'})) ? -1 : $json_object->{'IdICP'});
            $this->setNomIC($json_object->{'NomIC'});
            $this->setTriNoOrdreIC($json_object->{'TriNoOrdreIC'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdBranche": '.$this->getIdBranche().' ,';
        $string .= '"IdIC": '.$this->getIdIC().' ,';
        $string .= '"CodIC": "'.$this->getCodIC().'" ,';
        $string .= '"IdCat": '.$this->getIdCat().' ,';
        $string .= '"IdICP": '.$this->getIdICP().' ,';
        $string .= '"NomIC": "'.$this->getNomIC().'" ,';
        $string .= '"TriNoOrdreIC": "'.$this->getTriNoOrdreIC().'" ';
        $string .= '}';

        return $string;
    }

    /**
     * @return integer
     */
    public function getIdBranche()
    {
        return $this->IdBranche;
    }

    /**
     * @param integer $IdBranche
     */
    public function setIdBranche($IdBranche)
    {
        $this->IdBranche = $IdBranche;
    }

    /**
     * @return integer
     */
    public function getIdIC()
    {
        return $this->IdIC;
    }

    /**
     * @param integer $IdIC
     */
    public function setIdIC($IdIC)
    {
        $this->IdIC = $IdIC;
    }

    /**
     * @return string
     */
    public function getCodIC()
    {
        return $this->CodIC;
    }

    /**
     * @param string $CodIC
     */
    public function setCodIC($CodIC)
    {
        $this->CodIC = $CodIC;
    }

    /**
     * @return integer
     */
    public function getIdCat()
    {
        return $this->IdCat;
    }

    /**
     * @param integer $IdCat
     */
    public function setIdCat($IdCat)
    {
        $this->IdCat = $IdCat;
    }

    /**
     * @return integer
     */
    public function getIdICP()
    {
        return $this->IdICP;
    }

    /**
     * @param integer $IdICP
     */
    public function setIdICP($IdICP)
    {
        $this->IdICP = $IdICP;
    }

    /**
     * @return string
     */
    public function getNomIC()
    {
        return $this->NomIC;
    }

    /**
     * @param string $NomIC
     */
    public function setNomIC($NomIC)
    {
        $this->NomIC = $NomIC;
    }

    /**
     * @return string
     */
    public function getTriNoOrdreIC()
    {
        return $this->TriNoOrdreIC;
    }

    /**
     * @param string $TriNoOrdreIC
     */
    public function setTriNoOrdreIC($TriNoOrdreIC)
    {
        $this->TriNoOrdreIC = $TriNoOrdreIC;
    }


}