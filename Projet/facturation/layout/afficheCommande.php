
<?php 
//
// Première partie dans le cas ou on a cliquer sur ajouter
// on renvoie dans ce cas une Commande qui remplace le reste
//
if ($this->getData('commandeModif')){
    $commande = $this->getData('commandeModif');
    $idClient = $commande->getIdClient();
    $articles = $commande->getListeArticle();
    $idCmd = $commande->getIdCmd();
    $date = $commande->getDateCmd();
    if (!$commande->getValidationCommande()){
        echo '<form action="'._LIENDIR_.'">';
    }else{
        echo '<form action="">';
    }
}else{
    //
    // Deuxième cas ou on rentre la première fois
    // on récupère des $_POST directement
    //
    echo '<form action="'._LIENDIR_.'">';
    $idCmd = $this->getData('newId');
    $date = $this->getData('dateCmd');
    //
    // Dans le cas d'un nouveau client on importe la liste des clients
    //  pour alimenter le select
    //
    if ($this->getData('clients') != false){
        $clients = $this->getData('clients');
    }
    //
    // Dans le cas d'une modification on récupère juste l'idClient
    //
    if ($this->getData('idClient') != false){
        $idClient = $this->getData('idClient');
    }
}
?>
<tr>
    <td>Commande Numero : <?php echo $idCmd;?></td>
<?php
//
// Les 3 cas différent par rapport au client
//
if (isset($clients)){
    echo '<td><select name="idClient">';
    foreach ($clients as $valeur){
        echo '<option value="'.$valeur->getIdClient().'">'.strtoupper($valeur->getNomClient()).' '.$valeur->getPrenomClient().'</option>';
    }
    echo '</select></td>';
}elseif (isset($commande)){
    echo '<td>Client :'.strtoupper($commande->getNomClient()).' '.$commande->getPrenomClient().'</td>';
    echo '<input type="hidden" value="'.$commande->getIdClient().'" name="idClient">';
}elseif (isset($idClient)){
    echo '<td>Client :'.$idClient.'</td>';
}
?>
    <td>Date Commande : <?php echo $date;?></td>
    <td>Article  : <select name='idArticle'>
<?php 
    //
    // Prépare le select avec la liste d'articles
    //
    foreach ($this->getData('articles') as $valeur){
        echo '<option value="'.$valeur->getIdArticle().'">'.$valeur->getIdArticle().' ==> '.$valeur->getDesignation().'</option>';
    }
?>
</select></td>
<?php 
//
// L'idée était de mettre une restriction si la commande n'est pas valide
// car devenu facture
//
if (isset($commande) && (!$commande->getValidationCommande())){
    echo '<td>Quantité : <input name="qte" type="text"></td>';
}elseif (isset($idClient)){
    echo '<td>Quantité : <input name"qte" type="text"></td>';
}elseif (isset($clients)){
    echo '<td>Quantité : <input name="qte" type="text"></td>';
} ?>
<td><input type="submit" value="Ajouter">
    <input type="hidden" value="<?php echo $idCmd; ?>" name="idCmd">
    <input type="hidden" value="<?php echo $date;?>" name="dateCmd">
    <input type="hidden" value="ajouterArticleComClient" name="action">
    Acompte<input type="text" value="0" name="acompte"> 

<?php if (isset($commande) && (!$commande->getValidationCommande())){
    echo 'NbPaiement<input type="text" value="'.$commande->getNbPaiement().'" name="nbPaiement">';
}else{
    echo 'NbPaiement<input type="text" value="1" name="nbPaiement">';
}?>
</td></tr>
</form>
<table class="tableau">
    <thead>
        <th class="enteteListe"></th>
        <th class="enteteListe">Code Produit</th>
        <th class="enteteListe">Designation</th>
        <th class="enteteListe">PrixHT</th>
        <th class="enteteListe">Quantité</th>
        <th class="enteteListe">TVA</th>
        <th class="enteteListe">TotalHT</th>
    </thead>
    <tbody>
<?php 
if (isset($articles)){
    $sommeTotalHT = 0;
    $totalTVA     = 0;
    foreach ($articles as $valeur){
        //$sousTotal    =  $valeur['totalHT'] * $valeur['qte'];
        $sommeTotalHT += $valeur['totalHT'];
        $totalTVA     += $valeur['article']->getTauxTVA() * $valeur['totalHT'] / 100;
        echo '<tr><td><a href="'._LIENDIR_.'supprimerOneArticle&idArticle='.$valeur['article']->getIdArticle().'&idCmd='.$commande->getIdCmd().'">Supprimer</a></td>';
        echo '<td>'.$valeur['article']->getIdArticle().'</td>';
        echo '<td>'.$valeur['article']->getDesignation();
        echo '<td>'.$valeur['article']->getPrixHT().'</td>';
        echo '<td>'.$valeur['qte'].'</td>';
        echo '<td>'.$valeur['article']->getTauxTVA().'</td>';
        echo '<td>'.$valeur['totalHT'].'</td></tr>';
    }

?>
    </tbody>
</table>
<table class="tableau">
    <tr>
        <td class="enteteListe">TotalHT</td>
        <td><?php echo $sommeTotalHT;?></td>
    </tr>
    <tr>
        <td class="enteteListe">TotalTVA</td>
        <td><?php echo $totalTVA?></td>
    </tr>
    <tr>
        <td class="enteteListe">TotalTTC</td>
        <td><?php echo $sommeTotalHT + $totalTVA; ?></td>
    </tr>
</table>
<?php
}
//
// Le controle marche ici
//
if (isset($commande) && (!$commande->getValidationCommande())){?>
<form action="<?php echo _LIENDIR_.'facturerCommande';?>">
    <input type="submit" value="Facturer" onclick="if(!confirm('Voulez-vous vraiment supprimer la commande <?php echo $idCmd;?> de l\'utilisateur <?php echo $commande->getNomClient();?> ?')) return false;">    
</form>
<a href="<?php echo _LIENDIR_.'commandeClient';?>">Retour liste des commandes</a>
<?php } ?>





















