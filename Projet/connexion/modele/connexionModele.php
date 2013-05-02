<?php

include _DIR_."structure/modele.php";

class ConnexionModele extends Modele{
    public function __construct(){
        parent::__construct();
        //Exemple de requete == 'select * from clients where nomClient='Dupond'
        //$resultat = $this->getTable(array('*'), array('clients'),array('Dupond'),array('nomClient'));
//        foreach ($resultat as $valeur){
//            echo $valeur->idClient;
//        }
      
    }
    
}