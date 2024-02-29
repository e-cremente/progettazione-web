<?php
	include "../db/DatabaseAccessLayer.php";

	function toJson($pResultSet){
		$jsonarray = array();
		while($row = $pResultSet->fetch_assoc()){
			$jsonarray[] = $row;
		}
		return $jsonarray;
	}

//echo "<pre>";print_r($_POST);echo "</pre>";
	$ToCall = isset($_REQUEST["ToCall"]) ? $_REQUEST['ToCall'] : null;
	if ($ToCall == null) $ToCall = isset($_POST["ToCall"]) ? $_POST['ToCall'] : null;
	$Value = isset($_REQUEST["Value"]) ? $_REQUEST['Value'] : null;
	if ($Value == null) $Value = isset($_POST["Value"]) ? $_POST['Value'] : null;
	$IdCbArma = isset($_REQUEST["IdCbArma"]) ? $_REQUEST['IdCbArma'] : null;
	if ($IdCbArma == null) $IdCbArma = isset($_POST["IdCbArma"]) ? $_POST['IdCbArma'] : null;
	$IdCbProficienze = isset($_REQUEST["IdCbProficienze"]) ? $_REQUEST['IdCbProficienze'] : null;
	if ($IdCbProficienze == null) $IdCbProficienze = isset($_POST["IdCbProficienze"]) ? $_POST['IdCbProficienze'] : null;
	$IdCbAbRazza = isset($_REQUEST["IdCbAbRazza"]) ? $_REQUEST['IdCbAbRazza'] : null;
	if ($IdCbAbRazza == null) $IdCbAbRazza = isset($_POST["IdCbAbRazza"]) ? $_POST['IdCbAbRazza'] : null;
	$IdCbAbClasse = isset($_REQUEST["IdCbAbClasse"]) ? $_REQUEST['IdCbAbClasse'] : null;
	if ($IdCbAbClasse == null) $IdCbAbClasse = isset($_POST["IdCbAbClasse"]) ? $_POST['IdCbAbClasse'] : null;
	switch ($ToCall){
		case "getArmiCategoria":
			$rsArmi = selectArmi($Value, $IdCbArma);
			$records = toJson($rsArmi);
			echo json_encode($records);
			break;
		case "aggiungiArma":
			$rsArma = getArma($Value);
			echo json_encode($rsArma);
			break;
		case "InsUpdPersonaggio":
			$result = InsUpdPersonaggio($_POST);
			echo json_encode("idPersonaggio=".$result);
			break;
		case "InsUpdCaratteristica":
			$result = InsUpdCaratteristica($_POST);
			//echo $result;
			echo json_encode("success=".$result); //il risultato è true o false a seconda se ha avuto successo o no
			break;
		case "InsUpdTiroSalvezza":
			$result = InsUpdTiroSalvezza($_POST);
			echo json_encode("success=".$result);
			break;
		case "InsUpdArmatura":
			$result = InsUpdArmatura($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdPuntiFerita":
			$result = UpdPuntiFerita($_POST);
			echo json_encode("success=".$result);
			break;
		case "ChkInsArma":
			$result = ChkInsArma($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdPgArma":
			$result = UpdPgArma($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelArma":
			$result = DelArma($_POST);
			echo json_encode("success=".$result);
			break;
		case "ChkInsArmaProf":
			$result = ChkInsArmaProf($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdPgArmaProf":
			$result = UpdPgArmaProf($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelArmaProf":
			$result = DelArmaProf($_POST);
			echo json_encode("success=".$result);
			break;
		case "selectProficienze":
			$rsProficienze = selectProficienze($Value, $IdCbProficienze);
			$records = toJson($rsProficienze);
			echo json_encode($records);
			break;
		case "aggiungiProficienza":
			$rsProficienza = aggiungiProficienza($Value);
			echo json_encode($rsProficienza);
			break;
		case "ChkInsProficienza":
			$result = ChkInsProficienza($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdPgProficienza":
			$result = UpdPgProficienza($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPgProficienza":
			$result = DelPgProficienza($_POST);
			echo json_encode("success=".$result);
			break;
		case "aggiungiTratto":
			$rsTratto = aggiungiTratto($Value);
			echo json_encode($rsTratto);
			break;
		case "ChkInsTratto":
			$result = ChkInsTratto($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPgTratto":
			$result = DelPgTratto($_POST);
			echo json_encode("success=".$result);
			break;
		case "aggiungiSvantaggio":
			$rsSvantaggio = aggiungiSvantaggio($Value);
			echo json_encode($rsSvantaggio);
			break;
		case "ChkInsSvantaggio":
			$result = ChkInsSvantaggio($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdPgSvantaggio":
			$result = UpdPgSvantaggio($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPgSvantaggio":
			$result = DelPgSvantaggio($_POST);
			echo json_encode("success=".$result);
			break;
		case "selectAbilitaDiRazza":
			$rsAbRazza = selectAbilitaDiRazza($Value, $IdCbAbRazza);
			$records = toJson($rsAbRazza);
			echo json_encode($records);
			break;
		case "selectAbilitaDiClasse":
			$rsAbClasse = selectAbilitaDiClasse($Value, $IdCbAbClasse);
			$records = toJson($rsAbClasse);
			echo json_encode($records);
			break;
		case "aggiungiAbRazza":
			$rsAbRazza = aggiungiAbRazza($Value);
			echo json_encode($rsAbRazza);
			break;
		case "ChkInsAbRazza":
			$result = ChkInsAbRazza($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPgAbRazza":
			$result = DelPgAbRazza($_POST);
			echo json_encode("success=".$result);
			break;
		case "aggiungiAbClasse":
			$rsAbClasse = aggiungiAbClasse($Value);
			echo json_encode($rsAbClasse);
			break;
		case "ChkInsAbClasse":
			$result = ChkInsAbClasse($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPgAbClasse":
			$result = DelPgAbClasse($_POST);
			echo json_encode("success=".$result);
			break;
		case "aggiungiStileComb":
			$rsStileComb = aggiungiStileComb($Value);
			echo json_encode($rsStileComb);
			break;
		case "ChkInsStileComb":
			$result = ChkInsStileComb($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdPgStileComb":
			$result = UpdPgStileComb($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPgStileComb":
			$result = DelPgStileComb($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdInfoGeneriche":
			$result = UpdInfoGeneriche($_POST);
			echo json_encode("success=".$result);
			break;
		case "InsUpdRicchezze":
			$result = InsUpdRicchezze($_POST);
			echo json_encode("success=".$result);
			break;
		case "InsUpdAbilitaDeiLadri":
			$result = InsUpdAbilitaDeiLadri($_POST);
			echo json_encode("success=".$result);
			break;
		case "ChkInsPgIncantesimo":
			$result = ChkInsPgIncantesimo($_POST);
			echo json_encode("success=".$result.",".$_POST['pNum']);
			break;
		case "DelPgIncantesimo":
			$result = DelPgIncantesimo($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdEquipaggiamento":
			$result = UpdEquipaggiamento($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPersonaggioByChange":
			$result = DelPersonaggioByChange($_POST);
			echo json_encode("success=".$result);
			break;
		case "DelPersonaggio":
			$result = DelPersonaggio($_POST);
			echo json_encode("success=".$result);
			break;
		case "UpdProfilo":
			$result = UpdProfilo($_POST);
			echo json_encode("result=".$result);
			break;
		case "DelProfilo":
			$result = DelProfilo($_POST);
			echo json_encode("result=".$result);
			break;
		default: break;
	}
?>