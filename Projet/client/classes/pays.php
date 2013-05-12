<?php

class Pays{
    private $idPays;
    private $nomPays;

    public function __construct($id, $nom){
        $this->idPays = $id;
        $this->nomPays = $nom;
    }

    public function setNomPays($nom){
        $this->nomPays = $nom;
    }
    public function setIdPays($nom){
        $this->idPays = $nom;
    }
    public function getNomPays(){
        return $this->nomPays;
    }
    public function getIdPays(){
        return $this->idPays;
    }
}
