<h1>Modifier un client</h1> 
 <article class="formulaire">
<?php $key = $this->getData('client')->getIdClient();?>


<form method='POST' action='<?php echo _LIENDIR_.'updateClient';?>'><h1>Client n°<?php echo $key;?></h1>
    <fieldset>
    <label for='nomClient'>Nom</label>
    <input type='text' name='nomClient' value='
<?php echo ($this->getData('nomClient') != false) ? $this->getData('nomClient') : $this->getData('client')->getNomClient();?>'>
    <label for='prenomClient'>Prenom</label>
    <input type='text' name='prenomClient' value='
<?php echo ($this->getData('prenomClient') != false) ? $this->getData('prenomClient') : $this->getData('client')->getPrenomClient();?>'>
    <label for='adresseClient'>Adresse</label>
    <input type='text' name='adresseClient' value='
<?php echo ($this->getData('adresseClient') != false) ? $this->getData('adresseClient') : $this->getData('client')->getAdresseClient();?>'>
    <label for='cpClient'>Code Postal</label>
    <input type='text' name='cpClient' value='
<?php echo ($this->getData('cpClient') != false) ? $this->getData('cpClient') : $this->getData('client')->getCpClient();?>'>
    <label for='idPays'>Pays</label>
    <input type='text' name='nomPays' value='
<?php echo ($this->getData('nomPays') != false) ? $this->getData('nomPays') : $this->getData('client')->getNomPays();?>'>
                   <!-- //if (!isset($_REQUEST['selectPays'])){
//                        
//                    }else{
//                        echo '<input type=\'text\' name=\'nomPays\' value=\''.$_REQUEST['selectPays'].'\'></ul>';
//                    }
//        echo '<ul><label></label>';
//        
//               echo     '<select name=\'selectPays\' onChange=\'parent.location.href=\''._LIENDIR_.'afficheListeClient&idClient='.$key.'&selectPays=\'+this[this.selectedIndex].value\'';
//                        echo '<option>Selectionnez un pays<option>';
//                  foreach ($this->listePays as $valeur){
//                      echo '<option value=\''.$valeur->nomPays.'\'>'.$valeur->nomPays.'</option>';
//                  }
//              echo '</select></ul><ul> -->
<?php echo '<input type=\'submit\' value=\'Modifier\'>
    <input type=\'hidden\' name=\'idClient\' value=\''.$key.'\'>';?>
        </fieldset>
    </form>


 </article>

