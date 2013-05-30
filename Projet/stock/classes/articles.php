<?php

class Article{
    private $idArticle;
    private $refArticle;
    private $designation;
    private $prixHT;
    private $txTVA;
    private $prixTTC;
    private $stock;
    private $fournisseur;//Objet fournisseur fournis par la fabrique
    private $qteCmd;//Utile lors de la création d'un objet commande
    private $totalHT = null;

    public function __construct($idArticle, $refArticle, $designation, $prixHT,
        $txTVA, $stock, $fournisseur, $qte = null){
            $this->idArticle = $idArticle;
            $this->designation = $designation;
            $this->refArticle = $refArticle;
            $this->prixHT = (float) $prixHT;
            $this->txTVA = (float) $txTVA;
            $this->prixTTC = round($this->prixHT * (1 + ($this->txTVA / 100)),3);
            $this->stock = (int) $stock;
            $this->fournisseur = $fournisseur;
            $this->qteCmd = (int) $qte;
    }

    public function setQuantiteCmd($qte){
        $this->qteCmd = (int) $qte;
        $this->totalHT = $qte * $this->prixHT;
    }

    public function getTotalHT(){
        return $this->totalHT;
    }
    public function getQteCmd(){
        return $this->qteCmd;
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
