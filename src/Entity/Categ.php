<?php

namespace App\Entity;

use App\Services\Objets\WsCateg;
use Doctrine\Common\Collections\ArrayCollection;

class Categ
{
    private $IdCat;
    private $NomCat;
    private $CodCat;
    private $PoidsCat;

    /**
     * InstCat constructor.
     */
    public function __construct()
    {

    }


    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsCateg $json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdCat($json_object->{'IdCat'});
            $this->setNomCat($json_object->{'NomCat'});
            $this->setCodCat($json_object->{'CodCat'});
            $this->setPoidsCat($json_object->{'PoidsCat'});
        }
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
     * @return integer
     */
    public function getPoidsCat()
    {
        return $this->PoidsCat;
    }

    /**
     * @param integer $PoidsCat
     */
    public function setPoidsCat($PoidsCat)
    {
        $this->PoidsCat = $PoidsCat;
    }
}