<?php declare(strict_types=1); ?>

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

<form method="post" action="index.php?controller=admin&action=validateLogin">
	<label for="username">Username</label>
	<input type="text" name="username" id="username" required>
	<label for="password">Password</label>
	<input type="password" name="password" id="password" required>
	<input type="submit" value="Se connecter">
</form>