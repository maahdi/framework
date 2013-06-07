<?php

class Pays{
    private $idPays;
    private $nomPays;

    public function __construct(&$pays){
        $this->idPays = (int) $pays['idPays'];
        $this->nomPays = $pays['nomPays'];
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
