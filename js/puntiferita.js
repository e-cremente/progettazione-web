var PuntiFerita = document.getElementById('valpuntiferita');
if(PuntiFerita != null) PuntiFerita.addEventListener('change', checkPuntiFerita);
var Ferite = document.getElementById('valferite');
if(Ferite != null) Ferite.addEventListener('change', checkFerite);

var bitArrayPuntiFerita = ["valpuntiferita", "valferite"];

var SfondiGialliPuntiFerita = new clsBitMask(bitArrayPuntiFerita);

function checkPuntiFerita(){
	var PuntiFerita = document.getElementById('valpuntiferita');
	let regex = /^[1-9][0-9]?[0-9]?$/;
	if(regex.test(PuntiFerita.value)){
		SfondiGialliPuntiFerita.unsetYellow(PuntiFerita);
	} else {
		SfondiGialliPuntiFerita.setYellow(PuntiFerita);
	}
	checkFerite();
}

function checkFerite(){
	var Ferite = document.getElementById('valferite');
	var PuntiFerita = document.getElementById('valpuntiferita');
	Ferite.value = isNull(Ferite.value, 0);
	PuntiFerita.value = isNull(PuntiFerita.value, 0);
	let regex = /^(0|[1-9][0-9]?[0-9]?[0-9]?)$/;
	if((Ferite.value >= 0 && Ferite.value <= (Number(PuntiFerita.value) + 10)) && regex.test(Ferite.value)){
		SfondiGialliPuntiFerita.unsetYellow(Ferite);
	} else {
		SfondiGialliPuntiFerita.setYellow(Ferite);
	}
	if(SfondiGialliPuntiFerita.maschera == 0) ModificaRimanenti(1);
	else ModificaRimanenti(0);
}

function ModificaRimanenti(pBool){
	var Ferite = document.getElementById('valferite');
	var PuntiFerita = document.getElementById('valpuntiferita');
	var Rimanenti = document.getElementById('valrimanenti');
	if(pBool == 0){
		Rimanenti.value = '-';
	}
	else if (pBool == 1){
		Rimanenti.value = Number(PuntiFerita.value) - Number(Ferite.value);
	}
}