
<?php 
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
    echo '<form action="'._LIENDIR_.'">';
    $idCmd = $this->getData('idCmd');
    $date = $this->getData('dateCmd');
    $idClient = $this->getData('idClient');
}
?>
<tr>
    <td>Commande Numero : <?php echo $idCmd;?></td>
    <td>Date Commande : <?php echo $date;?></td>
    <td>Article  : <select name='idArticle'>
<?php 
    foreach ($this->getData('articles') as $valeur){
        echo '<option value="'.$valeur->getIdArticle().'">'.$valeur->getIdArticle().' ==> '.$valeur->getDesignation().'</option>';
    }
?>
</select></td>
<?php if (!$commande->getValidationCommande()){?>
    <td>Quantité : <input name="qte" type="text"></td>
<?php } ?>
<td><input type="submit" value="Ajouter">
<input type="hidden" value="<?php echo $idCmd; ?>" name="idCmd">
<input type="hidden" value="<?php echo $idClient; ?>" name="idClient">
<input type="hidden" value="<?php echo $date;?>" name="dateCmd">
<input type="hidden" value="ajouterArticleComClient" name="action"></td></tr>
</form>
<table class="tableau">
    <thead>
        <th class="enteteListe">Code Produit</th>
        <th class="enteteListe">Designation</th>
        <th class="enteteListe">PrixHT</th>
        <th class="enteteListe">Quantité</th>
        <th class="enteteListe">TVA</th>
        <th class="enteteListe">TotalHT</th>
    </thead>
    <tbody>
<?php 
$sommeTotalHT = 0;
$totalTVA = 0;
foreach ($articles as $valeur){
    $sousTotal = $valeur->getPrixHT()*$valeur->getQteCmd();
    $sommeTotalHT += $sousTotal;
    $totalTVA += $valeur->getTauxTVA()*$sousTotal/100;
    echo '<tr><td>'.$valeur->getIdArticle().'</td>';
    echo '<td>'.$valeur->getDesignation();
    echo '<td>'.$valeur->getPrixHT().'</td>';
    echo '<td>'.$valeur->getQteCmd().'</td>';
    echo '<td>'.$valeur->getTauxTVA().'</td>';
    echo '<td>'.$sousTotal.'</td></tr>';
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
if (!$commande->getValidationCommande()){?>
<form action="<?php echo _LIENDIR_.'facturerCommande';?>">
<input type="submit" value="Facturer" onclick="if(!confirm('Voulez-vous vraiment supprimer la commande <?php echo $idCmd;?> de l\'utilisateur <?php echo $commande->getNomClient();?> ?')) return false;"></form>
<?php } ?>





















