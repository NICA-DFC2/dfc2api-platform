<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Services\Objets\WsArticle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Swagger\Annotations as SWG;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Validator\Constraints as ApiAssert;

/**
 * Entité qui représente un Article. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource()
 * @ORM\Entity
 * @ORM\Table(name="Article")
 */
class Article
{
    /**
     * @param integer $IdAD A IdAD propriété - Identifiant unique d'un article dans la base de l'application.
     *
     * @ORM\Column(name="IdAD", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $IdAD;

    /**
     * @param integer $IdArtEvoAD A IdArt propriété - Identifiant unique d'un article dans Evolubat.
     *
     * @ORM\Column(name="IdArtEvoAD", type="integer", options={"default":-1}, nullable=true)
     */
    private $IdArtEvoAD;

    /**
     * @ORM\Column(name="DesiAD", type="string", length=255, nullable=true)
     * @ApiFilter(SearchFilter::class, strategy="partial")
     */
    private $DesiAD;

    /**
     * Désignation commune à tous les articles de la même déclinaison
     * @ORM\Column(name="DesiPrincAD", type="string", length=255, nullable=true)
     */
    private $DesiPrincAD;

    /**
     * @Gedmo\Slug(fields={"DesiAD"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="DescriWebAD", type="text", nullable=true)
     */
    private $DescriWebAD;

    /**
     * @ORM\Column(name="DescriCatalogAD", type="text", nullable=true)
     */
    private $DescriCatalogAD;

    /**
     * @ORM\Column(name="MediasAD", type="text", nullable=true)
     */
    private $MediasAD;

    /**
     * @ORM\Column(name="PlusAD", type="text", nullable=true)
     */
    private $PlusAD;

    /**
     * @ORM\Column(name="MotsClesAD", type="string", length=255, nullable=true)
     * @ApiFilter(SearchFilter::class, strategy="partial")
     */
    private $MotsClesAD;

    /**
     * @ORM\Column(name="OrdreAD", type="integer", options={"default":0}, nullable=true)
     */
    private $OrdreAD;

    /**
     * @ORM\Column(name="NumDecliAD", type="integer", nullable=true)
     */
    private $NumDecliAD;

    /**
     * @ORM\Column(name="FlgAncAD", type="boolean", nullable=true)
     */
    private $FlgAncAD;

    /**
     * @ORM\Column(name="FlgCatalogAD", type="boolean", nullable=true)
     */
    private $FlgCatalogAD;

    /**
     * @ORM\Column(name="FlgPrincAD", type="boolean", nullable=true)
     */
    private $FlgPrincAD;

    /**
     * @ORM\Column(name="FlgDestockAD", type="boolean", nullable=true)
     */
    private $FlgDestockAD;

    /**
     * @ORM\Column(name="FlgHorsMarqueAD", type="boolean", nullable=true)
     */
    private $FlgHorsMarqueAD;

    /**
     * @ORM\Column(name="FlgNouvAD", type="boolean", nullable=true)
     */
    private $FlgNouvAD;

    /**
     * @ORM\Column(name="FlgPromoAD", type="boolean", nullable=true)
     */
    private $FlgPromoAD;

    /**
     * @ORM\Column(name="FlgVisibleAD", type="boolean", nullable=true)
     */
    private $FlgVisibleAD;

    /**
     * @ORM\Column(name="FlgEclBleuAD", type="boolean", nullable=true)
     */
    private $FlgEclBleuAD;

    /**
     * @ORM\Column(name="FlgEclRoseAD", type="boolean", nullable=true)
     */
    private $FlgEclRoseAD;

    /**
     * @ORM\Column(name="FlgEclVertAD", type="boolean", nullable=true)
     */
    private $FlgEclVertAD;

    /**
     * @ORM\Column(name="FlgEclOrangeAD", type="boolean", nullable=true)
     */
    private $FlgEclOrangeAD;

    /**
     * @ORM\Column(name="IdFourAD", type="integer", nullable=true)
     */
    private $IdFourAD;

    /**
     * @ORM\Column(name="DateCreAD", type="datetime", nullable=true)
     */
    private $DateCreAD;

    /**
     * @ORM\Column(name="DateModAD", type="datetime", nullable=true)
     */
    private $DateModAD;

    /**
     * @ORM\Column(name="UCreAD", type="string", length=5, nullable=true)
     */
    private $UCreAD;

    /**
     * @ORM\Column(name="UModAD", type="string", length=5, nullable=true)
     */
    private $UModAD;

    /**
     * @ORM\ManyToMany(targetEntity="ArticleCategorie", mappedBy="articles", cascade={"persist"})
     * @ORM\JoinTable(name="article_category")
     *
     * @ApiAssert\ArticleCategorieOfArticleHaveNoChildren()
     */
    private $articleCategories;






    /* ***********************

    DEBUT :: A HYDRATER AVEC API WEB SERVICE

    ************************ */

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant unique Evolubat de l'article.", type="integer")
     */
    private $IdADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Numéro unique Evolubat de l'article.", type="integer")
     */
    private $NoADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Code fournisseur unique Evolubat de l'article.", type="string")
     */
    private $CodADFWS;

    /**
     * @var string|null
     * @SWG\Property(description="Désignation Evolubat de l'article.", type="string")
     */
    private $DesiADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Code unique Evolubat de l'article.", type="string")
     */
    private $CodADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Unité de vente de l'article.", type="string")
     */
    private $UVteADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Unité de stock de l'article.", type="string")
     */
    private $UStoADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix public HT de l'article.", type="decimal")
     */
    private $PrixPubADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix net HT du client connecté de l'article.", type="decimal")
     */
    private $PrixNetCliADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant de la société de l'article.", type="integer")
     */
    private $IdSocWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant du dépot d'appartenance de l'article.", type="integer")
     */
    private $IdDepWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant d'instance de catégorie de l'article.", type="integer")
     */
    private $IdICWS;

    /**
     * @var string|null
     * @SWG\Property(description="Désignation automatique de l'article.", type="string")
     */
    private $DesiAutoADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Valeur de niveau de l'article.", type="string")
     */
    private $ValNivADWS;
    
    /**
     * @var float|null
     * @SWG\Property(description="Stock réél de l'article.", type="float")
     */
    private $StkReelADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Stock réservé de l'article.", type="float")
     */
    private $StkResADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Stock en commande de l'article.", type="float")
     */
    private $StkCmdeADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Code de gestion stock de l'article.", type="string")
     */
    private $CodGesStkADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Etat de stock de l'article.", type="string")
     */
    private $EtatStockADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Stock disponible de l'article.", type="float")
     */
    private $StockDisponibleWS;

    /**
     * @var float|null
     * @SWG\Property(description="Stock disponible de la société de l'article.", type="float")
     */
    private $StockDisponibleSocWS;

    /**
     * @var float|null
     * @SWG\Property(description="Stock pratique de l'article.", type="float")
     */
    private $StockPratiqueWS;

    /**
     * @var float|null
     * @SWG\Property(description="Stock réél à la plateforme de l'article.", type="float")
     */
    private $StkReelPlat1WS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant unique ?? de l'article.", type="integer")
     */
    private $QteCIDSsCFADWS;

    /**
     * @var string|null
     * @SWG\Property(description="Unité de vente de l'article.", type="string")
     */
    private $UVteArtWS;

    /**
     * @var string|null
     * @SWG\Property(description="Unité de stock de l'article.", type="string")
     */
    private $UStoArtWS;

    /**
     * @var float|null
     * @SWG\Property(description="valeur ?? de l'article.", type="float")
     */
    private $CvStoVteADWS;

    /**
     * @var boolean|null
     * @SWG\Property(description="valeur ?? de l'article.", type="boolean")
     */
    private $TypCvStoVteADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Nombre unité de stock en conditionnement de vente de l'article.", type="integer")
     */
    private $NbUStoCondVteADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Poids unité de vente de l'article.", type="float")
     */
    private $PoidsUVteArtWS;

    /**
     * @var float|null
     * @SWG\Property(description="Nombre unité de vente en conditionnement de vente de l'article.", type="float")
     */
    private $NbUVteUCondVteWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix public conditionnel vente de l'article.", type="float")
     */
    private $PrixPubUCondVteWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix net unitaire conditionel vente de l'article.", type="float")
     */
    private $PrixNetUCondVteWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Nombre unitaire stock à la vente de l'article.", type="integer")
     */
    private $NbUStoUVteWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Nombre unitaire vente de stock de l'article.", type="integer")
     */
    private $NbUVteUStoWS;
    
    /**
     * @var integer|null
     * @SWG\Property(description="Nombre déconditionnement de l'article.", type="integer")
     */
    private $NbrDecArtWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Longueur de l'article.", type="integer")
     */
    private $LongADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Largeur de l'article.", type="integer")
     */
    private $LargADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Epaissseur de l'article.", type="integer")
     */
    private $EpaisADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Conditionnement à la vente de l'article.", type="integer")
     */
    private $CondVteADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="indique s'il faut déconditionner l'article.", type="integer")
     */
    private $FlgDecondADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Désignation 2 de l'article.", type="integer")
     */
    private $Desi2ArtWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant unique du fournisseur de l'article.", type="integer")
     */
    private $IdFourWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Nom du dépot d'apartenance de l'article.", type="integer")
     */
    private $NomDepWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Code de suspension de l'article.", type="integer")
     */
    private $CodSuspADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Lien du média de l'article.", type="integer")
     */
    private $MultimediaArtWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Commentaires techniques de l'article.", type="integer")
     */
    private $ComTechADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Lien vers un document de l'article.", type="integer")
     */
    private $DocLieWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Gencode de l'article.", type="integer")
     */
    private $GenCodADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Code ecotaxe de l'article.", type="integer")
     */
    private $CodEcoTaxeADWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Montant ecotaxe de l'article.", type="integer")
     */
    private $MtEcoTaxeWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Valeur ecotaxe de l'article.", type="integer")
     */
    private $ValEcoTaxeWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant du dépot de la plateforme de l'article.", type="integer")
     */
    private $IdDepPlatWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Identifiant unique fournisseur  de l'article.", type="integer")
     */
    private $IdADFWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Gencode 1 fournisseur de l'article.", type="integer")
     */
    private $GenCod1ADFWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Gencode 2 fournisseur de l'article.", type="integer")
     */
    private $GenCod2ADFWS;

    /**
     * @var integer|null
     * @SWG\Property(description="Code de la catégorie de l'article.", type="integer")
     */
    private $CodCatADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix net de l'article.", type="float")
     */
    private $PrixNetWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix public client de l'article.", type="float")
     */
    private $PrixPubCliWS;

    /**
     * @var string|null
     * @SWG\Property(description="Type tarif de l'article.", type="string")
     */
    private $TypeTarifWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix de revient conventionnel de l'article.", type="float")
     */
    private $PrixRevConvADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Prix de revient réél de l'article.", type="float")
     */
    private $PrixRevReelADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Coefficient PRR de l'article.", type="float")
     */
    private $CoefPRRADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Coefficient PRC de l'article.", type="float")
     */
    private $CoefPRCADWS;

    /**
     * @var float|null
     * @SWG\Property(description="Marge réélle de l'article.", type="float")
     */
    private $MargeReelleADWS;
    
    /**
     * @var float|null
     * @SWG\Property(description="Marge conventionelle de l'article.", type="float")
     */
    private $MargeConvADWS;
    
    /**
     * @var array
     * @SWG\Property(description="Stocks disponibles Evolubat de l'article dans les différents dépots.", type="array")
     */
    private $Stocks = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AffinageGroupe", inversedBy="articles")
     */
    private $affinageGroupe;

    /**
     * ArtDet constructor.
     */
    public function __construct()
    {
        $this->Stocks = array();
        $this->articleCategories = new ArrayCollection();
    }

    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsArticle $json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdAD($json_object->{'IdAD'});
            $this->setIdArtEvoAD($json_object->{'IdArt'});
            $this->setIdDepWS($json_object->{'IdDep'});
            $this->setNoADWS($json_object->{'NoAD'});
            $this->setCodADWS($json_object->{'CodAD'});
            $this->setDesiAutoADWS($json_object->{'DesiAutoAD'});
            $this->setStkReelADWS($json_object->{'StkReelAD'});
            $this->setStkResADWS($json_object->{'StkResAD'});
            $this->setStkCmdeADWS($json_object->{'StkCmdeAD'});
            $this->setStockDisponibleWS($json_object->{'StockDisponible'});
            $this->setStockDisponibleSocWS($json_object->{'StockDisponibleSoc'});
            $this->setStockPratiqueWS($json_object->{'StockPratique'});
            $this->setStkReelPlat1WS($json_object->{'StkReelPlat1'});
            $this->setUVteArtWS($json_object->{'UVteArt'});
            $this->setUStoArtWS($json_object->{'UStoArt'});
            $this->setPrixPubUCondVteWS($json_object->{'PrixPubUCondVte'});
            $this->setPrixNetUCondVteWS($json_object->{'PrixNetUCondVte'});

            // Champs qui n'existe pas dans les articles de ttStock
            if (isset($json_object->{'NbrDecArt'})) {
                $this->setLongADWS($json_object->{'LongAD'});
                $this->setLargADWS($json_object->{'LargAD'});
                $this->setEpaisADWS($json_object->{'EpaisAD'});
                $this->setCondVteADWS($json_object->{'CondVteAD'});
                $this->setFlgDecondADWS($json_object->{'FlgDecondAD'});
                $this->setDesi2ArtWS($json_object->{'Desi2Art'});
                $this->setIdFourWS($json_object->{'IdFour'});
                $this->setNomDepWS($json_object->{'NomDep'});
                $this->setCodSuspADWS($json_object->{'CodSuspAD'});
                $this->setGenCodADWS($json_object->{'GenCodAD'});
                $this->setCodADFWS($json_object->{'CodADF'});
                $this->setGenCod1ADFWS($json_object->{'GenCod1ADF'});
                $this->setGenCod2ADFWS($json_object->{'GenCod2ADF'});
            }

            $this->setPrixNetWS($json_object->{'PrixNet'});
            $this->setPrixPubCliWS($json_object->{'PrixPubCli'});
            $this->setPrixPubADWS($json_object->{'PrixPubAD'});
            $this->setPrixRevConvADWS($json_object->{'PrixRevConvAD'});
            $this->setCoefPRCADWS($json_object->{'CoefPRCAD'});
            $this->setMargeConvADWS($json_object->{'MargeConvAD'});
        }
    }

    public function __toString() {
        $string = '{';
        $string .= '"IdAD": '. $this->getIdAD() .', ';
        $string .= '"IdArt": '. $this->getIdArtEvoAD() .', ';
        $string .= '"IdSoc": '. $this->getIdSocWS() .', ';
        $string .= '"IdDep": '. $this->getIdDepWS() .', ';
        $string .= '"IdIC": '. $this->getIdICWS() .', ';
        $string .= '"NoAD": '. $this->getNoADWS() .', ';
        $string .= '"CodAD": "'. $this->getCodADWS() .'", ';
        $string .= '"DesiAutoAD": "'. $this->getDesiAutoADWS() .'", ';
        $string .= '"ValNivAD": "'. $this->getValNivADWS() .'", ';
        $string .= '"StkReelAD": '. $this->getStkReelADWS() .', ';
        $string .= '"StkResAD": '. $this->getStkResADWS() .', ';
        $string .= '"StkCmdeAD": '. $this->getStkCmdeADWS() .', ';
        $string .= '"CodGesStkAD": "'. $this->getCodGesStkADWS() .'", ';
        $string .= '"EtatStockAD": "'. $this->getEtatStockADWS() .'", ';
        $string .= '"StockDisponible": '. $this->getStockDisponibleWS() .', ';
        $string .= '"StockDisponibleSoc": '. $this->getStockDisponibleSocWS() .', ';
        $string .= '"StockPratique": '. $this->getStockPratiqueWS() .', ';
        $string .= '"StkReelPlat1": '. $this->getStkReelPlat1WS() .', ';
        $string .= '"QteCIDSsCFAD": '. $this->getQteCIDSsCFADWS() .', ';
        $string .= '"UVteArt": "'. $this->getUVteArtWS() .'", ';
        $string .= '"UStoArt": "'. $this->getUStoArtWS() .'", ';
        $string .= '"CvStoVteAD": '. $this->getCvStoVteADWS() .', ';

        $val = ($this->getTypCvStoVteADWS()) ? 'true' : 'false';
        $string .= '"TypCvStoVteAD": '. $val .', ';

        $string .= '"NbUStoCondVteAD": "'. $this->getNbUStoCondVteADWS() .'", ';
        $string .= '"PoidsUVteArt": "'. $this->getPoidsUVteArtWS() .'", ';
        $string .= '"NbUVteUCondVte": '. $this->getNbUVteUCondVteWS() .', ';
        $string .= '"PrixPubUCondVte": '. $this->getPrixPubUCondVteWS() .', ';
        $string .= '"PrixNetUCondVte": '. $this->getPrixNetUCondVteWS() .', ';
        $string .= '"NbUStoUVte": '. $this->getNbUStoUVteWS() .', ';
        $string .= '"NbUVteUSto": '. $this->getNbUVteUStoWS() .', ';
        $string .= '"NbrDecArt": '. $this->getNbrDecArtWS() .', ';
        $string .= '"LongAD": '. $this->getLongADWS() .', ';
        $string .= '"LargAD": '. $this->getLargADWS() .', ';
        $string .= '"EpaisAD": '. $this->getEpaisADWS() .', ';
        $string .= '"CondVteAD": "'. $this->getCondVteADWS() .'", ';

        $val = ($this->getFlgDecondADWS()) ? 'true' : 'false';
        $string .= '"FlgDecondAD": "'. $val .'", ';

        $string .= '"Desi2Art": "'. $this->getDesi2ArtWS() .'", ';
        $string .= '"IdFour": '. $this->getIdFourWS() .', ';
        $string .= '"NomDep": "'. $this->getNomDepWS() .'", ';
        $string .= '"CodSuspAD": "'. $this->getCodSuspADWS() .'", ';
        $string .= '"MultimediaArt": "'. $this->getMultimediaArtWS() .'", ';
        $string .= '"ComTechAD": "'. $this->getComTechADWS() .'", ';
        $string .= '"DocLie": "'. $this->getDocLieWS() .'", ';
        $string .= '"GenCodAD": "'. $this->getGenCodADWS() .'", ';
        $string .= '"CodEcoTaxeAD": "'. $this->getCodEcoTaxeADWS() .'", ';
        $string .= '"MtEcoTaxe": "'. $this->getMtEcoTaxeWS() .'", ';
        $string .= '"ValEcoTaxe": '. $this->getValEcoTaxeWS() .', ';
        $string .= '"IdDepPlat": '. $this->getIdDepPlatWS() .', ';
        $string .= '"IdADF": '. $this->getIdADFWS() .', ';
        $string .= '"CodADF": "'. $this->getCodADFWS() .'", ';
        $string .= '"GenCod1ADF": "'. $this->getGenCod1ADFWS() .'", ';
        $string .= '"GenCod2ADF": "'. $this->getGenCod2ADFWS() .'", ';
        $string .= '"CodCatAD": "'. $this->getCodCatADWS() .'", ';
        $string .= '"PrixNet": '. $this->getPrixNetWS() .', ';
        $string .= '"PrixPubCli": '. $this->getPrixPubCliWS() .', ';
        $string .= '"PrixPubAD": '. $this->getPrixPubADWS() .', ';
        $string .= '"TypeTarif": "'. $this->getTypeTarifWS() .'", ';
        $string .= '"PrixRevConvAD": '. $this->getPrixRevConvADWS() .', ';
        $string .= '"PrixRevReelAD": '. $this->getPrixRevReelADWS() .', ';
        $string .= '"CoefPRRAD": '. $this->getCoefPRRADWS() .', ';
        $string .= '"CoefPRCAD": '. $this->getCoefPRCADWS() .', ';
        $string .= '"MargeReelleAD": '. $this->getMargeReelleADWS() .', ';
        $string .= '"MargeConvAD": '. $this->getMargeConvADWS();

        if(!is_null($this->getStocks())) {
            $string .= ', "Stocks": '. $this->getStocks()->__toString();
        }

        $string .= '}';

        return $string;
    }

    public function __shortToString() {
        $string = '{';
        $string .= '"IdAD": '. $this->getIdAD() .', ';
        $string .= '"NoAD": '. $this->getNoADWS() .', ';
        $string .= '"CodAD": "'. $this->getCodADWS() .'", ';
        $string .= '"DesiAutoAD": "'. $this->getDesiAutoADWS() .'", ';
        $string .= '"UVteArt": "'. $this->getUVteArtWS() .'", ';
        $string .= '"UStoArt": "'. $this->getUStoArtWS() .'", ';
        $string .= '"CondVteAD": "'. $this->getCondVteADWS() .'", ';
        $string .= '"CodSuspAD": "'. $this->getCodSuspADWS() .'", ';
        $string .= '"GenCodAD": "'. $this->getGenCodADWS() .'", ';
        $string .= '"CodADF": "'. $this->getCodADFWS() .'", ';
        $string .= '"GenCod1ADF": "'. $this->getGenCod1ADFWS() .'", ';
        $string .= '"GenCod2ADF": "'. $this->getGenCod2ADFWS() .'", ';
        $string .= '"PrixPubAD": '. $this->getPrixPubADWS() .' ';
        $string .= '}';

        return $string;
    }

    /**
     * @return mixed
     */
    public function getIdAD()
    {
        return $this->IdAD;
    }

    /**
     * @param mixed $IdAD
     */
    public function setIdAD($IdAD)
    {
        $this->IdAD = $IdAD;
    }

    /**
     * @return mixed
     */
    public function getIdArtEvoAD()
    {
        return $this->IdArtEvoAD;
    }

    /**
     * @param mixed $IdArtEvoAD
     */
    public function setIdArtEvoAD($IdArtEvoAD)
    {
        $this->IdArtEvoAD = $IdArtEvoAD;
    }

    /**
     * @return mixed
     */
    public function getDesiAD()
    {
        return $this->DesiAD;
    }

    /**
     * @param mixed $DesiAD
     */
    public function setDesiAD($DesiAD)
    {
        $this->DesiAD = $DesiAD;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }



    /**
     * @return mixed
     */
    public function getDesiPrincAD()
    {
        return $this->DesiPrincAD;
    }

    /**
     * @param mixed $DesiPrincAD
     */
    public function setDesiPrincAD($DesiPrincAD)
    {
        $this->DesiPrincAD = $DesiPrincAD;
    }

    /**
     * @return mixed
     */
    public function getDescriWebAD()
    {
        return $this->DescriWebAD;
    }

    /**
     * @param mixed $DescriWebAD
     */
    public function setDescriWebAD($DescriWebAD)
    {
        $this->DescriWebAD = $DescriWebAD;
    }

    /**
     * @return mixed
     */
    public function getDescriCatalogAD()
    {
        return $this->DescriCatalogAD;
    }

    /**
     * @param mixed $DescriCatalogAD
     */
    public function setDescriCatalogAD($DescriCatalogAD)
    {
        $this->DescriCatalogAD = $DescriCatalogAD;
    }

    /**
     * @return mixed
     */
    public function getMediasAD()
    {
        return $this->MediasAD;
    }

    /**
     * @param mixed $MediasAD
     */
    public function setMediasAD($MediasAD)
    {
        $this->MediasAD = $MediasAD;
    }

    /**
     * @return mixed
     */
    public function getPlusAD()
    {
        return $this->PlusAD;
    }

    /**
     * @param mixed $PlusAD
     */
    public function setPlusAD($PlusAD)
    {
        $this->PlusAD = $PlusAD;
    }

    /**
     * @return mixed
     */
    public function getMotsClesAD()
    {
        return $this->MotsClesAD;
    }

    /**
     * @param mixed $MotsClesAD
     */
    public function setMotsClesAD($MotsClesAD)
    {
        $this->MotsClesAD = $MotsClesAD;
    }

    /**
     * @return mixed
     */
    public function getOrdreAD()
    {
        return $this->OrdreAD;
    }

    /**
     * @param mixed $OrdreAD
     */
    public function setOrdreAD($OrdreAD)
    {
        $this->OrdreAD = $OrdreAD;
    }

    /**
     * @return mixed
     */
    public function getNumDecliAD()
    {
        return $this->NumDecliAD;
    }

    /**
     * @param mixed $NumDecliAD
     */
    public function setNumDecliAD($NumDecliAD)
    {
        $this->NumDecliAD = $NumDecliAD;
    }

    /**
     * @return mixed
     */
    public function getFlgAncAD()
    {
        return $this->FlgAncAD;
    }

    /**
     * @param mixed $FlgAncAD
     */
    public function setFlgAncAD($FlgAncAD)
    {
        $this->FlgAncAD = $FlgAncAD;
    }

    /**
     * @return mixed
     */
    public function getFlgCatalogAD()
    {
        return $this->FlgCatalogAD;
    }

    /**
     * @param mixed $FlgCatalogAD
     */
    public function setFlgCatalogAD($FlgCatalogAD)
    {
        $this->FlgCatalogAD = $FlgCatalogAD;
    }

    /**
     * @return mixed
     */
    public function getFlgPrincAD()
    {
        return $this->FlgPrincAD;
    }

    /**
     * @param mixed $FlgPrincAD
     */
    public function setFlgPrincAD($FlgPrincAD)
    {
        $this->FlgPrincAD = $FlgPrincAD;
    }

    /**
     * @return mixed
     */
    public function getFlgDestockAD()
    {
        return $this->FlgDestockAD;
    }

    /**
     * @param mixed $FlgDestockAD
     */
    public function setFlgDestockAD($FlgDestockAD)
    {
        $this->FlgDestockAD = $FlgDestockAD;
    }

    /**
     * @return mixed
     */
    public function getFlgHorsMarqueAD()
    {
        return $this->FlgHorsMarqueAD;
    }

    /**
     * @param mixed $FlgHorsMarqueAD
     */
    public function setFlgHorsMarqueAD($FlgHorsMarqueAD)
    {
        $this->FlgHorsMarqueAD = $FlgHorsMarqueAD;
    }

    /**
     * @return mixed
     */
    public function getFlgNouvAD()
    {
        return $this->FlgNouvAD;
    }

    /**
     * @param mixed $FlgNouvAD
     */
    public function setFlgNouvAD($FlgNouvAD)
    {
        $this->FlgNouvAD = $FlgNouvAD;
    }

    /**
     * @return mixed
     */
    public function getFlgPromoAD()
    {
        return $this->FlgPromoAD;
    }

    /**
     * @param mixed $FlgPromoAD
     */
    public function setFlgPromoAD($FlgPromoAD)
    {
        $this->FlgPromoAD = $FlgPromoAD;
    }

    /**
     * @return mixed
     */
    public function getFlgVisibleAD()
    {
        return $this->FlgVisibleAD;
    }

    /**
     * @param mixed $FlgVisibleAD
     */
    public function setFlgVisibleAD($FlgVisibleAD)
    {
        $this->FlgVisibleAD = $FlgVisibleAD;
    }

    /**
     * @return mixed
     */
    public function getFlgEclBleuAD()
    {
        return $this->FlgEclBleuAD;
    }

    /**
     * @param mixed $FlgEclBleuAD
     */
    public function setFlgEclBleuAD($FlgEclBleuAD)
    {
        $this->FlgEclBleuAD = $FlgEclBleuAD;
    }

    /**
     * @return mixed
     */
    public function getFlgEclRoseAD()
    {
        return $this->FlgEclRoseAD;
    }

    /**
     * @param mixed $FlgEclRoseAD
     */
    public function setFlgEclRoseAD($FlgEclRoseAD)
    {
        $this->FlgEclRoseAD = $FlgEclRoseAD;
    }

    /**
     * @return mixed
     */
    public function getFlgEclVertAD()
    {
        return $this->FlgEclVertAD;
    }

    /**
     * @param mixed $FlgEclVertAD
     */
    public function setFlgEclVertAD($FlgEclVertAD)
    {
        $this->FlgEclVertAD = $FlgEclVertAD;
    }

    /**
     * @return mixed
     */
    public function getFlgEclOrangeAD()
    {
        return $this->FlgEclOrangeAD;
    }

    /**
     * @param mixed $FlgEclOrangeAD
     */
    public function setFlgEclOrangeAD($FlgEclOrangeAD)
    {
        $this->FlgEclOrangeAD = $FlgEclOrangeAD;
    }

    /**
     * @return mixed
     */
    public function getIdFourAD()
    {
        return $this->IdFourAD;
    }

    /**
     * @param mixed $IdFourAD
     */
    public function setIdFourAD($IdFourAD)
    {
        $this->IdFourAD = $IdFourAD;
    }

    /**
     * @return mixed
     */
    public function getDateCreAD()
    {
        return $this->DateCreAD;
    }

    /**
     * @param mixed $DateCreAD
     */
    public function setDateCreAD($DateCreAD)
    {
        $this->DateCreAD = $DateCreAD;
    }

    /**
     * @return mixed
     */
    public function getDateModAD()
    {
        return $this->DateModAD;
    }

    /**
     * @param mixed $DateModAD
     */
    public function setDateModAD($DateModAD)
    {
        $this->DateModAD = $DateModAD;
    }

    /**
     * @return mixed
     */
    public function getUCreAD()
    {
        return $this->UCreAD;
    }

    /**
     * @param mixed $UCreAD
     */
    public function setUCreAD($UCreAD)
    {
        $this->UCreAD = $UCreAD;
    }

    /**
     * @return mixed
     */
    public function getUModAD()
    {
        return $this->UModAD;
    }

    /**
     * @param mixed $UModAD
     */
    public function setUModAD($UModAD)
    {
        $this->UModAD = $UModAD;
    }

    /**
     * @return Collection|ArticleCategorie[]
     */
    public function getArticleCategories(): Collection
    {
        return $this->articleCategories;
    }

    public function addArticleCategory(ArticleCategorie $articleCategory): self
    {
        if (!$this->articleCategories->contains($articleCategory)) {
            $this->articleCategories[] = $articleCategory;
            $articleCategory->addArticle($this);
        }

        return $this;
    }

    public function removeArticleCategory(ArticleCategorie $articleCategory): self
    {
        if ($this->articleCategories->contains($articleCategory)) {
            $this->articleCategories->removeElement($articleCategory);
            $articleCategory->removeArticle($this);
        }

        return $this;
    }

    /* ***********************

    DEBUT :: A HYDRATER AVEC API WEB SERVICE

    ************************ */

    /**
     * @return integer|null
     */
    public function getIdADWS()
    {
        return $this->IdADWS;
    }

    /**
     * @param integer|null $IdADWS
     */
    public function setIdADWS($IdADWS)
    {
        $this->IdADWS = $IdADWS;
    }

    /**
     * @return integer|null
     */
    public function getNoADWS()
    {
        return $this->NoADWS;
    }

    /**
     * @param integer|null $NoADWS
     */
    public function setNoADWS($NoADWS)
    {
        $this->NoADWS = $NoADWS;
    }

    /**
     * @return string|null
     */
    public function getCodADFWS()
    {
        return $this->CodADFWS;
    }

    /**
     * @param string|null $CodADFWS
     */
    public function setCodADFWS($CodADFWS)
    {
        $this->CodADFWS = $CodADFWS;
    }

    /**
     * @return string|null
     */
    public function getDesiADWS()
    {
        return $this->DesiADWS;
    }

    /**
     * @param string|null $DesiADWS
     */
    public function setDesiADWS($DesiADWS)
    {
        $this->DesiADWS = $DesiADWS;
    }

    /**
     * @return string|null
     */
    public function getCodADWS()
    {
        return $this->CodADWS;
    }

    /**
     * @param string|null $CodADWS
     */
    public function setCodADWS($CodADWS)
    {
        $this->CodADWS = $CodADWS;
    }

    /**
     * @return string|null
     */
    public function getUVteADWS()
    {
        return $this->UVteADWS;
    }

    /**
     * @param string|null $UVteADWS
     */
    public function setUVteADWS($UVteADWS)
    {
        $this->UVteADWS = $UVteADWS;
    }

    /**
     * @return string|null
     */
    public function getUStoADWS()
    {
        return $this->UStoADWS;
    }

    /**
     * @param string|null $UStoADWS
     */
    public function setUStoADWS($UStoADWS)
    {
        $this->UStoADWS = $UStoADWS;
    }

    /**
     * @return float|null
     */
    public function getPrixPubADWS()
    {
        return $this->PrixPubADWS;
    }

    /**
     * @param float|null $PrixPubADWS
        */
        public function setPrixPubADWS($PrixPubADWS)
    {
        $this->PrixPubADWS = $PrixPubADWS;
    }

    /**
     * @return float|null
     */
    public function getPrixNetCliADWS()
    {
        return $this->PrixNetCliADWS;
    }

    /**
     * @param float|null $PrixNetCliADWS
     */
    public function setPrixNetCliADWS($PrixNetCliADWS)
    {
        $this->PrixNetCliADWS = $PrixNetCliADWS;
    }

    /**
     * @return int|null
     */
    public function getIdSocWS()
    {
        return $this->IdSocWS;
    }

    /**
     * @param int|null $IdSocWS
     */
    public function setIdSocWS($IdSocWS)
    {
        $this->IdSocWS = $IdSocWS;
    }

    /**
     * @return int|null
     */
    public function getIdDepWS()
    {
        return $this->IdDepWS;
    }

    /**
     * @param int|null $IdDepWS
     */
    public function setIdDepWS($IdDepWS)
    {
        $this->IdDepWS = $IdDepWS;
    }

    /**
     * @return int|null
     */
    public function getIdICWS()
    {
        return $this->IdICWS;
    }

    /**
     * @param int|null $IdICWS
     */
    public function setIdICWS($IdICWS)
    {
        $this->IdICWS = $IdICWS;
    }

    /**
     * @return null|string
     */
    public function getDesiAutoADWS()
    {
        return $this->DesiAutoADWS;
    }

    /**
     * @param null|string $DesiAutoADWS
     */
    public function setDesiAutoADWS($DesiAutoADWS)
    {
        $this->DesiAutoADWS = $DesiAutoADWS;
    }

    /**
     * @return null|string
     */
    public function getValNivADWS()
    {
        return $this->ValNivADWS;
    }

    /**
     * @param null|string $ValNivADWS
     */
    public function setValNivADWS($ValNivADWS)
    {
        $this->ValNivADWS = $ValNivADWS;
    }

    /**
     * @return float|null
     */
    public function getStkReelADWS()
    {
        return $this->StkReelADWS;
    }

    /**
     * @param float|null $StkReelADWS
     */
    public function setStkReelADWS($StkReelADWS)
    {
        $this->StkReelADWS = $StkReelADWS;
    }

    /**
     * @return float|null
     */
    public function getStkResADWS()
    {
        return $this->StkResADWS;
    }

    /**
     * @param float|null $StkResADWS
     */
    public function setStkResADWS($StkResADWS)
    {
        $this->StkResADWS = $StkResADWS;
    }

    /**
     * @return float|null
     */
    public function getStkCmdeADWS()
    {
        return $this->StkCmdeADWS;
    }

    /**
     * @param float|null $StkCmdeADWS
     */
    public function setStkCmdeADWS($StkCmdeADWS)
    {
        $this->StkCmdeADWS = $StkCmdeADWS;
    }

    /**
     * @return null|string
     */
    public function getCodGesStkADWS()
    {
        return $this->CodGesStkADWS;
    }

    /**
     * @param null|string $CodGesStkADWS
     */
    public function setCodGesStkADWS($CodGesStkADWS)
    {
        $this->CodGesStkADWS = $CodGesStkADWS;
    }

    /**
     * @return null|string
     */
    public function getEtatStockADWS()
    {
        return $this->EtatStockADWS;
    }

    /**
     * @param null|string $EtatStockADWS
     */
    public function setEtatStockADWS($EtatStockADWS)
    {
        $this->EtatStockADWS = $EtatStockADWS;
    }

    /**
     * @return float|null
     */
    public function getStockDisponibleWS()
    {
        return $this->StockDisponibleWS;
    }

    /**
     * @param float|null $StockDisponibleWS
     */
    public function setStockDisponibleWS($StockDisponibleWS)
    {
        $this->StockDisponibleWS = $StockDisponibleWS;
    }

    /**
     * @return float|null
     */
    public function getStockDisponibleSocWS()
    {
        return $this->StockDisponibleSocWS;
    }

    /**
     * @param float|null $StockDisponibleSocWS
     */
    public function setStockDisponibleSocWS($StockDisponibleSocWS)
    {
        $this->StockDisponibleSocWS = $StockDisponibleSocWS;
    }

    /**
     * @return float|null
     */
    public function getStockPratiqueWS()
    {
        return $this->StockPratiqueWS;
    }

    /**
     * @param float|null $StockPratiqueWS
     */
    public function setStockPratiqueWS($StockPratiqueWS)
    {
        $this->StockPratiqueWS = $StockPratiqueWS;
    }

    /**
     * @return float|null
     */
    public function getStkReelPlat1WS()
    {
        return $this->StkReelPlat1WS;
    }

    /**
     * @param float|null $StkReelPlat1WS
     */
    public function setStkReelPlat1WS($StkReelPlat1WS)
    {
        $this->StkReelPlat1WS = $StkReelPlat1WS;
    }

    /**
     * @return int|null
     */
    public function getQteCIDSsCFADWS()
    {
        return $this->QteCIDSsCFADWS;
    }

    /**
     * @param int|null $QteCIDSsCFADWS
     */
    public function setQteCIDSsCFADWS($QteCIDSsCFADWS)
    {
        $this->QteCIDSsCFADWS = $QteCIDSsCFADWS;
    }

    /**
     * @return null|string
     */
    public function getUVteArtWS()
    {
        return $this->UVteArtWS;
    }

    /**
     * @param null|string $UVteArtWS
     */
    public function setUVteArtWS($UVteArtWS)
    {
        $this->UVteArtWS = $UVteArtWS;
    }

    /**
     * @return null|string
     */
    public function getUStoArtWS()
    {
        return $this->UStoArtWS;
    }

    /**
     * @param null|string $UStoArtWS
     */
    public function setUStoArtWS($UStoArtWS)
    {
        $this->UStoArtWS = $UStoArtWS;
    }

    /**
     * @return float|null
     */
    public function getCvStoVteADWS()
    {
        return $this->CvStoVteADWS;
    }

    /**
     * @param float|null $CvStoVteADWS
     */
    public function setCvStoVteADWS($CvStoVteADWS)
    {
        $this->CvStoVteADWS = $CvStoVteADWS;
    }

    /**
     * @return bool|null
     */
    public function getTypCvStoVteADWS()
    {
        return $this->TypCvStoVteADWS;
    }

    /**
     * @param bool|null $TypCvStoVteADWS
     */
    public function setTypCvStoVteADWS($TypCvStoVteADWS)
    {
        $this->TypCvStoVteADWS = $TypCvStoVteADWS;
    }

    /**
     * @return int|null
     */
    public function getNbUStoCondVteADWS()
    {
        return $this->NbUStoCondVteADWS;
    }

    /**
     * @param int|null $NbUStoCondVteADWS
     */
    public function setNbUStoCondVteADWS($NbUStoCondVteADWS)
    {
        $this->NbUStoCondVteADWS = $NbUStoCondVteADWS;
    }

    /**
     * @return float|null
     */
    public function getPoidsUVteArtWS()
    {
        return $this->PoidsUVteArtWS;
    }

    /**
     * @param float|null $PoidsUVteArtWS
     */
    public function setPoidsUVteArtWS($PoidsUVteArtWS)
    {
        $this->PoidsUVteArtWS = $PoidsUVteArtWS;
    }

    /**
     * @return float|null
     */
    public function getNbUVteUCondVteWS()
    {
        return $this->NbUVteUCondVteWS;
    }

    /**
     * @param float|null $NbUVteUCondVteWS
     */
    public function setNbUVteUCondVteWS($NbUVteUCondVteWS)
    {
        $this->NbUVteUCondVteWS = $NbUVteUCondVteWS;
    }

    /**
     * @return float|null
     */
    public function getPrixPubUCondVteWS()
    {
        return $this->PrixPubUCondVteWS;
    }

    /**
     * @param float|null $PrixPubUCondVteWS
     */
    public function setPrixPubUCondVteWS($PrixPubUCondVteWS)
    {
        $this->PrixPubUCondVteWS = $PrixPubUCondVteWS;
    }

    /**
     * @return float|null
     */
    public function getPrixNetUCondVteWS()
    {
        return $this->PrixNetUCondVteWS;
    }

    /**
     * @param float|null $PrixNetUCondVteWS
     */
    public function setPrixNetUCondVteWS($PrixNetUCondVteWS)
    {
        $this->PrixNetUCondVteWS = $PrixNetUCondVteWS;
    }

    /**
     * @return int|null
     */
    public function getNbUStoUVteWS()
    {
        return $this->NbUStoUVteWS;
    }

    /**
     * @param int|null $NbUStoUVteWS
     */
    public function setNbUStoUVteWS($NbUStoUVteWS)
    {
        $this->NbUStoUVteWS = $NbUStoUVteWS;
    }

    /**
     * @return int|null
     */
    public function getNbUVteUStoWS()
    {
        return $this->NbUVteUStoWS;
    }

    /**
     * @param int|null $NbUVteUStoWS
     */
    public function setNbUVteUStoWS($NbUVteUStoWS)
    {
        $this->NbUVteUStoWS = $NbUVteUStoWS;
    }

    /**
     * @return int|null
     */
    public function getNbrDecArtWS()
    {
        return $this->NbrDecArtWS;
    }

    /**
     * @param int|null $NbrDecArtWS
     */
    public function setNbrDecArtWS($NbrDecArtWS)
    {
        $this->NbrDecArtWS = $NbrDecArtWS;
    }

    /**
     * @return int|null
     */
    public function getLongADWS()
    {
        return $this->LongADWS;
    }

    /**
     * @param int|null $LongADWS
     */
    public function setLongADWS($LongADWS)
    {
        $this->LongADWS = $LongADWS;
    }

    /**
     * @return int|null
     */
    public function getLargADWS()
    {
        return $this->LargADWS;
    }

    /**
     * @param int|null $LargADWS
     */
    public function setLargADWS($LargADWS)
    {
        $this->LargADWS = $LargADWS;
    }

    /**
     * @return int|null
     */
    public function getEpaisADWS()
    {
        return $this->EpaisADWS;
    }

    /**
     * @param int|null $EpaisADWS
     */
    public function setEpaisADWS($EpaisADWS)
    {
        $this->EpaisADWS = $EpaisADWS;
    }

    /**
     * @return int|null
     */
    public function getCondVteADWS()
    {
        return $this->CondVteADWS;
    }

    /**
     * @param int|null $CondVteADWS
     */
    public function setCondVteADWS($CondVteADWS)
    {
        $this->CondVteADWS = $CondVteADWS;
    }

    /**
     * @return int|null
     */
    public function getFlgDecondADWS()
    {
        return $this->FlgDecondADWS;
    }

    /**
     * @param int|null $FlgDecondADWS
     */
    public function setFlgDecondADWS($FlgDecondADWS)
    {
        $this->FlgDecondADWS = $FlgDecondADWS;
    }

    /**
     * @return int|null
     */
    public function getDesi2ArtWS()
    {
        return $this->Desi2ArtWS;
    }

    /**
     * @param int|null $Desi2ArtWS
     */
    public function setDesi2ArtWS($Desi2ArtWS)
    {
        $this->Desi2ArtWS = $Desi2ArtWS;
    }

    /**
     * @return int|null
     */
    public function getIdFourWS()
    {
        return $this->IdFourWS;
    }

    /**
     * @param int|null $IdFourWS
     */
    public function setIdFourWS($IdFourWS)
    {
        $this->IdFourWS = $IdFourWS;
    }

    /**
     * @return int|null
     */
    public function getNomDepWS()
    {
        return $this->NomDepWS;
    }

    /**
     * @param int|null $NomDepWS
     */
    public function setNomDepWS($NomDepWS)
    {
        $this->NomDepWS = $NomDepWS;
    }

    /**
     * @return int|null
     */
    public function getCodSuspADWS()
    {
        return $this->CodSuspADWS;
    }

    /**
     * @param int|null $CodSuspADWS
     */
    public function setCodSuspADWS($CodSuspADWS)
    {
        $this->CodSuspADWS = $CodSuspADWS;
    }

    /**
     * @return int|null
     */
    public function getMultimediaArtWS()
    {
        return $this->MultimediaArtWS;
    }

    /**
     * @param int|null $MultimediaArtWS
     */
    public function setMultimediaArtWS($MultimediaArtWS)
    {
        $this->MultimediaArtWS = $MultimediaArtWS;
    }

    /**
     * @return int|null
     */
    public function getComTechADWS()
    {
        return $this->ComTechADWS;
    }

    /**
     * @param int|null $ComTechADWS
     */
    public function setComTechADWS($ComTechADWS)
    {
        $this->ComTechADWS = $ComTechADWS;
    }

    /**
     * @return int|null
     */
    public function getDocLieWS()
    {
        return $this->DocLieWS;
    }

    /**
     * @param int|null $DocLieWS
     */
    public function setDocLieWS($DocLieWS)
    {
        $this->DocLieWS = $DocLieWS;
    }

    /**
     * @return int|null
     */
    public function getGenCodADWS()
    {
        return $this->GenCodADWS;
    }

    /**
     * @param int|null $GenCodADWS
     */
    public function setGenCodADWS($GenCodADWS)
    {
        $this->GenCodADWS = $GenCodADWS;
    }

    /**
     * @return int|null
     */
    public function getCodEcoTaxeADWS()
    {
        return $this->CodEcoTaxeADWS;
    }

    /**
     * @param int|null $CodEcoTaxeADWS
     */
    public function setCodEcoTaxeADWS($CodEcoTaxeADWS)
    {
        $this->CodEcoTaxeADWS = $CodEcoTaxeADWS;
    }

    /**
     * @return int|null
     */
    public function getMtEcoTaxeWS()
    {
        return $this->MtEcoTaxeWS;
    }

    /**
     * @param int|null $MtEcoTaxeWS
     */
    public function setMtEcoTaxeWS($MtEcoTaxeWS)
    {
        $this->MtEcoTaxeWS = $MtEcoTaxeWS;
    }

    /**
     * @return int|null
     */
    public function getValEcoTaxeWS()
    {
        return $this->ValEcoTaxeWS;
    }

    /**
     * @param int|null $ValEcoTaxeWS
     */
    public function setValEcoTaxeWS($ValEcoTaxeWS)
    {
        $this->ValEcoTaxeWS = $ValEcoTaxeWS;
    }

    /**
     * @return int|null
     */
    public function getIdDepPlatWS()
    {
        return $this->IdDepPlatWS;
    }

    /**
     * @param int|null $IdDepPlatWS
     */
    public function setIdDepPlatWS($IdDepPlatWS)
    {
        $this->IdDepPlatWS = $IdDepPlatWS;
    }

    /**
     * @return int|null
     */
    public function getIdADFWS()
    {
        return $this->IdADFWS;
    }

    /**
     * @param int|null $IdADFWS
     */
    public function setIdADFWS($IdADFWS)
    {
        $this->IdADFWS = $IdADFWS;
    }

    /**
     * @return int|null
     */
    public function getGenCod1ADFWS()
    {
        return $this->GenCod1ADFWS;
    }

    /**
     * @param int|null $GenCod1ADFWS
     */
    public function setGenCod1ADFWS($GenCod1ADFWS)
    {
        $this->GenCod1ADFWS = $GenCod1ADFWS;
    }

    /**
     * @return int|null
     */
    public function getGenCod2ADFWS()
    {
        return $this->GenCod2ADFWS;
    }

    /**
     * @param int|null $GenCod2ADFWS
     */
    public function setGenCod2ADFWS($GenCod2ADFWS)
    {
        $this->GenCod2ADFWS = $GenCod2ADFWS;
    }

    /**
     * @return int|null
     */
    public function getCodCatADWS()
    {
        return $this->CodCatADWS;
    }

    /**
     * @param int|null $CodCatADWS
     */
    public function setCodCatADWS($CodCatADWS)
    {
        $this->CodCatADWS = $CodCatADWS;
    }

    /**
     * @return float|null
     */
    public function getPrixNetWS()
    {
        return $this->PrixNetWS;
    }

    /**
     * @param float|null $PrixNetWS
     */
    public function setPrixNetWS($PrixNetWS)
    {
        $this->PrixNetWS = $PrixNetWS;
    }

    /**
     * @return float|null
     */
    public function getPrixPubCliWS()
    {
        return $this->PrixPubCliWS;
    }

    /**
     * @param float|null $PrixPubCliWS
     */
    public function setPrixPubCliWS($PrixPubCliWS)
    {
        $this->PrixPubCliWS = $PrixPubCliWS;
    }

    /**
     * @return null|string
     */
    public function getTypeTarifWS()
    {
        return $this->TypeTarifWS;
    }

    /**
     * @param null|string $TypeTarifWS
     */
    public function setTypeTarifWS($TypeTarifWS)
    {
        $this->TypeTarifWS = $TypeTarifWS;
    }

    /**
     * @return float|null
     */
    public function getPrixRevConvADWS()
    {
        return $this->PrixRevConvADWS;
    }

    /**
     * @param float|null $PrixRevConvADWS
     */
    public function setPrixRevConvADWS($PrixRevConvADWS)
    {
        $this->PrixRevConvADWS = $PrixRevConvADWS;
    }

    /**
     * @return float|null
     */
    public function getPrixRevReelADWS()
    {
        return $this->PrixRevReelADWS;
    }

    /**
     * @param float|null $PrixRevReelADWS
     */
    public function setPrixRevReelADWS($PrixRevReelADWS)
    {
        $this->PrixRevReelADWS = $PrixRevReelADWS;
    }

    /**
     * @return float|null
     */
    public function getCoefPRRADWS()
    {
        return $this->CoefPRRADWS;
    }

    /**
     * @param float|null $CoefPRRADWS
     */
    public function setCoefPRRADWS($CoefPRRADWS)
    {
        $this->CoefPRRADWS = $CoefPRRADWS;
    }

    /**
     * @return float|null
     */
    public function getCoefPRCADWS()
    {
        return $this->CoefPRCADWS;
    }

    /**
     * @param float|null $CoefPRCADWS
     */
    public function setCoefPRCADWS($CoefPRCADWS)
    {
        $this->CoefPRCADWS = $CoefPRCADWS;
    }

    /**
     * @return float|null
     */
    public function getMargeReelleADWS()
    {
        return $this->MargeReelleADWS;
    }

    /**
     * @param float|null $MargeReelleADWS
     */
    public function setMargeReelleADWS($MargeReelleADWS)
    {
        $this->MargeReelleADWS = $MargeReelleADWS;
    }

    /**
     * @return float|null
     */
    public function getMargeConvADWS()
    {
        return $this->MargeConvADWS;
    }

    /**
     * @param float|null $MargeConvADWS
     */
    public function setMargeConvADWS($MargeConvADWS)
    {
        $this->MargeConvADWS = $MargeConvADWS;
    }

    

    /**
     * @return array|null
     */
    public function getStocks()
    {
        return $this->Stocks;
    }

    /**
     * @param array|null $stocks
     */
    public function setStocks($stocks)
    {
        $this->Stocks = $stocks;
    }

    public function getAffinageGroupe(): ?AffinageGroupe
    {
        return $this->affinageGroupe;
    }

    public function setAffinageGroupe(?AffinageGroupe $affinageGroupe): self
    {
        $this->affinageGroupe = $affinageGroupe;

        return $this;
    }


    /* ***********************

    FIN :: A HYDRATER AVEC API WEB SERVICE

    ************************ */

}
