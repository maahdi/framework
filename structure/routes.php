<?php
$routes = array();
//En indice la valeur de la variable action
//Affecter ensuite nom fonction appelée et le bundle séparé par un "/"
$routes['login'] = 'login/connexion';
$routes['deconnex'] = 'deconnex/connexion';
$routes['connex'] = 'connexion/connexion';
$routes['gestionStock'] = 'renderStock/stock';
$routes['gestionClient'] = 'renderListeClient/client';
