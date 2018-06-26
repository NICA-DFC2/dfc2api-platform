<?php

namespace App\Utils;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Utils\Extensions\Document;
use App\Utils\Extensions\DocumentLigne;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entité qui représente une entête de panier. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_devis_items_get"},
 *          "allInLimit"={"route_name"="api_devis_limit_items_get"}
 *      }
 * )
 *
 */
class Devis extends Document
{
    private $lignes = null;

    /**
     * Devis constructor.
     */
    public function __construct()
    {
        $this->lignes = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|null
     */
    public function getLignes()
    {
        return $this->lignes;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getLigne($i)
    {
        return $this->lignes->get($i);
    }

    /**
     * @param DocumentLigne|null $ligne
     */
    public function setLignes(DocumentLigne $ligne)
    {
        $this->lignes->add($ligne);
    }
}