<?php
	session_start();
	include "./php/util/sessionUtil.php";
	include "./php/db/DatabaseAccessLayer.php";
	include "./php/classi/clsVoceMenu.php";
	include "./php/classi/clsMenu.php";

	if(isLogged()){
		header('Location: ./php/home.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Edoardo Cremente">
		<meta name = "keywords" content="HTML, CSS, JavaScript, Php, DnD, Dungeons And Dragons, RolePlay, Game, Table, Character">
		<meta name="description" content="Utile per tenere conto di ogni progresso nella propria campagna di DnD, creare i propri personaggi, le proprie campagne, consultare quelle altrui e molto altro.">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--		<link rel="stylesheet" href="./css/menu.css" type="text/css" media="screen">-->
		<link rel="shortcut icon" type="image/x-icon" href="./css/img/favicon.png">
		<title>RolePlaying - AD&amp;D 2nd Edition</title>
	</head>
	<body>
		<?php
			include "./php/layout/nav_menu.php";
		?>
		<header id="titolo">
			<h1>Benvenuto su RolePlaying - Advanced Dungeons&Dragons 2nd Edition!</h1>
			<em>Stanco dei fogli volanti o quaderni disorganizzati? Questo posto fa per te!</em>
		</header>
		<section id="introduzione">
			<h2>Sei nuovo del settore?</h2>
			<p>Se sei capitato qui per caso, non hai idea di cosa sia <abbr title="Advanced Dungeons&amp;Dragons 2nd Edition">AD&amp;D2Ed</abbr> (o D&amp;D in generale, o i giochi di ruolo)
				e intendi rimediare, ti invito caldamente a cliccare su "Inizia Da Qui" e farti una cultura!</p>
			<h2>Se sai gi&agrave; di che si parla...</h2>
			<p>...perch&eacute; aspettare? Registrati subito, o accedi se sei gi&agrave; registrato, e comincia a giocare!</p>
		</section>
	</body>
</html>
