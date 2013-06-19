
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
        echo '<form id="com" action="'._LIENDIR_.'">';
    }else{
        echo '<form id="com" action="">';
    }
}else{
    //
    // Deuxième cas ou on rentre la première fois
    // on récupère des $_POST directement
    //
    echo '<form id="com" action="'._LIENDIR_.'">';
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
    <p class="title">Commande Numero : <?php echo $idCmd;?></p>
<?php
//
// Les 3 cas différent par rapport au client
//
if (isset($clients)){
    echo '<p>Client :<select name="idClient">';
    foreach ($clients as $valeur){
        echo '<option value="'.$valeur->getIdClient().'">'.strtoupper($valeur->getNomClient()).' '.$valeur->getPrenomClient().'</option>';
    }
    echo '</select></p>';
}elseif (isset($commande)){
    echo '<p class="title">Client :'.strtoupper($commande->getNomClient()).' '.$commande->getPrenomClient().'</p>';
    echo '<input type="hidden" value="'.$commande->getIdClient().'" name="idClient">';
}elseif (isset($idClient)){
    echo '<p class="title">Client :'.$idClient.'</p>';
}
?>
    <p class="title">Date Commande : <?php echo $date;?></p>
    <p class="title">Article  : <select name='idArticle'></p>
<?php 
    //
    // Prépare le select avec la liste d'articles
    //
    foreach ($this->getData('articles') as $valeur){
        echo '<option value="'.$valeur->getIdArticle().'">'.$valeur->getIdArticle().' ==> '.$valeur->getDesignation().' '.$valeur->getStock().' : '.$valeur->getStockTheorique().'</option>';
    }
?>
</select>
<?php 
//
// L'idée était de mettre une restriction si la commande n'est pas valide
// car devenu facture
//
if (isset($commande) && (!$commande->getValidationCommande())){
    echo '<p>Quantité : <input name="qte" type="text"></p>';
}elseif (isset($idClient)){
    echo '<p>Quantité : <input name"qte" type="text"></p>';
}elseif (isset($clients)){
    echo '<p>Quantité : <input name="qte" type="text"></p>';
} ?>

    <input type="hidden" value="<?php echo $idCmd; ?>" name="idCmd">
    <input type="hidden" value="<?php echo $date;?>" name="dateCmd">
    <input type="hidden" value="ajouterArticleComClient" name="action">
    <p>Acompte : <input type="text" value="0" name="acompte"></p>

<?php if (isset($commande) && (!$commande->getValidationCommande())){
    echo 'NbPaiement<input type="text" value="'.$commande->getNbPaiement().'" name="nbPaiement">';
}else{
    echo 'NbPaiement<input type="text" value="1" name="nbPaiement">';
}?>
<input type="submit" value="Ajouter">
</form>
<div id="grostab">
<div id ="tab">
<table class="tableau">
    <thead>
        <th></th>
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
</table></div>
<div id="tabss">
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
    </tr><tr><td>
<?php
}
//
// Le controle marche ici
//
if (isset($commande) && (!$commande->getValidationCommande())){?>
<form class="bouForm" action="<?php echo _LIENDIR_.'facturerCommande&idCmd='.$idCmd;?>">
    <input type="submit" value="Facturer" onclick="if(!confirm('Voulez-vous vraiment passer la commande <?php echo $idCmd;?> de l\'utilisateur <?php echo $commande->getNomClient();?> en facture ?')) return false;">    
</form>
<?php } ?>





















