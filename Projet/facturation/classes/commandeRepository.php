<?php
include_once _DIR_.'structure/repository.php';
include_once _DIR_.'Projet/facturation/classes/commande.php';

class CommandeRepository extends Repository{
    //
    //$articles = array('idArticle'=> Article) 
    //$client = array('idClient' => Client)
    //$factOrCom = 'fact' ou 'com'
    //pour facture ou commande
    //
    public function getNewCommande($id){
        return new Commande($id);
    }

    public function getAll($articles, $client, $factOrCom){
        $commandes = $this->findAll('commandes','idCmd');
        $produitCmd = $this->findAll('produitcmd', 'idCmd');
        $lastValue = '';
        $index = array();
        //
        //On récupère les numéro de commandes uniques
        //
        foreach ($produitCmd as $valeur){
            //
            // 1. '' != '4000' -->les numero sont dans l'ordre normalement asc
            // Ensuite dès que un change on met dans $index
            // 
            if ($lastValue != $valeur->idCmd){
                $index[] = $valeur->idCmd;
                $lastValue = $valeur->idCmd;
            }
            $listeProduit[] = $valeur;
        }
        //
        //Pour chaque commande on instancie une nouvelle commande
        //et on lui associe les articles correspondants
        //
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
        }
        return $this->checkValid($liste, $unValid, $factOrCom);
    }

    //
    //$factOrCom = 'fact' ou 'com'
    //pour facture ou commande
    //
    public function getOne($idCmd, array $articles, array $client, $factOrCom){
        $requete = new Requete('select');
        $listeChamp = array ('idCmd',
                             'idClient',
                             'dateCmd',
                             'valid');
        $requete->liste($listeChamp);
        $requete->liste(array('commandes'), 'from');
        $requete->where('idCmd','?');
        $rslt = $requete->queryPrepare(array($idCmd));
        //
        // $unValid est rempli par les commandes qui ont valid = false
        // Servira a faire le partage de quel parti de la liste ont garde
        // entre les commande et les commandes validées (factures)
        //
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
        $requete->liste(array('idArticle', 'qteCmd'),'select');
        $requete->liste(array('produitcmd'),'from');
        $requete->where('idCmd','?');
        $rslt2 = $requete->queryPrepare(array($idCmd));
        foreach($rslt2 as $valeur){
            $commande->setOneArticle($articles[$valeur->idArticle]);
            $commande->setQteCmd($valeur->idArticle, $valeur->qteCmd);
        }
        $commande->setTotaux();
        //
        //Retour comme sa car checkValid renvoi un tableau associatif
        //
        return $this->checkValid(array($commande), $unValid, $factOrCom); 
    }

    //
    // Enregistre une commande deja créer
    //
    public function updateOne(Commande $commande, $lastId){
        $requete = new Requete('update commandes');
        $requete->liste(array('set idClient = ?',
                                     'totalHT = ?',
                                     'totalTVA = ?',
                                     'valid = ?'));
        $requete->where('idCmd','?');
        $requete->queryPrepare(array($commande->getIdClient(),
                                     $commande->getTotalHT(),
                                     $commande->getTva(),
                                     $commande->getValidationCommande(),
                                     $commande->getIdCmd()));
        $requete->liste(array('insert into produitcmd'));
        $requete->liste(array('idArticle',
                                     'idCmd',
                                     'qteCmd',
                                     'totalHT'),'(',')');
        $requete->liste(array('?,?,?,?'),'values(',')');
        $requete->queryPrepare(array($lastId,
                                     $commande->getIdCmd(),
                                     $commande->getQteCmd($lastId),
                                     $commande->getTotalHTArticle($lastId)));
    }

    public function insertOne($idCmd, $idClient, $date, $qte, $idArticle){
        $requete = new Requete('insert into');
        $requete->liste(array('commandes'));
        $requete->liste(array('idCmd','idClient', 'dateCmd'),'(',')');
        $requete->liste(array('?,?,?'),'values(',')');
        $requete->queryPrepare(array($idCmd, 
                                     $idClient,
                                     $date));
        $requete->resetRequete();
        $requete->liste(array('produitcmd'),'insert into');
        $requete->liste(array('idCmd','idArticle', 'qteCmd'),'(',')');
        $requete->liste(array('?,?,?'), 'values(',')');
        $requete->queryPrepare(array($idCmd,
                                     $idArticle,
                                     $qte));
    }

    //
    //Vérifie que la liste retourne soit les factures $commande::valid = 1
    //soit les commandes $commande::valid = 0
    //
    private function checkValid($liste, $unValid, $factOrCom){
        $rslt = array();
        switch ($factOrCom){
        case 'fact':
            foreach ($liste as $valeur){
                //
                // On parcourt la liste des commandes
                // Pour chaque on compare s'ils faisait partis des commandes::valid était = false
                // Si c'est pas le cas on met la commande dans le retourne
                //
                if (isset($unValid[$valeur->getIdCmd()]) && $valeur->getIdCmd() != $unValid[$valeur->getIdCmd()]){
                    $rslt[$valeur->getIdCmd()] = $valeur;
                }
            }
            break;
        case 'com':
            foreach ($liste as $valeur){
                //
                //Meme cas sauf que si commande::valid était = false
                //On met les commandes dans le retourne
                //
                if (isset($unValid[$valeur->getIdCmd()]) && $valeur->getIdCmd() == $unValid[$valeur->getIdCmd()]){
                    $rslt[$valeur->getIdCmd()] = $valeur;
                }
            }
            break;
        }
        return $rslt;
    }
}





