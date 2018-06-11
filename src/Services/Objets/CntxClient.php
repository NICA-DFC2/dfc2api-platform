<?php

namespace App\Services\Objets;

class CntxClient
{
    private $IdAdr;
    private $IdCli;
    private $IdDep;
    private $IdSal;
    private $IdSession;
    private $IdSoc;
    private $IdU;
    private $Valid;

    public function __construct($IdAdr=null, $IdCli=null, $IdDep=null, $IdSal=null, $IdSession=null, $IdSoc=null, $IdU=null, $Valid=null) {
        $this->IdAdr = $IdAdr;
        $this->IdCli = $IdCli;
        $this->IdDep = $IdDep;
        $this->IdSal = $IdSal;
        $this->IdSession = $IdSession;
        $this->IdSoc = $IdSoc;
        $this->IdU = $IdU;
        $this->Valid = $Valid;
    }

    public function __toString() {
        $string = '{"ProDataSet":{"ttParam":[{';
        $string .= '"IdAdr":"'.$this->getIdAdr().'", ';
        $string .= '"IdCli":"'.$this->getIdCli().'", ';
        $string .= '"IdDep":"'. $this->getIdDep().'", ';
        $string .= '"IdSal":"'. $this->getIdSal().'", ';
        $string .= '"IdSession":"'. $this->getIdSession().'", ';
        $string .= '"IdSoc":"'. $this->getIdSoc().'", ';
        $string .= '"IdU":"'.$this->getIdU().'", ';
        $string .= '"Valid":"'.$this->getValid().'"';
        $string .= '}]}}';

        return $string;
    }

    public function __toValsString() {
        $string = '{"IdAdr":"'.$this->getIdAdr().'", ';
        $string .= '"IdCli":"'.$this->getIdCli().'", ';
        $string .= '"IdDep":"'. $this->getIdDep().'", ';
        $string .= '"IdSal":"'. $this->getIdSal().'", ';
        $string .= '"IdSession":"'. $this->getIdSession().'", ';
        $string .= '"IdSoc":"'. $this->getIdSoc().'", ';
        $string .= '"IdU":"'.$this->getIdU().'", ';
        $string .= '"Valid":"'.$this->getValid().'"}';

        return $string;
    }

    public function __parse($data) {
        if(!is_null($data) && !empty($data)) {
            $data = json_decode($data);

            if(!isset($data->IdAdr) && !isset($data->IdCli)) {
                return false;
            }

            $this->IdAdr = $data->IdAdr;
            $this->IdCli = $data->IdCli;
            $this->IdDep = $data->IdDep;
            $this->IdSal = $data->IdSal;
            $this->IdSession = $data->IdSession;
            $this->IdSoc = $data->IdSoc;
            $this->IdU = $data->IdU;
            $this->Valid = $data->Valid;
        }
        return true;
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
     * @return CntxClient
     */
    public function setIdAdr($IdAdr)
    {
        $this->IdAdr = $IdAdr;
        return $this;
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
     * @return CntxClient
     */
    public function setIdCli($IdCli)
    {
        $this->IdCli = $IdCli;
        return $this;
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
     * @return CntxClient
     */
    public function setIdDep($IdDep)
    {
        $this->IdDep = $IdDep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdSal()
    {
        return $this->IdSal;
    }

    /**
     * @param mixed $IdSal
     * @return CntxClient
     */
    public function setIdSal($IdSal)
    {
        $this->IdSal = $IdSal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdSession()
    {
        return $this->IdSession;
    }

    /**
     * @param mixed $IdSession
     * @return CntxClient
     */
    public function setIdSession($IdSession)
    {
        $this->IdSession = $IdSession;
        return $this;
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
     * @return CntxClient
     */
    public function setIdSoc($IdSoc)
    {
        $this->IdSoc = $IdSoc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdU()
    {
        return $this->IdU;
    }

    /**
     * @param mixed $IdU
     * @return CntxClient
     */
    public function setIdU($IdU)
    {
        $this->IdU = $IdU;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->Valid;
    }

    /**
     * @param mixed $Valid
     * @return CntxClient
     */
    public function setValid($Valid)
    {
        $this->Valid = $Valid;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        if(!is_null($this->Valid)) {
            // séparation de la date et du time de la date Valid
            $args_fulldate = explode(' ', $this->Valid);
            // séparation de la date
            $args_date = explode('/', $args_fulldate[0]);
            // on créé la nouvelle date
            $date = new \DateTime($args_date[2].'-'.$args_date[1].'-'.$args_date[0]. ' '.$args_fulldate[1]);

            return ($date > new \DateTime('now'));
        }
        return false;
    }
}
