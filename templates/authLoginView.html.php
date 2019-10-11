<?php declare(strict_types=1); ?>

<h2>Accès à l'Administration</h2>

<?php 
	// if connexion failed
	if (isset($data['param']) && $data['param'] === 0): 
?>
<p>Les données saisies sont incorrectes.</p>
<?php endif; ?>

<?php 
	// if logout was successful
	if (isset($data['param']) && $data['param'] === 1): 
?>
<p>Vous avez été déconnecté(e).</p>
<?php endif; ?>

<?php 
	// if admin was requested without connexion
	if (isset($data['param']) && $data['param'] === 3): 
?>
<p>Vous devez être connecté(e) pour accéder à cet espace.</p>
<?php endif; ?>

<form id="loginForm" method="post" action="index.php?controller=auth&action=validateLogin">
	<label for="username">Nom d'utilisateur</label>
	<input type="text" name="username" id="username" required>
	<label for="password">Mot de passe</label>
	<input type="password" name="password" id="password" required>
	<input type="submit" value="Se connecter">
</form>
