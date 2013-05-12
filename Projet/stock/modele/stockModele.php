<?php
include _DIR_.'structure/modele.php';

class stockModele extends Modele{
    public function __construct() {
        parent::__construct();
    }
    
    public function getListeArticles(){
        $resultat = $this->getTable(array('*'), array('articles'));
        return $resultat;
    }
}