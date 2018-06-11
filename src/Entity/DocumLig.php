<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

//@ApiResource

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="DocumLig")
 */
class DocumLig
{
    /**
     * @ORM\Column(name="IdDL", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $IdDL;

    /**
     * @ORM\Column(name="IdDE", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDE;

    /**
     * @ORM\Column(name="IdDocDL", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDocDL;

    /**
     * @ORM\Column(name="IdDocDE", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDocDE;

    /**
     * @ORM\Column(name="IdDocSecDE", type="integer", options={"default":0}, nullable=true)
     */
    private $IdDocSecDE;

    /**
     * @ORM\Column(name="IdAD", type="integer", options={"default":0}, nullable=true)
     */
    private $IdAD;

    /**
     * @ORM\Column(name="NumDL", type="integer", options={"default":0}, nullable=true)
     */
    private $NumDL;

    /**
     * @ORM\Column(name="NbUStoDL", type="integer", options={"default":0}, nullable=true)
     */
    private $NbUStoDL;

    /**
     * @ORM\Column(name="UStoDL", type="string", length=50, nullable=true)
     */
    private $UStoDL;

    /**
     * @ORM\Column(name="MontHTDL", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $MontHTDL;

    /**
     * @ORM\Column(name="MontTTCDL", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $MontTTCDL;

    /**
     * @ORM\Column(name="PrixNetDL", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $PrixNetDL;

    /**
     * @ORM\Column(name="NbUVteDL", type="integer", options={"default":0}, nullable=true)
     */
    private $NbUVteDL;

    /**
     * @ORM\Column(name="UVteDL", type="string", length=50, nullable=true)
     */
    private $UVteDL;

    /**
     * @ORM\Column(name="ComDL", type="text", nullable=true)
     */
    private $ComDL;

    /**
     * @return mixed
     */
    public function getIdDL()
    {
        return $this->IdDL;
    }

    /**
     * @param mixed $IdDL
     */
    public function setIdDL($IdDL): void
    {
        $this->IdDL = $IdDL;
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
    public function setIdDE($IdDE): void
    {
        $this->IdDE = $IdDE;
    }

    /**
     * @return mixed
     */
    public function getIdDocDL()
    {
        return $this->IdDocDL;
    }

    /**
     * @param mixed $IdDocDL
     */
    public function setIdDocDL($IdDocDL): void
    {
        $this->IdDocDL = $IdDocDL;
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
    public function getIdDocSecDE()
    {
        return $this->IdDocSecDE;
    }

    /**
     * @param mixed $IdDocSecDE
     */
    public function setIdDocSecDE($IdDocSecDE): void
    {
        $this->IdDocSecDE = $IdDocSecDE;
    }

    /**
     * @return mixed
     */
    public function getIdAD()
    {
        return $this->IdAD;
    }

    /**
     * @param mixed $IdAD
     */
    public function setIdAD($IdAD): void
    {
        $this->IdAD = $IdAD;
    }

    /**
     * @return mixed
     */
    public function getNumDL()
    {
        return $this->NumDL;
    }

    /**
     * @param mixed $NumDL
     */
    public function setNumDL($NumDL): void
    {
        $this->NumDL = $NumDL;
    }

    /**
     * @return mixed
     */
    public function getNbUStoDL()
    {
        return $this->NbUStoDL;
    }

    /**
     * @param mixed $NbUStoDL
     */
    public function setNbUStoDL($NbUStoDL): void
    {
        $this->NbUStoDL = $NbUStoDL;
    }

    /**
     * @return mixed
     */
    public function getUStoDL()
    {
        return $this->UStoDL;
    }

    /**
     * @param mixed $UStoDL
     */
    public function setUStoDL($UStoDL): void
    {
        $this->UStoDL = $UStoDL;
    }

    /**
     * @return mixed
     */
    public function getMontHTDL()
    {
        return $this->MontHTDL;
    }

    /**
     * @param mixed $MontHTDL
     */
    public function setMontHTDL($MontHTDL): void
    {
        $this->MontHTDL = $MontHTDL;
    }

    /**
     * @return mixed
     */
    public function getMontTTCDL()
    {
        return $this->MontTTCDL;
    }

    /**
     * @param mixed $MontTTCDL
     */
    public function setMontTTCDL($MontTTCDL): void
    {
        $this->MontTTCDL = $MontTTCDL;
    }

    /**
     * @return mixed
     */
    public function getPrixNetDL()
    {
        return $this->PrixNetDL;
    }

    /**
     * @param mixed $PrixNetDL
     */
    public function setPrixNetDL($PrixNetDL): void
    {
        $this->PrixNetDL = $PrixNetDL;
    }

    /**
     * @return mixed
     */
    public function getNbUVteDL()
    {
        return $this->NbUVteDL;
    }

    /**
     * @param mixed $NbUVteDL
     */
    public function setNbUVteDL($NbUVteDL): void
    {
        $this->NbUVteDL = $NbUVteDL;
    }

    /**
     * @return mixed
     */
    public function getUVteDL()
    {
        return $this->UVteDL;
    }

    /**
     * @param mixed $UVteDL
     */
    public function setUVteDL($UVteDL): void
    {
        $this->UVteDL = $UVteDL;
    }

    /**
     * @return mixed
     */
    public function getComDL()
    {
        return $this->ComDL;
    }

    /**
     * @param mixed $ComDL
     */
    public function setComDL($ComDL): void
    {
        $this->ComDL = $ComDL;
    }


}