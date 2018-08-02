<?php

namespace App\Services\Objets;

use Doctrine\Common\Collections\ArrayCollection;

class TTParam
{
    /**
     * @var ArrayCollection
     */
    private $params;

    private $TotalItems = 0;
    private $View = array();

    /**
     * TTParam constructor.
     */
    public function __construct()
    {
        $this->params = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = '';
        foreach ($this->params as $param){
            if($param instanceof CritParam ||
                $param instanceof WsClient ||
                $param instanceof WsArticle ||
                $param instanceof WsStock ||
                $param instanceof WsDocumEnt ||
                $param instanceof WsDocumLig ||
                $param instanceof WsFacCliAtt ||
                $param instanceof WsEdition ||
                $param instanceof WsLibelle ||
                $param instanceof WsDepot ||
                $param instanceof WsContact ||
                $param instanceof WsInstCat ||
                $param instanceof WsCateg ||
                $param instanceof WsFour ||
                $param instanceof WsUtil
            ) {
                $string .= ($string !== "") ? ',' : '';
                $string .= $param->__toString();
            }
            else {
                break;
            }
        }
        return '['.$string.']';

    }


    /**
     * @param mixed $param
     * @return TTParam
     */
    public function addItem($param){
        if($param instanceof CritParam ||
            $param instanceof WsClient ||
            $param instanceof WsArticle ||
            $param instanceof WsStock ||
            $param instanceof WsDocumEnt ||
            $param instanceof WsDocumLig ||
            $param instanceof WsFacCliAtt ||
            $param instanceof WsEdition ||
            $param instanceof WsLibelle ||
            $param instanceof WsDepot ||
            $param instanceof WsContact ||
            $param instanceof WsInstCat ||
            $param instanceof WsCateg ||
            $param instanceof WsFour ||
            $param instanceof WsUtil
        ) {
            $this->params[] = $param;
        }
        return $this;
    }

    /**
     * @param mixed $param
     * @return TTParam
     */
    public function removeItem($param){
        if($param instanceof CritParam ||
            $param instanceof WsClient ||
            $param instanceof WsArticle ||
            $param instanceof WsStock ||
            $param instanceof WsDocumEnt ||
            $param instanceof WsDocumLig ||
            $param instanceof WsFacCliAtt ||
            $param instanceof WsEdition ||
            $param instanceof WsLibelle ||
            $param instanceof WsDepot ||
            $param instanceof WsContact ||
            $param instanceof WsInstCat ||
            $param instanceof WsCateg ||
            $param instanceof WsFour ||
            $param instanceof WsUtil
        ) {
            $this->params->removeElement($param);
        }
        return $this;
    }

    /**
     * @param mixed $param
     * @return TTParam
     */
    public function removeItems(ArrayCollection $items){
        foreach($items as $item) {
            $this->params->removeElement($item);
        }
        return $this;
    }

    /**
     * @return int
     */
    public function countItems(){
        return $this->params->count();
    }

    /**
     * @param $index
     * @return CritParam|WsArticle|WsClient|WsStock
     */
    public function getItem($index){
        return $this->params->get($index);
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->params;
    }

    /**
     * @param ArrayCollection $params
     * @return TTParam
     */
    public function setItems(ArrayCollection $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param integer $index
     * @param mixed $item
     */
    public function setItem($index, $item)
    {
        $this->params[$index] = $item;
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->params->count();
    }


    /**
     * @return array
     */
    public function getView(): array
    {
        return $this->View;
    }

    /**
     * @param array $View
     */
    public function setView(array $View)
    {
        $this->View = $View;
    }




    /**
     * @param $property : Propriété ou le filtre doit s'appliquer
     * @param $value : Valeur de la propriété à filtrer
     * @return array
     */
    public function getItemsByFilter($property, $value)
    {
        $itemsFind = array();
        foreach ($this->params as $param){
            if(property_exists($param, $property)) {
                if($param->{$property} === $value){
                    array_push($itemsFind, $param);
                }
            }
            else {
                break;
            }
        }
        return $itemsFind;
    }

    /**
     * @param $property : Propriété ou le filtre doit s'appliquer
     * @param $value : Valeur de la propriété à filtrer
     * @return ArrayCollection
     */
    public function getItemsByFilterInArrayCollection($property, $value)
    {
        $itemsFind = new ArrayCollection();
        foreach ($this->params as $param){
            if(property_exists($param, $property)) {
                if($param->{$property} === $value){
                    $itemsFind->add($param);
                }
            }
        }
        return $itemsFind;
    }

    /**
     * @param $property : Propriété ou le filtre doit s'appliquer
     * @param $value : Valeur de la propriété à filtrer
     * @return mixed
     */
    public function getItemByFilter($property, $value)
    {
        foreach ($this->params as $param){
            if(property_exists($param, $property)) {
                if($param->{$property} === $value){
                    return $param;
                }
            }
        }
    }
}
