
<table class="tableau">
<?php 
if ($this->getData('listeCommande') != false){
    $liste = $this->getData('listeCommande');
}else if ($this->getData('listeFacture') != false){
    $liste = $this->getData('listeFacture');
}else{
    $liste = false;
}
if ($liste != false){
    $champ = array('idCmd', 'dateCmd', 'nomClient', 'totalHT', 'totalTVA', 'totalTTC', 'articles');
    $nom = array('Code', 'Date','Nom Client', 'Total HT' , 'TVA', 'Total TTC', 'Articles');
    $i = 0;
    echo '<thead class="enteteListe">';
    foreach ($champ as $valeur){
        if ($valeur == $this->getData('champ')){
            if ($this->getData('tri') == 'desc'){
                $tri = 'Desc';
                $image = '../images/boutonTri_DESC.png';
            }else{
                $tri = 'Asc';
                $image = '../images/boutonTri.png';
            }
        }else{
            $tri = 'Asc';
            $image = '../images/boutonTri.png';
        }
        $action = 'triCommande'.$tri.'&champ=';
        if ($valeur == 'nomClient' || $valeur == 'articles'){
            echo '<th class="enteteListe">'.$nom[$i].'</th>';
        }else{
            echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.$valeur.'">';
            echo '<img src="'.$image.'" border="0">'.$nom[$i].'</a></th>';
        }
        $i++;
    }

    //<?php  
    //echo '<th class="enteteListe">Numero<a href="'._LIENDIR_.$action.'idClient" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
    //echo '<th class="enteteListe">Date Creation<a href="'._LIENDIR_.$action.'nomClient" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
    //echo '<th class="enteteListe" >Nom Client<a href="'._LIENDIR_.$action.'prenomClient" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
    //echo '<th class="enteteListe">TotalHT<a href="'._LIENDIR_.$action.'adresseClient" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
    //echo '<th class="enteteListe">TVA<a href="'._LIENDIR_.$action.'cpClient" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
    //echo '<th class="enteteListe">TotalTTC<a href="'._LIENDIR_.$action.'idPays" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
    //echo '<th class="enteteListe">Articles<a href="'._LIENDIR_.$action.'idPays" >';
    //    echo '<img src="'.$image.'" border="0"></a></th>';
?>
        <th class="enteteListefin"></th>
        <th class="enteteListefin"></th></thead>
    <tbody>
<?php $i = 1;
foreach ($liste as $valeur){
    $id = $valeur->getIdCmd();
    echo '<tr><td style="width:10%;">'.$valeur->getIdCmd().'</td>';
    echo "<td class='texte' >".$valeur->getDateCmd()."</td>";
    echo "<td class='texte' >".$valeur->getNomClient()."</td>";
    echo "<td class='texte' >".round($valeur->getTotalHT(),3)."</td>";
    echo "<td class='texte' >".round($valeur->getTotalTVA(),2)."</td>";
    echo "<td class='texte' >".round($valeur->getTotalTTC(),3)."</td>";
    echo "<td style='width:25%;' >".$valeur->toStringArticles(5)."</td>";
    if (!$valeur->getValidationCommande()){
        echo '<td><a href="'._LIENDIR_.'facturerCommande&idCmd='.$id.'">facturer</a></td>';
        echo '<td><a href="'._LIENDIR_.'modifierCommande&idCmd='.$id.'&idClient='.$valeur->getIdClient().'">modifier</a></td>';
        echo '<td><a href="'._LIENDIR_.'deleteCommande&idCmd='.$id.
            '" onclick="if(!confirm(\"Voulez-vous vraiment supprimer la commande '.$valeur->getIdCmd().'\n
           de l\'utilisateur '.$valeur->getNomClient().' ?\")) return false;">supprimer</a></td></tr>';
    }else{
        echo '<td><a href="'._LIENDIR_.'voirFacture&idCmd='.$id.'">Visualiser</a></td></tr>';
    }
    $i++;
}
?>
           </tbody>
    </table>
<?php }else{
    echo '<div id=\'notfound\'><h2>Pas d\'enregistrement trouvé !!!</h2></div>';

}
