<?php include (_DIR_.'Projet/layout/header.php');

?>
<h1>Erreur<h1>
<div id="Page">

<p>
<?php
echo $this->getData('messageErreur');
echo '<a href=\''.$_SERVER['HTTP_REFERER'].'\'>Retour</a>';

?>

</p>

</div>

<?php 
include (_DIR_.'Projet/layout/footer.php'); 
?>
