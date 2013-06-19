<h1>Liste des clients</h1>
<table class="tableau">
<?php 
if ($this->getData('listeClient') != false){
    $champ = array('idClient', 'nomClient', 'prenomClient', 'emailClient', 'adresseClient', 'cpClient', 'idPays');
    $nom = array('Code', 'Nom', 'Prenom' , 'Courriel', 'Adresse', 'Code Postal', 'Pays');
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
        $action = 'triClient'.$tri.'&champ=';
        if ($valeur == 'idPays'){
            echo '<th class="enteteListe">'.$nom[$i].'</th>';
        }else{
            echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.$valeur.'">';
            echo '<img src="'.$image.'" border="0">'.$nom[$i].'</a></th>';
        }

        $i++;
    }
    //echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.'idClient" >';
    //    echo '<img src="'.$image.'" border="0">CodeClient</a></th>';
    //echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.'nomClient" >';
    //    echo '<img src="'.$image.'" border="0">Nom</a></th>';
    //echo '<th class="enteteListe" ><a href="'._LIENDIR_.$action.'prenomClient" >';
    //    echo '<img src="'.$image.'" border="0">Prenom</a></th>';
    //echo '<th class="enteteListe" ><a href="'._LIENDIR_.$action.'emailClient" >';
    //    echo '<img src="'.$image.'" border="0">Courriel</a></th>';
    //echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.'adresseClient" >';
    //    echo '<img src="'.$image.'" border="0">Adresse</a></th>';
    //echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.'cpClient" >';
    //    echo '<img src="'.$image.'" border="0">Code Postal</a></th>';
    //echo '<th class="enteteListe"><a href="'._LIENDIR_.$action.'idPays" ><img src="'.$image.'" border="0">Pays</a></th>';
?>
        <th class="enteteListefin"></th>
        <th class="enteteListefin"></th>
    </thead>
<tbody>
<?php
    $i = 0;
    foreach ($this->getData('listeClient') as $key => $valeur){
        $id = $valeur->getIdClient();
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
            echo '<td><select name=\'idPays\'>';
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

<?php }else{
    echo '<div id=\'notfound\'><h2>Pas d\'enregistrement trouvé !!!</h2>';
    if (!$this->getData('newSearch')){
        echo '<a href=\''._LIENDIR_.'gestionClient\'>Retour</a></div>';       
    }else{
        echo '<a href=\''._LIENDIR_.'renderAdvancedSearchClient\'>Retour</a></div>';
    }

}
