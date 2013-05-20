<?php

class Controller{
    protected $view;
    protected $repository;
    protected $formValid = null;

    public function __construct(){
        include _DIR_.'structure/view.php';
        $this->view = new View();
        include _DIR_.'structure/repositoryFinder.php';
        $this->repository = new RepositoryFinder();
        if (is_file(_DIR_.'Projet/serialized/dataErreur.txt')){
            $this->view->setData($this->restoreDataFromError());
        }
    }           

    //Fontions à utiliser si on utilise la classe FormValidation
    public function setFormValid($c){
        $this->formValid = $c; 
    }

    public function getFormValid(){
        return $this->formValid;
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
    public function renderAccueil(){
        $this->view->setSubmenu('menuAccueil');
        $this->view->render(_DIR_.'Projet/connexion/layout/accueil.php');
    }
    public function setData(array $data){
        $this->view->setData($data);
    }

    //Vrai ou faux selon table utilisateurs
    //Ne gère pas de différence de niveau d'accès entre utilisateurs
    public function setAccess($message){
        $this->view->setAccess($message);
    }

    //Fonction appelée dans __construct() si il s'agit d'un retour d'erreur de formulaire
    public function restoreDataFromError(){
        $data = $this->unserializedObjet(_DIR_.'Projet/serialized/dataErreur.txt');
        unlink(_DIR_.'Projet/serialized/dataErreur.txt');
        return $data;
    }

    //Fonction en cas d'erreur
    //Si on vien d'un formulaire, elle enregistre les données dans un fichier
    //Et selon le type d'erreur renvoie un message spécifique ou non
    public function renderErrorAction($erreur){
        if (isset($_POST)){
            $this->serializedObjet(_DIR_.'Projet/serialized/dataErreur.txt', $_POST, 'w');
        }
        switch ($erreur->getCode()){
        case '23000':
            $this->view->setData(array('messageErreur' => 'Erreur n°'.$erreur->getCode().' :<br/>
                Le numéro d\'identification est déjà présent dans la base de données !!!'));
            break;
        default:
            $this->view->setData(array('messageErreur' => $erreur->getMessage()));
            break;
        }
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
        $objet = unserialize($data);
        fclose($fh);
        return $objet;
    }

    public function deleteFichier($fichier){
        unlink($fichier);
    }

    public function resetFichierObjet($fichier){
        $fh = fopen($fichier,'a');
        ftruncate($fh, filesize($fichier));
        fclose($fh);
    }

    //Fonction d'accès aux repositorys accessible a tous les controlleurs
    public function getRepository($repo){
        return $this->repository->getRepo($repo);
    }
}
