<?php

namespace App\Services\Objets;

class WsDocumEnt
{
    private $IdDE = 0;
    private $IdDocDE = 0;
    private $NumDE = 0;
    private $DateDE = "";
    private $IdCli = null;
    private $IdSoc = 0;
    private $EtatDE = "";
    private $TypeDE = null;
    private $RefDE = "";
    private $MontTTCDE = 0;
    private $MontHTDE = 0;
    private $ComDE = "";
    private $DateLivrDE = null;
    private $IdFac = 0;
    private $IdDepLiv = 0;
    private $FlgValidDE = false;
    private $MotsClesAutoDE = "";

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

        $this->setDateLivrDE('1970-01-01');
        $this->setDateDE('1970-01-01');

        if(!is_null($json_object)) {
            $this->setIdCli($json_object->{'IdCli'});
            $this->setIdDE($json_object->{'IdDE'});
            $this->setIdSoc($json_object->{'IdSoc'});
            $this->setIdDocDE($json_object->{'IdDocDE'});
            $this->setNumDE($json_object->{'NumDE'});
            $this->setEtatDE($json_object->{'EtatDE'});
            $this->setTypeDE($json_object->{'TypeDE'});
            $this->setRefDE($json_object->{'RefDE'});
            $this->setMontTTCDE($json_object->{'MontTTCDE'});
            $this->setMontHTDE($json_object->{'MontHTDE'});
            $this->setComDE($json_object->{'ComDE'});
            $this->setIdFac($json_object->{'IdFac'});
            $this->setIdDepLiv($json_object->{'IdDepLiv'});
            $this->setFlgValidDE($json_object->{'FlgValidDE'});
            $this->setMotsClesAutoDE($json_object->{'MotsClesAutoDE'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdDE": '.$this->getIdDE().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"NumDE": '.$this->getNumDE().' ,';
        $string .= '"DateDE": "'.date_format($this->getDateDE(), 'Y-m-d').'" ,';
        $string .= '"IdCli": '.$this->getIdCli().' ,';
        $string .= '"IdSoc": '.$this->getIdSoc().' ,';
        $string .= '"EtatDE": "'.$this->getEtatDE().'" ,';
        $string .= '"TypeDE": "'.$this->getTypeDE().'" ,';
        $string .= '"RefDE": "'.$this->getRefDE().'" ,';
        $string .= '"MontTTCDE": '.$this->getMontTTCDE().' ,';
        $string .= '"MontHTDE": '.$this->getMontHTDE().' ,';
        $string .= '"ComDE": "'.$this->getComDE().'" ,';
        $string .= '"DateLivrDE": "'.date_format($this->getDateLivrDE(), 'Y-m-d').'" ,';
        $string .= '"IdFac": '.$this->getIdFac().' ,';
        $string .= '"IdDepLiv": '.$this->getIdDepLiv().' ,';

        $val = ($this->getFlgValidDE()) ? 'true' : 'false';
        $string .= '"FlgValidDE": '.$val.' ,';

        $string .= '"MotsClesAutoDE": "'.$this->getMotsClesAutoDE().'"';
        $string .= '}';

        return $string;
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