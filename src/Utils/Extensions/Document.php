<?php

namespace App\Utils\Extensions;


use App\Services\Objets\WsDocumEnt;

class Document
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
    private $IdFac = null;
    private $IdDepLiv = null;
    private $FlgValidDE = false;
    private $MotsClesAutoDE = null;

    /**
     * parseObject
     * Prend un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsDocumEnt $object) {

        if(!is_null($object)) {
            $this->setDateLivrDE($object->getDateLivrDE());
            $this->setDateDE($object->getDateDE());
            $this->setIdCli($object->getIdCli());
            $this->setIdDE($object->getIdDE());
            $this->setIdSoc($object->getIdSoc());
            $this->setIdDocDE($object->getIdDocDE());
            $this->setNumDE($object->getNumDE());
            $this->setEtatDE($object->getEtatDE());
            $this->setTypeDE($object->getTypeDE());
            $this->setRefDE($object->getRefDE());
            $this->setMontTTCDE($object->getMontTTCDE());
            $this->setMontHTDE($object->getMontHTDE());
            $this->setComDE($object->getComDE());
            $this->setIdFac($object->getIdFac());
            $this->setIdDepLiv($object->getIdDepLiv());
            $this->setFlgValidDE($object->getFlgValidDE());
            $this->setMotsClesAutoDE($object->getMotsClesAutoDE());
        }
    }

    /**
     * parseJson
     * Convertion de l'objet en une structure JSON personnalisée
     */
    public function parseJson()
    {
        $string = '{';
        $string .= '"IdDE": '.$this->getIdDE().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"NumDE": '.$this->getNumDE().' ,';
        $string .= '"DateDE": "'.$this->getDateDE().'" ,';
        $string .= '"IdCli": '.$this->getIdCli().' ,';
        $string .= '"IdSoc": '.$this->getIdSoc().' ,';
        $string .= '"EtatDE": "'.$this->getEtatDE().'" ,';
        $string .= '"TypeDE": "'.$this->getTypeDE().'" ,';
        $string .= '"RefDE": "'.$this->getRefDE().'" ,';
        $string .= '"MontTTCDE": '.$this->getMontTTCDE().' ,';
        $string .= '"MontHTDE": '.$this->getMontHTDE().' ,';
        $string .= '"ComDE": "'.$this->getComDE().'" ,';
        $string .= '"DateLivrDE": "'.$this->getDateLivrDE().'" ,';
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
    public function setIdDE($IdDE)
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
    public function setIdDocDE($IdDocDE)
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
    public function setNumDE($NumDE)
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
    public function setDateDE($DateDE)
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
    public function setIdCli($IdCli)
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
    public function setIdSoc($IdSoc)
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
    public function setEtatDE($EtatDE)
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
    public function setTypeDE($TypeDE)
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
    public function setRefDE($RefDE)
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
    public function setMontTTCDE($MontTTCDE)
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
    public function setMontHTDE($MontHTDE)
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
    public function setComDE($ComDE)
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
    public function setDateLivrDE($DateLivrDE)
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
    public function setIdFac($IdFac)
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
    public function setIdDepLiv($IdDepLiv)
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
    public function setFlgValidDE($FlgValidDE)
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
    public function setMotsClesAutoDE($MotsClesAutoDE)
    {
        $this->MotsClesAutoDE = $MotsClesAutoDE;
    }
}