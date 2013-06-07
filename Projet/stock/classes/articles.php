<?php

class Articles{
    private $idArticle;
    private $refArticle;
    private $designation;
    private $prixHT;
    private $txTVA;
    private $prixTTC;
    private $stock;
    private $fournisseur;//Objet fournisseur fournis par la fabrique
    private $stockTheorique;

    public function __construct(&$article){
            $this->idArticle      = $article['idArticle'];
            $this->designation    = $article['designation'];
            $this->refArticle     = $article['refArticle'];
            $this->prixHT         = (float) $article['prixHT'];
            $this->txTVA          = (float) $article['txTVA'];
            $this->prixTTC        = round($this->prixHT * (1 + ($this->txTVA / 100)),3);
            $this->stock          = (int) $article['stock'];
            $this->stockTheorique = (int) $article['stockTheorique'];
            $this->fournisseur    = $article['fournisseurs'];
    }

    public function getStockTheorique(){
        return $this->stockTheorique;
    }

    public function setStockTheorique($valeur, $operateur){
        //
        // Possibilite de mettre des restrictions pour que le stock ne passe pas en négatif
        //
        switch($operateur){
        case '+':
            $this->stockTheorique = $this->stock + $valeur;
            break;
        case '-':
            $this->stockTheorique = $this->stock - $valeur;
            break;
        }
    }

    public function getIdArticle(){
        return $this->idArticle;
    }

    public function getRefArticle(){
        return $this->refArticle;
    }

    public function getPrixTTC(){
        return $this->prixTTC;
    }

    public function getTauxTVA(){
        return $this->txTVA;
    }

    public function getPrixHT(){
        return $this->prixHT;
    }

    public function getStock(){
        return $this->stock;
    }

    public function getDesignation(){
        return $this->designation;
    }

    public function getNomFournisseur(){
        return $this->fournisseur->getNomFournisseur();
    }

    public function setStock($newStock){
        $this->stock = (int) $newStock;
    }

    public function setDesignation($newDes){
        $this->designation = $newDes;
    }

    public function setFournisseur($newFournisseur){
        $this->fournisseur = $newFournisseur;
    }
}
