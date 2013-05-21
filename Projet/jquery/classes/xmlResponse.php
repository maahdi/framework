<?php

class XmlResponse{
    private $response;
    
    //
    // listeChamp = title => valeur
    //
    public function __construct(array $listeChamp){
        $key = array_keys($listeChamp);
        $i = 0;
        foreach($listeChamp as $valeur){
            $this->response = '<'.$key[$i].'>'.$valeur.'</'.$key[$i].'>';
            $i++;
        }
    }

    public function SendResponse(){
        echo '<?xml version\'1.0\' encoding=\'UTF-8\' standalone=\'yes\'>';
        echo '<item>'.$this->response.'</item>';
        exit;
    }
}
