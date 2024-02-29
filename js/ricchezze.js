var MoneteRame = document.getElementById('valmoneterame');
if(MoneteRame != null) MoneteRame.addEventListener('change', function(){checkRicchezze('valmoneterame')});
var MoneteArgento = document.getElementById('valmoneteargento');
if(MoneteArgento != null) MoneteArgento.addEventListener('change', function(){checkRicchezze('valmoneteargento')});
var MoneteElectrum = document.getElementById('valmoneteelectrum');
if(MoneteElectrum != null) MoneteElectrum.addEventListener('change', function(){checkRicchezze('valmoneteelectrum')});
var MoneteOro = document.getElementById('valmoneteoro');
if(MoneteOro != null) MoneteOro.addEventListener('change', function(){checkRicchezze('valmoneteoro')});
var MonetePlatino = document.getElementById('valmoneteplatino');
if(MonetePlatino != null) MonetePlatino.addEventListener('change', function(){checkRicchezze('valmoneteplatino')});

var bitArrayRicchezze = ["valmoneterame", "valmoneteargento", "valmoneteelectrum", "valmoneteoro", "valmoneteplatino"];

var SfondiGialliRicchezze = new clsBitMask(bitArrayRicchezze);

function checkRicchezze(pId){
	var obj = document.getElementById(pId);

	let regex = /^[1-9][0-9]?[0-9]?[0-9]?$/;
	if(regex.test(obj.value) || obj.value == ''){
		SfondiGialliRicchezze.unsetYellow(obj);
	} else {
		SfondiGialliRicchezze.setYellow(obj);
	}

	if (SfondiGialliRicchezze.maschera == 0){
		checkTotaleRicchezze();
	}
}

function checkTotaleRicchezze(){
	var MoneteRame = document.getElementById('valmoneterame');
	var MoneteArgento = document.getElementById('valmoneteargento');
	var MoneteElectrum = document.getElementById('valmoneteelectrum');
	var MoneteOro = document.getElementById('valmoneteoro');
	var MonetePlatino = document.getElementById('valmoneteplatino');
	var Totale = document.getElementById('valtotalericchezze');

	var Rame = (MoneteRame.value == '' ? 0 : Number(MoneteRame.value));
	var Argento = (MoneteArgento.value == '' ? 0 : Number(MoneteArgento.value));
	var Electrum = (MoneteElectrum.value == '' ? 0 : Number(MoneteElectrum.value));
	var Oro = (MoneteOro.value == '' ? 0 : Number(MoneteOro.value));
	var Platino = (MonetePlatino.value == '' ? 0 : Number(MonetePlatino.value));

	Totale.value = Rame/100 + Argento/10 + Electrum/2 + Oro + Platino*5;
}