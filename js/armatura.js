var ArmaturaPredefinita = document.getElementById('predarmor');
if(ArmaturaPredefinita != null) ArmaturaPredefinita.addEventListener('change', ModificaCA);
var ClasseArmatura = document.getElementById('CA');
if(ClasseArmatura != null) ClasseArmatura.addEventListener('change', function(){checkFormato('CA')});
var CASorpreso = document.getElementById('sorpreso');
if(CASorpreso != null) CASorpreso.addEventListener('change', function(){checkFormato('sorpreso')});
var CASenzaScudo = document.getElementById('senzascudo');
if(CASenzaScudo != null) CASenzaScudo.addEventListener('change', function(){checkFormato('senzascudo')});
var CAAlleSpalle = document.getElementById('allespalle');
if(CAAlleSpalle != null) CAAlleSpalle. 	addEventListener('change', function(){checkFormato('allespalle')});
var CAIncantesimi = document.getElementById('caincantesimi');
if(CAIncantesimi != null) CAIncantesimi.addEventListener('change', function(){checkFormato('caincantesimi')});

function ModificaCA(){
	var ArmaturaPredefinita = document.getElementById('predarmor');
	var ClasseArmatura = document.getElementById('CA');
	if(ClasseArmatura.hasAttribute('readonly')) ClasseArmatura.removeAttribute('readonly');
	switch (ArmaturaPredefinita.value){
		case 'nochoice':
			ClasseArmatura.value = 10;
			break;
		case '1':
			ClasseArmatura.value = 10;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '2':
			ClasseArmatura.value = 9;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '3':
			ClasseArmatura.value = 8;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '4':
			ClasseArmatura.value = 7;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '5':
			ClasseArmatura.value = 6;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '6':
			ClasseArmatura.value = 5;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '7':
			ClasseArmatura.value = 4;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '8':
			ClasseArmatura.value = 3;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '9':
			ClasseArmatura.value = 2;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '10':
			ClasseArmatura.value = 1;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		case '11':
			ClasseArmatura.value = 0;
			ClasseArmatura.setAttribute('readonly', 'readonly');
			break;
		default: break;
	}
	checkFormato('CA');
}

var bitArrayArmatura = ["CA", "sorpreso", "senzascudo", "allespalle", "caincantesimi"];

var SfondiGialliArmatura = new clsBitMask(bitArrayArmatura);

function checkFormato(pID){
	var valore = document.getElementById(pID);
	let regex = /^([0-9]|-?[1-9][0-9]?)$/;
	if(regex.test(valore.value)){
		SfondiGialliArmatura.unsetYellow(valore);
	} else {
		SfondiGialliArmatura.setYellow(valore);
	}
}