<?php

namespace App\Utils;

/**
 * Entité qui représente l'état d'une facture. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 */
class EtatFacture
{
    public $NoFacFCA = 0;
    public $DateFacFCA = null;
    public $DateRegFCA = null;
    public $DateFinRisqueFCA = null;
    public $DateRegleFCA = null;
    public $MontTotTtcFCA = 0;
    public $ResteDuFCA = 0;
    public $AnnotFCA = "";
    public $NbJoursRetard = 0;

    /**
     * parseObject
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject($json_object=null) {

        if(!is_null($json_object)) {
            $this->setNoFacFCA($json_object->{'NoFacFCA'});
            $this->setDateFacFCA($json_object->{'DateFacFCA'});
            $this->setDateRegFCA($json_object->{'DateRegFCA'});
            $this->setDateFinRisqueFCA($json_object->{'DateFinRisqueFCA'});
            $this->setDateRegleFCA($json_object->{'DateRegleFCA'});
            $this->setMontTotTtcFCA($json_object->{'MontTotTtcFCA'});
            $this->setResteDuFCA($json_object->{'ResteDuFCA'});
            $this->setAnnotFCA($json_object->{'AnnotFCA'});
            $this->setNbJoursRetard($json_object->{'NbJoursRetard'});
        }
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

}