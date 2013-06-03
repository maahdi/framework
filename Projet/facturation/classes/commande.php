<?php
class Commande{
    private $idCmd;
    private $client = null;
    private $dateCmd;
    private $listeArticle = array();
    private $totalHT = 0;
    private $totalTTC = 0;
    private $totalTVA = 0;
    private $valid = false;
    private $remise;
    private $acompte = 0;
    private $nbPaiement = 1;
    private $sommePaid = 0;
    private $versement = 0;
    
    
    public function __construct($idCmd) {
        $this->idCmd = $idCmd;
    }

    //
    // Retourne String Pour Affichage aperçu liste d'articles
    //
    public function toStringArticles($nb){
        $i =0;
        $rslt ='';
        $nb = count($this->listeArticle);
        foreach($this->listeArticle as $valeur){
            if ($i < $nb){
                $rslt .= $valeur['article']->getDesignation();
                if ($i != ($nb-1)){
                    $rslt .= ', ';
                }else{
                    $rslt .= ' ...';
                }
            }
            $i++;
        }
        return $rslt;
    }
    
    public function setAcompte($valeur){
        $this->acompte = $valeur;
        $this->setSommePaid($valeur);
    }

    public function setSommePaid($valeur){
        $this->sommePaid = $valeur;
    }

    public function getSommePaid(){
        return $this->sommePaid;
    }

    public function getVersement(){
        return $this->versement;
    }

    public function setNbPaiement($valeur){
        $this->nbPaiement = $valeur;
        $this->versement  = ($this->totalTTC - $this->acompte) / $valeur;
    }

    public function getNbPaiement(){
        return $this->nbPaiement;
    }

    public function getAcompte(){
        return $this->acompte;
    }

    public function isClient(){
        if ($this->client != null){
            return true;
        }else{
            return false;
        }
    }

    public function getStockTheorique($idArticle){
        return $this->listeArticle[$idArticle]['article']->getStockTheorique();
    }

    public function getTotalHTArticle($id){
        return $this->listeArticle[$id]['totalHT'];
//        return $this->listeArticle[$id]->getTotalHT();
    }

    public function setClient($client){
        $this->client = $client;
    }

    public function setOneArticle($article){
        $this->listeArticle[$article->getIdArticle()] = array( 'article'  => $article,
                                                               'qte'      => 'vide',
                                                               'totalHT'  => 'vide');
    }

    public function setDateCmd($date){
        $this->dateCmd = $date;
    }

    public function setRemise($remise){
        $this->remise = $remise;
    }

    public function getRemise(){
        return $this->remise;
    }

    public function getTotalTVA(){
        return $this->totalTVA;
    }

    public function setQteCmd($idArticle, $qte){
        $this->listeArticle[$idArticle]['totalHT'] = $this->listeArticle[$idArticle]['article']->getPrixHT() * (int) $qte;
        $this->listeArticle[$idArticle]['qte'] = (int) $qte;
        $this->listeArticle[$idArticle]['article']->setStockTheorique((int) $qte, '-');
        //$this->listeArticle[$idArticle]->setQuantiteCmd($qte);
    }
    
    public function getIdCmd(){
        return $this->idCmd;
    }
    
    public function getIdClient(){
        return $this->client->getIdClient();
    }
    
    public function getNomClient(){
        return $this->client->getNomClient();
    }

    public function getPrenomClient(){
        return $this->client->getPrenomClient();
    }
  
    public function getDateCmd(){
        return $this->dateCmd;
    }
    
    public function getTotalHT(){
        return $this->totalHT;
    }
    
    public function getTotalTTC(){
        return $this->totalTTC;
    }
    
    // 
    // Retourne array ( id => Objet )
    //
    public function getListeArticle(){
        return $this->listeArticle;
    }

    public function getQteCmd($idArticle){
        return $this->listeArticle[$idArticle]['qte'];
        //return $this->listeArticle[$idArticle]->getQteCmd();
    }

    public function setValidation(){
        if (!$this->valid){
            $this->valid = true;
        }else{
            //
            // Si la commande est deja valid lever une exception
            // A faire
            //
        }
    }

    public function getValidationCommande(){
    	return $this->valid;
    }
    
    //
    // A lancer pour remplir
    //   totalHT
    //   tva
    //   totalTTC
    //  AVANT d'utiliser l'objet commande
    //
    public function setTotaux($idArticle = null){
        $this->totalHT  = 0;
        $this->totalTVA = 0;
        $this->totalTTC = 0;
        if ($idArticle != null){
            $this->totalHT  += (float) $this->listeArticle[$idArticle]['article']->getPrixHT() * (int) $this->listeArticle[$idArticle]['qte'];
            $this->totalTVA += $this->totalHT * (float) $this->listeArticle[$idArticle]['article']->getTauxTVA() / 100;
            $this->totalTTC += $this->totalHT + $this->totalTVA;
//            $this->totalHT  += (float) $this->listeArticle[$idArticle]->getPrixHT() * (int) $this->listeArticle[$idArticle]->getQteCmd();
//            $this->totalTVA += $this->totalHT * (float) $this->listeArticle[$idArticle]->getTauxTVA()/100;
        }else{
            foreach($this->listeArticle as $valeur){
                $this->totalHT   += (float) $valeur['totalHT'];
                $this->totalTVA  += (float) $valeur['totalHT'] * (float) $valeur['article']->getTauxTVA()/100;
            }
            $this->totalTTC  = (float) $this->totalHT + (float) $this->totalTVA;
        }
    }
}
?> 
