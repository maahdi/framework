<h1>Ajouter un client</h1> 
<article class="formulaire">
        <?php 
            $key = $this->getData('lastId');
 echo '<form method=\'POST\' action=\''._LIENDIR_.'creationClient\'>';?>
               <fieldset>
                <ul>
<?php echo '<h1>Client n° '.$key.'</h1>'; ?>
                </ul><br><br>
                <ul>
                    <label for='nomClient'>Nom</label>
                    <input type='text' name='nomClient' value='<?php echo ($this->getData('nomClient') != false)?  $this->getData('nomClient'):'';?>'>
                </ul>
                <ul> 
                    <label for='prenomClient'>Prenom</label>
                    <input type='text' name='prenomClient' value='<?php echo ($this->getData('prenomClient') != false)?  $this->getData('prenomClient'):'';?>'>
                </ul>
                <ul>  
                    <label for='adresseClient'>Adresse</label>
                    <input type='text' name='adresseClient' value='<?php echo ($this->getData('adresseClient') != false)?  $this->getData('adresseClient'):'';?>'>
                </ul>
                <ul>  
                    <label for='cpClient'>Code Postal</label>
                    <input type='text' name='cpClient' value='<?php echo ($this->getData('cpClient') != false)?  $this->getData('cpClient'):'';?>' >
                </ul>
                <ul>
                    <label for='nomPays'>Pays</label>
                    <input type='text' name='nomPays' value='<?php echo ($this->getData('nomPays') != false)? $this->getData('nomPays'):'';?>'>
                </ul>
                 <!-- //  }else{
                  //      echo "<input type='text' name='nomPays' value='".$_REQUEST['selectPays']."'></ul>";
                  //  }
              // echo "<ul><label></label>";
        
              // echo     "<select name='selectPays' onChange='parent.location.href=\""._LIENDIR_."structure/main.php?action=afficheListeClient&idClient=".$key."&ajoutClient=true&selectPays=\"+this[this.selectedIndex].value'>";
                //        echo "<option>Selectionnez un pays<option>";
                  //  foreach ($this->listePays as $valeur){
                    //    echo "<option value='".$valeur->nomPays."'>".$valeur->nomPays."</option>";
                   // }
                //echo "</select></ul>";-->
                     <ul>  
                    <input type='submit' value='Créer'>
                    <input type='reset' value='Reset'>
<?php echo '<input type=\'hidden\' name=\'idClient\' value=\''.$key.'\'>';?>
                    </ul>
                </fieldset></form>
                
        </article>
