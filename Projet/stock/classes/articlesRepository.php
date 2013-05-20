<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/stock/classes/articles.php';

class ArticlesRepository extends Repository{
    
    public function getAll($fournisseurs){
        $resultat = $this->findAll('articles','idArticle');
        if ($resultat->rowCount() > 0){
            foreach ($resultat as $valeur){
            $liste[$valeur->idArticle] = new Article($valeur->idArticle, $valeur->refArticle,
                    $valeur->designation, round($valeur->prixHT,3), $valeur->txTVA,
                    $valeur->stock, $fournisseurs[$valeur->idFournisseur]);
            }
            return $liste;
        }
    }
    
    public function getOne($id){
        
    }
}
