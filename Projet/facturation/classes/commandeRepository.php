<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/facturation/classes/commande.php';

class CommandeRepository extends Repository{
    //$articles = array('idArticle'=> Article) 
    //$client = array('idClient' => Client)
    //$factOrCom = 'fact' ou 'com'
    //pour facture ou commande
    public function getNewCommande(){
        return new Commande('1');
    }

    public function getAll($articles, $client, $factOrCom){
        $commandes = $this->findAll('commandes','idCmd');
        $produitCmd = $this->findAll('produitcmd', 'idCmd');
        $lastValue = '';
        $index = array();
        //On récupère les numéro de commandes uniques
        foreach ($produitCmd as $valeur){
            if ($lastValue != $valeur->idCmd){
                $index[] = $valeur->idCmd;
                $lastValue = $valeur->idCmd;
            }
            $listeProduit[] = $valeur;
        }
        //Pour chaque commande on instancie une nouvelle commande
        //et on lui associe les articles correspondants
        foreach ($index as $valeur){
            $liste[$valeur] = new Commande($valeur);
        }
        foreach ($listeProduit as $valeur){
            $liste[$valeur->idCmd]->setOneArticle($articles[$valeur->idArticle]);
            $liste[$valeur->idCmd]->setQteCmd($valeur->idArticle, $valeur->qteCmd);
            $liste[$valeur->idCmd]->setTotaux($valeur->idArticle);
        }
        foreach ($commandes as $valeur){
            $liste[$valeur->idCmd]->setDateCmd($valeur->dateCmd);
            $liste[$valeur->idCmd]->setClient($client[$valeur->idClient]);
            if ($valeur->valid == 1){
                $liste[$valeur->idCmd]->setValidation();
            }else{
                $unValid [$valeur->idCmd] = $valeur->idCmd;
            }
            //Remise dans la base mais pas utiliser
        }
        return $this->checkValid($liste, $unValid, $factOrCom);
    }

    //$factOrCom = 'fact' ou 'com'
    //pour facture ou commande
    public function getOne($idCmd, array $articles, array $client, $factOrCom){
        $requete = new Requete('select');
        $listeChamp = array ('idCmd',
                             'idClient',
                             'dateCmd',
                             'valid');
        $requete->setListePart($listeChamp);
        $requete->setListePart(array('commandes'), 'from');
        $requete->addWherePart('idCmd','?');
        $rslt = $requete->queryPrepare(array($idCmd));
        $unValid = array();
        foreach ($rslt as $valeur){
            $commande = new Commande($valeur->idCmd);
            $commande->setClient($client[$valeur->idClient]);
            $commande->setDateCmd($valeur->dateCmd);
            if ($valeur->valid == 1){
                $commande->setValidation();
            }else{
                $unValid[$commande->getIdCmd()] = $commande->getIdCmd();
            }
        }
        $requete->resetRequete();
        $requete->setListePart(array('idArticle', 'qteCmd'),'select');
        $requete->setListePart(array('produitcmd'),'from');
        $requete->addWherePart('idCmd','?');
        $rslt = $requete->queryPrepare(array($idCmd));
        foreach($rslt as $valeur){
            $commande->setOneArticle($articles[$valeur->idArticle]);
            $commande->setQteCmd($valeur->idArticle, $valeur->qteCmd);
        }
        $commande->setTotaux();
        //Retour comme sa car checkValid renvoi un tableau associatif
        return $this->checkValid(array($commande), $unValid, $factOrCom); 
    }

    public function updateOne(Commande $commande, $lastId){
        $requete = new Requete('update commandes');
        $requete->setListePart(array('set idClient = ?',
                                     'totalHT = ?',
                                     'totalTVA = ?',
                                     'valid = ?'));
        $requete->addWherePart('idCmd','?');
        $requete->queryPrepare(array($commande->getIdClient(),
                                     $commande->getTotalHT(),
                                     $commande->getTva(),
                                     $commande->getValidationCommande(),
                                     $commande->getIdCmd()));

        $requete->resetRequete();
        $requete->setListePart(array('insert into produitcmd'));
        $requete->setListePart(array('idArticle',
                                     'idCmd',
                                     'qteCmd',
                                     'totalHT'),'(',')');
        $requete->setListePart(array('?,?,?,?'),'values(',')');
        $requete->queryPrepare(array($lastId,
                                     $commande->getIdCmd(),
                                     $commande->getQteCmd($lastId),
                                     $commande->getTotalHTArticle($lastId)));
    }

    public function insertOne($idCmd, $client, $date, $qte, $idArticle, $factOrCom){
        $requete = new Requete('insert into');
        $requete->setListePart(array('commandes'));
        switch ($factOrCom){
        case 'com':
            $valid = 0;
            break;
        case 'fact':
            $valid = 1;
            break;
        }
        $requete->setListePart(array('idCmd','idClient', 'dateCmd', 'valid'),'(',')');
        $requete->setListePart(array('?,?,?,?'),'values(',')');
        $requete->queryPrepare(array($idCmd, 
                                     $client->getIdClient(),
                                     $date, 
                                     $valid));
        $requete->resetRequete();
        $requete->setListePart(array('produitcmd'),'insert into');
        $requete->setListePart(array('idCmd','idArticle', 'qteCmd'),'(',')');
        $requete->setListePart(array('?,?,?'), 'values(',')');
        $requete->queryPrepare(array($idCmd,
                                     $idArticle,
                                     $qte));

    }

    //Vérifie que la liste retourne soit les factures $commande::valid = 1
    //soit les commandes $commande::valid = 0
    private function checkValid($liste, $unValid, $factOrCom){
        $rslt = array();
        switch ($factOrCom){
        case 'fact':
            foreach ($liste as $valeur){
                if (isset($unValid[$valeur->getIdCmd()]) && $valeur->getIdCmd() != $unValid[$valeur->getIdCmd()]){
                    $rslt[$valeur->getIdCmd()] = $valeur;
                }
            }
            break;
        case 'com':
            foreach ($liste as $valeur){
                if (isset($unValid[$valeur->getIdCmd()]) && $valeur->getIdCmd() == $unValid[$valeur->getIdCmd()]){
                    $rslt[$valeur->getIdCmd()] = $valeur;
                }
            }
            break;
        }
        return $rslt;
    }
}





