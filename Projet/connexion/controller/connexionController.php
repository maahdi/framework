<?php
include _DIR_.'Projet/connexion/modele/connexionModele.php';
include _DIR_.'structure/controller.php';

class ConnexionController extends Controller{
    private $modele;
    
    public function __construct(){
       parent::__construct();
       $this->modele = new ConnexionModele();
    }
    
    public function login(){
        $this->view->render(_DIR_.'Projet/connexion/layout/login.php');
    }
    
    public function connexion(){
        //Indice numérique pour fonctionner avec $this->modele->testIdentifiant()
        $identifiant[0] = $_POST['login'];
        $identifiant[1] = $this->hashPassword($_POST['password']);
        if ($this->modele->testIdentifiant($identifiant)){
            //Enregistre la session pour l'identifier à chaque appel de page
            SessionPerso::setSession($identifiant[0], $identifiant[1]);
            $_SESSION['access'] = true;            
            $this->view->setSubmenu('menuAccueil');
            $this->view->render(_DIR_.'Projet/connexion/layout/accueil.php');
        }else{
            $_SESSION['access']= false;
            //Permet d'afficher le message 'Mauvais identifiants';
            $this->view->setAction('fail');
            //Renvoie a la page de login
            $this->login();
        }        
    }
    
    public function deconnex(){
        $this->destroySession();
    }
    
    private function hashPassword($password){
        return Config::hashPassword($password);
    }
}
