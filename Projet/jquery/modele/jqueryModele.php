<?php
include _DIR_.'structure/modele.php';

class JqueryModele extends Modele{
    public function __construct(){
        parent::__construct();
    }

    public function findOne($champ, $table, $whereSearch, $where){
        $rslt = $this->getTable(array($champ),array($table), array ($whereSearch), array($where));
        foreach ($rslt as $valeur){
            return $valeur->$champ;
        }
    }

    public function enregistrer($listeChamp, $listeValeur, $table, $where, $primaryKey){
        $requete = new Requete('update '.$table.' set');
        if (count($listeChamp == count($listeValeur))){
            $i = 0;
            $nb = count($listeChamp);
            $fin = ',';
            foreach ($listeChamp as $valeur){
                if ($i == $nb -1){
                    $fin = '';
                }
                $requete->liste(array($valeur),'','= ?'.$fin);
                $i++;
            }
        }
        $requete->where($primaryKey, $where);
        $requete->queryPrepare($listeValeur);
        unset($requete);
    }
}
