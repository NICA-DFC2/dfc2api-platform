<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource
 *
 * Entité qui représente une entête de panier. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ORM\Entity
 * @ORM\Table(name="Panier")
 */
class Panier
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="IdDE", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDE;

    /**
     * @ORM\Column(name="IdDocDE", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDocDE;

    /**
     * @ORM\Column(name="NumDE", type="integer", options={"default":0}, nullable=true)
     */
    private $NumDE;

    /**
     * @ORM\Column(name="DateDE", type="date", nullable=true)
     */
    private $DateDE;

    /**
     * @ORM\Column(name="IdCli", type="integer", options={"default":0}, nullable=true)
     */
    private $IdCli;

    /**
     * @ORM\Column(name="IdSoc", type="integer", options={"default":0}, nullable=true)
     */
    private $IdSoc;

    /**
     * @ORM\Column(name="EtatDE", type="string", length=1, nullable=true)
     */
    private $EtatDE;

    /**
     * @ORM\Column(name="TypeDE", type="string", length=50, nullable=true)
     */
    private $TypeDE;

    /**
     * @ORM\Column(name="RefDE", type="string", length=255, nullable=true)
     */
    private $RefDE;

    /**
     * @ORM\Column(name="MontTTCDE", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $MontTTCDE;

    /**
     * @ORM\Column(name="MontHTDE", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $MontHTDE;

    /**
     * @ORM\Column(name="ComDE", type="text", nullable=true)
     */
    private $ComDE;

    /**
     * @ORM\Column(name="DateLivrDE", type="date", nullable=true)
     */
    private $DateLivrDE;

    /**
     * @ORM\Column(name="IdFac", type="integer", options={"default":0}, nullable=true)
     */
    private $IdFac;

    /**
     * @ORM\Column(name="IdDepLiv", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDepLiv;

    /**
     * @ORM\Column(name="FlgValidDE", type="boolean")
     */
    private $FlgValidDE;

    /**
     * @ORM\Column(name="MotsClesAutoDE", type="text", nullable=true)
     */
    private $MotsClesAutoDE;


    private $PanierLig;


    public function __construct()
    {
        $this->PanierLig = new ArrayCollection();
    }


    /**
     * @return Collection|PanierLig[]
     */
    public function getPanierLig(): Collection
    {
        return $this->PanierLig;
    }

    public function setPanierLig(Collection $PanierLig)
    {
        $this->PanierLig = $PanierLig;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $Id
     */
    public function setId($Id)
    {
        $this->id = $Id;
    }

    /**
     * @return mixed
     */
    public function getIdDE()
    {
        return $this->IdDE;
    }

    /**
     * @param mixed $IdDE
     */
    public function setIdDE($IdDE)
    {
        $this->IdDE = $IdDE;
    }

    /**
     * @return mixed
     */
    public function getIdDocDE()
    {
        return $this->IdDocDE;
    }

    /**
     * @param mixed $IdDocDE
     */
    public function setIdDocDE($IdDocDE)
    {
        $this->IdDocDE = $IdDocDE;
    }

    /**
     * @return mixed
     */
    public function getNumDE()
    {
        return $this->NumDE;
    }

    /**
     * @param mixed $NumDE
     */
    public function setNumDE($NumDE)
    {
        $this->NumDE = $NumDE;
    }

    /**
     * @return mixed
     */
    public function getDateDE()
    {
        return $this->DateDE;
    }

    /**
     * @param mixed $DateDE
     */
    public function setDateDE($DateDE)
    {
        $this->DateDE = $DateDE;
    }

    /**
     * @return mixed
     */
    public function getIdCli()
    {
        return $this->IdCli;
    }

    /**
     * @param mixed $IdCli
     */
    public function setIdCli($IdCli)
    {
        $this->IdCli = $IdCli;
    }

    /**
     * @return mixed
     */
    public function getIdSoc()
    {
        return $this->IdSoc;
    }

    /**
     * @param mixed $IdSoc
     */
    public function setIdSoc($IdSoc)
    {
        $this->IdSoc = $IdSoc;
    }

    /**
     * @return mixed
     */
    public function getEtatDE()
    {
        return $this->EtatDE;
    }

    /**
     * @param mixed $EtatDE
     */
    public function setEtatDE($EtatDE)
    {
        $this->EtatDE = $EtatDE;
    }

    /**
     * @return mixed
     */
    public function getTypeDE()
    {
        return $this->TypeDE;
    }

    /**
     * @param mixed $TypeDE
     */
    public function setTypeDE($TypeDE)
    {
        $this->TypeDE = $TypeDE;
    }

    /**
     * @return mixed
     */
    public function getRefDE()
    {
        return $this->RefDE;
    }

    /**
     * @param mixed $RefDE
     */
    public function setRefDE($RefDE)
    {
        $this->RefDE = $RefDE;
    }

    /**
     * @return mixed
     */
    public function getMontTTCDE()
    {
        return $this->MontTTCDE;
    }

    /**
     * @param mixed $MontTTCDE
     */
    public function setMontTTCDE($MontTTCDE)
    {
        $this->MontTTCDE = $MontTTCDE;
    }

    /**
     * @return mixed
     */
    public function getMontHTDE()
    {
        return $this->MontHTDE;
    }

    /**
     * @param mixed $MontHTDE
     */
    public function setMontHTDE($MontHTDE)
    {
        $this->MontHTDE = $MontHTDE;
    }

    /**
     * @return mixed
     */
    public function getComDE()
    {
        return $this->ComDE;
    }

    /**
     * @param mixed $ComDE
     */
    public function setComDE($ComDE)
    {
        $this->ComDE = $ComDE;
    }

    /**
     * @return mixed
     */
    public function getDateLivrDE()
    {
        return $this->DateLivrDE;
    }

    /**
     * @param mixed $DateLivrDE
     */
    public function setDateLivrDE($DateLivrDE)
    {
        $this->DateLivrDE = $DateLivrDE;
    }

    /**
     * @return mixed
     */
    public function getIdFac()
    {
        return $this->IdFac;
    }

    /**
     * @param mixed $IdFac
     */
    public function setIdFac($IdFac)
    {
        $this->IdFac = $IdFac;
    }

    /**
     * @return mixed
     */
    public function getIdDepLiv()
    {
        return $this->IdDepLiv;
    }

    /**
     * @param mixed $IdDepLiv
     */
    public function setIdDepLiv($IdDepLiv)
    {
        $this->IdDepLiv = $IdDepLiv;
    }

    /**
     * @return mixed
     */
    public function getFlgValidDE()
    {
        return $this->FlgValidDE;
    }

    /**
     * @param mixed $FlgValidDE
     */
    public function setFlgValidDE($FlgValidDE)
    {
        $this->FlgValidDE = $FlgValidDE;
    }

    /**
     * @return mixed
     */
    public function getMotsClesAutoDE()
    {
        return $this->MotsClesAutoDE;
    }

    /**
     * @param mixed $MotsClesAutoDE
     */
    public function setMotsClesAutoDE($MotsClesAutoDE)
    {
        $this->MotsClesAutoDE = $MotsClesAutoDE;
    }


}