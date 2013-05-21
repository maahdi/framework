<?php
include _DIR_.'ORM/pdo/pdo.php';

class Requete{
    private $mysql;
    private $wherePart = 'where ';
    private $requete='';
    private $pdostatement=true;
    
    //On peut appeler Requete en spécifiant une commande SQL ou non
    //Met l'objet PDOStatement en mode objet;
    public function __construct($commande = null) {
        $this->mysql = DB::getInstance();
        if ($commande != null){
            $this->requete = $commande." ";
        }
    }
    
    public function resetRequete(){
        $this->requete = "";
        $this->pdostatement->closeCursor();
        $this->wherePart = 'where ';
    }
    
    public function setfromPart(array $liste){
        $this->requete .= " from ".$this->addVirgule($liste);
    }

    public function queryPrepare(array $valeur){
        $this->pdostatement = $this->mysql->prepare($this->requete);
        $nb = count($valeur);
        $i = 0;
        //Boucle servant à mettre une valeur par défault s'il n'y as rien a enregistrer
        while ($i < $nb){
            if ($valeur[$i] == null){
                $valeur[$i] = '';
            }
            $i++;
        }
        $this->pdostatement->execute($valeur);
        if ($this->pdostatement == null){
            return false;
        }else{
            $this->setFetchModObj();
            return $this->pdostatement;
        }
    }
    public function query(){
        $this->pdostatement = $this->mysql->query($this->requete);
        if ($this->pdostatement == null){
            return false;
        }else{
            $this->setFetchModObj();
            return $this->pdostatement;
        }
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
   //$choix : null pour le premier après on choisi and ou or 
    public function addWherePart($champ,$valeur,$choix = null){
        if (!($valeur == '?')){
           // $valeur = '\''.$valeur.'\'';
        }
        if ($choix == null){
            $choix ='and';
        }
        if ($this->wherePart == 'where '){
            $this->wherePart = $this->addEgal($champ, $valeur, $this->wherePart);
        }else{
            $this->wherePart = ' '.$choix.' ';
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
