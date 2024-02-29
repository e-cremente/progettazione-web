<?php
    include "header.php";
?>

<h1 class="profilo">IL MIO PROFILO</h1>

<?php
	$divpersonalinfo = new clsUIDiv('personalinfo');

	$ErroreProfilo = new clsUIParagrafo(["id"=>"msgerrprofilo", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divpersonalinfo->addElemento($ErroreProfilo);

	$tbUsername = creaTextbox('Username', 'profileuser', null, $_SESSION['user'], null, null, 'readonly');
	$divpersonalinfo->addElemento($tbUsername);

	$tbEmail = creaTextbox('E-Mail', 'profilemail', null, $_SESSION['email'], null, null, 'readonly');
	$divpersonalinfo->addElemento($tbEmail);

	$tbNuovaPassword = creaTextbox('Nuova Password', 'newpwd', 'Ignora per non cambiare password', null, 'hidden', 'divnewpwd');
	$divpersonalinfo->addElemento($tbNuovaPassword);

	$tbPasswordCorrente = creaTextbox('Password Attuale', 'currentpwd', 'Obbligatorio per confermare', null, 'hidden', 'divcurrentpwd');
	$divpersonalinfo->addElemento($tbPasswordCorrente);

	$buttonModificaProfilo = new clsButton('Modifica Profilo', 'btnmodificaprofilo', 'button', 'btnmodificaprofilo', 'login_logout');
	$divpersonalinfo->addElemento($buttonModificaProfilo);

	$buttonEliminaProfilo = new clsButton('Elimina Profilo', 'btneliminaprofilo', 'button', 'btneliminaprofilo', 'login_logout');
	$divpersonalinfo->addElemento($buttonEliminaProfilo);

	$buttonSalvaProfilo = new clsButton('Salva Profilo', 'btnsalvaprofilo', 'button', 'btnsalvaprofilo', 'login_logout', 'hidden');
	$divpersonalinfo->addElemento($buttonSalvaProfilo);

	$buttonAnnulla = new clsButton('Annulla', 'btnannulla', 'button', 'btnannulla', 'login_logout', 'hidden');
	$divpersonalinfo->addElemento($buttonAnnulla);

	$divpersonalinfo->render();

?>

<?php 
    include "footer.php";
?>