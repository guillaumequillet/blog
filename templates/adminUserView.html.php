<?php declare(strict_types=1); ?>

<h2>Paramètres de connexion</h2>

<form method="post" action="index.php?controller=admin&action=userValidate" id="userForm">
  	<fieldset>
    	<legend>Paramètre Nom d'Utilisateur</legend>
		<label for="oldUsername">Nom d'utilisateur actuel</label>
		<input type="text" name="oldUsername" id="oldUsername">
		<label for="newUsername">Nouveau nom d'utilisateur</label>
		<input type="text" name="newUsername" id="newUsername">
		<label for="newUsernameConfirm">Confirmer le nouveau nom d'utilisateur</label>
		<input type="text" name="newUsernameConfirm" id="newUsernameConfirm">
	</fieldset>

  	<fieldset>
    	<legend>Paramètre Mot de Passe</legend>
		<label for="oldPassword">Mot de passe actuel</label>
		<input type="password" name="oldPassword" id="oldPassword">
		<label for="newPassword">Nouveau mot de passe</label>
		<input type="password" name="newPassword" id="newPassword">
		<label for="newPasswordConfirm">Confirmer le nouveau mot de passe</label>
		<input type="password" name="newPasswordConfirm" id="newPasswordConfirm">
	</fieldset>

	<input type="submit" value="Valider les modifications">
</form>