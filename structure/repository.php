<?php
include_once _DIR_.'ORM/requete/requete.php';

class Repository{
    
    //$orderBy = 'DESC' ou 'ASC' directement
    public function findAll($table, $orderBy){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setfromPart(array($table));
        $requete->setListePart(array($orderBy),'order by');
        $requete->setAscOrder();
        return $requete->query();
    }

    //On lui donne la table, le champ de la recherche et le champ recherché
    public function findBy($table, $where, $whereSearch){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setFromPart(array($table));
        $requete->addWherePart($where,$whereSearch);
        //echo $requete->toString();
        return $requete->query();
    }
}
