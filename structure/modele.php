<?php
include _DIR_."ORM/requete/requete.php";

class Modele{
    public function __construct() {
        
    }
    public function getTable(array $listeChamps, array $listeTable, array $whereSearch = null, array $where = null){
        $requete = new Requete('select');
        $requete->setListePart($listeChamps);
        $requete->setfromPart($listeTable);
        if ($whereSearch != null && $where != null && count($where) > 0){
            foreach ($where as $champ){
                $requete->addWherePart($champ, '?');
            }
            return $requete->queryPrepare($whereSearch);
        }else{
            return $requete->query();
        }
        
    }
    
    public function updateTable(array $listeChamps, array $listeValeur, $whereSearch, $table, $where){
        $requete = new Requete('insert into');
        $requete->setListeTable(array($table));
        $requete->setListePart($listeChamps,'(',')');
        $requete->setListePart($listeValeur,' values (',')');
        $requete->addWherePart($where, $whereSearch);
        $requete->query();
    }
}
