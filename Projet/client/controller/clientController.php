<?php
include _DIR_.'structure/controller.php';
class ClientController extends Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function renderListeClient(){
        $this->view->setSubmenu('menuClient');
        $this->view->render(_DIR_.'Projet/client/layout/pageClient.php');
    }
}
