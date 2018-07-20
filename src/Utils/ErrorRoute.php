<?php

namespace App\Utils;


class ErrorRoute
{
    private $error=null;
    private $status_code=null;

    /**
     * ErrorRoute constructor.
     * @param string|null $error
     * @param integer|null $status_code
     */
    public function __construct($error, $status_code=null)
    {
        $this->setError($error);
        $this->setStatusCode($status_code);
    }

    /**
     * @return null|string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param null|string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return null|integer
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param null|integer $status_code
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
    }

    public function __toString()
    {
        return '{ "status_code": '.$this->getStatusCode().', "error": "'.$this->getError().'" }';
    }


}