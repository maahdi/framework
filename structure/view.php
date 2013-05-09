<?php

class View{

    private $search = true;
    private $droit;
    private $data = array();
    private $action;
    private $menuGauche = false;
    private $erreur;

    public function render($url,array $data = null){
        $this->setData($data);
        include ($url);
    }        

    public function generateFichier($fichier, $bundle){
        include _DIR_.'Projet/'.$bundle.'/layout/'.$fichier.'.php';
    }

    public function getData($index){
        return $this->data[$index];
    }

    //Sert a afficher message erreur dans login.php
    public function setAction($action){
        $this->action = $action;
    }

    //Pour afficher le menu en fonction du module dans lequel on est
    public function setSubmenu($action){
        $this->menuGauche = $action;
    }

    public function getMenu(){
        include _MENU_.$this->menuGauche.".php";
    }

    public function turnSearchBarOff(){
        $this->search = false;
    }
    public function renderErrorAction(){
        $this->erreur = "Erreur 403";
        include (_DIR_.'Projet/erreur/erreur.php');
    }
    public function setData($data){
        if ($data != null){
            $key = array_keys($data);                          
            foreach ($key as $valeur){                       
                $this->data[$valeur] = $data[$valeur];        
            }
        }
    }
}
