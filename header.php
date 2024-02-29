<?php
	session_start();
	require_once "config.php";
	require_once "autoload.php";
	spl_autoload_register("myAutoload");

	include "db/DatabaseAccessLayer.php";
	require_once "PanelPersonaggio.php";
	require_once "PanelCombattimento.php";
	require_once "PanelProficienze.php";
	require_once "PanelAltreInfo.php";
	require_once "PanelAbLadri.php";
	require_once "PanelIncantesimi.php";
	require_once "PanelEquipaggiamento.php";
	include "funcs/funUtil.php";
	
	include "MessageManager.php";

?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Edoardo Cremente">
		<meta name = "keywords" content="HTML, CSS, JavaScript, Php, DnD, Dungeons And Dragons, RolePlay, Game, Table, Character">
		<meta name="description" content="Utile per tenere conto di ogni progresso nella propria campagna di DnD, creare i propri personaggi, le proprie campagne, consultare quelle altrui e molto altro.">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> -->
		<link rel="stylesheet" href="css/oldlondon.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/roboto.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/geosanslight.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/immagini.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/testi.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/registrazione.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/creanuovopersonaggio.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/tabbedPanes.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/manuali.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/profilo.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/footer.css" type="text/css" media="screen">
		<script src="js/Tabelle.js" defer></script>
		<script src="classi/clsBitMask.js" defer></script>
		<script src="js/TabCaratteristiche.js" defer></script>
		<script src="js/armi.js" defer></script>
		<script src="js/proficienzearmi.js" defer></script>
		<script src="js/proficienze.js" defer></script>
		<script src="js/tratti.js" defer></script>
		<script src="js/svantaggi.js" defer></script>
		<script src="js/armatura.js" defer></script>
		<script src="js/puntiferita.js" defer></script>
		<script src="js/infogeneriche.js" defer></script>
		<script src="js/ricchezze.js" defer></script>
		<script src="js/abilitadirazza.js" defer></script>
		<script src="js/abilitadiclasse.js" defer></script>
		<script src="js/stilidicombattimento.js" defer></script>
		<script src="js/abilitadeiladri.js" defer></script>
		<script src="js/incantesimi.js" defer></script>
		<script src="js/ValidateAnagrafica.js" defer></script>
		<script src="js/ValidateCaratteristiche.js" defer></script>
		<script src="js/ValidateTiriSalvezza.js" defer></script>
		<script src="js/ValidateArmatura.js" defer></script>
		<script src="js/ValidatePuntiFerita.js" defer></script>
		<script src="js/ValidateInfoGeneriche.js" defer></script>
		<script src="js/ValidateRicchezze.js" defer></script>
		<script src="js/ValidateAbilitaDeiLadri.js" defer></script>
		<script src="js/ValidateEquipaggiamento.js" defer></script>
		<script src="js/eliminapersonaggio.js" defer></script>
		<script src="js/bodyOnLoad.js" defer></script>
		<script src="js/profilo.js" defer></script>
		<script src="js/ajax.js" defer></script>
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		<title>RolePlaying - AD&amp;D 2nd Edition</title>
	</head>
	<body <?php if(isset($_GET['idPersonaggio'])) echo 'onLoad="EseguiFunzioniJavascript()"' ?> >
		<div class="backgroundimage"></div>
		<?php
				include "layout/nav_menu.php";
		?>
		<div class="content" id="contenuto">	