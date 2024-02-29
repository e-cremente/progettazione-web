<?php
//controlla che l'user sia entrato in questa pagina premendo il bottone
if (isset($_POST['registrazione-submit'])){

	require "../db/DatabaseAccessLayer.php";

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['pwd'];
	$confermapwd = $_POST['confermapwd'];

	if (empty($username) || empty($email) || empty($password) || empty($confermapwd)){
		header("Location: ../Registrati.php?regerror=emptyfields&username=".$username."&email=".$email);
		exit();
	} 
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
		header("Location: ../Registrati.php?regerror=invalidmailanduser");
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../Registrati.php?regerror=invalidmail&username=".$username);
		exit();
	}
	else if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
		header("Location: ../Registrati.php?regerror=invaliduser&email=".$email);
		exit();
	}
	else if ($password !== $confermapwd) {
		header("Location: ../Registrati.php?regerror=passwordcheck&username=".$username."&email=".$email);
		exit();
	}
	else {
		insertUser($username, $email, $password);
	}
}
else {
	header("Location: ../Registrati.php");
	exit();
}