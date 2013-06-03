
<table class="tableau">
<?php 
if ($this->getData('listeCommande') != false){
    $action = 'afficheListeCommande&tri=';
    $image = '../images/boutonTri.png';?>
    <thead class="enteteListe">
        <th class="enteteListe"></th>
<?php  
    echo '<th class="enteteListe">Numero<a href="'._LIENDIR_.$action.'idClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">Date Creation<a href="'._LIENDIR_.$action.'nomClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe" >Nom Client<a href="'._LIENDIR_.$action.'prenomClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">TotalHT<a href="'._LIENDIR_.$action.'adresseClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">TVA<a href="'._LIENDIR_.$action.'cpClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">TotalTTC<a href="'._LIENDIR_.$action.'idPays" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">Articles<a href="'._LIENDIR_.$action.'idPays" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
?>
        <th class="enteteListefin"></th>
        <th class="enteteListefin"></th></thead>
    <tbody>
<?php $i = 1;
foreach ($this->getData('listeCommande') as $valeur){
    $id = $valeur->getIdCmd();
    echo '<tr><td><input type="checkbox" name="checkbox'.$i.'" value="'.$valeur->getIdCmd().'"></td>';
    echo '<td style="width:10%;">'.$valeur->getIdCmd().'</td>';
    echo "<td class='texte' >".$valeur->getDateCmd()."</td>";
    echo "<td class='texte' >".$valeur->getNomClient()."</td>";
    echo "<td class='texte' >".round($valeur->getTotalHT(),3)."</td>";
    echo "<td class='texte' >".round($valeur->getTotalTVA(),2)."</td>";
    echo "<td class='texte' >".round($valeur->getTotalTTC(),3)."</td>";
    echo "<td style='width:25%;' >".$valeur->toStringArticles(5)."</td>";
    if (!$valeur->getValidationCommande()){
        echo '<td><a href="'._LIENDIR_.'facturerCommande&idCmd='.$id.'">facture</a></td>';
        echo '<td><a href="'._LIENDIR_.'modifierCommande&idCmd='.$id.'&idClient='.$valeur->getIdClient().'">modifier</a></td>';
        echo '<td><a href="'._LIENDIR_.'deleteCommande&idCmd='.$id.
            '" onclick="if(!confirm(\"Voulez-vous vraiment supprimer la commande '.$valeur->getIdCmd().'\n
           de l\'utilisateur '.$valeur->getNomClient().' ?\")) return false;">supprimer</a></td></tr>';
    }
    $i++;
}
?>
           </tbody>
    </table>
        <?php echo '<form method="POST" action="'._LIENDIR_.'selectClient">'; ?>
         <table class="tableau">   <tr >
                <td class="enteteListe">
                    <img id="flechebas" src="../images/fleche-retour.png" border="0">
                </td>
                <td class="enteteListe" colspan="2">

                    <input id="boutonbas" type="submit" value="Supprimer la sélection">
<?php 
    echo '<input type="hidden" name="indiceCheckbox" value="'.$i.'">'; 
?>
                </td>
            </tr></table>

<?php }else{
    echo '<div id=\'notfound\'><h2>Pas d\'enregistrement trouvé pour !!!</h2></div>';

}
