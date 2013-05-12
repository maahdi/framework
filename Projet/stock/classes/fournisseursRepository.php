<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'structure/repositoryInterface.php';
include_once _DIR_.'Projet/stock/classes/fournisseurs.php';

class FournisseursRepository extends Repository implements RepositoryInterface{
    
    public function getAll(){
        $resultat = $this->findAll('fournisseurs','idFournisseur');
        if ($resultat->rowCount() > 0){
            foreach ($resultat as $valeur){
            $liste[$valeur->idFournisseur] = new Fournisseur($valeur->idFournisseur,
                    $valeur->telFournisseur, $valeur->nomFournisseur, $valeur->adresseFournisseur);
        }
        return $liste;
        }
    }
    
    public function getOne($id){
        
    }
}
