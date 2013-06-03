<div id="fond_menu_navigationGauche">
    <div id="navigationGauche">
        <ul>
            <li> <?php echo '<a href="'._LIENDIR_.'gestionClient">Liste des clients</a>'; ?></li>
                <li><?php echo '<a href="'._LIENDIR_.'nouveauClient">Nouveau client</a>'; ?></li>
<?php  if ($this->search == true){ 
    echo '<li> <div id="rechercheclient">';
    echo '<form method="POST" action="'._LIENDIR_.'searchClient">'; 
    echo '<input type="text" placeholder="Rechercher" name="search" id="keyword">';
    echo '<input type="submit" id="ok" value="OK">';
    echo '</form></li>';
    echo '<li><a href=\''._LIENDIR_.'renderAdvancedSearchClient\'>Recherche avancée</a></li>';
}else{
    echo '<li><a href=\''._LIENDIR_.'renderAdvancedSearchClient\'>Nouvelle Recherche</a></li>';
}
    echo '<li><a href=\''._LIENDIR_.'suiviClient\'>Suivi client</a></li>';


?>
    </div>
    </div>

    <div class="cb"></div>
</div>
