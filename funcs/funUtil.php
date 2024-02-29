<?php

function coalesce($pValue, $pDef1) {
    if ($pValue != null) return $pValue;
    return $pDef1;
}

function creaCella($initarray){
	if (isset($initarray['name'])) {
        $nomecella = $initarray['name'];
        $valore = (isset($_SESSION['POST'][$nomecella])) ? $_SESSION['POST'][$nomecella] : (isset($initarray['value']) ? $initarray['value'] : null);
        $initarray = array_merge($initarray, ['value'=>"{$valore}"]);
	}
	$nuovacella = new clsUITabellaCella($initarray);
	return $nuovacella;
}

function creaTextbox($pLabel, $pName, $pPlaceholder = null, $pValue = null, $pHidden = null, $pDivId = null, $pReadonly = null){
   // $valore = (isset($_SESSION['POST'][$pName])) ? $_SESSION['POST'][$pName] : $pValue;
    $nuovotextbox = new clsUITextBox($pLabel, $pName, $pPlaceholder, $pValue, $pHidden, $pDivId, $pReadonly);
    return $nuovotextbox;
}

function creaCombobox($pLabel, $pName, $arr, $colvalue, $coldescr, $pValore='nochoice'){
    $valore = (isset($_SESSION['POST'][$pName])) ? $_SESSION['POST'][$pName] : $pValore;
    $nuovocombobox = new clsUIComboBox($pLabel, $pName, $arr, $colvalue, $coldescr);
    $nuovocombobox->selectValue($valore);
    return $nuovocombobox;
}

function creaTextArea($array){
    $valore = (isset($_SESSION['POST'][$array['name']])) ? $_SESSION['POST'][$array['name']] : (isset($array['value']) ? $array['value'] : null);
    $array = array_merge($array, ['value'=>"{$valore}"]);
    $nuovatextarea = new clsUITextArea($array);
    return $nuovatextarea;
}

$currentNumRighe = 0; 
$arrayarma = ["arma", "at", "modad", "thaco", "danni", "raggio", "peso", "taglia", "tipologia", "velocita"];

function creaNextRigaArmi(){
    global $tabcombattimento;
    global $currentNumRighe;
    global $arrayarma;
    $rigaarma{$currentNumRighe} = new clsUITabellaRiga('tabellariga');
    for($i = 0; $i < 10; $i++){
        $cella{$arrayarma[$i]}{$currentNumRighe} = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"{$arrayarma[$i]}{$currentNumRighe}"]);
        $rigaarma{$currentNumRighe}->addCella($cella{$arrayarma[$i]}{$currentNumRighe});
    } 
    $tabcombattimento->addRiga($rigaarma{$currentNumRighe});
    $currentNumRighe++;
}

function setCorrectArraySkills($idPersonaggio, $index){
    $array = array();
    $array['idPersonaggio'] = $idPersonaggio;
    $array['idAbilita'] = $index;
    switch ($index){
        case 1:
            $array['Val_Abilita'] = $_POST['valforza'];
            $array['Val_Skill1'] = $_POST['valenergia'];
            $array['Val_Skill2'] = $_POST['valmuscoli'];
            break;
        case 2:
            $array['Val_Abilita'] = $_POST['valdes'];
            $array['Val_Skill1'] = $_POST['valmira'];
            $array['Val_Skill2'] = $_POST['valequilibrio'];
            break;
        case 3:
            $array['Val_Abilita'] = $_POST['valcos'];
            $array['Val_Skill1'] = $_POST['valsalute'];
            $array['Val_Skill2'] = $_POST['valformafisica'];
            break;
        case 4:
            $array['Val_Abilita'] = $_POST['valint'];
            $array['Val_Skill1'] = $_POST['valragione'];
            $array['Val_Skill2'] = $_POST['valconoscenza'];
            break;
        case 5:
            $array['Val_Abilita'] = $_POST['valsag'];
            $array['Val_Skill1'] = $_POST['valintuizione'];
            $array['Val_Skill2'] = $_POST['valfdivolonta'];
            break;
        case 6:
            $array['Val_Abilita'] = $_POST['valcar'];
            $array['Val_Skill1'] = $_POST['valcomando'];
            $array['Val_Skill2'] = $_POST['valfascino'];
            break;
        default:
            break;
    }
    return $array;
}

function setCorrectArrayTs($idPersonaggio, $index){
    $array = array();
    $array['idPersonaggio'] = $idPersonaggio;
    $array['idTiroSalvezza'] = $index;
    switch ($index){
        case 1:
            $array['Modificatore'] = $_POST['valmod1'];
            break;
        case 2:
            $array['Modificatore'] = $_POST['valmod2'];
            break;
        case 3:
            $array['Modificatore'] = $_POST['valmod3'];
            break;
        case 4:
            $array['Modificatore'] = $_POST['valmod4'];
            break;
        case 5:
            $array['Modificatore'] = $_POST['valmod5'];
            break;
        default:
            break;
    }
    return $array;
}

function checkCampiObbligatori($arrayTB, $arrayCB){
    for($i = 0; $i < count($arrayTB); $i++){
        if(empty($arrayTB[$i])) return true;
    }

    for($i = 0; $i < count($arrayCB); $i++){
        if($arrayCB[$i] == "nochoice") return true;
    }

    return false;
}

function checkCorrectFormat($regex1, $arr1, $regex2, $arr2, $regex3, $arr3){
    for($i = 0; $i < count($arr1); $i++){
        if(!preg_match($regex1, $arr1[$i])) return true;
    }

    for($i = 0; $i < count($arr2); $i++){
        if(!preg_match($regex2, $arr2[$i])) return true;
    }

    for($i = 0; $i < count($arr3); $i++){
        if(!preg_match($regex3, $arr3[$i])) return true;
    }

    return false;
}
