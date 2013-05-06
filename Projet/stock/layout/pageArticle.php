<?php
include (_DIR_.'Projet/layout/header.php');
?>

<div id="Page">
    
<?php
// on pourrait utiliser cette page pour afficher plusieurs parties
echo $this->generateFichier('tableauStock','stock');
?>
    
</div>
<?php 
include (_DIR_.'Projet/layout/footer.php');
?>