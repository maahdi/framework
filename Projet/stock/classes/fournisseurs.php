<?php

class Fournisseur{
    private $idFournisseur;
    private $nomFournisseur;
    private $telFournisseur;
    private $adresseFournisseur;
    
    public function __construct($idFournisseur, $telFournisseur, $nomFournisseur,
                                    $adresseFournisseur){
        $this->idFournisseur = $idFournisseur;
        $this->nomFournisseur = $nomFournisseur;
        $this->telFournisseur = $telFournisseur;
        $this->adresseFournisseur = $adresseFournisseur;
    }
    
    public function getIdFournisseur(){
        return $this->idFournisseur;
    }
    
    public function getNomFournisseur(){
        return $this->nomFournisseur;
    }
    
    public function getTelFournisseur(){
        return $this->telFournisseur;
    }
    
    public function getAdresseFournisseur(){
        return $this->adresseFournisseur;
    }
}
?>