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
                $rslt .= $valeur->getDesignation();
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
    
    public function isClient(){
        if ($this->client != null){
            return true;
        }else{
            return false;
        }
    }

    public function getTotalHTArticle($id){
        return $this->listeArticle[$id]->getTotalHT();
    }

    public function setClient($client){
        $this->client = $client;
    }
    public function setOneArticle($article){
        $this->listeArticle[$article->getIdArticle()] = $article;
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
        $this->listeArticle[$idArticle]->setQuantiteCmd($qte);
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
        return $this->listeArticle[$idArticle]->getQteCmd();
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
            $this->totalHT   += (float) $this->listeArticle[$idArticle]->getPrixHT() * (int) $this->listeArticle[$idArticle]->getQteCmd();
            $this->totalTVA  += $this->totalHT * (float) $this->listeArticle[$idArticle]->getTauxTVA()/100;
            $this->totalTTC  += $this->totalHT + $this->totalTVA;
        }else{
            foreach($this->listeArticle as $valeur){
                $this->totalHT   += (float) $valeur->getTotalHT();
                $this->totalTVA  += (float) $valeur->getTotalHT() * (float) $valeur->getTauxTVA()/100;
            }
            $this->totalTTC  = (float) $this->totalHT + (float) $this->totalTVA;
        }
    }
}
?> 
