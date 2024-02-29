<?php
	include "header.php";
?>

<header class="centro">
	<h1 id="titoloindex">Benvenuto su RolePlaying<br><p id="adnd">Advanced Dungeons&Dragons 2nd Edition</p></h1>
	<hr id="separatoretitolo">
	<p id="sottotitolo">Stanco dei fogli volanti o quaderni disorganizzati? Questo posto fa per te!</p>
</header>
<section class="sezione">
<?php
	if (isset($_SESSION['user'])) { 
		echo '<h2 class="titolo_due">Bentornato, '. $_SESSION['user'] .'!</h2>';
		echo '<p class="paragrafo">Qui &egrave; rimasto tutto come l\'hai lasciato. Vogliamo continuare?</p>';
	}
	else { ?>
	<h2 class="titolo_due">Sei nuovo del settore?</h2>
	<p class="paragrafo">Se sei capitato qui per caso, non hai idea di cosa sia <abbr title="Advanced Dungeons&amp;Dragons 2nd Edition">AD&amp;D2Ed</abbr> (o D&amp;D in generale, o i giochi di ruolo)
		e intendi rimediare, ti invito caldamente a cliccare su "Inizia Da Qui" e farti una cultura!</p>
	<h2 class="titolo_due">Se sai gi&agrave; di che si parla...</h2>
	<p class="paragrafo">...perch&eacute; aspettare? Registrati subito, o accedi se sei gi&agrave; registrato, e comincia a giocare!</p>
<?php
	}
?>
</section>
<?php 
	include "footer.php";
?>