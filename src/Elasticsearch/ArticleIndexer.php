<?php

namespace App\Elasticsearch;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Elastica\Client;
use Elastica\Document;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
                'PlusAD' => $article->getPlusAD(),
                'DescriCatalogAD' => $article->getDescriCatalogAD(),
                'DescriWebAD' => $article->getDescriWebAD(),
                'slug' => $article->getSlug(),
                'DesiAD' => $article->getDesiAD(),
                'DesiPrincAD' => $article->getDesiPrincAD(),

                // Non indexé
//                'IdArtEvoAD' => $article->getIdArtEvoAD() ,
//                'MediasAD' => $article->getMediasAD() ,
//                'OrdreAD' => $article->getOrdreAD() ,
//                'NumDecliAD' => $article->getNumDecliAD() ,
//                'FlgAncAD' => $article->getFlgAncAD() ,
//                'FlgCatalogAD' => $article->getFlgCatalogAD() ,
//                'FlgPrincAD' => $article->getFlgPrincAD() ,
//                'FlgDestockAD' => $article->getFlgDestockAD() ,
//                'FlgHorsMarqueAD' => $article->getFlgHorsMarqueAD() ,
//                'FlgNouvAD' => $article->getFlgNouvAD() ,
//                'FlgPromoAD' => $article->getFlgPromoAD() ,
//                'FlgVisibleAD' => $article->getFlgVisibleAD() ,
//                'FlgEclBleuAD' => $article->getFlgEclBleuAD() ,
//                'FlgEclRoseAD' => $article->getFlgEclRoseAD() ,
//                'FlgEclVertAD' => $article->getFlgEclVertAD() ,
//                'FlgEclOrangeAD' => $article->getFlgEclOrangeAD() ,
//                'IdFourAD' => $article->getIdFourAD() ,
//                'DateCreAD' => $article->getDateCreAD() ,
//                'DateModAD' => $article->getDateModAD() ,
//                'UCreAD' => $article->getUCreAD() ,
//                'UModAD' => $article->getUModAD() ,
//
//                // ---
//                // hydraté par les web services - Non indexé
//                // ---
//                'IdArt' => $article->getIdArtEvoAD() ,
//                'IdSoc' => $article->getIdSocWS() ,
//                'IdDep' => $article->getIdDepWS() ,
//                'IdIC' => $article->getIdICWS() ,
//                'NoAD' => $article->getNoADWS() ,
//                'CodAD' => $article->getCodADWS() ,
//                'DesiAutoAD' => $article->getDesiAutoADWS() ,
//                'ValNivAD' => $article->getValNivADWS() ,
//                'StkReelAD' => $article->getStkReelADWS() ,
//                'StkResAD' => $article->getStkResADWS() ,
//                'StkCmdeAD' => $article->getStkCmdeADWS() ,
//                'CodGesStkAD' => $article->getCodGesStkADWS() ,
//                'EtatStockAD' => $article->getEtatStockADWS() ,
//                'StockDisponible' => $article->getStockDisponibleWS() ,
//                'StockDisponibleSoc' => $article->getStockDisponibleSocWS() ,
//                'StockPratique' => $article->getStockPratiqueWS() ,
//                'StkReelPlat1' => $article->getStkReelPlat1WS() ,
//                'QteCIDSsCFAD' => $article->getQteCIDSsCFADWS() ,
//                'UVteArt' => $article->getUVteArtWS() ,
//                'UStoArt' => $article->getUStoArtWS() ,
//                'CvStoVteAD' => $article->getCvStoVteADWS() ,
//                'TypCvStoVteAD' => ($this->getTypCvStoVteADWS()) ? 'true' : 'false' ,
//                'NbUStoCondVteAD' => $article->getNbUStoCondVteADWS() ,
//                'PoidsUVteArt' => $article->getPoidsUVteArtWS() ,
//                'NbUVteUCondVte' => $article->getNbUVteUCondVteWS() ,
//                'PrixPubUCondVte' => $article->getPrixPubUCondVteWS() ,
//                'PrixNetUCondVte' => $article->getPrixNetUCondVteWS() ,
//                'NbUStoUVte' => $article->getNbUStoUVteWS() ,
//                'NbUVteUSto' => $article->getNbUVteUStoWS() ,
//                'NbrDecArt' => $article->getNbrDecArtWS() ,
//                'LongAD' => $article->getLongADWS() ,
//                'LargAD' => $article->getLargADWS() ,
//                'EpaisAD' => $article->getEpaisADWS() ,
//                'CondVteAD' => $article->getCondVteADWS() ,
//                'FlgDecondAD' => ($this->getFlgDecondADWS()) ? 'true' : 'false' ,
//                'Desi2Art' => $article->getDesi2ArtWS() ,
//                'IdFour' => $article->getIdFourWS() ,
//                'NomDep' => $article->getNomDepWS() ,
//                'CodSuspAD' => $article->getCodSuspADWS() ,
//                'MultimediaArt' => $article->getMultimediaArtWS() ,
//                'ComTechAD' => $article->getComTechADWS() ,
//                'DocLie' => $article->getDocLieWS() ,
//                'GenCodAD' => $article->getGenCodADWS() ,
//                'CodEcoTaxeAD' => $article->getCodEcoTaxeADWS() ,
//                'MtEcoTaxe' => $article->getMtEcoTaxeWS() ,
//                'ValEcoTaxe' => $article->getValEcoTaxeWS() ,
//                'IdDepPlat' => $article->getIdDepPlatWS() ,
//                'IdADF' => $article->getIdADFWS() ,
//                'CodADF' => $article->getCodADFWS() ,
//                'GenCod1ADF' => $article->getGenCod1ADFWS() ,
//                'GenCod2ADF' => $article->getGenCod2ADFWS() ,
//                'CodCatAD' => $article->getCodCatADWS() ,
//                'PrixNet' => $article->getPrixNetWS() ,
//                'PrixPubCli' => $article->getPrixPubCliWS() ,
//                'PrixPubAD' => $article->getPrixPubADWS() ,
//                'TypeTarif' => $article->getTypeTarifWS() ,
//                'PrixRevConvAD' => $article->getPrixRevConvADWS() ,
//                'PrixRevReelAD' => $article->getPrixRevReelADWS() ,
//                'CoefPRRAD' => $article->getCoefPRRADWS() ,
//                'CoefPRCAD' => $article->getCoefPRCADWS() ,
//                'MargeReelleAD' => $article->getMargeReelleADWS() ,
//                'MargeConvAD' => $article->getMargeConvADWS(),
//                'Stocks' => (!is_null($this->getStocks())) ? $article->getStocks()->__toString() : []

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