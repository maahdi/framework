<?php
include _DIR_.'structure/controller.php';

class FacturationClientController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->url = _DIR_.'Projet/facturation/layout/pageFacturation.php';
        //Un premier menu neutre afficher au premier coup
        $this->view->setSubMenu('menuFacturationClient.php');
    }

    public function displayAccueilClient(){
        $this->view->setData(array('accueilClient' =>true));
        $this->view->setSubMenu(false);
        $this->view->render($this->url);
    }
}
