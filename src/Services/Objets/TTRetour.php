<?php

namespace App\Services\Objets;

use Doctrine\Common\Collections\ArrayCollection;

class TTRetour
{
    /**
     * @var ArrayCollection
     */
    private $tts;

    /**
     * TTParam constructor.
     */
    public function __construct()
    {
        $this->tts = new ArrayCollection();
    }

    /**
     * @param mixed $tt
     * @return ArrayCollection
     */
    public function addTable($tt, $key=null){
        if(!is_null($key)) {
            if(!$this->tts->containsKey($key)) {
                $this->tts[$key] = $tt;
            }
        }
        else {
            $this->tts[] = $tt;
        }
        return $this->tts;
    }

    /**
     * @param mixed $tt
     * @return ArrayCollection
     */
    public function removeTable($tt){
        $this->tts->removeElement($tt);
        return $this->tts;
    }

    /**
     * @return int
     */
    public function countTables(){
        return $this->tts->count();
    }

    /**
     * @return int
     */
    public function containsKey($key){
        return $this->tts->containsKey($key);
    }

    /**
     * @param $index
     * @return mixed
     */
    public function getTable($key){
        return $this->tts->get($key);
    }

    /**
     * @return ArrayCollection
     */
    public function getTables()
    {
        return $this->tts;
    }

    /**
     * @param ArrayCollection $tts
     * @return ArrayCollection
     */
    public function setTables(ArrayCollection $tts)
    {
        $this->tts = $tts;
        return $this->tts;
    }

    /**
     * @param mixed $tt
     * @param integer $index
     * @return ArrayCollection
     */
    public function setTable($tt, $key)
    {
        if($this->tts->containsKey($key)) {
            $this->tts[$key] = $tt;
        }
        return $this->tts;
    }

}
