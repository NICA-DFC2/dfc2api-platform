<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Entité qui représente les edition des documents. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_depots_items_get"}
 *      },
 *     itemOperations={
 *          "one"={"route_name"="api_depots_item_get"}
 *     }
 * )
 *
 */
class Depot
{
    private $IdDep = 0;
    private $NomDep = "";
    private $CodDep = "";
    private $FlgPlateformeDep = false;
    private $FlgActifDep = true;

    /**
     * parseObject
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject($json_object=null) {

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