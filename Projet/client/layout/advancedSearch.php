<div id="Page">
    <h1>Recherche Avancée</h1>
<?php echo '<form class="formulaire" method="POST" action="'._LIENDIR_.'advancedSearchClient">'; ?>
    <fieldset>
        <ul><br><br>
            <label for="search">Recherche :</label>
            <input name="search" type="text">            
        </ul>
        <ul>
            <label for="champ">Numero</label>
            <input type="radio" name="champ" value="idClient" checked>
        </ul>
        <label for="champ">Nom</label>
        <input type="radio" name="champ" value="nomClient">
        </ul>
        <ul>
            <label for="champ">Prénom</label>
            <input type="radio" name="champ" value="prenomClient">
        </ul>
        <ul>
            <label for="champ">Courriel</label>
            <input type="radio" name="champ" value="emailClient">
        </ul>
        <ul>
            <label for="champ">Adresse</label>
            <input type="radio" name="champ" value="adresseClient">
        </ul>
        <ul>
            <label for="champ">Code Postal</label>
            <input type="radio" name="champ" value="cpClient">
        </ul>
        <ul>
            <label for="champ">Pays</label>
            <input type="radio" name="champ" value="nomPays">
        </ul>
        <ul>
            <input type="submit" value="Envoyer">
        </ul>
        </ul>
    </fieldset>
</form>


</div>
