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
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="old_id", type="integer")
     */
    private $oldId;

    /**
     * @ORM\Column(name="old_id_parent", type="integer", nullable=true)
     */
    private $oldIdParent;




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
     * @OneToMany(targetEntity="Category", mappedBy="parent", cascade={"persist"})
     */
    private $children;

    /**
     * Many Categories have One parent Category.
     * @ManyToOne(targetEntity="Category", inversedBy="children", cascade={"persist"})
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     * @ApiAssert\ParentCategoryIsEmpty()
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="categories", cascade={"persist"})
     * @ORM\JoinTable(name="article_category",
     *      joinColumns={@JoinColumn(name="category_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="article_id", referencedColumnName="IdAD")}
     *      )
     */
    private $articles;


    public function __construct() {
        $this->children = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function setId(int $id){
        $this->$id = $id;
        return $this;
}
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOldId()
    {
        return $this->oldId;

    }

    /**
     * @param mixed $oldId
     */
    public function setOldId($oldId)
    {
        $this->oldId = $oldId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOldIdParent()
    {
        return $this->oldIdParent;
    }

    /**
     * @param mixed $oldIdParent
     */
    public function setOldIdParent($oldIdParent)
    {
        $this->oldIdParent = $oldIdParent;
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
     * @return Collection|Category[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChildren(Category $children): self
    {
        if (!$this->children->contains($children)) {
            $this->children[] = $children;
            $children->setParent($this);
        }

        return $this;
    }

    /**
     * @param Category $children
     * @return Category
     */
    public function removeChildren(Category $children): self
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
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     * @return $this
     */
    public function setParent(Category $parent)
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
