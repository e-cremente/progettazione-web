<?php
$error_messages = [
	"emptyfields" => "Riempi tutti i campi!",
	"emptyreqfields" => "Riempi tutti i campi segnati con l'asterisco!",
	"invalidmailanduser" => "Username e E-Mail non sono validi.<br>Lo Username pu&ograve; contenere solo lettere e numeri!",
	"invalidmail" => "La E-Mail non &egrave; valida.",
	"invaliduser" => "Username non valido.<br>Lo Username pu&ograve; contenere solo lettere e numeri!",
	"passwordcheck" => "Le password non coincidono.",
	"sqlerror" => "C'&egrave; stato un problema di connessione al server.<br>Riprova pi&ugrave; tardi.",
	"userandemailtaken" => "Username e E-Mail gi&agrave; registrati.",
	"usertaken" => "Username gi&agrave; registrato.",
	"emailtaken" => "E-Mail gi&agrave; registrata.",
	"wrongpwd" => "Password errata",
	"nouser" => "Username errato",
	"incorrectformat" => "Per favore rispetta il formato specificato nelle caselle.",
	"notregistered" => "Login non eseguito. Il personaggio non &egrave; stato potuto essere salvato.",
];

function stampaErrore($errCode){
	global $error_messages;
	if (array_key_exists($errCode, $error_messages)) {
		echo '<p class="message_error">'. $error_messages[$errCode] .'</p>';
	} else {
		echo '<p class="message_error">Non &egrave; stato assegnato nessun messaggio al codice: <b>'. $errCode .'</b></p>';
	}
}

function pulisciErrore() {
	echo '<p id="errmsg" class="message_error"><br></p>';
}


$text_messages = [
	"regsuccess" => "Registrazione completata!<br>Esegui il login per accedere con il tuo profilo.",
	"NoSaveAllowed" => "Come utente non registrato puoi esplorare la scheda del personaggio, ma <em>non potrai salvarne uno!</em>",
	"CreationSuccess" => "Il personaggio &egrave; stato salvato correttamente!",
	"tableindication" => "Inserire nella tabella esclusivamente numeri interi",
];


function stampaMessaggio($msgCode) {
	global $text_messages;
	if (array_key_exists($msgCode, $text_messages)) {
		echo '<p class="text_message">'. $text_messages[$msgCode] .'</p>';
	} else {
		echo '<p class="text_message">Non &egrave; stato assegnato nessun messaggio al codice: <b>'. $msgCode .'</b></p>';
	}
}