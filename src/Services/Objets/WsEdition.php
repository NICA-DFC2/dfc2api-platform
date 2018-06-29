<?php

namespace App\Services\Objets;

class WsEdition
{
    public $IdEdi = 0;
    public $IdDocDE = 0;
    public $TypeEdi = "";
    public $LienEdi = "";
    public $LienLocalEdi = "";
    public $DataEdi = "";

    /**
     * Constructeur
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function __construct($json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdEdi($json_object->{'IdEdi'});
            $this->setIdDocDE($json_object->{'IdDocDE'});
            $this->setTypeEdi($json_object->{'TypeEdi'});
            $this->setLienEdi($json_object->{'LienEdi'});
            $this->setLienLocalEdi($json_object->{'LienLocalEdi'});
            $this->setDataEdi($json_object->{'DataEdi'});
        }
    }

    public function __toString()
    {
        $string = '{';
        $string .= '"IdEdi": '.$this->getIdEdi().' ,';
        $string .= '"IdDocDE": '.$this->getIdDocDE().' ,';
        $string .= '"TypeEdi": "'.$this->getTypeEdi().'" ,';
        $string .= '"LienEdi": "'.$this->getLienEdi().'" ,';
        $string .= '"LienLocalEdi": "'.$this->getLienLocalEdi().'" ,';
        $string .= '"DataEdi": "'.$this->getDataEdi().'" ';
        $string .= '}';

        return $string;
    }

    /**
     * @return int
     */
    public function getIdEdi()
    {
        return $this->IdEdi;
    }

    /**
     * @param int $IdEdi
     */
    public function setIdEdi($IdEdi)
    {
        $this->IdEdi = $IdEdi;
    }

    /**
     * @return int
     */
    public function getIdDocDE()
    {
        return $this->IdDocDE;
    }

    /**
     * @param int $IdDocDE
     */
    public function setIdDocDE($IdDocDE)
    {
        $this->IdDocDE = $IdDocDE;
    }

    /**
     * @return string
     */
    public function getTypeEdi()
    {
        return $this->TypeEdi;
    }

    /**
     * @param string $TypeEdi
     */
    public function setTypeEdi($TypeEdi)
    {
        $this->TypeEdi = $TypeEdi;
    }

    /**
     * @return string
     */
    public function getLienEdi()
    {
        return $this->LienEdi;
    }

    /**
     * @param string $LienEdi
     */
    public function setLienEdi($LienEdi)
    {
        $this->LienEdi = $LienEdi;
    }

    /**
     * @return string
     */
    public function getLienLocalEdi()
    {
        return $this->LienLocalEdi;
    }

    /**
     * @param string $LienLocalEdi
     */
    public function setLienLocalEdi($LienLocalEdi)
    {
        $this->LienLocalEdi = $LienLocalEdi;
    }

    /**
     * @return string
     */
    public function getDataEdi()
    {
        return $this->DataEdi;
    }

    /**
     * @param string $DataEdi
     */
    public function setDataEdi($DataEdi)
    {
        $this->DataEdi = $DataEdi;
    }

}