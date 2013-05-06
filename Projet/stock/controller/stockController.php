<?php
include_once _DIR_.'structure/controller.php';
include_once _DIR_.'Projet/stock/modele/stockModele.php';

class StockController extends Controller{
    private $modele;
    
    public function __construct(){
        parent::__construct();
        $this->modele = new stockModele();
    }
    
    public function renderStock(){
        $fournisseurs = $this->getRepository('fournisseurs')->getAll();       
        $data['listeArticles'] = $this->getRepository('articles')->getAll($fournisseurs);
        $this->view->setSubmenu('menuStock');
        $this->view->render(_DIR_.'Projet/stock/layout/pageArticle.php', $data);
    }
}