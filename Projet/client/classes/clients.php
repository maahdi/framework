<?php

class Clients{
    private $courriel;
    private $idClient;
    private $nomClient;
    private $prenomClient;
    private $adresseClient;
    private $cpClient;
    private $pays;

    public function __construct($client){
        $this->idClient      = $client['idClient'];
        $this->nomClient     = $client['nomClient'];
        //$this->prenomClient  = $prenom;
        //$this->courriel      = $courriel;
        //$this->adresseClient = $adresse;
        //$this->cpClient      = $cp;
        //$this->pays          = $pays;
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

    public function setPays($pays){
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
}
