<?php
$routes = array();
//En indice la valeur de la variable action
//Affecter ensuite nom fonction appelée et le bundle séparé par un "/"
//bundle =nom du dossier du module dans le dossier 'Projet'
$routes['login'] = 'login/connexion';
$routes['deconnex'] = 'deconnex/connexion';
$routes['connex'] = 'connexion/connexion';
$routes['gestionStock'] = 'renderStock/stock';
$routes['gestionClient'] = 'renderListeClient/client';
$routes['nouveauClient'] = 'renderNouveauClientForm/client';
$routes['searchClient'] = 'search/client';
$routes['renderAdvancedSearchClient'] = 'renderAdvancedSearch/client';
$routes['advancedSearchClient'] = 'advancedSearch/client';
$routes['creationClient'] = 'enregistrerClient/client';
