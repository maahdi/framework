<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/client/classes/pays.php';

class PaysRepository extends Repository{

    public function getAll(){
        return parent::getAll();
    }

    public function getOne($id){
        return parent::getOne($id);
    }

    public function getBy($search, $champ){
        $requete = new Requete('select idPays');
        $requete->liste(array('pays'), 'from');
        $requete->where('upper('.$champ.')','?', true);
        $resultat = $requete->queryPrepare(array($search));
        unset($requete);
        if ($resultat->rowCount() == 0){
            return false;
        }else{
            foreach ($resultat as $valeur){
                $return = parent::getOne($valeur->idPays);
            }
            return $return;
        }
    }

    //public function constructPays($resultat){
    //    if ($resultat->rowCount() > 0){
    //        foreach ($resultat as $valeur){
    //            $liste[$valeur->idPays] = new Pays($valeur->idPays, $valeur->nomPays);
    //        }
    //    }
    //    return $liste; 
    //}
}
