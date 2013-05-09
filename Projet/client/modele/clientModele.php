<?php
include _DIR_.'structure/modele.php';
class ClientModele extends Modele{
    public function __construct() {
        parent::__construct();
    }

    public function getId(){
        $rslt = $this->getTable(array('idClient'),array('clients'));
        $id = array ();
        foreach ($rslt as $valeur){
            $id[] = $valeur->idClient;
        }
        return $id;
    }

}
