<?php
include _DIR_.'Projet/layout/header.php';?>
<h1>Accueil Facturation</h1>
<div id="page">
<?php
if ($this->getData('accueil')){
?>
<table>
 <tr>
 <td><a href="<?php echo _LIENDIR_.'accueilClient';?>">Facturation Client</a></td>
 <td><a href="<?php echo _LIENDIR_.'accueilFournisseur';?>">Facturation Fournisseur</a></td>
 </tr>
</table>
<?php
}
if ($this->getData('liste')){
    $this->generateFichier('listeCommande','facturation');
}
if ($this->getData('afficherCommande')){
    $this->generateFichier('afficheCommande', 'facturation');
}
?>



















</div>
<?php
include _DIR_.'Projet/layout/footer.php';?>
