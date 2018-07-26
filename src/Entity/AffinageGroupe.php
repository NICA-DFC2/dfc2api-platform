<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AffinageGroupeRepository")
 */
class AffinageGroupe
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
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="affinageGroupe")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AffinageLib", inversedBy="groupes")
     */
    private $libelles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->libelles = new ArrayCollection();
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
            $article->setAffinageGroupe($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getAffinageGroupe() === $this) {
                $article->setAffinageGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AffinageLib[]
     */
    public function getLibelles(): Collection
    {
        return $this->libelles;
    }

    public function addLibelle(AffinageLib $libelle): self
    {
        if (!$this->libelles->contains($libelle)) {
            $this->libelles[] = $libelle;
        }

        return $this;
    }

    public function removeLibelle(AffinageLib $libelle): self
    {
        if ($this->libelles->contains($libelle)) {
            $this->libelles->removeElement($libelle);
        }

        return $this;
    }
}
