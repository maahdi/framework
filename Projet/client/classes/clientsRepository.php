<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/client/classes/clients.php';

class ClientsRepository extends Repository{

    public function getAll($pays){
        $resultat = $this->findAll('clients','idClient');
        return $this->constructClients($resultat, $pays);
    }

    private function constructClients($resultat, $pays){
        if ($resultat->rowCount() > 0){
            foreach ($resultat as $valeur){
                $liste[$valeur->idClient] = new Clients($valeur->idClient, $valeur->nomClient,
                    $valeur->prenomClient, $valeur->adresseClient, $valeur->cpClient, $pays[$valeur->idPays]);
            }
            return $liste;
        }else{
            return false;
        }
    }

    public function getOne($whereSearch){
        $resultat = $this->findBy('clients','idClient',$whereSearch);
        foreach ($resultat as $valeur){
            $client = new Clients($valeur->idClient, $valeur->nomClient,
                    $valeur->prenomClient, $valeur->adresseClient, $valeur->cpClient, $pays[$valeur->idPays]);
        }
        return $client;
    }

    public function insertOne(array $values, $pays){
        $requete = new Requete('insert into');
        $requete->setListePart(array('clients'));
        $requete->setListePart(array('?,?,?,?,?,?'),'values(',')');
        $requete->queryPrepare($values);
        return $this->getBy('idClient',$values[0],$pays);
    }

    public function getBy($where,$whereSearched, $pays){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setFromPart(array('clients'));
        if (is_numeric($whereSearched)){
            //$requete->setListePart(array($where), '?');
            $requete->setListePart(array($where), 'where',"like '%$whereSearched%'");
            $resultat = $requete->queryPrepare(array("%$whereSearched%"));
        }else{
            //if ($where == 'adresseClient'){
                $requete->setListePart(array("upper($where)"), 'where',"like '%$whereSearched%'");
                $resultat = $requete->queryPrepare(array("%$whereSearched%"));
            //}else{
            //    $requete->addWherePart($where,'?');
            //    $resultat = $requete->queryPrepare(array($whereSearched));
            //}
        }
        return $this->constructClients($resultat, $pays);
    }

    public function getByNomOrPrenom($whereSearch, $pays){
        $requete = new Requete('select');
        $requete->setListePart(array('*'));
        $requete->setFromPart(array('clients'));
        $requete->setListePart(array('upper(nomClient)'), 'where',"like '%$whereSearch%'");
        $requete->setListePart(array('upper(prenomClient)'), 'or',"like '%$whereSearch%'");
        $resultat = $requete->query();
        return $this->constructClients($resultat, $pays);
    }

}
