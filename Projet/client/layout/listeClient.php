<h1>Liste des clients</h1>
<table class="tableau">
<?php 
if ($this->getData('listeClient') != false){
    $action = 'afficheListeClient&tri=';
    $image = '../images/boutonTri.png';
?>
    <thead class="enteteListe">
        <th class="enteteListe"></th>
<?php
    echo '<th class="enteteListe">CodeClient<a href="'._LIENDIR_.$action.'idClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">Nom <a href="'._LIENDIR_.$action.'nomClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe" >Prenom <a href="'._LIENDIR_.$action.'prenomClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe" >Courriel <a href="'._LIENDIR_.$action.'emailClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">Adresse <a href="'._LIENDIR_.$action.'adresseClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">Code Postal <a href="'._LIENDIR_.$action.'cpClient" >';
        echo '<img src="'.$image.'" border="0"></a></th>';
    echo '<th class="enteteListe">Pays <a href="'._LIENDIR_.$action.'idPays" ><img src="'.$image.'" border="0"></a></th>';
?>
        <th class="enteteListefin"></th>
        <th class="enteteListefin"></th>
    </thead>
<tbody>
<?php
    $i = 1;
    foreach ($this->getData('listeClient') as $key => $valeur){
        $id = $valeur->getIdClient();
        echo '<tr><td><input type="checkbox" name="checkbox'.$i.'" value="'.$valeur->getIdClient().'"></td>';
        echo '<td style="width:10%;">'.$valeur->getIdClient().'</td>';
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'nomClient', 'texte',".$i.",'clients')\">".$valeur->getNomClient()."</td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'prenomClient', 'texte',".$i.",'clients')\">".$valeur->getprenomClient()."</td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'emailClient', 'texte',".$i.",'clients')\">".$valeur->getEmailClient()."</td>";

        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'adresseClient', 'texte',".$i.",'clients')\">".$valeur->getAdresseClient()."</td>";
        echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'cpClient', 'texte',".$i.",'clients')\">".$valeur->getCpClient()."</td>";
        //
        //Data['retour'] a mettre a true lors de retour d'enregistrement
        //
        if (!$this->getData('retour')){

            foreach ($this->getData('listePays') as $pays){
                if ($pays->getIdPays() == $valeur->getIdPays()){
                    echo '<option value=\''.$valeur->getIdPays().'\' selected>'.$valeur->getNomPays().'</option>';
                }else{            
                    echo '<option value=\''.$pays->getIdPays().'\'>'.$pays->getNomPays().'</option>';
                }
            }
            echo '<option value=\'nouveau\'>Nouveau</option>';
            echo '</select></td>';
        }else{
            echo '<td>'.$valeur->getNomPays().'</td>'; 
        }

        if (!$this->getData('retour')){
            echo '<td ><a href="'._LIENDIR_.'modifierClient&idClient='.$key.'">modifier</a></td>';
            echo '<td ><a href="'._LIENDIR_.'deleteClient&idClient='.$key.
            '" onclick="if(!confirm("Voulez-vous vraiment supprimer l\'utilisateur '.$valeur->getNomClient().' ?")) return false;">supprimer</a></td></tr>';
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
    echo '<div id=\'notfound\'><h2>Pas d\'enregistrement trouvé pour : '.$_REQUEST['search'].'</h2>';
    if (!$this->getData('newSearch')){
        echo '<a href=\''._LIENDIR_.'gestionClient\'>Retour</a></div>';       
    }else{
        echo '<a href=\''._LIENDIR_.'renderAdvancedSearchClient\'>Retour</a></div>';
    }

}
