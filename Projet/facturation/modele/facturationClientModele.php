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
        if ($pdo->rowCount() > 0){
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

    public function deleteCommande($idCmd){
        $requete = new Requete ('select idArticle, qteCmd');
        $requete->liste(array('produitcmd'), 'from');
        $requete->where('idCmd', '?');
        $pdoStatement = $requete->queryPrepare(array($idCmd));
        if ($pdoStatement->rowCount() > 0 ){
        foreach ($pdoStatement as $valeur){
                $requete->liste(array('update articles'));
                $requete->liste(array('set stockTheorique = stockTheorique + ?'));
                $requete->where('idArticle','?');
                $requete->queryPrepare(array($valeur->qteCmd, $valeur->idArticle));
            }
            $requete->liste(array('delete from commandes'));
            $requete->where('idCmd', '?');
            $requete->queryPrepare(array($idCmd));
            $requete->liste(array('delete from produitcmd'));
            $requete->where('idCmd', '?');
            $requete->queryPrepare(array($idCmd));
        }
    }

    public function facturerCommande($commande){
        $requete = new Requete('update commandes set');
        $requete->liste(array('valid = ?'));
        $requete->where('idCmd', '?');
        $requete->queryPrepare(array('1',
                                     $commande->getIdCmd()));
        foreach ($commande->getListeArticle() as $valeur){
            $requete->liste(array('update articles set'));
            $requete->liste(array('stock = stock-?'));
            $requete->where('idArticle', '?');
            $requete->queryPrepare(array($valeur['qte'],
                                         $valeur['article']->getIdArticle()));
        }
    }

}
