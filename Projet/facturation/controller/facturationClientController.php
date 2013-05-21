<?php
include_once _DIR_.'structure/controller.php';
include_once _DIR_.'Projet/facturation/modele/facturationClientModele.php';

class FacturationClientController extends Controller{
    private $url;
    private $modele;

    public function __construct(){
        parent::__construct();
        $this->url = _DIR_.'Projet/facturation/layout/pageFacturation.php';
        //Un premier menu neutre afficher au premier coup
        $this->modele = new FacturationClientModele();
        $this->view->setSubMenu('menuFacturationClient');
    }

    public function displayAccueilClient(){
        $this->view->setData(array('accueilClient' =>true));
        $this->view->render($this->url);
    }

    private function getAllCommande($factOrCom){
        $pays = $this->getRepository('pays')->getAll();
        $clients = $this->getRepository('clients')->getAll($pays);
        unset($pays);
        $fournisseurs = $this->getRepository('fournisseurs')->getAll();
        $articles = $this->getRepository('articles')->getAll($fournisseurs);
        unset($fournisseurs);
        return $this->getRepository('commande')->getAll($articles, $clients, $factOrCom);
    }

    private function getOneCommande($idCmd, $factOrCom){
        $pays = $this->getRepository('pays')->getAll();
        $clients = $this->getRepository('clients')->getAll($pays);
        unset($pays);
        $fournisseurs = $this->getRepository('fournisseurs')->getAll();
        $articles = $this->getRepository('articles')->getAll($fournisseurs);
        unset($fournisseurs);
        return $this->getRepository('commande')->getOne($idCmd, $articles, $clients, $factOrCom);
    }

    public function displayAllCommande(){
        $data['listeCommande'] = $this->getAllCommande('com');
        unset($clients);
        unset($articles);
        $this->setData(array('liste' => true));
        $this->view->render($this->url, $data);
    }

    public function modifierCommande(){
        if (is_file(_DIR_.'Projet/serialized/commandeEnCours.txt')){
            unlink(_DIR_.'Projet/serialized/commandeEnCours.txt');
        }
        $commandes = $this->getOneCommande($_GET['idCmd'], 'com');
        $this->view->setData(array('commandeModif' => $commandes[$_GET['idCmd']]));
        $fournisseur = $this->getRepository('fournisseurs')->getAll();
        $data['articles'] = $this->getRepository('articles')->getAll($fournisseur);
        $this->view->setData(array('afficherCommande' => true,
                                   'idClient'         => $_GET['idClient']));
        $this->serializedObjet(_DIR_.'Projet/serialized/commandeEnCours.txt', $commandes[$_GET['idCmd']], 'w');
        $this->view->render($this->url, $data);
    }

    public function ajouterArticle(){
        if (is_file(_DIR_.'Projet/serialized/commandeEnCours.txt')){
            include_once _DIR_.'Projet/facturation/classes/commande.php';
            include_once _DIR_.'Projet/stock/classes/articles.php';
            include_once _DIR_.'Projet/client/classes/clients.php';
            include_once _DIR_.'Projet/stock/classes/fournisseurs.php';
            include_once _DIR_.'Projet/client/classes/pays.php';
            $commande = $this->unserializedObjet(_DIR_.'Projet/serialized/commandeEnCours.txt');
            $fournisseur = $this->getRepository('fournisseurs')->getAll();
            $article = $this->getRepository('articles')->getAll ($fournisseur);
            unset($fournisseur);
            $pays = $this->getRepository('pays')->getAll();
            $client = $this->getRepository('clients')->getOne($_GET['idClient'], $pays);
            unset($pays);
            $commande->setDateCmd($_GET['dateCmd']);
            $commande->setOneArticle($article[$_GET['idArticle']]);
            $commande->setQteCmd($_GET['idArticle'],$_GET['qte']);
            $commande->setClient($client);
            $commande->setTotaux();
            $this->getRepository('commande')->updateOne($commande, $_GET['idArticle']);
        }
        $this->serializedObjet(_DIR_.'Projet/serialized/commandeEnCours.txt', $commande, 'w');
        $this->view->setData(array('commandeModif' => $commande,
                                   'articles'      => $article,
                                   'afficherCommande' => true));
        $this->view->render($this->url);
    }

    public function newCommande(){
        if (is_file(_DIR_.'Projet/serialized/commandeEnCours.txt')){
            unlink(_DIR_.'Projet/serialized/commandeEnCours.txt');
        }else{
            $fournisseurs = $this->getRepository('fournisseurs')->getAll();
            $data['articles'] = $this->getRepository('articles')->getAll($fournisseurs);
            unset($fournisseurs);
            $this->view->setData(array('afficherCommande'   => true,
                                       'idCmd'              => $_GET['idCmd'],
                                       'dateCmd'            => time()));
            $this->view->render($this->url, $data); 
        }
    }
}
