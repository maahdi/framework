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

    public function supprimerOneArticleCommande(array $champ, array $value, $table){
        $requete = new Requete('select qteCmd from produitcmd');
        $requete->where('idArticle', $value[0]);
        $pdo = $requete->queryPrepare(array($value[0]));
        foreach ($pdo as $valeur){
            $stockARajouter = $valeur->qteCmd;
        }
        $requete->liste(array($table),'delete from');
        //$requete = new Requete('delete from '.$table);
        foreach($champ as $valeur){
            $requete->where($valeur, '?');
        }
        $requete->queryPrepare($value);
        $requete->liste(array('update articles'));
        $requete->liste(array('set stockTheorique = stockTheorique + ?'));
        $requete->where('idArticle','?');
        $requete->queryPrepare(array($stockARajouter, $value[0]));
        unset($requete);
    }

}
