<?php

namespace App\Services\Objets;

class CntxAdmin
{
    private $IdCais;
    private $IdDep;
    private $IdentAppliCli;
    private $IdSal;
    private $IdSession;
    private $IdSoc;
    private $IdU;
    private $Valid;

    public function __construct($IdCais=null, $IdDep=null, $IdentAppCli=null, $IdSal=null, $IdSession=null, $IdSoc=null, $IdU=null, $Valid=null)
    {
        $this->IdCais = $IdCais;
        $this->IdDep = $IdDep;
        $this->IdentAppliCli = $IdentAppCli;
        $this->IdSal= $IdSal;
        $this->IdSession = $IdSession;
        $this->IdSoc = $IdSoc;
        $this->IdU = $IdU;
        $this->Valid = $Valid;
    }

    public function __toString() {
        $string = '{"ProDataSet":{"ttParam":[{';
        $string .= '"IdCais":"'.$this->getIdCais().'", ';
        $string .= '"IdDep":"'.$this->getIdDep().'", ';
        $string .= '"IdentAppliCli":"'. $this->getIdentAppliCli().'", ';
        $string .= '"IdSal":"'. $this->getIdSal().'", ';
        $string .= '"IdSession":"'. $this->getIdSession().'", ';
        $string .= '"IdSoc":"'. $this->getIdSoc().'", ';
        $string .= '"IdU":"'.$this->getIdU().'", ';
        $string .= '"Valid":"'.$this->getValid().'"';
        $string .= '}]}}';

        return $string;
    }

    public function __toValsString() {
        $string = '{"IdCais":"'.$this->getIdCais().'", ';
        $string .= '"IdDep":"'.$this->getIdDep().'", ';
        $string .= '"IdentAppliCli":"'. $this->getIdentAppliCli().'", ';
        $string .= '"IdSal":"'. $this->getIdSal().'", ';
        $string .= '"IdSession":"'. $this->getIdSession().'", ';
        $string .= '"IdSoc":"'. $this->getIdSoc().'", ';
        $string .= '"IdU":"'.$this->getIdU().'", ';
        $string .= '"Valid":"'.$this->getValid().'"}';

        return $string;
    }

    public function __parse($data)
    {
        if(!is_null($data) && !empty($data)) {
            $data = json_decode($data);

            if(!isset($data->IdCais) && !isset($data->IdentAppliCli)) {
                return false;
            }

            $this->IdCais = $data->IdCais;
            $this->IdDep = $data->IdDep;
            $this->IdentAppliCli = $data->IdentAppliCli;
            $this->IdSal= $data->IdSal;
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
    public function getIdCais()
    {
        return $this->IdCais;
    }

    /**
     * @param mixed $IdCais
     */
    public function setIdCais($IdCais)
    {
        $this->IdCais = $IdCais;
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
    public function getIdentAppliCli()
    {
        return $this->IdentAppliCli;
    }

    /**
     * @param mixed $IdentAppliCli
     */
    public function setIdentAppliCli($IdentAppliCli)
    {
        $this->IdentAppliCli = $IdentAppliCli;
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
     */
    public function setIdSal($IdSal)
    {
        $this->IdSal = $IdSal;
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
     */
    public function setIdSession($IdSession)
    {
        $this->IdSession = $IdSession;
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
    public function getIdU()
    {
        return $this->IdU;
    }

    /**
     * @param mixed $IdU
     */
    public function setIdU($IdU)
    {
        $this->IdU = $IdU;
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
     * @return CntxAdmin
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
            if(is_array($args_fulldate)) {
                // séparation de la date
                $args_date = explode('/', $args_fulldate[0]);
                if (is_array($args_date)) {
                    if($args_date[2] !== '' && $args_date[1]  !== '' && $args_date[0] !== '') {
                        // on créé la nouvelle date
                        $date = new \DateTime($args_date[2] . '-' . $args_date[1] . '-' . $args_date[0] . ' ' . $args_fulldate[1]);
                        return ($date > new \DateTime('now'));
                    }
                }
            }
        }
        return false;
    }

}
