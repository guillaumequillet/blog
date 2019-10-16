<?php declare(strict_types=1); ?>

<h2>Paramètres de connexion</h2>

<?php if($data['param'] === 0): ?>
<p>
    Les données saisies sont incorrectes.
</p>
<?php endif; ?>

<?php if($data['param'] === 1): ?>
<p>
    Vos modifications ont bien été apportées.
</p>
<?php endif; ?>

<form method="post" action="index.php?controller=admin&action=userValidate" id="userForm">
    <p id="error" class="errorText"></p>

    <fieldset>
        <legend>Paramètre Nom d'Utilisateur</legend>
        <label for="oldUsername">Nom d'utilisateur actuel</label>
        <input type="text" name="oldUsername" id="oldUsername">
        <label for="newUsername">Nouveau nom d'utilisateur</label>
        <input type="text" name="newUsername" id="newUsername">
        <label for="newUsernameConfirm">Confirmer le nouveau nom d'utilisateur</label>
        <input type="text" name="newUsernameConfirm" id="newUsernameConfirm">
    </fieldset>
    <p id="errorUser" class="errorText"></p>

    <fieldset>
        <legend>Paramètre Mot de Passe</legend>
        <label for="oldPassword">Mot de passe actuel</label>
        <input type="password" name="oldPassword" id="oldPassword">
        <label for="newPassword">Nouveau mot de passe</label>
        <input type="password" name="newPassword" id="newPassword">
        <label for="newPasswordConfirm">Confirmer le nouveau mot de passe</label>
        <input type="password" name="newPasswordConfirm" id="newPasswordConfirm">
    </fieldset>
    <p id="errorPassword" class="errorText"></p>

    <input type="submit" value="Valider les modifications" id="formValidate">
</form>