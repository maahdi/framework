<?php
$routes = array();
//En indice la valeur de la variable action
//Affecter ensuite nom fonction appelée et le bundle séparé par un "/"
//'$routes['action'] = nomDeLaFonction/bundle'
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
$routes['facturation'] = 'renderAccueilFacturation/client';
$routes['accueil'] = 'renderAccueil/client';
$routes['deleteClient'] = 'deleteClient/client';
$routes['modifierClient'] = 'modifClient/client';
$routes['updateClient'] = 'enregistrementModificationClient/client';
$routes['enregistrerAjax'] = 'enregistrer/jquery';
$routes['facturation'] = 'displayAccueilFacturation/facturation';
$routes['accueilClient'] = 'displayAccueilClient/facturation/Client';
$routes['accueilFournisseur'] = 'displayAccueilFournisseur/facturation/Fournisseur';
