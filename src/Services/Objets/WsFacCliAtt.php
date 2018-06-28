<?php

namespace App\Services\Objets;

class WsFacCliAtt
{
    public $IdFCA = 0;
    public $IdFac = 0;
    public $IdSoc = 0;
    public $IdDep = 0;
    public $IdCli = 0;
    public $IdSal = 0;
    public $NoFacFCA = 0;
    public $DateFacFCA = null;
    public $DateRegFCA = null;
    public $DateFinRisqueFCA = null;
    public $DateRegleFCA = null;
    public $MontTotTtcFCA = 0;
    public $ResteDuFCA = 0;
    public $LibFCA = "";
    public $LibSocFCA = null;
    public $TypeFCA = "";
    public $MRegFCA = "";
    public $CodAcceptFCA = "";
    public $CodDepartFCA = "";
    public $CodImpFCA = "";
    public $CodLitFCA = "";
    public $CodReseauFCA = "";
    public $NbRelFCA = 0;
    public $LettrageFCA = "";
    public $AnnotFCA = "";
    public $NbJoursRetard = 0;

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdFCA($json_object->{'IdFCA'});
            $this->setIdFac($json_object->{'IdFac'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setIdDep($json_object->{'IdDep'});
            $this->setIdCli($json_object->{'IdCli'});
            $this->setIdSal($json_object->{'IdSal'});
            $this->setNoFacFCA($json_object->{'NoFacFCA'});
            $this->setDateFacFCA($json_object->{'DateFacFCA'});
            $this->setDateRegFCA($json_object->{'DateRegFCA'});
            $this->setDateFinRisqueFCA($json_object->{'DateFinRisqueFCA'});
            $this->setDateRegleFCA($json_object->{'DateRegleFCA'});
            $this->setMontTotTtcFCA($json_object->{'MontTotTtcFCA'});
            $this->setResteDuFCA($json_object->{'ResteDuFCA'});
            $this->setLibFCA($json_object->{'LibFCA'});
            $this->setLibSocFCA($json_object->{'LibSocFCA'});
            $this->setTypeFCA($json_object->{'TypeFCA'});
            $this->setMRegFCA($json_object->{'MRegFCA'});
            $this->setCodAcceptFCA($json_object->{'CodAcceptFCA'});
            $this->setCodDepartFCA($json_object->{'CodDepartFCA'});
            $this->setCodImpFCA($json_object->{'CodImpFCA'});
            $this->setCodLitFCA($json_object->{'CodLitFCA'});
            $this->setCodReseauFCA($json_object->{'CodReseauFCA'});
            $this->setNbRelFCA($json_object->{'NbRelFCA'});
            $this->setLettrageFCA($json_object->{'LettrageFCA'});
            $this->setAnnotFCA($json_object->{'AnnotFCA'});
            $this->setNbJoursRetard($json_object->{'NbJoursRetard'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdFCA": '.$this->getIdFCA().' ,';
        $string .= '"IdFac": '.$this->getIdFac().' ,';
        $string .= '"IdSoc": '.$this->getIdSoc().' ,';
        $string .= '"IdDep": '.$this->getIdDep().' ,';
        $string .= '"IdCli": '.$this->getIdCli().' ,';
        $string .= '"IdSal": '.$this->getIdSal().' ,';
        $string .= '"NoFacFCA": '.$this->getNoFacFCA().' ,';
        $string .= '"DateFacFCA": "'.$this->getDateFacFCA().'" ,';
        $string .= '"DateRegFCA": "'.$this->getDateRegFCA().'" ,';
        $string .= '"DateFinRisqueFCA": "'.$this->getDateFinRisqueFCA().'" ,';
        $string .= '"DateRegleFCA": "'.$this->getDateRegleFCA().'" ,';
        $string .= '"MontTotTtcFCA": '.$this->getMontTotTtcFCA().' ,';
        $string .= '"ResteDuFCA": '.$this->getResteDuFCA().' ,';
        $string .= '"LibFCA": "'.$this->getLibFCA().'" ,';
        $string .= '"LibSocFCA": "'.$this->getLibSocFCA().'" ,';
        $string .= '"TypeFCA": "'.$this->getTypeFCA().'" ,';
        $string .= '"MRegFCA": "'.$this->getMRegFCA().'" ,';
        $string .= '"CodAcceptFCA": "'.$this->getCodAcceptFCA().'" ,';
        $string .= '"CodDepartFCA": "'.$this->getCodDepartFCA().'" ,';
        $string .= '"CodImpFCA": "'.$this->getCodImpFCA().'" ,';
        $string .= '"CodLitFCA": "'.$this->getCodLitFCA().'" ,';
        $string .= '"CodReseauFCA": "'.$this->getCodReseauFCA().'" ,';
        $string .= '"NbRelFCA": '.$this->getNbRelFCA().' ,';
        $string .= '"LettrageFCA": "'.$this->getLettrageFCA().'" ,';
        $string .= '"AnnotFCA": "'.$this->getAnnotFCA().'" ,';
        $string .= '"NbJoursRetard": '.$this->getNbJoursRetard().' ';
        $string .= '}';

        return $string;
    }

    /**
     * @return int
     */
    public function getIdFCA()
    {
        return $this->IdFCA;
    }

    /**
     * @param int $IdFCA
     */
    public function setIdFCA($IdFCA)
    {
        $this->IdFCA = $IdFCA;
    }

    /**
     * @return int
     */
    public function getIdFac()
    {
        return $this->IdFac;
    }

    /**
     * @param int $IdFac
     */
    public function setIdFac($IdFac)
    {
        $this->IdFac = $IdFac;
    }

    /**
     * @return int
     */
    public function getIdSoc()
    {
        return $this->IdSoc;
    }

    /**
     * @param int $IdSoc
     */
    public function setIdSoc($IdSoc)
    {
        $this->IdSoc = $IdSoc;
    }

    /**
     * @return int
     */
    public function getIdDep()
    {
        return $this->IdDep;
    }

    /**
     * @param int $IdDep
     */
    public function setIdDep($IdDep)
    {
        $this->IdDep = $IdDep;
    }

    /**
     * @return int
     */
    public function getIdCli()
    {
        return $this->IdCli;
    }

    /**
     * @param int $IdCli
     */
    public function setIdCli($IdCli)
    {
        $this->IdCli = $IdCli;
    }

    /**
     * @return int
     */
    public function getIdSal()
    {
        return $this->IdSal;
    }

    /**
     * @param int $IdSal
     */
    public function setIdSal($IdSal)
    {
        $this->IdSal = $IdSal;
    }

    /**
     * @return int
     */
    public function getNoFacFCA()
    {
        return $this->NoFacFCA;
    }

    /**
     * @param int $NoFacFCA
     */
    public function setNoFacFCA($NoFacFCA)
    {
        $this->NoFacFCA = $NoFacFCA;
    }

    /**
     * @return null
     */
    public function getDateFacFCA()
    {
        return $this->DateFacFCA;
    }

    /**
     * @param null $DateFacFCA
     */
    public function setDateFacFCA($DateFacFCA)
    {
        $this->DateFacFCA = $DateFacFCA;
    }

    /**
     * @return null
     */
    public function getDateRegFCA()
    {
        return $this->DateRegFCA;
    }

    /**
     * @param null $DateRegFCA
     */
    public function setDateRegFCA($DateRegFCA)
    {
        $this->DateRegFCA = $DateRegFCA;
    }

    /**
     * @return null
     */
    public function getDateFinRisqueFCA()
    {
        return $this->DateFinRisqueFCA;
    }

    /**
     * @param null $DateFinRisqueFCA
     */
    public function setDateFinRisqueFCA($DateFinRisqueFCA)
    {
        $this->DateFinRisqueFCA = $DateFinRisqueFCA;
    }

    /**
     * @return null
     */
    public function getDateRegleFCA()
    {
        return $this->DateRegleFCA;
    }

    /**
     * @param null $DateRegleFCA
     */
    public function setDateRegleFCA($DateRegleFCA)
    {
        $this->DateRegleFCA = $DateRegleFCA;
    }

    /**
     * @return int
     */
    public function getMontTotTtcFCA()
    {
        return $this->MontTotTtcFCA;
    }

    /**
     * @param int $MontTotTtcFCA
     */
    public function setMontTotTtcFCA($MontTotTtcFCA)
    {
        $this->MontTotTtcFCA = $MontTotTtcFCA;
    }

    /**
     * @return int
     */
    public function getResteDuFCA()
    {
        return $this->ResteDuFCA;
    }

    /**
     * @param int $ResteDuFCA
     */
    public function setResteDuFCA($ResteDuFCA)
    {
        $this->ResteDuFCA = $ResteDuFCA;
    }

    /**
     * @return string
     */
    public function getLibFCA()
    {
        return $this->LibFCA;
    }

    /**
     * @param string $LibFCA
     */
    public function setLibFCA($LibFCA)
    {
        $this->LibFCA = $LibFCA;
    }

    /**
     * @return null
     */
    public function getLibSocFCA()
    {
        return $this->LibSocFCA;
    }

    /**
     * @param null $LibSocFCA
     */
    public function setLibSocFCA($LibSocFCA)
    {
        $this->LibSocFCA = $LibSocFCA;
    }

    /**
     * @return string
     */
    public function getTypeFCA()
    {
        return $this->TypeFCA;
    }

    /**
     * @param string $TypeFCA
     */
    public function setTypeFCA($TypeFCA)
    {
        $this->TypeFCA = $TypeFCA;
    }

    /**
     * @return string
     */
    public function getMRegFCA()
    {
        return $this->MRegFCA;
    }

    /**
     * @param string $MRegFCA
     */
    public function setMRegFCA($MRegFCA)
    {
        $this->MRegFCA = $MRegFCA;
    }

    /**
     * @return string
     */
    public function getCodAcceptFCA()
    {
        return $this->CodAcceptFCA;
    }

    /**
     * @param string $CodAcceptFCA
     */
    public function setCodAcceptFCA($CodAcceptFCA)
    {
        $this->CodAcceptFCA = $CodAcceptFCA;
    }

    /**
     * @return string
     */
    public function getCodDepartFCA()
    {
        return $this->CodDepartFCA;
    }

    /**
     * @param string $CodDepartFCA
     */
    public function setCodDepartFCA($CodDepartFCA)
    {
        $this->CodDepartFCA = $CodDepartFCA;
    }

    /**
     * @return string
     */
    public function getCodImpFCA()
    {
        return $this->CodImpFCA;
    }

    /**
     * @param string $CodImpFCA
     */
    public function setCodImpFCA($CodImpFCA)
    {
        $this->CodImpFCA = $CodImpFCA;
    }

    /**
     * @return string
     */
    public function getCodLitFCA()
    {
        return $this->CodLitFCA;
    }

    /**
     * @param string $CodLitFCA
     */
    public function setCodLitFCA($CodLitFCA)
    {
        $this->CodLitFCA = $CodLitFCA;
    }

    /**
     * @return string
     */
    public function getCodReseauFCA()
    {
        return $this->CodReseauFCA;
    }

    /**
     * @param string $CodReseauFCA
     */
    public function setCodReseauFCA($CodReseauFCA)
    {
        $this->CodReseauFCA = $CodReseauFCA;
    }

    /**
     * @return int
     */
    public function getNbRelFCA()
    {
        return $this->NbRelFCA;
    }

    /**
     * @param int $NbRelFCA
     */
    public function setNbRelFCA($NbRelFCA)
    {
        $this->NbRelFCA = $NbRelFCA;
    }

    /**
     * @return string
     */
    public function getLettrageFCA()
    {
        return $this->LettrageFCA;
    }

    /**
     * @param string $LettrageFCA
     */
    public function setLettrageFCA($LettrageFCA)
    {
        $this->LettrageFCA = $LettrageFCA;
    }

    /**
     * @return string
     */
    public function getAnnotFCA()
    {
        return $this->AnnotFCA;
    }

    /**
     * @param string $AnnotFCA
     */
    public function setAnnotFCA($AnnotFCA)
    {
        $this->AnnotFCA = $AnnotFCA;
    }

    /**
     * @return int
     */
    public function getNbJoursRetard()
    {
        return $this->NbJoursRetard;
    }

    /**
     * @param int $NbJoursRetard
     */
    public function setNbJoursRetard($NbJoursRetard)
    {
        $this->NbJoursRetard = $NbJoursRetard;
    }

}