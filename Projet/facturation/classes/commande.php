<?php
class Commande{
    private $idCmd;
    private $client = null;
    private $dateCmd;
    private $listeArticle = array();
    private $totalHT = 0;
    private $totalTTC = 0;
    private $tva = 0;
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

    public function getTva(){
        return $this->tva;
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
    //
    public function setTotaux($idArticle = null){
        if ($idArticle != null){
            $this->totalHT  += $this->listeArticle[$idArticle]->getPrixHT()*$this->listeArticle[$idArticle]->getQteCmd();
            $this->tva      = $this->totalHT * $this->listeArticle[$idArticle]->getTauxTVA()/100;
            $this->totalTTC = $this->totalHT + $this->tva;
        }else{
            $totalTVA = 0;
            $totalHT  = 0;
            $totalTTC = 0;
            foreach($this->listeArticle as $valeur){
                $totalHT  += $valeur->getPrixHT()*$valeur->getQteCmd();
                $totalTVA += $totalHT * $valeur->getTauxTVA()/100;
                $totalTTC += $totalHT + $totalTVA;
            }
            $this->totalHT  = $totalHT;
            $this->totalTVA = $totalTVA;
            $this->totalTTC = $totalTTC;
        }
    }
}
?> 
