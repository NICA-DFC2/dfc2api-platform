<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"user.id_cli": "exact"})
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
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_created;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_update;

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
        $this->setDateCreated(new \DateTime('now'));
        $this->setDateUpdate(new \DateTime('now'));
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

    /**
     * Get date_created
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set date_created
     *
     * @param mixed $date_created
     * @return Panier
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;
        return $this;
    }

    /**
     * Get date_update
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->date_update;
    }

    /**
     * Set date_update
     *
     * @param mixed $date_update
     * @return Panier
     */
    public function setDateUpdate($date_update)
    {
        $this->date_update = $date_update;
        return $this;
    }


}