<?php

class Controller{
    protected $view;
    protected $repository;
    
    public function __construct(){
        include _DIR_.'structure/view.php';
        $this->view = new View();
        include _DIR_.'structure/repositoryFinder.php';
        $this->repository = new RepositoryFinder();
    }           
    
    public function destroySession(){
        $_SESSION = array(); // Vide la variable $_SESSION 
        setcookie(session_name(),'',  time()-10);
        session_destroy();
        $this->view->setAction('login');
        $this->view->render(_DIR_.'Projet/connexion/layout/login.php');
    }
    
    //Change le choix du menu
    public function setMenuGauche($choixMenu){
        $this->view->menuGauche = $choixMenu;
    }
    
    public function setAccess($message){
        $this->view->setAccess($message);
    }
    
    public function renderErrorAction(){
        $this->view->renderErrorAction();
    }
    
    public function serializedObjet($fichier, $data, $mode){
        $fh = fopen($fichier, $mode);
        fwrite($fh, serialize($data));
        fclose($fh);
    }
    
    public function unserializedObjet($fichier){
        $fh = fopen($fichier,'r');
        $data = fread($fh, filesize($fichier));
        $commande = unserialize($data);
        fclose($fh);
        return $commande;
    }
    
    public function resetFichierObjet($fichier){
        $fh = fopen($fichier,'a');
        ftruncate($fh, filesize($fichier));
        fclose($fh);
    }
    
    public function getRepository($repo){
        return $this->repository->getRepo($repo);
    }
}