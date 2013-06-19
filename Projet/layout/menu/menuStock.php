<div id="fond_menu_navigationGauche">
    <div id="navigationGauche">
        <ul>
            <li> <?php echo '<a href="'._LIENDIR_.'gestionArticle">Liste des articles</a>'; ?></li>
            <!-- <li><?php// echo '<a href="'._LIENDIR_.'nouvelArticle">Nouvel article</a>'; ?></li> -->
<?php
//  if ($this->search == true){ 
    //echo '<li> <div id="rechercheclient">';
    //echo '<form method="POST" action="'._LIENDIR_.'searchArticle">'; 
    //echo '<input type="text" placeholder="Rechercher" name="search" id="keyword">';
    //echo '<input type="submit" id="ok" value="OK">';
    //echo '</form></li>';
    //echo '<li><a href=\''._LIENDIR_.'renderAdvancedSearchArticle\'>Recherche avancée</a></li>';
//}else{
  //  echo '<li><a href=\''._LIENDIR_.'renderAdvancedSearchArticle\'>Nouvelle Recherche</a></li>';

//}

    if (($liste = $this->getData('listeArticles')) != false){
        $t = false;
        foreach ($liste as $valeur){
            if ($valeur->getStockTheorique() <= 0){
                $t = true;
            }    
        }
        if ($t){
            echo '<li><a href="'._LIENDIR_.'stockNegatif">Stock négatif</a></li>';
        }
    }
?>
        </ul>
    </div>
</div>
