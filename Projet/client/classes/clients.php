<?php

class Clients{
    private $courriel;
    private $idClient;
    private $nomClient;
    private $prenomClient;
    private $adresseClient;
    private $cpClient;
    private $pays;

    public function __construct(&$client){
        $this->idClient      = (int) $client['idClient'];
        $this->nomClient     = $client['nomClient'];
        $this->prenomClient  = $client['prenomClient'];
        $this->courriel      = $client['emailClient'];
        $this->adresseClient = $client['adresseClient'];
        $this->cpClient      = $client['cpClient'];
        //undefined offset alors que $client est bien un tableau avec un objet pays à l'index "pays"
        $this->pays          = @$client['pays'];
    }

    public function getIdClient(){
        return $this->idClient;
    }

    public function setEmailClient($courrier){
        $this->courriel = $courrier;
    }

    public function getNomClient(){
        return $this->nomClient;
    }

    public function getPrenomClient(){
        return $this->prenomClient;
    }

    public function getAdresseClient(){
        return $this->adresseClient;
    }

    public function getCpClient(){
        return $this->cpClient;
    }

    public function setPays(Pays $pays){
        $this->pays = $pays;
    }

    public function getNomPays(){
        return $this->pays->getNomPays();
    }

    public function getIdPays(){
        return $this->pays->getIdPays();
    }

    public function getEmailClient(){
        return $this->courriel;
    }

    public function setIdClient($foo){
        $this->idClient = $foo;
    }

    public function setNomClient($foo){
        $this->nomClient = $foo;
    }

    public function setPrenomClient($foo){
        $this->prenomClient = $foo;
    }
    
    public function setAdresseClient($foo){
        $this->adresseClient = $foo;
    }

    public function setCpClient($foo){
        $this->cpClient = $foo;
    }

    public function modifierAll($nom , $prenom, $email, $adresse, $cp, $pays){
        $this->setEmailClient($email);
        $this->setPays($pays);
        $this->setNomClient($nom);
        $this->setPrenomClient($prenom);
        $this->setCpClient($cp);
        $this->setAdresseClient($adresse);
    }
}
