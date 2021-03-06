<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/stock/classes/articles.php';

class ArticlesRepository extends Repository{
    
    public function getAll(){
        return parent::getAll();
    }
//    public function getAll($fournisseurs){
//        $resultat = $this->findAll('articles','idArticle');
//        if ($resultat->rowCount() > 0){
//            foreach ($resultat as $valeur){
//            $liste[$valeur->idArticle] = new Article($valeur->idArticle, $valeur->refArticle,
//                    $valeur->designation, round($valeur->prixHT,3), $valeur->txTVA,
//                    $valeur->stock, $valeur->stockTheorique, $fournisseurs[$valeur->idFournisseur]);
//            }
//            return $liste;
//        }
//    }
    
    public function getOne($id){
        return parent::getOne($id);
    }
    //public function getOne($id, $fournisseur){
    //    $resultat = $this->findBy('articles', $id, 'idArticle');
    //    foreach($resultat as $valeur){
    //        $article = new Article($valeur->idArticle, $valeur->refArticle, $valeur->designation,
    //                                round($valeur->prixHT,3), $valeur->txTVA, $valeur->stock,
    //                                $valeur->stockTheorique, $fournisseur[$valeur->idFournisseur]);
    //    }
    //    return $article;
    //}

    public function getByOrder($orderBy, $order){
        $requete = new Requete('select '.$orderBy.',idArticle');
        $requete->liste(array('articles'), 'from');
        $requete->liste(array('order by '.$orderBy.' '.$order));
        $rslt = $requete->queryPrepare(array($orderBy, $order));
        foreach ($rslt as $valeur){
            $clients[$valeur->idArticle] = $this->getOne($valeur->idArticle);
        }
        return $clients;
    }
}
