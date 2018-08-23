<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Utils\Extensions\Stat;

/**
 * Entité qui représente les statistisque d'un client. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "statscli"={"route_name"="api_stats_client_items_get"},
 *          "statsrepcli"={"route_name"="api_stats_client_rep_items_get"}
 *      },
 *     itemOperations={}
 * )
 *
 */
class StatClient extends Stat
{
    public function parseObject($json_object = null)
    {
        parent::parseObject($json_object);
    }
}