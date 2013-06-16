<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/client/classes/clients.php';

class ClientsRepository extends Repository{

    public function getOne($id){
        return parent::getOne($id);
    }

    public function save(&$objet){
        parent::save($objet);
    }

    public function getAll(){
        return parent::getAll();
    }

    public function modifierClient($valeur, $id, $pays){
        $i = 0;
        $resultat = $this->findBy('clients', 'idClient', $id);
        foreach ($pays as $valeur){
            $client = new Clients($resultat['idClient'],
                                  $resultat['nomClient'],
                                  $resultat['prenomClient'],
                                  $resultat['emailClient'],
                                  $resultat['adresseClient'],
                                  $resultat['cpClient'],
                                  $valeur);
        }

        foreach ($valeur as $v){
            $fonction = 'set'.ucfirst($key[$i]); 
            $client[$id]->$fonction($v);
            $i++;
        }
        return $client;
    }

    public function insertOne(array $values){
        $requete = new Requete('insert into');
        $requete->liste(array('clients'));
        $requete->liste(array('?,?,?,?,?,?,?'), 'values(',')');
        $requete->queryPrepare($values);
        unset($requete);
    }

    public function getBy($where, $whereSearched){
        $requete = new Requete('select idClient');
        $requete->liste(array('clients'), 'from');
        if (is_numeric($whereSearched)){
            $requete->liste(array($where), 'where', 'like ?');
            $resultat = $requete->queryPrepare(array('%'.$whereSearched.'%'));
        }else{
            $requete->liste(array("upper($where)"), 
                                  'where',
                                  'like ? ');
            $resultat = $requete->queryPrepare(array('%'.$whereSearched.'%'));
        }
        foreach($resultat as $valeur){
            $clients[$valeur->idClient] = $this->getOne($valeur->idClient);
        }
        unset($requete);
        return $clients;
    }

    public function getByNomOrPrenom($whereSearch){
        $requete = new Requete('select idClient');
        $requete->liste(array('clients'), 'from');
        $requete->liste(array('where upper(nomClient) like ?'));
        $requete->liste(array('or upper(prenomClient) like ?'));
        $resultat = $requete->queryPrepare(array('%'.$whereSearch.'%',
                                                 '%'.$whereSearch.'%'));
        foreach ($resultat as $valeur){
            echo $valeur->idClient;
            $clients[$valeur->idClient] = $this->getOne($valeur->idClient);
        }
        unset($requete);
        return $clients;
    }

}
