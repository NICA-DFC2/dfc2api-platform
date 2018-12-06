<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity
 * @ORM\Table(name="panier_ligne")
 */
class PanierLigne
{

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="lignes")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Panier", inversedBy="lignes")
     */
    protected $panier;

    /**
     * Set article
     *
     * @param Article $article
     * @return PanierLigne
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;
        return $this;
    }
    /**
     * Get article
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }
    /**
     * Set panier
     *
     * @param Panier $panier
     * @return PanierLigne
     */
    public function setPanier(Panier $panier)
    {
        $this->panier = $panier;
        return $this;
    }
    /**
     * Get panier
     *
     * @return Panier
     */
    public function getPanier()
    {
        return $this->panier;
    }
    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return PanierLigne
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}