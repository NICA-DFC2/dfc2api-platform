<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Validator\Constraints as ApiAssert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ArticleCategorieRepository")
 */
class ArticleCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * One Category has Many children ArticleCategories.
     * @OneToMany(targetEntity="ArticleCategorie", mappedBy="parent")
     */
    private $children;

    /**
     * Many ArticleCategories have One parent ArticleCategory.
     * @ManyToOne(targetEntity="ArticleCategorie", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     * @ApiAssert\ParentArticleCategorieIsEmpty()
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", inversedBy="articleCategories")
     */
    private $articles;
    // ...

    public function __construct() {
        $this->children = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
        return $this;
    }


    /**
     * @return Collection|ArticleCategorie[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChildren(ArticleCategorie $children): self
    {
        if (!$this->children->contains($children)) {
            $this->children[] = $children;
            $children->setParent($this);
        }

        return $this;
    }

    /**
     * @param ArticleCategorie $children
     * @return ArticleCategorie
     */
    public function removeChildren(ArticleCategorie $children): self
    {
        if ($this->children->contains($children)) {
            $this->children->removeElement($children);
            // set the owning side to null (unless already changed)
            if ($children->getParent() === $this) {
                $children->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return ArticleCategorie
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param ArticleCategorie $parent
     * @return $this
     */
    public function setParent(ArticleCategorie $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
        }

        return $this;
    }


}
