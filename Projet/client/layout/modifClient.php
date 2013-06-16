<h1>Modifier un client</h1> 
 <article class="formulaire">
<?php $key = $this->getData('client')->getIdClient();
$error = $this->getData('error');?>


<form method='POST' action='<?php echo _LIENDIR_.'updateClient';?>'><h1>Client n°<?php echo $key;?></h1>
    <fieldset>
    <label for='nomClient'>Nom</label>
    <input type='text' name='nomClient' value='
<?php echo ($this->getData('nomClient') != false) ? $this->getData('nomClient') : $this->getData('client')->getNomClient();?>'>
<?php echo (isset($error['nomClient']))? '<td>Erreur saisie ou champs obligatoire</td>': '';?>
    <label for='prenomClient'>Prenom</label>
    <input type='text' name='prenomClient' value='
<?php echo ($this->getData('prenomClient') != false) ? $this->getData('prenomClient') : $this->getData('client')->getPrenomClient();?>'>
<?php echo (isset($error['prenomClient']))? '<td>Erreur saisie ou champs obligatoire</td>': '';?>
    <label for='emailClient'>E-mail</label>
    <input type="text" name="emailClient" value='
<?php echo ($this->getData('emailClient') != false) ? $this->getData('emailClient') : $this->getData('client')->getEmailClient();?>'>
<?php echo (isset($error['emailClient']))? '<td>Erreur saisie ou champs obligatoire</td>': '';?>
    <label for='adresseClient'>Adresse</label>
    <input type='text' name='adresseClient' value='
<?php echo ($this->getData('adresseClient') != false) ? $this->getData('adresseClient') : $this->getData('client')->getAdresseClient();?>'>
<?php echo (isset($error['adresseClient']))? '<td>Erreur saisie ou champs obligatoire</td>': '';?>
    <label for='cpClient'>Code Postal</label>
    <input type='text' name='cpClient' value='
<?php echo ($this->getData('cpClient') != false) ? $this->getData('cpClient') : $this->getData('client')->getCpClient();?>'>
<?php echo (isset($error['cpClient']))? '<td>Erreur saisie ou champs obligatoire</td>': '';?>
    <label for='idPays'>Pays</label>
    <input type='text' name='nomPays' value='
<?php echo ($this->getData('nomPays') != false) ? $this->getData('nomPays') : $this->getData('client')->getNomPays();?>'>
<?php echo (isset($error['nomPays']))? '<td>Erreur saisie ou champs obligatoire</td>': '';?>
<?php echo '<input type=\'submit\' value=\'Modifier\'>
    <input type=\'hidden\' name=\'idClient\' value=\''.$key.'\'>';?>
        </fieldset>
    </form>


 </article>

