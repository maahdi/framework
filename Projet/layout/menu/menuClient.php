<div id="fond_menu_navigationGauche">
    <div id="navigationGauche">
        <ul>
            <li> <?php echo '<a href="'._LIENDIR_.'main.php?action=afficheListeClient">Liste des clients</a>'; ?></li>

                <li><?php echo '<a href="'._LIENDIR_.'main.php?action=ajoutCommandeClient">Liste des commandes</a>'; ?></li>

                <li><?php echo '<a href="'._LIENDIR_.'main.php?action=afficheListeClient&ajoutClient=true">Nouveau client</a>'; ?></li>
             <?php  if ($this->search == true && !isset($_REQUEST['idClient']) && !isset($_REQUEST['ajoutClient'])){ 
                    echo '<li> <div id="rechercheclient">';
                     echo '<form method="POST" action="'._LIENDIR_.'main.php?action=searchClient">'; 
                    echo '<input type="text" value="Rechercher" name="search" id="keyword">';
                    echo '<input type="submit" id="ok" value="OK">';
                     echo '</form></li>';
                     echo "<li><a href='"._LIENDIR_."main.php?action=advancedSearchClient'>Recherche avancée</a></li>";
             }?>
    </div>
    </div>
   
    <div class="cb"></div>
</div>