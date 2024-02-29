<?php
	require_once "config.php";
	include "header.php";
?>

<main>
	<section class="registrazione">
		<h1>Registrazione</h1>
			<?php				
				if (isset($_GET['regerror'])){
					stampaErrore($_GET['regerror']);
				} else if (isset($_GET['registrazione']) && ($_GET['registrazione'] == "success")) {
					stampaMessaggio('regsuccess');
				} else {
					pulisciErrore();
				}				
			?>
			<form class="form-registrazione" action="funcs/funRegistrazione.php" method="post">
			<?php
				if (isset($_GET['username'])) {
					echo '<input class="reginput" type="text" value="'.$_GET['username'].'" name="username" placeholder="Username">';
				} else {
					echo '<input class="reginput" type="text" name="username" placeholder="Username">';
				}
				if (isset($_GET['email'])) {
					echo '<input class="reginput" type="text" value="'.$_GET['email'].'" name="email" placeholder="E-Mail">';
				} else {
					echo '<input class="reginput" type="text" name="email" placeholder="E-Mail">';
				}
			?>
				<input class="reginput" type="password" name="pwd" placeholder="Password">
				<input class="reginput" type="password" name="confermapwd" placeholder="Conferma Password">
				<button type="submit" name="registrazione-submit">Registrati</button>
			</form>
	</section>
</main>

<?php
	include DIR_BASE ."footer.php";
?>