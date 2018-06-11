<?php

namespace App\Services\Objets;

class WsDocumLig
{
    private $IdDL;
    private $IdDE;
    private $IdDocDL;
    private $IdDocDE;
    private $IdDocSecDE;
    private $IdAD;
    private $NumDL;
    private $NbUStoDL;
    private $UStoDL;
    private $MontHTDL;
    private $MontTTCDL;
    private $PrixNetDL;
    private $NbUVteDL;
    private $UVteDL;
    private $ComDL;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdDL($json_object->{'IdDL'});
            $this->setIdDE($json_object->{'IdDE'});
            $this->setIdDocDL($json_object->{'IdDocDL'});
            $this->setIdDocDE($json_object->{'IdDocDE'});
            $this->setIdDocSecDE($json_object->{'IdDocSecDE'});
            $this->setIdAD($json_object->{'IdAD'});
            $this->setNumDL($json_object->{'NumDL'});
            $this->setNbUStoDL($json_object->{'NbUStoDL'});
            $this->setUStoDL($json_object->{'UStoDL'});
            $this->setMontHTDL($json_object->{'MontHTDL'});
            $this->setMontTTCDL($json_object->{'MontTTCDL'});
            $this->setPrixNetDL($json_object->{'PrixNetDL'});
            $this->setNbUVteDL($json_object->{'NbUVteDL'});
            $this->setUVteDL($json_object->{'UVteDL'});
            $this->setComDL($json_object->{'ComDL'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdDL": '.$this->getIdDL().' ,';
        $string .= '"IdDE": '.$this->getIdDE().' ,';
        $string .= '"IdDocDL": '.$this->getIdDocDL().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"IdDocSecDE": '.$this->getIdDocSecDE().' ,';
        $string .= '"IdAD": '.$this->getIdAD().' ,';
        $string .= '"NumDL": '.$this->getNumDL().' ,';
        $string .= '"NbUStoDL": '.$this->getNbUStoDL().' ,';
        $string .= '"UStoDL": "'.$this->getUStoDL().'" ,';
        $string .= '"MontHTDL": '.$this->getMontHTDL().' ,';
        $string .= '"MontTTCDL": '.$this->getMontTTCDL().' ,';
        $string .= '"PrixNetDL": '.$this->getPrixNetDL().' ,';
        $string .= '"NbUVteDL": '.$this->getNbUVteDL().' ,';
        $string .= '"UVteDL": "'.$this->getUVteDL().'" ,';
        $string .= '"ComDL": "'.$this->getComDL().'"';
        $string .= '}';

        return $string;
    }


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