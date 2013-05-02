<?php

class View{
         public $droit;
         public $data = array();
         public $action;
         public $menuGauche = false;
         public $erreur;
         
	public function render($url,array $data = null){
            if ($data != null){
               $key = array_keys($data);
                foreach ($key as $valeur){
                    $this->data[$valeur] = $data[$valeur];
                }
            }
            include ($url);
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
       
        
}