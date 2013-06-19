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
    public function ajoutOneStock($id){
        $requete = new Requete('update articles set');
        $requete->liste(array('stock = stock+1','stockTheorique = stockTheorique+1'));
        $requete->where('idArticle', '?');
        $requete->queryPrepare(array($id));
    }
    public function suppressionOneStock($id){
        $requete = new Requete('update articles set');
        $requete->liste(array('stock = stock-1','stockTheorique = stockTheorique-1'));
        $requete->where('idArticle', '?');
        $requete->queryPrepare(array($id));
    }
    public function getStockNeg(){
        $requete = new Requete('select idArticle from articles where stockTheorique <= 0');
        $rslt = $requete->query();
        foreach ($rslt as $valeur){
            $id [] = $valeur->idArticle;
        }
        return $id;
    }
}
