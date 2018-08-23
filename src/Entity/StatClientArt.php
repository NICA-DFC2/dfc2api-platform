<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Utils\Extensions\Stat;

/**
 * Entité qui représente les statistisque d'un client. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_stats_client_article_items_get"}
 *      },
 *     itemOperations={}
 * )
 *
 */
class StatClientArt extends Stat
{
    private $IdArt= 0;
    private $Article;

    public function parseObject($json_object = null)
    {
        parent::parseObject($json_object);

        if(!is_null($json_object)) {
            $this->setIdArt($json_object->{'IdArt'});
        }
    }

    /**
     * @return int
     */
    public function getIdArt(): int
    {
        return $this->IdArt;
    }

    /**
     * @param int $IdArt
     */
    public function setIdArt(int $IdArt): void
    {
        $this->IdArt = $IdArt;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->Article;
    }

    /**
     * @param mixed $Article
     */
    public function setArticle($Article): void
    {
        $this->Article = $Article;
    }


}