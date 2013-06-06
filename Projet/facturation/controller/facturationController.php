<?php

include _DIR_.'structure/controller.php';
class FacturationController extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function displayAccueilFacturation(){
        $this->view->setData(array('accueil' => true));
        $this->view->setSubMenu('menuAccueil');
        $this->view->render(_DIR_.'Projet/facturation/layout/pageFacturation.php');
    }

    public function getClient(){
        $listeClient = &$this->getRepository('clients')->getAll();
//        var_dump($listeClient);
    }
}
