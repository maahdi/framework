<h1>Liste des clients</h1>

<table class="tableau">
            <?php 
            if ($this->listeClient != false){
            echo "<thead class='enteteListe'>
                    <th class='enteteListe'></th>
                    <th class='enteteListe'>CodeClient<a href='"._LIENDIR_."main.php?action=afficheListeClient&tri=idClient' ><img src='../images/boutonTri.png' border='0'></a></th>
                            



                <th class='enteteListe'>Nom <a href='"._LIENDIR_."main.php?action=afficheListeClient&tri=nomClient' ><img src='../images/boutonTri.png' border='0'></a></th>
                <th class='enteteListe' >Prenom <a href='"._LIENDIR_."main.php?action=afficheListeClient&tri=prenomClient' ><img src='../images/boutonTri.png' border='0'></a></th>
                <th class='enteteListe'>Adresse <a href='"._LIENDIR_."main.php?action=afficheListeClient&tri=adresseClient' ><img src='../images/boutonTri.png' border='0'></a></th>
                <th class='enteteListe'>Code Postal <a href='"._LIENDIR_."main.php?action=afficheListeClient&tri=cpClient' ><img src='../images/boutonTri.png' border='0'></a></th>
                <th class='enteteListe'>Pays <a href='"._LIENDIR_."main.php?action=afficheListeClient&tri=idPays' ><img src='../images/boutonTri.png' border='0'></a></th>
                    <th class='enteteListefin'></th>
                    <th class='enteteListefin'></th></thead>";
                echo "<tbody>";
                   $i = 1;
            foreach ($this->listeClient as $key => $valeur){
                $id = $valeur->getIdClient();
                echo "<tr><td><input type='checkbox' name='checkbox".$i."' value='".$valeur->getIdClient()."'></td>";
                    echo "<td style='width:10%'>".$valeur->getIdClient()."</td>";
                    echo "<td style='width:10%;' class='texte' ondblclick=\"inlineMod(".$id.",this , 'nomClient', 'texte',".$i.",'clients')\">".$valeur->getNomClient()."</td>";
                    echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'prenomClient', 'texte',".$i.",'clients')\">".$valeur->getPrenomClient()."</td>";
                    echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'adresseClient', 'texte',".$i.",'clients')\">".$valeur->getAdresseClient()."</td>";
                    echo "<td class='texte' ondblclick=\"inlineMod(".$id.",this , 'cpClient', 'texte',".$i.",'clients')\">".$valeur->getCpClient()."</td>";
                    echo "<td class='texte'>".$valeur->getNomPaysClient()."</td>";
                    echo "<td ><a href='"._LIENDIR_."main.php?action=afficheListeClient&idClient=".$key."'>modifier</a></td>";
                    echo "<td ><a href='"._LIENDIR_."main.php?action=deleteClient&idClient=".$key.
                            "' onclick=\"if(!confirm('Voulez-vous vraiment supprimer l\'utilisateur ".$valeur->getNomClient()." ?')) return false;\">supprimer</a></td></tr>";
                    $i++;
            }
            ?>
           </tbody>
    </table>
        <?php echo '<form method="POST" action="'._LIENDIR_.'main.php?action=selectClient">'; ?>
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
     
</form>
<?php }else{
        echo "<div id='notfound'><h2>Pas d'enregistrement trouvé pour : ".$_REQUEST['search']."</h2>";
        echo "<a href='"._LIENDIR_."main.php?action=afficheListeClient'>Retour</a></div>";
    }