<?php
include_once _DIR_.'ORM/requete/requete.php';

class Repository{
    
    public function findAll($table){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setfromPart(array($table));
        return $requete->query();
        
    }
}