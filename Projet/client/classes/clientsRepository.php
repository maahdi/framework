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
    //ClientsRepository a besoin de l'objet Pays pour satisfaire la relation SQL
    //public function getAll($pays){
    //    $resultat = $this->findAll('clients','idClient');
    //    return $this->constructClients($resultat, $pays);
    //}

    // $valeur = array('champ' , valeur)
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

    private function constructClients($resultat, $pays){
        if ($resultat->rowCount() > 0){
            foreach ($resultat as $valeur){
                if (is_array($pays)){
                    foreach($pays as $p){
                        if ($p->getIdPays() == $valeur->idPays){
                            $liste[$valeur->idClient] = new Clients($valeur->idClient, 
                                                                    $valeur->nomClient,
                                                                    $valeur->prenomClient, 
                                                                    $valeur->emailClient,
                                                                    $valeur->adresseClient, 
                                                                    $valeur->cpClient, 
                                                                    $p);
                        }
                    }
                }else{
                    $liste[$valeur->idClient] = new Clients($valeur->idClient, 
                        $valeur->nomClient,
                        $valeur->prenomClient, 
                        $valeur->emailClient,
                        $valeur->adresseClient, 
                        $valeur->cpClient, 
                        $pays[$valeur->idPays]);
                }
            }
            return $liste;
        }else{
            return false;
        }
    }

    //public function getOne($whereSearch, $pays){
    //    $requete = new Requete('select *');
    //    $requete->liste(array('from clients'));
    //    $requete->liste(array('where idClient = ?'));
    //    $resultat = $requete->queryPrepare(array($whereSearch));
    //    if ($resultat != false){
    //        //$client mis a false automatiquement
    //        //Dans le controller le resultat de cette fonction
    //        //renvoyait bien false pourtant
    //        $client = false;
    //        foreach ($resultat as $valeur){
    //            $client = new Clients($valeur->idClient, 
    //                $valeur->nomClient,
    //                $valeur->prenomClient, 
    //                $valeur->emailClient,
    //                $valeur->adresseClient, 
    //                $valeur->cpClient, 
    //                $pays[$valeur->idPays]);
    //        }
    //        return $client;
    //    }else{
    //        return false;
    //    }
    //    unset($requete);
    //}

    public function insertOne(array $values){
        $requete = new Requete('insert into');
        $requete->liste(array('clients'));
        $requete->liste(array('?,?,?,?,?,?,?'), 'values(',')');
        $requete->queryPrepare($values);
        unset($requete);
    }

    public function getBy($where,$whereSearched, $pays){
        $requete = new Requete('select');
        $requete->liste(array('*'));
        $requete->setFromPart(array('clients'));
        if (is_numeric($whereSearched)){
            //$requete->liste(array($where), '?');
            $requete->liste(array($where), 'where', "like '%$whereSearched%'");
            $resultat = $requete->queryPrepare(array("%$whereSearched%"));
        }else{
            //if ($where == 'adresseClient'){
            $requete->liste(array("upper($where)"), 
            'where',
            "like '%$whereSearched%'");
            $resultat = $requete->queryPrepare(array("%$whereSearched%"));
            //}else{
            //    $requete->where($where,'?');
            //    $resultat = $requete->queryPrepare(array($whereSearched));
            //}
        }
        unset($requete);
        return $this->constructClients($resultat, $pays);
    }

    public function getByNomOrPrenom($whereSearch, $pays){
        $requete = new Requete('select *');
        $requete->liste(array('upper(nomClient)','from'), 
        'where',
        "like '%$whereSearch%'");
        $requete->liste(array('upper(prenomClient)'), 
        'or',
        "like '%$whereSearch%'");
        $resultat = $requete->query();
        unset($requete);
        return $this->constructClients($resultat, $pays);
    }

}
