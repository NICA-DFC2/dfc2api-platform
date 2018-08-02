<?php

namespace App\Services\Filter;


use App\Services\Objets\CritParam;

class WsFilter
{
    protected $types = [
        'default' => '=',
        'equals' => '=',
        'after' => '>=',
        'before' => '<=',
        'strictly_after' => '>',
        'strictly_before' => '<',
        'not_equals' => '<>',
        'contains' => 'CONTAINS',
        'empty' => 'BLANC',
        'not_empty' => 'NONBLANC',
        'order' => 'order'
    ];

    protected $filter = "";
    protected $criteres_selection = array();
    protected $params_appel = array();

    /**
     * WsFilter constructor.
     *
     * @param $filter : parametres de l'url correspondant à "Request::class->request->query->all()"
     */
    public function __construct($filter)
    {
        $this->setCritSel($filter);
        $this->setParamsAppel($filter);
    }


    /**
     * Retourne un array de CritParam
     *
     * @return array
     */
    public function getCritSel() {
        return $this->criteres_selection;
    }

    /**
     * Retourne un array de CritParam
     *
     * @return array
     */
    public function getParamsAppel() {
        return $this->params_appel;
    }


    /**
     * Convertir les parametres d'url en un array de CritParam pour l'appel webservice. array qui est utilisé dans "pijDSCritSel"
     * @param $filter
     * @return array
     */
    public function setCritSel($filter) {
        $this->criteres_selection = array();

        if(!is_null($filter) && is_array($filter)){
            // boucle dans les paramètres d'URL
            foreach($filter as $property => $value_property) {

                // la valeur est de type string
                if(is_string($value_property)){

                    if($this->is_date($value_property)){
                        // création d'un critére de selection avec l'opérateur par defaut pour les dates exclusivement
                        array_push($this->criteres_selection, new CritParam($property, $this->format_date($value_property), 1));
                        array_push($this->criteres_selection, new CritParam($property, $this->types['default'], 2));
                    }
                    else {
                        // création d'un critére de selection avec l'opérateur par defaut pour tout sauf les dates
                        array_push($this->criteres_selection, new CritParam($property, str_replace('+', ' ', $value_property), 1));
                        array_push($this->criteres_selection, new CritParam($property, $this->types['default'], 2));
                    }
                }

                // la valeur est de type array
                else if(is_array($value_property)){
                    // boucle dans les paramètres d'URL qui sont des tableaux (exemple: DateDE[after]=2017-12-14)
                    foreach($value_property as $type_filter => $value_filter) {

                        if($type_filter === $this->types['order']){
                            // création d'un critére de selection pour le trie de la réponse
                            array_push($this->criteres_selection, new CritParam($property, $value_filter, 1, '|Tri|'));
                        }
                        else {
                            if($this->is_date($value_filter)){
                                // création d'un critére de selection avec l'opérateur définit pour les dates exclusivement
                                array_push($this->criteres_selection, new CritParam($property, $this->format_date($value_filter), 1));
                                array_push($this->criteres_selection, new CritParam($property, $this->types[$type_filter], 2));
                            }
                            else {
                                // création d'un critére de selection avec l'opérateur définit pour tout sauf les dates
                                array_push($this->criteres_selection, new CritParam($property, str_replace('+', ' ', $value_filter), 1));
                                array_push($this->criteres_selection, new CritParam($property, $this->types[$type_filter], 2));
                            }
                        }

                    }
                }
            }
        }
        return $this->criteres_selection;
    }

    /**
     * Convertir les parametres d'url en un array de CritParam pour l'appel webservice. array qui est utilisé dans "pijDSParamAppel"
     * @param $filter
     * @return array
     */
    public function setParamsAppel($filter) {
        $this->params_appel = array();

        if(!is_null($filter) && is_array($filter)){
            // boucle dans les paramètres d'URL
            foreach($filter as $property => $value_property) {

                // la valeur est de type string
                if(is_string($value_property)){

                    if($property === 'RowIdEnrSuiv'){
                        // création d'un parametre avec l'opérateur par defaut pour tout sauf les dates
                        array_push($this->params_appel, new CritParam($property, $value_property));
                    }
                }
            }
        }
        return $this->params_appel;
    }

    /**
     * Verification que $value est une date
     * @param $value
     * @return bool
     */
    private function is_date($value){
        $value = str_replace('/', '-', $value);
        $stamp = strtotime($value);
        if (is_numeric($stamp)){
            $month = date( 'm', $stamp );
            $day   = date( 'd', $stamp );
            $year  = date( 'Y', $stamp );
            return checkdate($month, $day, $year);
        }
        return false;
    }

    /**
     * @param $value
     * @param string $separator
     * @return mixed|string
     */
    private function format_date($value, $separator = '-'){
        $value = str_replace('/', '-', $value);
        $stamp = strtotime($value);
        if (is_numeric($stamp)){
            $month = date( 'm', $stamp );
            $day   = date( 'd', $stamp );
            $year  = date( 'Y', $stamp );
            return $day . $separator . $month . $separator . $year;
        }
        return $value;
    }
}