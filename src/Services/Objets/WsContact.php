<?php

namespace App\Services\Objets;


class WsContact
{
    public $IdAdr;
    public $IdUWeb;
    public $IdCli;
    public $PasswWebAdr;
    public $IdDep;
    public $IdSoc;
    public $CodLogWebAdr;
    public $RespAdr;
    public $PrenomAdr;
    public $MailAdr;
    public $CodCli;
    public $SiretCli;
    public $JRegCli;
    public $MRegCli;
    public $EchRegCli;
    public $NomDep;
    public $LivNonFact;
    public $SirenCli;
    public $ModeReg;
    public $Echeances;
    public $LstIdSoc;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

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

    public function __toString()
    {
        $string = '{';
        $string .= '"IdAdr": "'.$this->getIdAdr().'" ,';
        $string .= '"IdUWeb": "'.$this->getIdUWeb().'" ,';
        $string .= '"IdCli": "'.$this->getIdCli().'" ,';
        $string .= '"PasswWebAdr": "'.$this->getPasswWebAdr().'" ,';
        $string .= '"IdDep": "'.$this->getIdDep().'" ,';
        $string .= '"IdSoc": "'.$this->getIdSoc().'" ,';
        $string .= '"CodLogWebAdr": "'.$this->getCodLogWebAdr().'" ,';
        $string .= '"RespAdr": "'.$this->getRespAdr().'" ,';
        $string .= '"PrenomAdr": "'.$this->getPrenomAdr().'" ,';
        $string .= '"MailAdr": "'.$this->getMailAdr().'" ,';
        $string .= '"CodCli": "'.$this->getCodCli().'" ,';
        $string .= '"SiretCli": "'.$this->getSiretCli().'" ,';
        $string .= '"JRegCli": "'.$this->getJRegCli().'" ,';
        $string .= '"MRegCli": "'.$this->getMRegCli().'" ,';
        $string .= '"EchRegCli": "'.$this->getEchRegCli().'" ,';
        $string .= '"NomDep": "'.$this->getNomDep().'" ,';
        $string .= '"LivNonFact": "'.$this->getLivNonFact().'" ,';
        $string .= '"SirenCli": "'.$this->getSirenCli().'" ,';
        $string .= '"ModeReg": "'.$this->getModeReg().'" ,';
        $string .= '"Echeances": "'.$this->getEcheances().'" ,';
        $string .= '"LstIdSoc": "'.$this->getLstIdSoc().'" ';
        $string .= '}';

        return $string;
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
    public function setIdAdr($IdAdr)
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
    public function setIdUWeb($IdUWeb)
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
    public function setIdCli($IdCli)
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
    public function setPasswWebAdr($PasswWebAdr)
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
    public function setIdDep($IdDep)
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
    public function setIdSoc($IdSoc)
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
    public function setCodLogWebAdr($CodLogWebAdr)
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
    public function setRespAdr($RespAdr)
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
    public function setPrenomAdr($PrenomAdr)
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
    public function setMailAdr($MailAdr)
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
    public function setCodCli($CodCli)
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
    public function setSiretCli($SiretCli)
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
    public function setJRegCli($JRegCli)
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
    public function setMRegCli($MRegCli)
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
    public function setEchRegCli($EchRegCli)
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
    public function setNomDep($NomDep)
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
    public function setLivNonFact($LivNonFact)
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
    public function setSirenCli($SirenCli)
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
    public function setModeReg($ModeReg)
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
    public function setEcheances($Echeances)
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
    public function setLstIdSoc($LstIdSoc)
    {
        $this->LstIdSoc = $LstIdSoc;
    }
}