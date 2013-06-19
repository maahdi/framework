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
        //$fournisseurs = $this->getRepository('fournisseurs')->getAll();       
        $data['listeArticles'] = &$this->getRepository('articles')->getAll();
        $this->view->render(_DIR_.'Projet/stock/layout/pageArticle.php', $data);
    }

    public function triArticleOrderByDesc(){
        $this->setData(array('tri' => 'asc',
                             'champ' => $_GET['champ'],
                             'tableauStock' => true));
        $data['listeArticles'] = $this->getRepository('articles')->getByOrder($_GET['champ'],'DESC');
        $this->view->render(_DIR_.'Projet/stock/layout/pageArticle.php', $data);
    }

    public function triArticleOrderByAsc(){
        $this->setData(array('tri' => 'desc',
                             'champ' => $_GET['champ'],
                             'tableauStock' => true));
        $data['listeArticles'] = $this->getRepository('articles')->getByOrder($_GET['champ'],'ASC');
        $this->view->render(_DIR_.'Projet/stock/layout/pageArticle.php', $data);
    }

    public function suppressionStockArticle(){
        $this->modele->suppressionOneStock($_GET['idArticle']);
        $this->renderStock();
    }

    public function ajoutStockArticle(){
        $this->modele->ajoutOneStock($_GET['idArticle']);
        $this->renderStock();
    }

    public function displayStockNeg(){
        $id = $this->modele->getStockNeg();
        foreach ($id as $valeur){
            $a[$valeur] = &$this->getRepository('articles')->getOne($valeur);
        }
        $this->setData(array('tableauStock' => true,
                             'listeArticles' => $a));
        $this->view->render(_DIR_.'Projet/stock/layout/pageArticle.php');
    }
}
