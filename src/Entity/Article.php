<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Swagger\Annotations as SWG;

/**
 * Entité qui représente un Article. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *     itemOperations={
 *     "get"={"method"="GET"},
 *     "logistic"={
 *         "method"="GET",
 *         "path"="/articles/{id}/logistic",
 *         "requirements"={"id"="\d+"},
 *         "access_control"="is_granted('ROLE_USER')"
 *     },
 *     "anduser"={
 *         "method"="GET",
 *         "path"="/articles/{id}/and-user",
 *         "requirements"={"id"="\d+"},
 *         "access_control"="is_granted('ROLE_USER')"
 *     },
 *     "prixnet"={
 *         "method"="GET",
 *         "path"="/articles/{id}/prix-net",
 *         "requirements"={"id"="\d+"},
 *         "access_control"="is_granted('ROLE_USER')"
 *     },
 *     "prixnetlogistic"={
 *         "method"="GET",
 *         "path"="/articles/{id}/prix-net/logistic",
 *         "requirements"={"id"="\d+"},
 *         "access_control"="is_granted('ROLE_USER')"
 *     },
 *     "prixnetanduser"={
 *         "method"="GET",
 *         "path"="/articles/{id}/prix-net/and-user",
 *         "requirements"={"id"="\d+"},
 *         "access_control"="is_granted('ROLE_USER')"
 *     }
 * })
 * @ORM\Entity
 * @ORM\Table(name="Article")
 * @ApiFilter(SearchFilter::class, properties={"IdAD": "exact", "DesiAD": "partial", "DesiPrincAD": "partial"})
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
     */
    private $DesiAD;

    /**
     * Désignation commune à tous les articles de la même déclinaison
     * @ORM\Column(name="DesiPrincAD", type="string", length=255, nullable=true)
     */
    private $DesiPrincAD;

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
     * @var array
     * @SWG\Property(description="Stocks disponibles Evolubat de l'article dans les différents dépots.", type="array")
     */
    private $Stocks = [];


    /**
     * ArtDet constructor.
     */
    public function __construct()
    {

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
    public function setIdAD($IdAD): void
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
    public function setIdArtEvoAD($IdArtEvoAD): void
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
    public function setDesiAD($DesiAD): void
    {
        $this->DesiAD = $DesiAD;
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
    public function setDesiPrincAD($DesiPrincAD): void
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
    public function setDescriWebAD($DescriWebAD): void
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
    public function setDescriCatalogAD($DescriCatalogAD): void
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
    public function setMediasAD($MediasAD): void
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
    public function setPlusAD($PlusAD): void
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
    public function setMotsClesAD($MotsClesAD): void
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
    public function setOrdreAD($OrdreAD): void
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
    public function setNumDecliAD($NumDecliAD): void
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
    public function setFlgAncAD($FlgAncAD): void
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
    public function setFlgCatalogAD($FlgCatalogAD): void
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
    public function setFlgPrincAD($FlgPrincAD): void
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
    public function setFlgDestockAD($FlgDestockAD): void
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
    public function setFlgHorsMarqueAD($FlgHorsMarqueAD): void
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
    public function setFlgNouvAD($FlgNouvAD): void
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
    public function setFlgPromoAD($FlgPromoAD): void
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
    public function setFlgVisibleAD($FlgVisibleAD): void
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
    public function setFlgEclBleuAD($FlgEclBleuAD): void
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
    public function setFlgEclRoseAD($FlgEclRoseAD): void
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
    public function setFlgEclVertAD($FlgEclVertAD): void
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
    public function setFlgEclOrangeAD($FlgEclOrangeAD): void
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
    public function setIdFourAD($IdFourAD): void
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
    public function setDateCreAD($DateCreAD): void
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
    public function setDateModAD($DateModAD): void
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
    public function setUCreAD($UCreAD): void
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
    public function setUModAD($UModAD): void
    {
        $this->UModAD = $UModAD;
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
    public function setIdADWS($IdADWS): void
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
    public function setNoADWS($NoADWS): void
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
    public function setCodADFWS($CodADFWS): void
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
    public function setDesiADWS($DesiADWS): void
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
    public function setCodADWS($CodADWS): void
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
    public function setUVteADWS($UVteADWS): void
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
    public function setUStoADWS($UStoADWS): void
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
    public function setPrixPubADWS($PrixPubADWS): void
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
    public function setPrixNetCliADWS($PrixNetCliADWS): void
    {
        $this->PrixNetCliADWS = $PrixNetCliADWS;
    }

    /**
     * @return array
     */
    public function getStocks(): array
    {
        return $this->Stocks;
    }

    /**
     * @param array $Stocks
     */
    public function setStocks(array $Stocks): void
    {
        $this->Stocks = $Stocks;
    }



    /* ***********************

    FIN :: A HYDRATER AVEC API WEB SERVICE

    ************************ */

}
