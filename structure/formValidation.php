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
            if (preg_match('/,/', $valeur)){
                $exp = explode(',', $valeur);    
                if ($exp[1] == "obligatoire"){
                    if (!isset($post[$listeChamps[$i]]) || empty($post[$listeChamps[$i]])){
                        $test = false;
                        $data['error'][$listeChamps[$i]] = true;
                    }
                }
            }
            $i++;
        }
        $i = 0;
        foreach($listeControle as $valeur){
            if (preg_match('/,/', $valeur)){
                $exp = explode(',', $valeur);
                if (!$this->testDonnee($post[$listeChamps[$i]], $exp[0])){
                    $data['error'][$listeChamps[$i]] = true;
                    $test = false;
                }
            }else{
                if (!$this->testDonnee($post[$listeChamps[$i]], $valeur)){
                        $data['error'][$listeChamps[$i]] = true;
                        $test = false;
                }
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
        case 'email':
            if (preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/', $donnee)){
                return true;
            }else{
                return false;
            }
            break;

        case 'codePostal':
            if (preg_match('/^[0-9]{5}$/', $donnee)){
                return true;
            }else{
                return false;
            }
            break;

        case 'alphaNum':
            if (preg_match('/^[0-9a-zA-Z ]+$/', $donnee)){
                return true; 
            }else{
                return false;
            }
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
