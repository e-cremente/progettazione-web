<!-- GROSSA BARRA IN ALTO DOVE C'E IL MENU DI NAVIGAZIONE -->
<div id="big_bar">
	<div class="logo">
		<a href="index.php">
			<div class = "logo_image"></div>
		</a>
	</div>
	<div class="navigation_menu">
	<?php
		echo '<ul>';
		$VociMenu = getMenu();
		$menu = new clsMenu();
		while ($row = $VociMenu->fetch_assoc()){
			$vm = new clsVoceMenu($row['Id'], $row['Lingua'], $row['Testo'], $row['Azione'], $row['idpadre']);
			$menu->appendiFiglio($vm, $vm->idpadre);
		}
		$menu->render();
		echo '</ul>';
		echo '</div>';
		echo '<div class="login">';
		if(!isset($_SESSION['user'])){
	?>		
			<form action="./funcs/funLogin.php" method="post" class="toright">
			<div class="loginerror">
				<?php if (isset($_GET['error'])) stampaErrore($_GET['error']); else pulisciErrore(); ?>	
			</div>
			<div class="toright">
				<a id="registrati" href="Registrati.php">Registrati</a>
			</div>									
			<?php
			if (isset($_GET['useremail'])){
				echo '<input class="campoinput" type="text" value="'.$_GET['useremail'].'" name="user_email" placeholder="Username o E-Mail">';
			} else {
				echo '<input class="campoinput" type="text" name="user_email" placeholder="Username o E-Mail">';
			} 
			?>
				<input class="campoinput pwd" type="password" name="pwd" placeholder="Password">
				<button class="login_logout" type="submit" name="login-submit">Accedi</button>
			</form>	
							
	<?php	
		} else {
			pulisciErrore();		
			echo '<form action="./funcs/funLogout.php" method="post" class="toright">';
			echo 	'<button id="logout" class="login_logout" type="submit" name="logout-submit">Logout</button>';
			echo '</form>';
			echo '<a id="profilebtn" class="toright" href="Profilo.php"><span>'. $_SESSION['user'] .' </span></a>';
		}
		echo '</div>';
	?>
</div>
