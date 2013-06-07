<?php

class Fournisseurs{
    private $idFournisseur;
    private $nomFournisseur;
    private $telFournisseur;
    private $adresseFournisseur;
    
 //   public function __construct($idFournisseur, $telFournisseur, $nomFournisseur,
 //                                   $adresseFournisseur){
    public function __construct(&$fournisseur){
        $this->idFournisseur = $fournisseur['idFournisseur'];
        $this->nomFournisseur = $fournisseur['nomFournisseur'];
        $this->telFournisseur = $fournisseur['telFournisseur'];
        $this->adresseFournisseur = $fournisseur['adresseFournisseur'];
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
