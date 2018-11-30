<?php

namespace App\Elasticsearch;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Services\Objets\WsArticle;
use App\Services\Parameters\WsParameters;
use Elastica\Client;
use Elastica\Document;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Unirest\Request;
use Unirest\Response;

class ArticleIndexer
{
    private $client;
    private $articleRepository;
    private $router;

    public function __construct(Client $client, ArticleRepository $articleRepository, UrlGeneratorInterface $router)
    {
        $this->client = $client;
        $this->articleRepository = $articleRepository;
        $this->router = $router;
    }

    public function buildDocument(Article $article)
    {
        return new Document(
            $article->getIdAD(), // Manually defined ID
            [
                'NoAD' => $article->getNoAD(),
                'DesiAD' => $article->getDesiAD(),
                'DesiPrincAD' => $article->getDesiPrincAD(),
                'CodAD' => $article->getCodAD(),
                'DescriCatalogAD' => $article->getDescriCatalogAD(),
                'DescriWebAD' => $article->getDescriWebAD(),
                'PlusAD' => $article->getPlusAD(),
                'slug' => $article->getSlug(),

                // Non indexé
                'IdArtEvoAD' => $article->getIdArtEvoAD(),
                'MediasAD' => $article->getMediasAD(),
                'OrdreAD' => $article->getOrdreAD(),
                'NumDecliAD' => $article->getNumDecliAD(),
                'FlgAncAD' => $article->getFlgAncAD(),
                'FlgCatalogAD' => $article->getFlgCatalogAD(),
                'FlgPrincAD' => $article->getFlgPrincAD(),
                'FlgDestockAD' => $article->getFlgDestockAD(),
                'FlgHorsMarqueAD' => $article->getFlgHorsMarqueAD(),
                'FlgNouvAD' => $article->getFlgNouvAD(),
                'FlgPromoAD' => $article->getFlgPromoAD(),
                'FlgVisibleAD' => $article->getFlgVisibleAD(),
                'FlgEclBleuAD' => $article->getFlgEclBleuAD(),
                'FlgEclRoseAD' => $article->getFlgEclRoseAD(),
                'FlgEclVertAD' => $article->getFlgEclVertAD(),
                'FlgEclOrangeAD' => $article->getFlgEclOrangeAD(),
                'IdFourAD' => $article->getIdFourAD(),
                'DateCreAD' => $article->getDateCreAD(),
                'DateModAD' => $article->getDateModAD(),
                'UCreAD' => $article->getUCreAD(),
                'UModAD' => $article->getUModAD(),
            ],
            "article" // Types are deprecated, to be removed in Elastic 7
        );
    }

    public function indexAllDocuments($indexName)
    {
        $allArticles = $this->articleRepository->findAll();
        $index = $this->client->getIndex($indexName);

        $documents = [];
        foreach ($allArticles as $article) {
            $documents[] = $this->buildDocument($article);
        }

        $index->addDocuments($documents);
        $index->refresh();
    }
}