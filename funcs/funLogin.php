<?php
if (isset($_POST['login-submit'])){

	require "../db/DatabaseAccessLayer.php";

	$user_email = $_POST['user_email'];
	$password = $_POST['pwd'];

	if (empty($user_email)) {
		header("Location: ../index.php?error=emptyfields");
		exit();
	}
	else if (empty($password)) {
		header("Location: ../index.php?error=emptyfields&useremail=".$user_email);
		exit();
	}
	else {
		login($user_email, $password);
	}

}
else{
	header("Location: ../index.php");
	exit();
}