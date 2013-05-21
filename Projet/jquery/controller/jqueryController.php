<?php

include _DIR_.'Projet/jquery/classes/xmlResponse.php';
include _DIR_.'structure/controller.php';
include _DIR_.'Projet/jquery/modele/jqueryModele.php';

class JqueryController extends Controller{
	private $primaryKey = array();
	
    public function __construct(){
        parent::__construct();
        //
        // Tableau pour faciliter l'enregistrement
        // A remplir si on veut affecter d'autres tables
        //
        $this->primaryKey = array('articles' => 'idArticle',
        						  'clients'  => 'idClient');
        $this->modele = new JqueryModele();
    }

    //
    // Selon le type des donnée on les protège avant enregistrement
    //
    public function enregistrer(){
		$type = $_POST['type'];
		$valeur = $_POST['valeur'];
		$listeChamps = array ($_POST['champ']);
		switch ($type){
		    case 'texte':
		        $listeValeur = array(addslashes($valeur));
		        break;

		    case 'texte-multi':
		        $listeValeur = array(addslashes($valeur));
		        break;

		    case 'float':
		        $listeValeur = array(floatval($valeur));
		        break;

		    case 'entier':
		        $listeValeur = array(intval($valeur));
		        break;
	    }
	    $this->modele->enregistrer($listeChamps, $listeValeur, $_POST['table'], $_POST['id'], $this->primaryKey[$_POST['table']]);
        if ($_POST['champ'] == 'prixHT' or $_POST['champ'] == 'txTVA'){
            $this->sendReponse('prixHT*((100+txTVA)/100)', $_POST['table'], $_POST['id'],$this->primaryKey[$_POST['table']]);
        }
    }

    //
    // XmlResponse prépare du xml : <item>              </item>
    //                                  <$champ></$champ>
    //
    public function sendReponse($champ, $table, $whereSearch, $where){
        $rslt = $this->modele->findOne($champ, $table, $whereSearch, $where);
        $xml = new XmlResponse(array($champ => round($rslt, 3)));
        $xml->sendResponse();
    }
}
