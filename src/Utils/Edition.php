<?php

namespace App\Utils;

/**
 * Entité qui représente les edition des documents. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 */
class Edition
{
    private $IdEdi = 0;
    private $IdDocDE = 0;
    private $TypeEdi = "";
    private $LienEdi = "";
    private $LienLocalEdi = "";
    private $DataEdi = "";

    /**
     * parseObject
     * Peut prendre un argument $json_object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject($json_object=null) {

        if(!is_null($json_object)) {
            $this->setIdEdi($json_object->{'IdEdi'});
            $this->setIdDocDE($json_object->{'IdDocDE'});
            $this->setTypeEdi($json_object->{'TypeEdi'});
            $this->setLienEdi($json_object->{'LienEdi'});
            $this->setLienLocalEdi($json_object->{'LienLocalEdi'});
            $this->setDataEdi($json_object->{'DataEdi'});
        }
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