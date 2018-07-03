<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Entité qui représente les libellés d'une famille. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_libelles_item_get"}
 *      }
 * )
 *
 */
class Libelle
{
    private $FamLIB = "";
    private $CodLIB = "";
    private $CodGimLib = "";
    private $LibLIB = "";
    private $RgpLib = "";

    /**
     * parseObject
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject($json_object=null) {

        if(!is_null($json_object)) {
            $this->setFamLIB($json_object->{'FamLIB'});
            $this->setCodLIB($json_object->{'CodLIB'});
            $this->setCodGimLib($json_object->{'CodGimLib'});
            $this->setLibLIB($json_object->{'LibLIB'});
            $this->setRgpLib($json_object->{'RgpLib'});
        }
    }

    /**
     * @return string
     */
    public function getFamLIB()
    {
        return $this->FamLIB;
    }

    /**
     * @param string $FamLIB
     */
    public function setFamLIB($FamLIB)
    {
        $this->FamLIB = $FamLIB;
    }

    /**
     * @return string
     */
    public function getCodLIB()
    {
        return $this->CodLIB;
    }

    /**
     * @param string $CodLIB
     */
    public function setCodLIB($CodLIB)
    {
        $this->CodLIB = $CodLIB;
    }

    /**
     * @return string
     */
    public function getCodGimLib()
    {
        return $this->CodGimLib;
    }

    /**
     * @param string $CodGimLib
     */
    public function setCodGimLib($CodGimLib)
    {
        $this->CodGimLib = $CodGimLib;
    }

    /**
     * @return string
     */
    public function getLibLIB()
    {
        return $this->LibLIB;
    }

    /**
     * @param string $LibLIB
     */
    public function setLibLIB($LibLIB)
    {
        $this->LibLIB = $LibLIB;
    }

    /**
     * @return string
     */
    public function getRgpLib()
    {
        return $this->RgpLib;
    }

    /**
     * @param string $RgpLib
     */
    public function setRgpLib($RgpLib)
    {
        $this->RgpLib = $RgpLib;
    }

}