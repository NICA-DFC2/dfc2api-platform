<?php

namespace App\Entity;

use App\Services\Objets\WsUtil;

class Util
{
    public $IdU;
    public $IdDep;
    public $PassWU;
    public $IdSoc;
    public $IdSal;
    public $CodLogU;
    public $NomSoc;
    public $CodU;
    public $IdGrpU;
    public $NomDep;
    public $NomSal;
    public $PrenSal;
    public $MailSal;
    public $NomU;
    public $CodSal;
    public $FlgSocDefautUtilSoc = false;
    

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct(WsUtil $json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdU($json_object->{'IdU'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setPassWU($json_object->{'PassWU'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setIdSal($json_object->{'IdSal'});
            $this->setCodLogU($json_object->{'CodLogU'});
            $this->setNomSoc($json_object->{'NomSoc'});
            $this->setCodU($json_object->{'CodU'});
            $this->setIdGrpU($json_object->{'IdGrpU'});
            $this->setNomDep($json_object->{'NomDep'});
            $this->setNomSal($json_object->{'NomSal'});
            $this->setMailSal($json_object->{'MailSal'});
            $this->setNomU($json_object->{'NomU'});
            $this->setCodSal($json_object->{'CodSal'});
            $this->setFlgSocDefautUtilSoc($json_object->{'flgSocDefautUtilSoc'});
        }
    }

    /**
     * @return mixed
     */
    public function getIdU()
    {
        return $this->IdU;
    }

    /**
     * @param mixed $IdU
     */
    public function setIdU($IdU)
    {
        $this->IdU = $IdU;
    }

    /**
     * @return mixed
     */
    public function getIdDep()
    {
        return $this->IdDep;
    }

    /**
     * @param mixed $IdDep
     */
    public function setIdDep($IdDep)
    {
        $this->IdDep = $IdDep;
    }

    /**
     * @return mixed
     */
    public function getPassWU()
    {
        return $this->PassWU;
    }

    /**
     * @param mixed $PassWU
     */
    public function setPassWU($PassWU)
    {
        $this->PassWU = $PassWU;
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
    public function getIdSal()
    {
        return $this->IdSal;
    }

    /**
     * @param mixed $IdSal
     */
    public function setIdSal($IdSal)
    {
        $this->IdSal = $IdSal;
    }

    /**
     * @return mixed
     */
    public function getCodLogU()
    {
        return $this->CodLogU;
    }

    /**
     * @param mixed $CodLogU
     */
    public function setCodLogU($CodLogU)
    {
        $this->CodLogU = $CodLogU;
    }

    /**
     * @return mixed
     */
    public function getNomSoc()
    {
        return $this->NomSoc;
    }

    /**
     * @param mixed $NomSoc
     */
    public function setNomSoc($NomSoc)
    {
        $this->NomSoc = $NomSoc;
    }

    /**
     * @return mixed
     */
    public function getCodU()
    {
        return $this->CodU;
    }

    /**
     * @param mixed $CodU
     */
    public function setCodU($CodU)
    {
        $this->CodU = $CodU;
    }

    /**
     * @return mixed
     */
    public function getIdGrpU()
    {
        return $this->IdGrpU;
    }

    /**
     * @param mixed $IdGrpU
     */
    public function setIdGrpU($IdGrpU)
    {
        $this->IdGrpU = $IdGrpU;
    }

    /**
     * @return mixed
     */
    public function getNomDep()
    {
        return $this->NomDep;
    }

    /**
     * @param mixed $NomDep
     */
    public function setNomDep($NomDep)
    {
        $this->NomDep = $NomDep;
    }

    /**
     * @return mixed
     */
    public function getNomSal()
    {
        return $this->NomSal;
    }

    /**
     * @param mixed $NomSal
     */
    public function setNomSal($NomSal)
    {
        $this->NomSal = $NomSal;
    }

    /**
     * @return mixed
     */
    public function getPrenSal()
    {
        return $this->PrenSal;
    }

    /**
     * @param mixed $PrenSal
     */
    public function setPrenSal($PrenSal)
    {
        $this->PrenSal = $PrenSal;
    }

    /**
     * @return mixed
     */
    public function getMailSal()
    {
        return $this->MailSal;
    }

    /**
     * @param mixed $MailSal
     */
    public function setMailSal($MailSal)
    {
        $this->MailSal = $MailSal;
    }

    /**
     * @return mixed
     */
    public function getNomU()
    {
        return $this->NomU;
    }

    /**
     * @param mixed $NomU
     */
    public function setNomU($NomU)
    {
        $this->NomU = $NomU;
    }

    /**
     * @return mixed
     */
    public function getCodSal()
    {
        return $this->CodSal;
    }

    /**
     * @param mixed $CodSal
     */
    public function setCodSal($CodSal)
    {
        $this->CodSal = $CodSal;
    }

    /**
     * @return bool
     */
    public function isFlgSocDefautUtilSoc()
    {
        return $this->FlgSocDefautUtilSoc;
    }

    /**
     * @param bool $FlgSocDefautUtilSoc
     */
    public function setFlgSocDefautUtilSoc(bool $FlgSocDefautUtilSoc)
    {
        $this->FlgSocDefautUtilSoc = $FlgSocDefautUtilSoc;
    }

    
}