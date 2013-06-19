<?php
$facture = $this->getData('facture');
?>
<table id="fact">
<tr>
<td>Numero de la facture : <?php echo $facture->getIdCmd();?></td>
<td>Date : <?php echo $facture->getDateCmd();?></td>
<td>Client : <?php echo $facture->getNomClient().' '.$facture->getPrenomClient();?></td>
<td>Acompte : <?php echo $facture->getAcompte();?></td>
<td>Somme deja payée : <?php echo $facture->getSommePaid();?></td>
<td>Somme restante : <?php echo $facture->getTotalTTC()-$facture->getSommePaid();?></td>
</tr>
</table>
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
foreach ($facture->getListeArticle() as $valeur){
    $sommeTotalHT += $valeur['totalHT'];
    $totalTVA     += $valeur['article']->getTauxTVA() * $valeur['totalHT'] / 100;
    echo '<tr><td>'.$valeur['article']->getIdArticle().'</td>';
    echo '<td>'.$valeur['article']->getDesignation().'</td>';
    echo '<td>'.$valeur['article']->getPrixHT().'</td>';
    echo '<td>'.$valeur['qte'].'</td>';
    echo '<td>'.$valeur['article']->getTauxTVA().'</td>';
    echo '<td>'.$valeur['totalHT'].'</td></tr>';
}
?>
    </tbody>
</table>
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
    </tr>
</table></div>
