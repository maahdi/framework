<?php
include_once _DIR_.'utils/config.php';
include_once _DIR_.'utils/sessions.php';


class Kernel{
    private $bundles = array();
    public function __construct(){
        session_start();
        //Mettre en indice le nom des dossiers
        //qui corresponde aux actions
        $this->bundles['connexion'] = 'ConnexionController';
        $this->bundles['stock'] = 'StockController';
        $this->bundles['client'] = 'ClientController';
        
        if (isset($_GET['action'])){
            $action = $_GET['action'];  
            if (!SessionPerso::testSession() && $action != 'login' && $action != 'connex'){
                $action ='deconnex';
            }
            $this->dispatch($action);
        }else{
            $this->dispatch('deconnex');
        }
        
    }
    //dispatch
    public function dispatch($action){
        include _DIR_.'structure/routes.php';
        $exp = explode("/", $routes[$action]);
        include _DIR_."Projet/".$exp[1]."/controller/".$exp[1]."Controller.php";
        $controller = new $this->bundles[$exp[1]]();
        try{
            $controller->$exp[0]();
        }catch(PDOException $mess){
            $controller->renderErrorAction($mess);
        }

        
    }



}
