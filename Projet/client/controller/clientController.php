<?php
include _DIR_.'structure/controller.php';
class ClientController extends Controller{
    private $modele;
    private $url;

    public function __construct() {
        parent::__construct();
        include _DIR_.'Projet/client/modele/clientModele.php';
        include _DIR_.'structure/formValidation.php';
        $this->modele = new ClientModele();
        $this->view->setData(array('nouveau' => false, 'liste' => false, 'advancedSearch' => false, 'newSearch' => false));
        $this->view->setSubmenu('menuClient');
        $this->url = _DIR_.'Projet/client/layout/pageClient.php';
    }

    public function search(){
        $pays = $this->getRepository('pays')->getAll();
        $data = array();
        $data['listeClient'] = $this->getRepository('clients')->getByNomOrPrenom(strtoupper($_POST['search']), $pays);
        $this->view->turnSearchBarOff();
        unset($pays);
        $this->view->setData(array('liste' => true));
        $this->view->render($this->url, $data);
    }

    public function advancedSearch(){
        $pays = $this->getRepository('pays')->getAll();
        $data = array();
        $champ = $_POST['champ'];
        switch ($champ){
        case 'nomPays':
            $key = array_keys($pays);
            foreach ($key as $indice){
                if (strtoupper($pays[$indice]->getNomPays()) == strtoupper($_POST['search'])){
                    $indicePays = $indice;
                }
            }
            $search = (int) $indicePays;
            $champ = 'idPays';
            break;
        case 'cpClient':
            $search =(int) $_POST['search'];
            break;
        case 'idClient':
            $search = (int) $_POST['search'];
            break;
        default :
            $search = strtoupper($_POST['search']);
            break;
        }
        $data['listeClient'] = $this->getRepository('clients')->getBy($champ, $search, $pays);
        unset($pays);
        $this->view->turnSearchBarOff();
        $this->view->setData(array('liste' => true,'newSearch' => true));
        $this->view->render($this->url, $data);
    }

    public function renderAdvancedSearch(){
        $this->view->setData(array('advancedSearch' => true));
        $this->view->turnSearchBarOff();
        $this->view->render($this->url);
    }


    public function renderListeClient(){
        if (!$this->view->getData('liste')){
            $this->view->setData(array('liste'=>true));
        }
        $pays = $this->getRepository('pays')->getAll();
        $data = array();
        $data['listeClient'] = $this->getRepository('clients')->getAll($pays);
        unset($pays);
        $this->view->render($this->url, $data);
    }

    public function renderNouveauClientForm(){
        $data = $this->getLastId();
        if (is_file(_DIR_.'Projet/serialized/dataErreur.txt')){
            $this->deleteFichier(_DIR_.'Projet/serialized/dataErreur.txt');
        }
        $data['nouveau'] = true;
        $this->view->setData($data);
        $this->view->render($this->url);
    }

    public function enregistrerClient(){
        $c = new FormValidation(array('idClient'=> 'numeric', 'nomClient' => 'texte','cpClient' => 'numeric', 'prenomClient' => 'texte', 'adresseClient' => 'texte', 'nomPays'=> 'texte'), $_POST, $this);
        if ($this->getFormValid()){
            $pays = $this->getRepository('pays')->getBy(strtoupper($_POST['nomPays']),'nomPays');
            if ($pays == false){
                // insertion du nouveau pays
            }else{
                $data['listeClient'] = $this->getRepository('clients')->insertOne(array($_POST['idClient'],$_POST['nomClient'],$_POST['prenomClient'], $_POST['adresseClient'],$_POST['cpClient'], $pays[1]->getIdPays()),$pays);
            }
            unset($pays);
            $this->view->setData(array('liste' => true));
            $this->view->render($this->url, $data);
        }else{
            $this->view->setData($_POST);
            $this->view->setData(array('nouveau' => true));
            $this->view->render($this->url,$this->getLastId());
        }
    }

    public function deleteClient(){
        $client = $this->getRepository('clients')->getOne($_GET['idClient']);
        $this->modele->deleteOneClient($client);
        $this->view->setData(array('listeClient' => array($client->getIdClient() => $client),'liste' => true));
        $this->view->render($this->url);
    }

    public function modifClient(){
    }

    private function getLastId(){
        $data = array();
        $id = $this->modele->getId();
        if (($nb = count($id)) == 0){
            $data['lastId'] = 2000;
        }
        if ($id[0] > 2000){ //Gère le cas ou le premier num est 2001 par ex.
            $data['lastId'] = 2000;
        }else{
            for ($i = 0 ; $i < $nb-1 ; $i++){
                if ($id[$i+1] != $id[$i]+1 ){ //si le numéro suivant n'est pas logiquement le précédent +1 c'est un numéro libre
                    $data['lastId'] = $id[$i]+1;
                    $i = $nb-2; //dans ce cas on sort de la boucle
                }
            }
            if (!isset($data['lastId'])){
                $data['lastId'] = $id[$nb-1]+1;// s'il n'y a pas de num libre on continue en suivant du dernier
            }
        }
        return $data;
    }
}
