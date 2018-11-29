<?php

namespace App\Elasticsearch;

use Elastica\Client;
use Symfony\Component\Yaml\Yaml;

class IndexBuilder
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create()
    {
        // We name our index "articles"
        $index = $this->client->getIndex('articles');

        $settings = Yaml::parse(
            file_get_contents(
                __DIR__ . '/../../config/elasticsearch_articles.yaml'
            )
        );

        // We build our index settings and mapping
        $index->create($settings, true);

        return $index;
    }
}