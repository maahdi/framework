<h1>Ajouter un client</h1> 
<article class="formulaire">
        <?php 
//        if (isset($this->getData('lastId')){
            $key = $this->getData('lastId');
//        }

        echo "<form method='POST' action='"._LIENDIR_."creationClient'>";
               echo "<fieldset>";
                echo "<ul>";
                     echo   "<h1>Client n° ".$key."</h1>";
                          echo "</ul><br><br>";
                  echo "<ul>";
                        echo "<label for='nomClient'>Nom</label>";
                        echo "<input type='text' name='nomClient'>";
                        echo "</ul>";
                  echo "<ul>"; 
                        echo "<label for='prenomClient'>Prenom</label>";
                        echo "<input type='text' name='prenomClient'>";
                        echo "</ul>";
                 echo "<ul>";  
                        echo "<label for='adresseClient'>Adresse</label>";
                        echo "<input type='text' name='adresseClient'>";
                        echo "</ul>";
                  echo "<ul>";  
                        echo "<label for='cpClient'>Code Postal</label>";
                        echo "<input type='text' name='cpClient' >";
                        echo "</ul>";
                        echo "<ul><label for='nomPays'>Pays</label>";
                //  if (!isset($_REQUEST['selectPays'])){
                        echo "<input type='text' name='nomPays'></ul>";
                  //  }else{
                  //      echo "<input type='text' name='nomPays' value='".$_REQUEST['selectPays']."'></ul>";
                  //  }
              // echo "<ul><label></label>";
        
              // echo     "<select name='selectPays' onChange='parent.location.href=\""._LIENDIR_."structure/main.php?action=afficheListeClient&idClient=".$key."&ajoutClient=true&selectPays=\"+this[this.selectedIndex].value'>";
                //        echo "<option>Selectionnez un pays<option>";
                  //  foreach ($this->listePays as $valeur){
                    //    echo "<option value='".$valeur->nomPays."'>".$valeur->nomPays."</option>";
                   // }
                //echo "</select></ul>";
                  echo "<ul>";  
                    echo "<input type='submit' value='Créer'>";
                    echo "<input type='reset' value='Reset'>";
                    echo "<input type='hidden' name='idClient' value='".$key."'>";
                    echo "</ul>";
                echo "</fieldset></form>";
                
        ?>
 </article>
