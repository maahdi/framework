<?php
include_once _DIR_.'structure/controller.php';
include_once _DIR_.'Projet/facturation/modele/facturationClientModele.php';

class FacturationClientController extends Controller{
    private $url;
    private $modele;

    public function __construct(){
        parent::__construct();
        $this->url = _DIR_.'Projet/facturation/layout/pageFacturation.php';
        //
        //Un premier menu neutre afficher au premier coup
        //
        $this->modele = new FacturationClientModele();
        $this->view->setSubMenu('menuFacturationClient');
        $this->urlCommande = _DIR_.'Projet/serialized/commandeEnCours.txt';
    }

    public function displayAccueilClient(){
        $this->view->setData(array('accueilClient' =>true));
        $this->view->render($this->url);
    }

    //
    // Fonction pour automatiser quand c'est possible la construction
    // de  toutes les commandes
    // Retourne array( id => Objet )
    //
    private function getAllCommande($factOrCom){
        $pays = $this->getRepository('pays')->getAll();
        $clients = $this->getRepository('clients')->getAll($pays);
        unset($pays);
        $fournisseurs = $this->getRepository('fournisseurs')->getAll();
        $articles = $this->getRepository('articles')->getAll($fournisseurs);
        unset($fournisseurs);
        return $this->getRepository('commande')->getAll($articles, $clients, $factOrCom);
    }

    //
    // Fonction pour automatiser quand c'est possible la construction
    // d'une commande
    // Retourne un Objet
    //
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
        if (is_file($this->urlCommande)){
            unlink($this->urlCommande);
        }
        $data['listeCommande'] = $this->getAllCommande('com');
        $this->setData(array('liste' => true));
        $this->view->render($this->url, $data);
    }

    public function modifierCommande(){
        if (is_file($this->urlCommande)){
            unlink($this->urlCommande);
        }
        //
        // En modifiant on construit une Commande
        // envoyée à la vue et sérialisée pour faire les ajouts d'articles 
        //
        $commandes = $this->getOneCommande($_GET['idCmd'], 'com');
        $this->view->setData(array('commandeModif' => $commandes[$_GET['idCmd']]));
        $fournisseur = $this->getRepository('fournisseurs')->getAll();
        $data['articles'] = $this->getRepository('articles')->getAll($fournisseur);
        $this->view->setData(array('afficherCommande' => true,
                                   'idClient'         => $_GET['idClient']));
        $this->serializedObjet($this->urlCommande, $commandes[$_GET['idCmd']], 'w');
        $this->view->render($this->url, $data);
    }

    private function modificationOneCommande($commande){
        //
        //Récupération des repository pour enregistrer mon objet Commande
        //
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
    }

    public function ajouterArticle($suppression = null){
        if (is_file($this->urlCommande)){
            //
            // Inclusion des fichiers pour récupérer l'objet Commande entier
            //
            include_once _DIR_.'Projet/facturation/classes/commande.php';
            include_once _DIR_.'Projet/stock/classes/articles.php';
            include_once _DIR_.'Projet/client/classes/clients.php';
            include_once _DIR_.'Projet/stock/classes/fournisseurs.php';
            include_once _DIR_.'Projet/client/classes/pays.php';
            //
            // Récupération de l'objet Commande dans le .txt
            // Serialized choix modif ou nouvelle commande
            //
            $commande = $this->unserializedObjet($this->urlCommande);
            $this->modificationOneCommande($commande);
            $this->getRepository('commande')->updateOne($commande, $_GET['idArticle']);
        }else{
            $commande = $this->getRepository('commande')->getNewCommande($_GET['idCmd']);
            $this->modificationOneCommande($commande);
            $this->getRepository('commande')->insertOne($commande);
        }
        //
        //Enregistrement pour ajout d'article au prochain passage
        //
        $this->serializedObjet($this->urlCommande, $commande, 'w');
        $articles = $this->getRepository('articles')->getAll($this->getRepository('fournisseurs')->getAll());
        $this->view->setData(array('commandeModif' => $commande,
                                   'articles'      => $articles,
                                   'afficherCommande' => true));
        $this->view->render($this->url);
    }

    public function supprimerOneArticle(){
        $this->modele->supprimerOneArticleCommande(array ('idArticle','idCmd'),array($_GET['idArticle'],$_GET['idCmd']), 'produitcmd');
        $liste = $this->getOneCommande($_GET['idCmd'],'com');
        $commande = $liste[$_GET['idCmd']];
        $commande->setTotaux();
        $this->getRepository('commande')->updateOne($commande);
        $this->serializedObjet($this->urlCommande, $commande, 'w');
        $article = $this->getRepository('articles')->getAll($this->getRepository('fournisseurs')->getAll());
        $this->view->setData(array('commandeModif' => $commande,
                                   'articles'      => $article,
                                   'afficherCommande' => true));
        $this->view->render($this->url);
    }

    public function newCommande(){
        if (is_file($this->urlCommande)){
            unlink($this->urlCommande);
        }
        $pays             = $this->getRepository('pays')->getAll();
        $data['clients']  = $this->getRepository('clients')->getAll($pays);
        unset($pays);
        $fournisseurs     = $this->getRepository('fournisseurs')->getAll();
        $data['articles'] = $this->getRepository('articles')->getAll($fournisseurs);
        unset($fournisseurs);
        $this->view->setData($this->getNewId());
        $this->view->setData(array('afficherCommande'   => true,
                                   'dateCmd'            => time()));
        $this->view->render($this->url, $data); 
    }

    // Retourne array(id => valeur)
    private function getNewId(){
        $data = array();
        $id = $this->modele->getAllId('idCmd', 'commandes');
        if (($nb = count($id)) == 0){
            $data['newId'] = 5000;
        }else{
            //
            //Gère le cas ou le premier num est 5001 par ex.
            //
            if ($id[0] > 5000){ 
                $data['newId'] = 5000;
            }else{
                for ($i = 0 ; $i < $nb-1 ; $i++){
                    //
                    //si le numéro suivant n'est pas logiquement le précédent + 1 
                    //C'est un numéro libre
                    //dans ce cas on sort de la boucle
                    //
                    if ($id[$i+1] != $id[$i]+1 ){ 
                        $data['newId'] = $id[$i]+1;
                        $i = $nb-2; 
                    }
                }
                //
                // s'il n'y a pas de num libre on continue en suivant du dernier
                //
                if (!isset($data['newId'])){
                    $data['newId'] = $id[$nb-1]+1;
                }
            }
        }
        return $data;

    }
}
