<?php

namespace App\Services\Objets;


class WsStatClient
{
    public $IdStat = 0;
    public $IdCli = 0;
    public $IdSoc = 0;
    public $IdDep = 0;
    public $IdSal = 0;
    public $IdIC = 0;
    public $Annee = 0;
    public $Mois = 0;
    public $CA = 0;
    public $CaDir = 0;
    public $MgConv = 0;
    public $MgConvDir = 0;
    public $MgReel = 0;
    public $MgReelDir = 0;
    public $NbBLDep = 0;
    public $NbBL = 0;
    public $NbBLDir = 0;
    public $NbBLSoc = 0;


    public function __toString()
    {
        $string = '{';
        $string .= '"IdStat": '. $this->getIdStat() .', ';
        $string .= '"IdCli": '. $this->getIdCli() .', ';
        $string .= '"IdSoc": '. $this->getIdSoc() .', ';
        $string .= '"IdDep": '. $this->getIdDep() .', ';
        $string .= '"IdSal": '. $this->getIdSal() .', ';
        $string .= '"IdIC": '. $this->getIdIC() .', ';
        $string .= '"Annee": '. $this->getAnnee() .', ';
        $string .= '"Mois": '. $this->getMois() .', ';
        $string .= '"CA": '. $this->getCA() .', ';
        $string .= '"CaDir": '. $this->getCaDir() .', ';
        $string .= '"MgConv": '. $this->getMgConv() .', ';
        $string .= '"MgConvDir": '. $this->getMgConvDir() .', ';
        $string .= '"MgReel": '. $this->getMgReel() .', ';
        $string .= '"MgReelDir": '. $this->getMgReelDir() .', ';
        $string .= '"NbBLDep": '. $this->getNbBLDep() .', ';
        $string .= '"NbBL": '. $this->getNbBL() .', ';
        $string .= '"NbBLDir": '. $this->getNbBLDir() .', ';
        $string .= '"NbBLSoc": '. $this->getNbBLSoc() .' ';
        $string .= '}';

        return $string;
    }

    public function __construct($json_object=null) {
        if(!is_null($json_object)) {
            $this->setIdStat($json_object->{'IdStat'});
            $this->setIdCli($json_object->{'IdCli'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setIdSal($json_object->{'IdSal'});
            $this->setIdIC($json_object->{'IdIC'});
            $this->setAnnee($json_object->{'Annee'});
            $this->setMois($json_object->{'Mois'});
            $this->setCA($json_object->{'CA'});
            $this->setCaDir($json_object->{'CaDir'});
            $this->setMgConv($json_object->{'MgConv'});
            $this->setMgConvDir($json_object->{'MgConvDir'});
            $this->setMgReel($json_object->{'MgReel'});
            $this->setMgReelDir($json_object->{'MgReelDir'});
            $this->setNbBLDep($json_object->{'NbBLDep'});
            $this->setNbBL($json_object->{'NbBL'});
            $this->setNbBLDir($json_object->{'NbBLDir'});
            $this->setNbBLSoc($json_object->{'NbBLSoc'});
        }
    }

    /**
     * @return int
     */
    public function getIdStat(): int
    {
        return $this->IdStat;
    }

    /**
     * @param int $IdStat
     */
    public function setIdStat(int $IdStat): void
    {
        $this->IdStat = $IdStat;
    }

    /**
     * @return int
     */
    public function getIdCli(): int
    {
        return $this->IdCli;
    }

    /**
     * @param int $IdCli
     */
    public function setIdCli(int $IdCli): void
    {
        $this->IdCli = $IdCli;
    }

    /**
     * @return int
     */
    public function getIdSoc(): int
    {
        return $this->IdSoc;
    }

    /**
     * @param int $IdSoc
     */
    public function setIdSoc(int $IdSoc): void
    {
        $this->IdSoc = $IdSoc;
    }

    /**
     * @return int
     */
    public function getIdDep(): int
    {
        return $this->IdDep;
    }

    /**
     * @param int $IdDep
     */
    public function setIdDep(int $IdDep): void
    {
        $this->IdDep = $IdDep;
    }

    /**
     * @return int
     */
    public function getAnnee(): int
    {
        return $this->Annee;
    }

    /**
     * @param int $Annee
     */
    public function setAnnee(int $Annee): void
    {
        $this->Annee = $Annee;
    }

    /**
     * @return int
     */
    public function getMois(): int
    {
        return $this->Mois;
    }

    /**
     * @param int $Mois
     */
    public function setMois(int $Mois): void
    {
        $this->Mois = $Mois;
    }

    /**
     * @return int
     */
    public function getCA(): int
    {
        return $this->CA;
    }

    /**
     * @param int $CA
     */
    public function setCA(int $CA): void
    {
        $this->CA = $CA;
    }

    /**
     * @return int
     */
    public function getCaDir(): int
    {
        return $this->CaDir;
    }

    /**
     * @param int $CaDir
     */
    public function setCaDir(int $CaDir): void
    {
        $this->CaDir = $CaDir;
    }

    /**
     * @return int
     */
    public function getMgConv(): int
    {
        return $this->MgConv;
    }

    /**
     * @param int $MgConv
     */
    public function setMgConv(int $MgConv): void
    {
        $this->MgConv = $MgConv;
    }

    /**
     * @return int
     */
    public function getMgConvDir(): int
    {
        return $this->MgConvDir;
    }

    /**
     * @param int $MgConvDir
     */
    public function setMgConvDir(int $MgConvDir): void
    {
        $this->MgConvDir = $MgConvDir;
    }

    /**
     * @return int
     */
    public function getMgReel(): int
    {
        return $this->MgReel;
    }

    /**
     * @param int $MgReel
     */
    public function setMgReel(int $MgReel): void
    {
        $this->MgReel = $MgReel;
    }

    /**
     * @return int
     */
    public function getMgReelDir(): int
    {
        return $this->MgReelDir;
    }

    /**
     * @param int $MgReelDir
     */
    public function setMgReelDir(int $MgReelDir): void
    {
        $this->MgReelDir = $MgReelDir;
    }

    /**
     * @return int
     */
    public function getNbBLDep(): int
    {
        return $this->NbBLDep;
    }

    /**
     * @param int $NbBLDep
     */
    public function setNbBLDep(int $NbBLDep): void
    {
        $this->NbBLDep = $NbBLDep;
    }

    /**
     * @return int
     */
    public function getNbBL(): int
    {
        return $this->NbBL;
    }

    /**
     * @param int $NbBL
     */
    public function setNbBL(int $NbBL): void
    {
        $this->NbBL = $NbBL;
    }

    /**
     * @return int
     */
    public function getNbBLSoc(): int
    {
        return $this->NbBLSoc;
    }

    /**
     * @param int $NbBLSoc
     */
    public function setNbBLSoc(int $NbBLSoc): void
    {
        $this->NbBLSoc = $NbBLSoc;
    }

    /**
     * @return int
     */
    public function getIdSal(): int
    {
        return $this->IdSal;
    }

    /**
     * @param int $IdSal
     */
    public function setIdSal(int $IdSal): void
    {
        $this->IdSal = $IdSal;
    }

    /**
     * @return int
     */
    public function getIdIC(): int
    {
        return $this->IdIC;
    }

    /**
     * @param int $IdIC
     */
    public function setIdIC(int $IdIC): void
    {
        $this->IdIC = $IdIC;
    }

    /**
     * @return int
     */
    public function getNbBLDir(): int
    {
        return $this->NbBLDir;
    }

    /**
     * @param int $NbBLDir
     */
    public function setNbBLDir(int $NbBLDir): void
    {
        $this->NbBLDir = $NbBLDir;
    }

}