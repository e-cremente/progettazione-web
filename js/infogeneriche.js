var PPRimanenti = document.getElementById('valPPRimanenti');
if(PPRimanenti != null) PPRimanenti.addEventListener('change', function(){checkInfoGeneriche('valPPRimanenti')});
var PuntiMagiaRimanenti = document.getElementById('valpuntimagiarimanenti');
if(PuntiMagiaRimanenti != null) PuntiMagiaRimanenti.addEventListener('change', function(){checkInfoGeneriche('valpuntimagiarimanenti')});
var PuntiMagiaTotali = document.getElementById('valpuntimagiatotali');
if(PuntiMagiaTotali != null) PuntiMagiaTotali.addEventListener('change', function(){checkInfoGeneriche('valpuntimagiatotali')});
var VelMovimento = document.getElementById('valvelocitamovimento');
if(VelMovimento != null) VelMovimento.addEventListener('change', function(){checkInfoGeneriche('valvelocitamovimento')});

var bitArrayInfoGeneriche = ["valPPRimanenti", "valpuntimagiarimanenti", "valpuntimagiatotali", "valvelocitamovimento"];

var SfondiGialliInfoGeneriche = new clsBitMask(bitArrayInfoGeneriche);

function checkInfoGeneriche(pId){
	var obj = document.getElementById(pId);

	let regex = /^[1-9][0-9]?[0-9]?$/;
	if(regex.test(obj.value) || obj.value == ''){
		SfondiGialliInfoGeneriche.unsetYellow(obj);
	} else {
		SfondiGialliInfoGeneriche.setYellow(obj);
	}

	checkPuntiMagia();
}

function checkPuntiMagia(){
	var rimanenti = document.getElementById('valpuntimagiarimanenti');
	var totali = document.getElementById('valpuntimagiatotali');

	if (totali.value == '' && rimanenti.value == ''){
		SfondiGialliInfoGeneriche.unsetYellow(totali);
		SfondiGialliInfoGeneriche.unsetYellow(rimanenti);
	} else if (totali.value != '' && rimanenti.value == ''){
		SfondiGialliInfoGeneriche.setYellow(rimanenti);
	} else if(rimanenti.value != '' && totali.value == ''){
		SfondiGialliInfoGeneriche.setYellow(totali);
	} else if (Number(totali.value) < Number(rimanenti.value)){
		SfondiGialliInfoGeneriche.setYellow(totali);
		SfondiGialliInfoGeneriche.setYellow(rimanenti);
	} else if (Number(totali.value) >= Number(rimanenti.value)){
		SfondiGialliInfoGeneriche.unsetYellow(totali);
		SfondiGialliInfoGeneriche.unsetYellow(rimanenti);
	} 
	
}