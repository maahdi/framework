<?php
include _DIR_.'ORM/pdo/pdo.php';

class Requete{
    private $mysql;
    private $where = true;
    private $requete='';
    private $pdostatement=true;

    //On peut appeler Requete en spécifiant une commande SQL ou non
    //Met l'objet PDOStatement en mode objet;
    public function __construct($commande = null) {
        $this->mysql = DB::getInstance();
        if ($commande != null){
            $this->requete = $commande.' ';
        }
    }

    //
    //Appeler automatiquement après un execute()
    //
    private function resetRequete(){
        $this->requete = false;
        $this->pdostatement = false;
        $this->where = true;
    }

    public function from(array $liste){
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

        $this->pdostatement->execute($valeur);
        if ($this->pdostatement->rowCount() == 0){
            $this->resetRequete();
            return false;
        }else{
            $this->setFetchModObj();
            $retour = $this->pdostatement;
            $this->resetRequete();
            return $retour;
        }
    }

    public function query(){
        $this->pdostatement = $this->mysql->query($this->requete);
        if ($this->pdostatement == null){
            $this->resetRequete();
            return false;
        }else{
            $this->setFetchModObj();
            $retour = $this->pdostatement;
            $this->resetRequete();
            return $retour;
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
    public function where($champ,$valeur, $choix = null){
        if ((!($valeur == '?')) && $choix == true){
            $valeur = '\''.$valeur.'\'';
        }
        if ($choix == null){
            $choix = 'and';
        }
        $where = '';
        if ($this->where){
            $where = 'where ' .$this->addEgal($champ, $valeur, $where);
            $this->where = false;
        }else{
            $where = $choix.' '.$this->addEgal($champ, $valeur, $where);
        }
        $this->requete .= $where.' ';
    }

    private function setFetchModObj(){
        $this->pdostatement->setFetchMode(PDO::FETCH_OBJ);
    }

    private function setFetchModAssoc(){
        $this->pdostatement->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function addEgal($champ, $Valeur, $req){
        $req .= $champ.'='.$Valeur;
        return $req;
    }

    private function addVirgule($liste){
        $req = "";
        $nb = count($liste);
        for ($i = 0 ; $i< $nb; $i++){
            $req .= $liste[$i].' ' ;
            if ($i != $nb-1){
                $req .= ', ';
            }
        }
        return $req;
    }
}
