<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

//@ApiResource


/**
 *
 * @ORM\Entity
 * @ORM\Table(name="DocumEnt")
 */
class DocumEnt
{
    /**
     * @ORM\Column(name="IdDE", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
    public function setIdDE($IdDE): void
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
    public function setIdDocDE($IdDocDE): void
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
    public function setNumDE($NumDE): void
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
    public function setDateDE($DateDE): void
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
    public function setIdCli($IdCli): void
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
    public function setIdSoc($IdSoc): void
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
    public function setEtatDE($EtatDE): void
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
    public function setTypeDE($TypeDE): void
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
    public function setRefDE($RefDE): void
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
    public function setMontTTCDE($MontTTCDE): void
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
    public function setMontHTDE($MontHTDE): void
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
    public function setComDE($ComDE): void
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
    public function setDateLivrDE($DateLivrDE): void
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
    public function setIdFac($IdFac): void
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
    public function setIdDepLiv($IdDepLiv): void
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
    public function setFlgValidDE($FlgValidDE): void
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
    public function setMotsClesAutoDE($MotsClesAutoDE): void
    {
        $this->MotsClesAutoDE = $MotsClesAutoDE;
    }


}