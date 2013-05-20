<?php

class View{

    private $search = true;
    private $droit;
    private $data = array();
    private $action;
    private $menuGauche = false;

    //inclue l'url fournie et si nécessaire enregistre les données fournies 
    //dans $data[]
    public function render($url,array $data = null){
        $this->setData($data);
        include ($url);
    }        

    //Fonction a utiliser sur le layout principal pour activer les vues
    public function generateFichier($fichier, $bundle){
        include _DIR_.'Projet/'.$bundle.'/layout/'.$fichier.'.php';
    }

    //Fournie les données contenue dans $data[] à l'index en paramètre
    public function getData($index){
        if (isset($this->data[$index])){
            return $this->data[$index];
        }else{
            return false;
        }
    }

    //Sert a afficher message erreur dans login.php
    public function setAction($action){
        $this->action = $action;
    }

    //Pour afficher le menu en fonction du module dans lequel on est
    public function setSubmenu($action){
        $this->menuGauche = $action;
    }

    //Sert à choisir le sous-menu à afficher
    //contenu dans /Projet/layout/menu
    public function getMenu(){
        if ($this->menuGauche != false){
            include _MENU_.$this->menuGauche.".php";
        }
    }

    public function turnSearchBarOff(){
        $this->search = false;
    }

    public function renderErrorAction(){
        $this->render(_DIR_.'Projet/erreur/erreur.php');
    }

    //Permet d'enregistrer les données dans un même tableau $data[]
    //Pour y avoir accès dans la vue avec getData()
    public function setData($data){
        if ($data != null){
            $key = array_keys($data);                          
            foreach ($key as $valeur){                       
                $this->data[$valeur] = $data[$valeur];        
            }
        }
    }
}
