<?php

class RepositoryFinder{
    private $repo;
    
    public function __construct(){
        $this->repo['articles'] = _DIR_.'Projet/stock/classes/articlesRepository.php';
        $this->repo['fournisseurs'] = _DIR_.'Projet/stock/classes/fournisseursRepository.php';
        $this->repo['clients'] = _DIR_.'Projet/client/classes/clientsRepository.php';
        $this->repo['pays'] = _DIR_.'Projet/client/classes/paysRepository.php';
    }
    
    public function getRepo($name){
        include $this->repo[$name];
        $repoName = ucfirst($name).'Repository';
        return new $repoName();
    }
}
