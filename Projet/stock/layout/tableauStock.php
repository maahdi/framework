<h1>Liste des Articles</h1>
    <table class="tableau">
        
<?php 
if ($this->getData('listeArticles') != false){
    $action = 'afficheListeArticle&tri=';
    $image = '../images/boutonTri.png';
?>
<thead class='enteteListe'>
    <th class='enteteListe'></th>
<?php 
    echo "<th class='enteteListe'>CodeArticle<a href='"._LIENDIR_.$action."idArticle' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Référence <a href='"._LIENDIR_.$action."refArticle' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Désignation <a href='"._LIENDIR_.$action."DesignationArticle' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Prix HT <a href='"._LIENDIR_.$action."prixHT' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>TVA <a href='"._LIENDIR_.$action."txTVA' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Prix TTC <a href='"._LIENDIR_.$action."prixTTC' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Stock <a href='"._LIENDIR_.$action."stock' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Stock Theo. <a href='"._LIENDIR_.$action."stockTheorique' >";
        echo "<img src='".$image."' border='0'></a></th>";
    echo "<th class='enteteListe'>Fournisseur <a href='"._LIENDIR_.$action."nomFournisseur' >";
        echo "<img src='".$image."' border='0'></a></th>";
?>
        <th class='enteteListeFin'></th>
        <th class='enteteListeFin'></th>
    </thead>
<tbody>
<?php
       $i = 1;
if ($this->getData('listeArticles')){
    foreach ($this->getData('listeArticles') as $key => $valeur){
        $id = $valeur->getIdArticle();
        echo "<tr><td><input type='checkbox' name='checkbox".$i."' value='".$id."'></td>";
        echo "<td>".$valeur->getIdArticle()."</td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'refArticle', 'texte',".$i.",'articles')\">".$valeur->getRefArticle()."</td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'designation', 'texte-multi',".$i.",'articles')\">".$valeur->getDesignation()."</td>";
        echo "<td class='prix' ondblclick=\"inlineMod(".$id.",this , 'prixHT', 'float',".$i.",'articles')\">".round($valeur->getPrixHT(),3)."</td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'txTVA', 'float',".$i.",'articles')\">".round($valeur->getTauxTVA(),2)."%"."</td>";
        echo "<td class='prix' id='prixttc".$i."'>".round($valeur->getPrixTTC(),3)."</td>";
        echo "<td><ul ondblclick=\"inlineMod(".$id.",this , 'stock', 'entier',".$i.",'articles')\">".$valeur->getStock()."</ul>
            <ul><a href='"._LIENDIR_."ajoutStockArticle&idArticle=".$valeur->getIdArticle()."'>
            <img src='../images/plus.gif' border='0'></a>
            <a href='"._LIENDIR_."suppressionStockArticle&idArticle=".$valeur->getIdArticle()."'>
            <img src='../images/moins.gif' border='0'></a></ul></td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'stockTheorique', 'float',".$i.",'articles')\">".$valeur->getStockTheorique()."</td>";

        echo "<td class='texte'>".$valeur->getNomFournisseur()."</td>";
        echo "<td class='enteteListefin'><a href='"._LIENDIR_."afficheListeArticle&idArticle=".$key."'>modifier</a></td>";
        echo "<td class='enteteListefin'><a href='"._LIENDIR_."deleteArticle&idArticle=".$key.
            "' onclick=\"if(!confirm('Voulez-vous vraiment supprimer l\'article ".$valeur->getIdArticle()." ?')) return false;\">supprimer</a></td></tr>";
        $i++;
    }
}
?>
    </tbody>
</table>

<?php echo '<form method="POST" action="'._LIENDIR_.'selectArticle">'; ?>
    <table class="tableau"> 
        <tr>
            <td class='enteteListe'>
                <img id="flechebas" src="../images/fleche-retour.png" border="0">
            </td>
            <td class='enteteListe' colspan="2">

                <input type="submit" id="boutonbas" value="Supprimer la sélection">
                <?php 
                    echo '<input type="hidden" name="indiceCheckbox" value="'.$i.'">'; 
                ?>
            </td>
        </tr>
    </table>      
</form>

<?php }else{
        echo "<div id='notfound'><h2>Pas d'enregistrement trouvé pour : ".$_REQUEST['search']."</h2>";
        echo "<a href='"._LIENDIR_."afficheListeArticle'>Retour</a></div>";
    }
