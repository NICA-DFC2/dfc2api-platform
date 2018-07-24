<?php

namespace App\Entity;

use App\Services\Objets\WsContact;

class Contact
{
    private $IdAdr;
    private $IdUWeb;
    private $IdCli;
    private $PasswWebAdr;
    private $IdDep;
    private $IdSoc;
    private $CodLogWebAdr;
    private $RespAdr;
    private $PrenomAdr;
    private $MailAdr;
    private $CodCli;
    private $SiretCli;
    private $JRegCli;
    private $MRegCli;
    private $EchRegCli;
    private $NomDep;
    private $LivNonFact;
    private $SirenCli;
    private $ModeReg;
    private $Echeances;
    private $LstIdSoc;

    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsContact $json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdAdr($json_object->{'IdAdr'});
            $this->setIdUWeb($json_object->{'IdUWeb'});
            $this->setIdCli($json_object->{'IdCli'});
            $this->setPasswWebAdr($json_object->{'PasswWebAdr'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setCodLogWebAdr($json_object->{'CodLogWebAdr'});
            $this->setRespAdr($json_object->{'RespAdr'});
            $this->setPrenomAdr($json_object->{'PrenomAdr'});
            $this->setMailAdr($json_object->{'MailAdr'});
            $this->setCodCli($json_object->{'CodCli'});
            $this->setSiretCli($json_object->{'SiretCli'});
            $this->setJRegCli($json_object->{'JRegCli'});
            $this->setMRegCli($json_object->{'MRegCli'});
            $this->setEchRegCli($json_object->{'EchRegCli'});
            $this->setNomDep($json_object->{'NomDep'});
            $this->setLivNonFact($json_object->{'LivNonFact'});
            $this->setSirenCli($json_object->{'SirenCli'});
            $this->setModeReg($json_object->{'ModeReg'});
            $this->setEcheances($json_object->{'Echeances'});
            $this->setLstIdSoc($json_object->{'LstIdSoc'});
        }
    }

    /**
     * @return mixed
     */
    public function getIdAdr()
    {
        return $this->IdAdr;
    }

    /**
     * @param mixed $IdAdr
     */
    public function setIdAdr($IdAdr): void
    {
        $this->IdAdr = $IdAdr;
    }

    /**
     * @return mixed
     */
    public function getIdUWeb()
    {
        return $this->IdUWeb;
    }

    /**
     * @param mixed $IdUWeb
     */
    public function setIdUWeb($IdUWeb): void
    {
        $this->IdUWeb = $IdUWeb;
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
    public function getPasswWebAdr()
    {
        return $this->PasswWebAdr;
    }

    /**
     * @param mixed $PasswWebAdr
     */
    public function setPasswWebAdr($PasswWebAdr): void
    {
        $this->PasswWebAdr = $PasswWebAdr;
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
    public function setIdDep($IdDep): void
    {
        $this->IdDep = $IdDep;
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
    public function getCodLogWebAdr()
    {
        return $this->CodLogWebAdr;
    }

    /**
     * @param mixed $CodLogWebAdr
     */
    public function setCodLogWebAdr($CodLogWebAdr): void
    {
        $this->CodLogWebAdr = $CodLogWebAdr;
    }

    /**
     * @return mixed
     */
    public function getRespAdr()
    {
        return $this->RespAdr;
    }

    /**
     * @param mixed $RespAdr
     */
    public function setRespAdr($RespAdr): void
    {
        $this->RespAdr = $RespAdr;
    }

    /**
     * @return mixed
     */
    public function getPrenomAdr()
    {
        return $this->PrenomAdr;
    }

    /**
     * @param mixed $PrenomAdr
     */
    public function setPrenomAdr($PrenomAdr): void
    {
        $this->PrenomAdr = $PrenomAdr;
    }

    /**
     * @return mixed
     */
    public function getMailAdr()
    {
        return $this->MailAdr;
    }

    /**
     * @param mixed $MailAdr
     */
    public function setMailAdr($MailAdr): void
    {
        $this->MailAdr = $MailAdr;
    }

    /**
     * @return mixed
     */
    public function getCodCli()
    {
        return $this->CodCli;
    }

    /**
     * @param mixed $CodCli
     */
    public function setCodCli($CodCli): void
    {
        $this->CodCli = $CodCli;
    }

    /**
     * @return mixed
     */
    public function getSiretCli()
    {
        return $this->SiretCli;
    }

    /**
     * @param mixed $SiretCli
     */
    public function setSiretCli($SiretCli): void
    {
        $this->SiretCli = $SiretCli;
    }

    /**
     * @return mixed
     */
    public function getJRegCli()
    {
        return $this->JRegCli;
    }

    /**
     * @param mixed $JRegCli
     */
    public function setJRegCli($JRegCli): void
    {
        $this->JRegCli = $JRegCli;
    }

    /**
     * @return mixed
     */
    public function getMRegCli()
    {
        return $this->MRegCli;
    }

    /**
     * @param mixed $MRegCli
     */
    public function setMRegCli($MRegCli): void
    {
        $this->MRegCli = $MRegCli;
    }

    /**
     * @return mixed
     */
    public function getEchRegCli()
    {
        return $this->EchRegCli;
    }

    /**
     * @param mixed $EchRegCli
     */
    public function setEchRegCli($EchRegCli): void
    {
        $this->EchRegCli = $EchRegCli;
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
    public function setNomDep($NomDep): void
    {
        $this->NomDep = $NomDep;
    }

    /**
     * @return mixed
     */
    public function getLivNonFact()
    {
        return $this->LivNonFact;
    }

    /**
     * @param mixed $LivNonFact
     */
    public function setLivNonFact($LivNonFact): void
    {
        $this->LivNonFact = $LivNonFact;
    }

    /**
     * @return mixed
     */
    public function getSirenCli()
    {
        return $this->SirenCli;
    }

    /**
     * @param mixed $SirenCli
     */
    public function setSirenCli($SirenCli): void
    {
        $this->SirenCli = $SirenCli;
    }

    /**
     * @return mixed
     */
    public function getModeReg()
    {
        return $this->ModeReg;
    }

    /**
     * @param mixed $ModeReg
     */
    public function setModeReg($ModeReg): void
    {
        $this->ModeReg = $ModeReg;
    }

    /**
     * @return mixed
     */
    public function getEcheances()
    {
        return $this->Echeances;
    }

    /**
     * @param mixed $Echeances
     */
    public function setEcheances($Echeances): void
    {
        $this->Echeances = $Echeances;
    }

    /**
     * @return mixed
     */
    public function getLstIdSoc()
    {
        return $this->LstIdSoc;
    }

    /**
     * @param mixed $LstIdSoc
     */
    public function setLstIdSoc($LstIdSoc): void
    {
        $this->LstIdSoc = $LstIdSoc;
    }


}