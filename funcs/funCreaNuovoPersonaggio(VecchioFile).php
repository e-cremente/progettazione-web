<?php

if (isset($_POST['parametri-submit'])){

	session_start();
	require "../db/DatabaseAccessLayer.php";
	require "funUtil.php";
	require "../classi/clsPersonaggio.php";
	require "../classi/clsAllineamento.php";
	require "../classi/clsClasse.php";
	require "../classi/clsRazza.php";

	//variabili di anagrafica
	$nomepg = $_POST['nomepg'];
	$allineamento = $_POST['alignment'];
	$razza = $_POST['race'];
	$classe = $_POST['cls'];
	$secClass = $_POST['secondaryclass'];
	$livello = $_POST['lvl'];
	$secLivello = $_POST['secondarylvl'];
	$esperienza = $_POST['exp'];
	$origine = $_POST['origin'];
	$famiglia = $_POST['family'];
	$clan = $_POST['clan'];
	$religione = $_POST['rel'];
	$classesociale = $_POST['socclass'];
	$fratellisorelle = $_POST['fratsis'];
	$sesso = $_POST['sex'];
	$anni = $_POST['age'];
	$altezza = $_POST['heigth'];
	$peso = $_POST['weigth'];
	$capelli = $_POST['hair'];
	$occhi = $_POST['eyes'];
	$aspetto = $_POST['appearance'];

}

if (isset($_POST['creapg-submit'])){

	session_start();
	require "../db/DatabaseAccessLayer.php";
	require "funUtil.php";
	require "../classi/clsPersonaggio.php";
	require "../classi/clsAllineamento.php";
	require "../classi/clsClasse.php";
	require "../classi/clsRazza.php";
	require "../classi/clsAbilita.php";
	require "../classi/clsPgAbilita.php";
	require "../classi/clsPgTirosalvMod.php";
	//variabili di anagrafica
	$nomepg = $_POST['nomepg'];
	$allineamento = $_POST['alignment'];
	$razza = $_POST['race'];
	$classe = $_POST['cls'];
	$secClass = $_POST['secondaryclass'];
	$livello = $_POST['lvl'];
	$secLivello = $_POST['secondarylvl'];
	$esperienza = $_POST['exp'];
	$origine = $_POST['origin'];
	$famiglia = $_POST['family'];
	$clan = $_POST['clan'];
	$religione = $_POST['rel'];
	$classesociale = $_POST['socclass'];
	$fratellisorelle = $_POST['fratsis'];
	$sesso = $_POST['sex'];
	$anni = $_POST['age'];
	$altezza = $_POST['heigth'];
	$peso = $_POST['weigth'];
	$capelli = $_POST['hair'];
	$occhi = $_POST['eyes'];
	$aspetto = $_POST['appearance'];
	//variabili delle caratteristiche
	$forza = $_POST['valforza'];
	$forzasec = $_POST['secvalforza'];	
	$energia = $_POST['valenergia'];
	$muscoli = $_POST['valmuscoli'];
	$destrezza = $_POST['valdes'];
	$mira = $_POST['valmira'];
	$equilibrio = $_POST['valequilibrio'];
	$costituzione = $_POST['valcos'];
	$salute = $_POST['valsalute'];
	$formafisica = $_POST['valformafisica'];
	$intelligenza = $_POST['valint'];
	$ragione = $_POST['valragione'];
	$conoscenza = $_POST['valconoscenza'];
	$saggezza = $_POST['valsag'];
	$intuizione = $_POST['valintuizione'];
	$forzadivolonta = $_POST['valfdivolonta'];
	$carisma = $_POST['valcar'];
	$comando = $_POST['valcomando'];
	$fascino = $_POST['valfascino'];
	//variabili dei tiri salvezza
	$mod1 = $_POST['valmod1'];
	$mod2 = $_POST['valmod2'];
	$mod3 = $_POST['valmod3'];
	$mod4 = $_POST['valmod4'];
	$mod5 = $_POST['valmod5'];

	$_SESSION['POST'] = $_POST;

	//creo un array con le textbox che devono essere obbligatoriamente riempite
	$obligedArrayTB = [$nomepg, $livello, $anni, $forza, $energia, $muscoli, $destrezza, $mira, $equilibrio, $costituzione, $formafisica,
					   $salute, $intelligenza, $ragione, $conoscenza, $saggezza, $intuizione, $forzadivolonta, $carisma, $comando, $fascino];

	//creo un array con le combo box che devono essere obbligatoriamente riempite con una scelta diversa da quella di default
	$obligedArrayCB = [$allineamento, $razza, $classe, $sesso];

	//controllo i campi obbligatori
	if (checkCampiObbligatori($obligedArrayTB, $obligedArrayCB)) {

		header("Location: ../CreaNuovoPersonaggio.php?newpgerror=emptyreqfields");
		exit;
	}

	//creo un array con tutti i campi che devono rispettare il formato "/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/"
	$regex1 = "/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/";
	$arrayregex1 = [$nomepg, $origine, $famiglia, $clan, $classesociale, $fratellisorelle, $capelli, $occhi, $aspetto];

	//creo un array con tutti i campi che devono rispettare il formato "/^[0-9]*$/"
	$regex2 = "/^[0-9]*$/";
	$arrayregex2 = [$livello, $esperienza, $anni, $altezza, $peso, $forza, $energia, $muscoli, $destrezza, $mira, $equilibrio, $costituzione,
				    $formafisica, $salute, $intelligenza, $ragione, $conoscenza, $saggezza, $intuizione, $forzadivolonta, $carisma, $comando, 
				    $fascino];

	//creo un array con tutti i campi che devono rispettare il formato "/^([+-][1-9][0-9]*)?$/"
	$regex3 = "/^([+-][1-9][0-9]*)?$/";
	$arrayregex3 = [$mod1, $mod2, $mod3, $mod4, $mod5];

	if (checkCorrectFormat($regex1, $arrayregex1, $regex2, $arrayregex2, $regex3, $arrayregex3)){

		header("Location: ../CreaNuovoPersonaggio.php?newpgerror=incorrectformat");
		exit;
	}
	if (isset($_SESSION['user'])) {
		$personaggio = new clsPersonaggio($_POST);
		$personaggio->setInsertStmt();
		$personaggio->insertIntoDb();
		$arrayskills = array();
		for ($x=1; $x <= 6; $x++) { 
			$arrayskills = setCorrectArraySkills($personaggio->idPersonaggio, $x);
			$abilita = new clsPgAbilita($arrayskills);
			$abilita->setInsertStmt();
			$abilita->insertIntoDb();
		}
		$arrayts = array();
		for ($x=1; $x < 6; $x++) { 
			$arrayts = setCorrectArrayTs($personaggio->idPersonaggio, $x);
			$tirosalvezza = new clsPgTirosalvMod($arrayts);
			$tirosalvezza->setInsertStmt();
			$tirosalvezza->insertIntoDb();
		}
		header("Location: ../CreaNuovoPersonaggio.php?pgcreation=creasuccess");
		exit;
	} else if (!isset($_SESSION['user'])){
		header("Location: ../CreaNuovoPersonaggio.php?newpgerror=notregistered");
		exit;
	}

} else {
	header("Location: ../CreaNuovoPersonaggio.php");
	exit;
}