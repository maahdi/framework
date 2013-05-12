<?php
include (_DIR_.'Projet/layout/header.php');
?>
<div id="Page">

    <?php
    if ($this->getData('liste')){
        $this->generateFichier('listeClient', 'client');
    }elseif ($this->getData('nouveau')){
        $this->generateFichier('nouveauClient', 'client');
    }elseif ($this->getData('advancedSearch')){
        $this->generateFichier('advancedSearch','client');
    }




//    if (isset($_GET['idClient']) && $_REQUEST['action'] == 'afficheListeClient' && !isset($_REQUEST['ajoutClient'])){
//        echo $this->generateFichier('formuModifClient');
//    }elseif (isset($_GET['ajoutClient']) && $_GET['ajoutClient'] == "true"){
//        echo $this->generateFichier('formuAjoutClient');
//    }
//    elseif ($_REQUEST['action'] == 'ajoutCommandeClient') {
//        if (!isset($_REQUEST['idClient'])){
//            echo "<form method='POST' action='"._LIENDIR_."main.php?action=ajoutCommandeClient'>
//                <label>Selectionnez le client</label>
//                <select name='idClient'>";
//                foreach ($this->getListeClient() as $valeur){
//                    echo "<option value='".$valeur->getIdClient()."'>".$valeur->getNomClient()."</option>";
//                }
//                echo "</select><input type='submit' value='Envoyer'></form>";
//        }else{
//            echo $this->generateFichier('ajoutCommande');
//        }
//        
    
    //}elseif ($_REQUEST['action'] == 'ajoutArticleCommandeClient'){
    //    echo $this->generateFichier('ajoutCommande');
    //}else{
        //echo $this->generateFichier('listeClient','client');
    //}
    
    ?>
    
    
    
</div>
<?php 
include (_DIR_.'Projet/layout/footer.php'); 
?>
