<?php
include _DIR_.'ORM/requete/requete.php';

class Modele{
    public function __construct(){
    }
    
    public function getTable(array $listeChamps, array $listeTable, array $whereSearch = null, array $where = null){
        $requete = new Requete('select');
        $requete->liste($listeChamps);
        $requete->from($listeTable);
        if ($whereSearch != null && $where != null && count($where) > 0){
            foreach ($where as $champ){
                $requete->where($champ, '?');
            }
            $retour = $requete->queryPrepare($whereSearch);
            unset($requete);
            return $retour; 

        }else{
            $retour = $requete->query();
            unset($requete);
            return $retour;
        }
    }
    
    public function updateTable(array $listeChamps, array $listeValeur, $whereSearch, $table, $where){
        $requete = new Requete('insert into');
        $requete->setListeTable(array($table));
        $requete->liste($listeChamps,'(',')');
        $requete->liste($listeValeur,' values (',')');
        $requete->where($where, $whereSearch);
        $requete->query();
        unset($requete);
    }
    
    public function getRequete($commande){
        return new Requete($commande);
    }
}
