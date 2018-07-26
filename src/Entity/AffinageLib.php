<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AffinageLibRepository")
 */
class AffinageLib
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
     * @ORM\ManyToMany(targetEntity="App\Entity\AffinageGroupe", mappedBy="libelles")
     */
    private $groupes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AffinageValeur", inversedBy="libelles")
     */
    private $valeurs;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->valeurs = new ArrayCollection();
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
     * @return Collection|AffinageGroupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(AffinageGroupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addLibelle($this);
        }

        return $this;
    }

    public function removeGroupe(AffinageGroupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeLibelle($this);
        }

        return $this;
    }

    /**
     * @return Collection|AffinageValeur[]
     */
    public function getValeurs(): Collection
    {
        return $this->valeurs;
    }

    public function addValeur(AffinageValeur $valeur): self
    {
        if (!$this->valeurs->contains($valeur)) {
            $this->valeurs[] = $valeur;
        }

        return $this;
    }

    public function removeValeur(AffinageValeur $valeur): self
    {
        if ($this->valeurs->contains($valeur)) {
            $this->valeurs->removeElement($valeur);
        }

        return $this;
    }
}
