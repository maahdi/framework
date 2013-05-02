<?php
include _DIR_."ORM/pdo/pdo.php";

class Requete{
    private $mysql;
    private $wherePart = "where ";
    private $requete="";
    private $pdostatement=true;
    
    
    
    
    public function __construct($commande) {
        $this->mysql = DB::getInstance();
        $this->requete = $commande." ";
    }
    
    public function resetRequete(){
        $this->requete = "";
        $this->pdostatement = true;
    }
    
    public function setfromPart(array $liste){
        $this->requete .= " from ".$this->addVirgule($liste);
    }
    public function queryPrepare(array $valeur){
        $this->pdostatement = $this->mysql->prepare($this->requete);
        $this->pdostatement->execute($valeur);
        $this->setFetchModObj();
        return $this->pdostatement;
    }
    public function query(){
        $this->pdostatement = $this->mysql->query($this->requete);
        $this->setFetchModObj();
        return $this->pdostatement;
    }
    
    public function setAscOrder(){
        $this->requete .= "ASC";
    }
    
    public function setDescOrder(){
        $this->requete .= "DESC";
    }
    
    //$liste =array()
    public function setListePart(array $liste, $entete = null, $pied = null){
        if (isset($entete)){
            $this->requete .= $entete." ".$this->addVirgule($liste);
        }else{
            $this->requete .= $this->addVirgule($liste);
        }
        if (isset($pied)){
            $this->requete .= $pied." ";
        }
    }

    //$liste =array()
    public function setListeTable(array $liste, $entete = null){
        $this->setListePart($liste, $entete);
    }

    public function toString(){
            return $this->requete;
    }
    
    public function addWherePart($champ,$valeur){
        if ($this->wherePart == "where "){
            $this->wherePart = $this->addEgal($champ, $valeur, $this->wherePart);
        }else{
            $this->wherePart = " and ";
            $this->wherePart = $this->addEgal($champ, $valeur, $this->wherePart);
        }
        $this->requete .= $this->wherePart." ";
        $this->wherePart = "";
    }
    
    private function setFetchModObj(){
            $this->pdostatement->setFetchMode(PDO::FETCH_OBJ);
           // return $pdostatement;
    }
    
    private function addEgal($Champ, $Valeur, $req){
        $req .= $Champ."=".$Valeur;
        return $req;
    }
    
    private function addVirgule($liste){
        $req = "";
        $nb = count($liste);
        for ($i = 0 ; $i< $nb; $i++){
                $req .= "$liste[$i] ";
                if ($i != $nb-1){
                    $req .= ", ";
                }
            }
            return $req;
    }
}
