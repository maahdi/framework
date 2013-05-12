<?php

include _DIR_.'Projet/layout/header.php';

$_SESSION['login'] = 'vide';
?>
<div id="Page">
    <?php 

switch ($this->action){
    case 'fail':
        echo "Mauvais identifiant";
        break;
}

?>
    <article class="formulaire">
        <h1 >Entrez vos identifiants</h1>
<?php echo '<form method="POST" action="'._LIENDIR_.'connex">';?>
        
    <fieldset>
        <br><ul>
	<label for="login">Login :</label>
        <input type="text" name="login" value="yoshi"/>
    </ul>
        <ul>
	<label for="password">Mot de passe :</label>
	<input name="password" type="password" value="martini"/>		
        </ul>
        <ul>
	<input type="submit" value="Envoyer"/>
        </ul>
        </fieldset>
        </form>
</article>
    </div>
<?php 
include _DIR_.'Projet/layout/footer.php';
?>
