<?php
include _DIR_.'structure/repository.php';
include _DIR_.'Projet/client/classes/pays.php';

class PaysRepository extends Repository{

    public function getAll(){
        $resultat = $this->findAll('pays', 'idPays');
        return $this->constructPays($resultat);
    }

    public function getBy($search, $champ){
        $resultat = $this->findBy('pays','upper('.$champ.')', $search);
        return $this->constructPays($resultat);
    }

    public function constructPays($resultat){
        if ($resultat->rowCount() > 0 ){
            foreach ($resultat as $valeur){
                $liste[$valeur->idPays] = new Pays($valeur->idPays, $valeur->nomPays);
            }
        }
        return $liste; 
    }







}
