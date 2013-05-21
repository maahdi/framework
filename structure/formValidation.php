<?php

class FormValidation{
    //Assure automatiquement le controle des donnée envoyé et prépare un tableau dans $data contenant la liste des champs
    //qui ne corresponde pas au type demandé
    //A mettre une deuxième liste avec la liste des champs obligatoires
    //La variable $formValid de la classe Controller contient true ou false : if ($this->formValid){}
    public function __construct(array $listeControle, $post, Controller $controller){
        $resultat = '';
        $listeChamps = array_keys($listeControle);
        $i = 0;
        $nb = count($listeControle);
        foreach($listeControle as $valeur){
            if (!$this->testDonnee($post[$listeChamps[$i]], $valeur)){
                if ($i == $nb-1){
                    $resultat .=$listeChamps[$i];               
                }else{
                    $resultat .=$listeChamps[$i].'/';
                }
            }
            $i++;
        }
        if ($resultat != ''){
            $controller->setFormValid(false);
            $d = explode('/',$resultat);
            $data = array();
            $data['champError'] = $d;
            $controller->setData($data);
        }else{
            $controller->setFormValid(true);
        }
    }

    private function testObligatory(){
    }

    private function testDonnee($donnee, $type){
        switch($type){
        case 'texte':
            if (!is_numeric($donnee)){
                return true;
            }else{
                return false;
            }
            break;
        case 'numeric':
            if (is_numeric($donnee)){
                return true;
            }else{
                return false;
            }
            break;
        case 'date':
            break;
        }
    }
}
