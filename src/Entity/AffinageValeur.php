<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AffinageValeurRepository")
 */
class AffinageValeur
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AffinageLib", mappedBy="valeurs")
     */
    private $libelles;

    public function __construct()
    {
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

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return Collection|AffinageLib[]
     */
    public function getLibelles(): Collection
    {
        return $this->libelles;
    }

    public function addAffinageLib(AffinageLib $libelle): self
    {
        if (!$this->libelles->contains($libelle)) {
            $this->libelles[] = $libelle;
            $libelle->addValeur($this);
        }

        return $this;
    }

    public function removeAffinageLib(AffinageLib $libelle): self
    {
        if ($this->libelles->contains($libelle)) {
            $this->libelles->removeElement($libelle);
            $libelle->removeValeur($this);
        }

        return $this;
    }
}
