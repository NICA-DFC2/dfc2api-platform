<?php

namespace App\Services\Objets;

class Notif
{

    private $Metier;
    private $Texte;
    private $Titre;
    private $Type;
    private $Function;


    public function __construct($Metier, $Texte, $Titre, $Type, $Function)
    {
        $this->Metier = $Metier;
        $this->Texte = $Texte;
        $this->Titre = $Titre;
        $this->Type = $Type;
        $this->Function = 'function qui relève la notification: ' . $Function . '()';
    }


    public function __toString()
    {
        $string = '{"ProDataSet":{"ttParam":[{';
        $string .= '"Metier": "'.$this->getMetier().'", ';
        $string .= '"Texte": "'.$this->getTexte().'", ';
        $string .= '"Titre": "'. $this->getTitre().'", ';
        $string .= '"Type": "'. $this->getType().'", ';
        $string .= '"Function": "'. $this->getFunction(). '"';
        $string .= '}]}}';

        return $string;
    }

    /**
     * @return mixed
     */
    public function getMetier()
    {
        return $this->Metier;
    }

    /**
     * @param mixed $Metier
     */
    public function setMetier($Metier)
    {
        $this->Metier = $Metier;
    }

    /**
     * @return mixed
     */
    public function getTexte()
    {
        return $this->Texte;
    }

    /**
     * @param mixed $Texte
     */
    public function setTexte($Texte)
    {
        $this->Texte = $Texte;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->Titre;
    }

    /**
     * @param mixed $Titre
     */
    public function setTitre($Titre)
    {
        $this->Titre = $Titre;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param mixed $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }

    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->Function;
    }

    /**
     * @param mixed $Function
     */
    public function setFunction($Function)
    {
        $this->Function = 'function qui relève la notification: ' . $Function . '()';
    }


}
