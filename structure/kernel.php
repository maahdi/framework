<?php
include_once _DIR_.'utils/config.php';
include_once _DIR_.'utils/sessions.php';

class Kernel{
    private $bundles = array();
    public function __construct(){
        session_start();
        //Mettre en indice le nom des dossiers
        //qui corresponde aux actions
        // '/Projet/bundle/BundleController'
        $this->bundles['connexion']              = 'ConnexionController';
        $this->bundles['stock']                  = 'StockController';
        $this->bundles['client']                 = 'ClientController';
        $this->bundles['jquery']                 = 'JqueryController';
        $this->bundles['facturation']            = 'FacturationController';
        $this->bundles['facturationClient']      = 'FacturationClientController';
        $this->bundles['facturationFournisseur'] = 'FacturationFournisseurController';

        if (isset($_GET['action'])){
            $action = $_GET['action'];  
            //Test la session en cours
            //Si pas bon renvoie à login
            if (!SessionPerso::testSession() && $action != 'login' && $action != 'connex'){
              $action ='deconnex';
            }
            //Cas de visite sur un autre site et revenir par un raccourci 
            //le menu de connexion apparaissait alors que la session est toujours valide
            //Retour direct a l'accueil dans ce cas
            if (SessionPerso::testSession() && $action == 'login'){
                $action = 'accueil';
            }
            $this->dispatch($action);
        }else{
            $this->dispatch('deconnex');
        }

    }
    //dispatch
    public function dispatch($action){
        include _DIR_.'structure/routes.php';
        // Récupere le nom de la fonction demandé et le nom du bundle
        $exp = explode('/', $routes[$action]);
        //$exp[2] correspond a un sous-controller du dossier facturation
        //FacturationController, FacturationClientController, FacturationFournisseurController
        if (!isset($exp[2])){        
            // '_DIR_/Projet/bundle/controller/bundleController.php'
            // 'new BundleController()'
            include _DIR_.'Projet/'.$exp[1].'/controller/'.$exp[1].'Controller.php';
            $controller = new $this->bundles[$exp[1]]();
        }else{
            include _DIR_.'Projet/'.$exp[1].'/controller/'.$exp[1].$exp[2].'Controller.php';
            $controller = new $this->bundles[$exp[1].$exp[2]]();
        }
        //try{
            //lance la fonction spécifié dans route[$action]
            $controller->$exp[0]();
        //}catch(PDOException $mess){
          //  $controller->renderErrorAction($mess);
        //}
    }
}
