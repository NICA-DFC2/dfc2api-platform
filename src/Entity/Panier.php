<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\PanierLigne;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity
 * @ORM\Table(name="panier")
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $total_price;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="panier")
     */
    private $user;

    /**
    * @ORM\OneToMany(targetEntity="PanierLigne", mappedBy="panier")
     */
    protected $lignes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set total_price
     *
     * @param string $totalPrice
     * @return Panier
     */
    public function setTotalPrice(?string $totalPrice)
    {
        $this->total_price = $totalPrice;
        return $this;
    }

    /**
     * Get total_price
     *
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Panier
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add lignes
     *
     * @param PanierLigne $lignes
     * @return Panier
     */
    public function addLignes(PanierLigne $lignes)
    {
        $this->lignes[] = $lignes;
        return $this;
    }

    /**
     * Remove lignes
     *
     * @param PanierLigne $lignes
     */
    public function removeLigne(PanierLigne $lignes)
    {
        $this->lignes->removeElement($lignes);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignes()
    {
        return $this->lignes;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Panier
     */
    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }


}