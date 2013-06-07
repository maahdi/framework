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
        $test = true;
        //
        // Test si le champ est vide et s'il existe dans $_POST
        //
        foreach ($listeControle as $valeur){
            if preg_match(',', $valeur){
                $exp = explode(',', $valeur);    
                if ($exp[1] == "obligatoire"){
                    if (!isset($post[$listeChamps[$i]]) || empty($post[$listeChamps[$i]])){
                        $test = false;
                        $data['champError'] = $listeChamps[$i];
                    }
                }
            }
            $i++;
        }
        $i = 0;
        foreach($listeControle as $valeur){
            if (!$this->testDonnee($post[$listeChamps[$i]], $valeur)){
                    $data['champError'] = $listeChamps[$i];               
                    $test = false;
            }
            $i++;
        }
        if (!$test){
            $controller->setFormValid(false);
            $controller->setData($data);
        }else{
            $controller->setFormValid(true);
        }
    }

    private function testDonnee($donnee, $type){
        switch($type){
        case 'codePostal':
            break;

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
            if (preg_match('-', $donnee)){
                $donnee = preg_replace('-', '/', $donnee); 
            }
            $exp = explode('/', $donnee);
            if (checkdate($exp[0], $exp[1], $exp[2])){
                return true;
            }else{
                return false;
            }
            break;
        }
    }
}
