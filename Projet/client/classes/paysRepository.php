<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/client/classes/pays.php';

class PaysRepository extends Repository{

    public function getAll(){
        $resultat = $this->findAll('pays', 'idPays');
        return $this->constructPays($resultat);
    }

    public function getBy($search, $champ){
        $requete = new Requete('select *');
        $requete->liste(array('pays'), 'from');
        $requete->where($champ,'?');
        $resultat = $requete->queryPrepare(array($search));
        return $this->constructPays($resultat);
    }

    public function constructPays($resultat){
        if ($resultat->rowCount() > 0){
            foreach ($resultat as $valeur){
                $liste[$valeur->idPays] = new Pays($valeur->idPays, $valeur->nomPays);
            }
        }
        return $liste; 
    }







}
