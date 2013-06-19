<h1>Liste des Articles</h1>
    <table class="tableau">
<?php 
if ($this->getData('listeArticles') != false){
    $champ = array('idArticle', 'refArticle', 'designation', 'prixHT', 'txTVA', 'prixTTC', 'stock', 'stockTheorique', 'idFournisseur');
    $nom = array('Code', 'Reference','Designation', 'Prix HT' , 'TVA', 'prix TTC', 'Stock', 'Stock Theorique', 'Fournisseur');
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
        $action = 'triArticle'.$tri.'&champ=';
        if ($valeur == 'idFournisseur' || $valeur == 'prixTTC'){
            echo '<th class="enteteListe">'.$nom[$i].'</th>';
        }else{
            echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.$valeur.'">';
            echo '<img src="'.$image.'" border="0">'.$nom[$i].'</a></th>';
        }
        $i++;
    }
?>
<?php 
//    echo "<th class='enteteListe'>CodeArticle<a href='"._LIENDIR_.$action."idArticle' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Référence <a href='"._LIENDIR_.$action."refArticle' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Désignation <a href='"._LIENDIR_.$action."DesignationArticle' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Prix HT <a href='"._LIENDIR_.$action."prixHT' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>TVA <a href='"._LIENDIR_.$action."txTVA' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Prix TTC <a href='"._LIENDIR_.$action."prixTTC' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Stock <a href='"._LIENDIR_.$action."stock' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Stock Theo. <a href='"._LIENDIR_.$action."stockTheorique' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//    echo "<th class='enteteListe'>Fournisseur <a href='"._LIENDIR_.$action."nomFournisseur' >";
//        echo "<img src='".$image."' border='0'></a></th>";
//?>
    </thead>
<tbody>
<?php
if ($this->getData('listeArticles')){
    $i = 0;
    foreach ($this->getData('listeArticles') as $key => $valeur){
        echo '<tr>';
        $id = $valeur->getIdArticle();
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
        echo "<td class='texte' >".$valeur->getStockTheorique()."</td>";

        echo "<td class='texte'>".$valeur->getNomFournisseur()."</td>";
        $i++;
    }
}
?>
    </tbody>
</table>
<?php

 }else{
        echo '<div id=\'notfound\'><h2>Pas d\'enregistrement trouvé !!!</h2>';
        echo '<a href=\''._LIENDIR_.'afficheListeArticle\'>Retour</a></div>';
    }
