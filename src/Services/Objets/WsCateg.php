<?php

namespace App\Services\Objets;


class WsCateg
{
    public $IdCat = 0;
    public $NomCat = "";
    public $CodCat = "";
    public $PoidsCat = 0;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdCat($json_object->{'IdCat'});
            $this->setNomCat($json_object->{'NomCat'});
            $this->setCodCat($json_object->{'CodCat'});
            $this->setPoidsCat($json_object->{'PoidsCat'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdCat": '.$this->getIdCat().' ,';
        $string .= '"NomCat": "'.$this->getNomCat().'" ,';
        $string .= '"CodCat": "'.$this->getCodCat().'" ,';
        $string .= '"PoidsCat": '.$this->getPoidsCat().' ';
        $string .= '}';

        return $string;
    }

    /**
     * @return int
     */
    public function getIdCat()
    {
        return $this->IdCat;
    }

    /**
     * @param int $IdCat
     */
    public function setIdCat($IdCat)
    {
        $this->IdCat = $IdCat;
    }

    /**
     * @return string
     */
    public function getNomCat()
    {
        return $this->NomCat;
    }

    /**
     * @param string $NomCat
     */
    public function setNomCat($NomCat)
    {
        $this->NomCat = $NomCat;
    }

    /**
     * @return string
     */
    public function getCodCat()
    {
        return $this->CodCat;
    }

    /**
     * @param string $CodCat
     */
    public function setCodCat($CodCat)
    {
        $this->CodCat = $CodCat;
    }

    /**
     * @return int
     */
    public function getPoidsCat()
    {
        return $this->PoidsCat;
    }

    /**
     * @param int $PoidsCat
     */
    public function setPoidsCat($PoidsCat)
    {
        $this->PoidsCat = $PoidsCat;
    }


}