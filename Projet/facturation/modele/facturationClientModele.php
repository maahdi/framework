<?php

include _DIR_.'structure/modele.php';

class FacturationClientModele extends Modele{
    public function __construct(){
        parent::__construct();
    }

    //
    //Retourne array( valeur )
    //
    public function getAllId($champ, $table){
        $rslt = $this->getTable(array($champ),array($table));
        $id = array();
        foreach($rslt as $valeur){
            $id[] = $valeur->$champ;
        }
        return $id;
    }

}