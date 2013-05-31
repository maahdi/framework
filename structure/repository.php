<?php
include_once _DIR_.'ORM/requete/requete.php';

class Repository{
    
    //
    //$orderBy = nomDuChamp
    //
    public function findAll($table, $orderBy){
        $requete = new Requete('select');
        $requete->liste(array('*'));
        $requete->liste(array($table), 'from');
        $requete->liste(array($orderBy),'order by');
        $requete->setAscOrder();
        $retour = $requete->query();
        unset($requete);
        return $retour;
    }

    //
    //On lui donne la table, le champ de la recherche et le champ recherché
    //
    public function findBy($table, $where, $whereSearch){
        $requete = new Requete('select');
        $requete->liste(array('*'));
        $requete->liste(array($table), 'from');
        $requete->where('?', '?');
        $rslt = $requete->queryPrepare(array($where,$whereSearch));
        unset($requete);
        if (!$rslt){
            return false;
        }else{
            return $rslt;
        }
    }
}
