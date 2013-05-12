<?php
include_once _DIR_.'structure/controller.php';
include_once _DIR_.'Projet/stock/modele/stockModele.php';

class StockController extends Controller{
    private $modele;
    
    public function __construct(){
        parent::__construct();
        $this->modele = new stockModele();
        $this->view->setSubmenu('menuStock');
        $this->view->setData(array('tableauStock' => false));
       
    }
    
    public function renderStock(){
        $this->view->setData(array('tableauStock'=> true));
        $fournisseurs = $this->getRepository('fournisseurs')->getAll();       
        $data['listeArticles'] = $this->getRepository('articles')->getAll($fournisseurs);
        $this->view->render(_DIR_.'Projet/stock/layout/pageArticle.php', $data);
    }
}
