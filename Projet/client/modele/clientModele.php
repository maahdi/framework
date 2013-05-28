<?php
include _DIR_.'structure/modele.php';
class ClientModele extends Modele{
    public function __construct() {
        parent::__construct();
    }

    public function getId(){
        $rslt = $this->getTable(array('idClient'),array('clients'));
        $id = array ();
        foreach ($rslt as $valeur){
            $id[] = $valeur->idClient;
        }
        return $id;
    }

    public function deleteOneClient($client){
        $requete = new Requete('delete');
        $requete->setFromPart(array('clients'));
        $requete->where('idClient','?');
        $requete->queryPrepare(array($client->getIdClient()));
    }

    public function updateOneClient($client){
        $requete = new Requete('update');
        $requete->liste(array('set nomClient = ?',
                                     'prenomClient = ?',
                                     'adresseClient = ?',
                                     'cpClient = ?',
                                     'idPays = ?'),'clients');
        $requete->where('idClient', '?');
        $requete->queryPrepare(array($client->getNomClient(),
                                     $client->getPrenomClient(),
                                     $client->getAdresseClient(),
                                     $client->getCpClient(),
                                     $client->getIdPays(),
                                     $client->getIdClient()));
        
    }

}
