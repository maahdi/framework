<?php
include_once _DIR_.'ORM/requete/requete.php';

class Repository{
    
    public function findAll($table, $orderBy){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setfromPart(array($table));
        $requete->setListePart(array($orderBy),'order by');
        $requete->setAscOrder();
        return $requete->query();
    }

    public function findBy($table, $where, $whereSearch){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setFromPart(array($table));
        $requete->addWherePart($where,$whereSearch);
        //echo $requete->toString();
        return $requete->query();
    }
}
