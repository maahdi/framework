<?php
include _DIR_.'ORM/pdo/pdo.php';

class Requete{
    private $mysql;
    private $where = 'where ';
    private $requete='';
    private $pdostatement=true;
    private $disable = false;
    
    //On peut appeler Requete en spécifiant une commande SQL ou non
    //Met l'objet PDOStatement en mode objet;
    public function __construct($commande = null) {
        $this->mysql = DB::getInstance();
        if ($commande != null){
            $this->requete = $commande.' ';
        }
        $this->disable = false;
    }

    //
    //Appeler automatiquement après un execute()
    //
    private function resetRequete(){
        $this->requete = '';
        //$this->pdostatement->closeCursor();
        $this->where = 'where ';
    }
    
    public function setfromPart(array $liste){
        $this->requete .= ' from '.$this->addVirgule($liste);
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
        if ($this->disable){
         $exec = $this->secureDonnees($valeur);    
         $this->disable = false;
        }else{
            $exec = $valeur;
        }
        $this->pdostatement->execute($exec);
        if ($this->pdostatement == null){
            return false;
        }else{
            $this->setFetchModObj();
            $this->resetRequete();
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
        $this->requete .= 'ASC';
    }
    
    public function setDescOrder(){
        $this->requete .= 'DESC';
    }
    
    public function liste(array $liste, $entete = null, $pied = null){
        if (isset($entete)){
            $this->requete .= $entete.' '.$this->addVirgule($liste);
        }else{
            $this->requete .= $this->addVirgule($liste);
        }
        if (isset($pied)){
            $this->requete .= $pied.' ';
        }
    }

    public function toString(){
            return $this->requete;
    }
    //
    // $choix : null pour le premier après on choisi AND ou OR 
    // Par default AND
    //
    public function where($champ,$valeur, $escape = null, $choix = null){
        if ((!($valeur == '?')) && $choix == true){
            $valeur = '\''.$valeur.'\'';
        }
        if ($choix == null){
            $choix ='and';
        }
        if ($this->where == 'where '){
            $this->where = $this->addEgal($champ, $valeur, $this->where);
        }else{
            $this->where = ' '.$choix.' ';
            $this->where = $this->addEgal($champ, $valeur, $this->where);
        }
        $this->requete .= $this->where.' ';
        $this->where = '';
    }
    
    private function setFetchModObj(){
            $this->pdostatement->setFetchMode(PDO::FETCH_OBJ);
    }
    
    private function addEgal($champ, $Valeur, $req){
        $req .= $champ.'='.$Valeur;
        return $req;
    }
    
    private function addVirgule($liste){
        $req = "";
        $nb = count($liste);
        for ($i = 0 ; $i< $nb; $i++){
                $req .= "$liste[$i] ";
                if ($i != $nb-1){
                    $req .= ', ';
                }
            }
            return $req;
    }
}
