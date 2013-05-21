<?php
include _DIR_.'structure/controller.php';
class ClientController extends Controller{
    private $modele;
    private $url;
    private $pays;

    public function __construct() {
        parent::__construct();
        include _DIR_.'Projet/client/modele/clientModele.php';
        include _DIR_.'structure/formValidation.php';
        $this->modele = new ClientModele();
        //
        //Initialise les element du tableau servant a afficher
        //Pour les activer ensuites à la demande
        //Si '$View->data['element'] = true' dans la page d'affichage principal
        //
        $this->view->setData(array('nouveau' => false, 'liste' => false, 'advancedSearch' => false, 'newSearch' => false));
        $this->view->setSubmenu('menuClient');
        $this->url = _DIR_.'Projet/client/layout/pageClient.php';
        $this->pays = $this->getRepository('pays')->getAll();
    }

    public function search(){
        $data = array();
        $data['listeClient'] = $this->getRepository('clients')->getByNomOrPrenom(strtoupper($_POST['search']), $this->pays);
        $this->view->turnSearchBarOff();
        $this->view->setData(array('liste'     => true,
                                   'listePays' => $this->pays));
        $this->view->render($this->url, $data);
    }

    //
    // Recherche pas sensible a la casse
    // Mise en majuscule de tout pour comparer
    //
    public function advancedSearch(){
        $data = array();
        $champ = $_POST['champ'];
        switch ($champ){
        case 'nomPays':
            $key = array_keys($this->pays);
            foreach ($key as $indice){
                if (strtoupper($this->pays[$indice]->getNomPays()) == strtoupper($_POST['search'])){
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
        $data['listeClient'] = $this->getRepository('clients')->getBy($champ, $search, $this->pays);
        $this->view->turnSearchBarOff();
        $this->view->setData(array('liste'     => true,
                                   'newSearch' => true,
                                   'listePays' => $this->pays));
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
        $data = array();
        $data['listeClient'] = $this->getRepository('clients')->getAll($this->pays);
        $data['listePays'] = $this->pays;
        $this->view->render($this->url, $data);
    }

    public function renderNouveauClientForm(){
        $data = $this->getLastId();
        //
        //On supprimer le fichier de donnée lorsque l'on clique sur le bouton
        //du sous-menu 'Nouveau client'
        //
        if (is_file(_DIR_.'Projet/serialized/dataErreur.txt')){
            $this->deleteFichier(_DIR_.'Projet/serialized/dataErreur.txt');
        }
        $data['nouveau'] = true;
        $this->view->setData($data);
        $this->view->render($this->url);
    }

    //
    //Enregistre le client et affiche un tableau contenant le client nouvellement enregistré
    //
    public function enregistrerClient(){
        //
        // FormValidation à inclure et instancier avec paramètres
        // Modifie seul controller::formValid à true ou false
        // Rempli aussi View::data[indice] = value
        //
        $c = new FormValidation(array('idClient'      => 'numeric', 
                                      'nomClient'     => 'texte',
                                      'cpClient'      => 'numeric', 
                                      'prenomClient'  => 'texte', 
                                      'adresseClient' => 'texte', 
                                      'nomPays'       => 'texte'), $_POST, $this);
        if ($this->getFormValid()){
            $pays = $this->getRepository('pays')->getBy(strtoupper($_POST['nomPays']),'nomPays');
            if ($pays == false){
                //
                // insertion du nouveau pays possible
                //
            }else{
                foreach($pays as $valeur){
                   $this->getRepository('clients')->insertOne(array($_POST['idClient'],
                                                                    $_POST['nomClient'],
                                                                    $_POST['prenomClient'], 
                                                                    $_POST['adresseClient'],
                                                                    $_POST['cpClient'], 
                                                                    $valeur->getIdPays()));
                }
            }
            $data['listeClient'] = array($this->getRepository('clients')->getOne($_POST['idClient'],$pays));
            $this->view->setData(array('liste'     => true,
                                       'listePays' => $this->pays));
            $this->view->turnOffAjax();
            $this->view->render($this->url, $data);
        }else{
            $this->view->setData($_POST);
            $this->view->setData(array('nouveau' => true));
            $this->view->render($this->url,$this->getLastId());
        }
    }

    public function enregistrementModificationClient(){
        //
        //Le pays rentré est chargé et envoyé à l'objet Client
        //Il n'y as plus qu'a modifier les autres attributs
        //
        $pays = $this->getRepository('pays')->getBy(strtoupper($_POST['nomPays']),'nomPays');
        $client = $this->getRepository('clients')->getOne($_POST['idClient'], $pays);
        $c = new FormValidation(array('idClient'      => 'numeric', 
                                      'nomClient'     => 'texte',
                                      'cpClient'      => 'numeric', 
                                      'prenomClient'  => 'texte', 
                                      'adresseClient' => 'texte', 
                                      'nomPays'       => 'texte'), $_POST, $this);

        if ($this->getFormValid()){
            $valeur = array('nomClient'      => $_POST['nomClient'],
                            'prenomClient'   => $_POST['prenomClient'],
                            'adresseClient'  => $_POST['adresseClient'],
                            'cpClient'       => $_POST['cpClient']);
            $this->modifierClient($valeur, $client);
            $this->modele->updateOneClient($client);
            $this->view->setData(array('listeClient' => array($client->getIdClient() => $client),
                                       'liste'       => true,
                                       'listePays'   => $this->pays));
            //
            //Désactivation du script ajax
            //
            $this->view->turnOffAjax();
            $this->view->render($this->url);
        }else{
            $this->view->setData($_POST);
            $pays = $this->getRepository('pays')->getAll();
            $this->view->setData(array('client' => $this->getRepository('clients')->getOne($_POST['idClient'], $pays)));
            unset($pays);
            $this->view->setData(array('modif' => true));
            $this->view->render($this->url);
        }
    }

    public function deleteClient(){
        $client = $this->getRepository('clients')->getOne($_GET['idClient'], $this->pays);
        if ($client != false){
            $this->modele->deleteOneClient($client);
            $this->view->setData(array('listeClient' => array($client->getIdClient() => $client),
                                       'liste'       => true,
                                       'listePays'   => $this->pays));
            $this->view->turnOffAjax();
            $this->view->render($this->url);
        }else{
            $this->renderListeClient();
        }
    }

    public function modifClient(){
        $client = $this->getRepository('clients')->getOne($_GET['idClient'], $this->pays);
        $this->view->setData(array('modif' => true,
                                   'client' => $client));
        $this->view->render($this->url);
    }

    private function getLastId(){
        $data = array();
        $id = $this->modele->getId();
        if (($nb = count($id)) == 0){
            $data['lastId'] = 2000;
        }
        //
        //Gère le cas ou le premier num est 2001 par ex.
        //
        if ($id[0] > 2000){ 
            $data['lastId'] = 2000;
        }else{
            for ($i = 0 ; $i < $nb-1 ; $i++){
                //
                //si le numéro suivant n'est pas logiquement le précédent +1 c'est un numéro libre
                //dans ce cas on sort de la boucle
                //
                if ($id[$i+1] != $id[$i]+1 ){ 
                    $data['lastId'] = $id[$i]+1;
                    $i = $nb-2; 
                }
            }
            //
            // s'il n'y a pas de num libre on continue en suivant du dernier
            //
            if (!isset($data['lastId'])){
                $data['lastId'] = $id[$nb-1]+1;
            }
        }
        return $data;
    }

    private function modifierClient(array $valeur, $client){
        $key = array_keys($valeur);
        $i = 0;
        foreach ($valeur as $v){
            //
            //ex : '$client->setIdClient()'
            //
            $fonction = 'set'.ucfirst($key[$i]);
            $client->$fonction($v);
            $i++;
        }
    }

}
