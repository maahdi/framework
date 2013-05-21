<?php

//Retourne le repository que l'on cherche
//Les repos sont enregistrés ici au préalable
class RepositoryFinder{
    private $repo;
    
    public function __construct(){
        $this->repo['articles']     = _DIR_.'Projet/stock/classes/articlesRepository.php';
        $this->repo['fournisseurs'] = _DIR_.'Projet/stock/classes/fournisseursRepository.php';
        $this->repo['clients']      = _DIR_.'Projet/client/classes/clientsRepository.php';
        $this->repo['pays']         = _DIR_.'Projet/client/classes/paysRepository.php';
        $this->repo['commande']    = _DIR_.'Projet/facturation/classes/commandeRepository.php';
    }
    
    public function getRepo($name){
        include_once $this->repo[$name];
        $repoName = ucfirst($name).'Repository';
        return new $repoName();
    }
}
