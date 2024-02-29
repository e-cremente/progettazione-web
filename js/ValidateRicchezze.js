var BtnSalvaRicchezze = document.getElementById('BtnSalvaRicchezze');
if(BtnSalvaRicchezze != null) BtnSalvaRicchezze.addEventListener('click', ValidateRicchezze);
var BtnModificaRicchezze = document.getElementById('BtnModificaRicchezze');
if(BtnModificaRicchezze != null) BtnModificaRicchezze.addEventListener('click', ModificaRicchezzeUIonModifica);

function ValidateRicchezze(){
	var errmsg = document.getElementById('msgerrricchezze');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(SfondiGialliRicchezze.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var MoneteRame = document.getElementById('valmoneterame');
	var MoneteArgento = document.getElementById('valmoneteargento');
	var MoneteElectrum = document.getElementById('valmoneteelectrum');
	var MoneteOro = document.getElementById('valmoneteoro');
	var MonetePlatino = document.getElementById('valmoneteplatino');

	var ArrayMonete = [isNull(MoneteRame.value, null), isNull(MoneteArgento.value, null), isNull(MoneteElectrum.value, null), isNull(MoneteOro.value, null),
	                   isNull(MonetePlatino.value, null)];

	for(var i = 0; i < ArrayMonete.length; i++){
		var qs = 'ToCall=InsUpdRicchezze';
		qs += '&idPersonaggio=' + idPersonaggio.value;
		qs += '&pIdMoneta=' + (i+1);
		qs += '&pQuantita=' + ArrayMonete[i];

		ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdRicchezzeSuccess);
	}
}

function onInsUpdRicchezzeSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaRicchezzeUIonSave();	
}

function ModificaRicchezzeUIonSave(){
	btnModifica = document.getElementById('BtnModificaRicchezze');
	btnSalva = document.getElementById('BtnSalvaRicchezze');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setRicchezzeReadonly();
	}
}

function setRicchezzeReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var MoneteRame = document.getElementById('valmoneterame');
	var MoneteArgento = document.getElementById('valmoneteargento');
	var MoneteElectrum = document.getElementById('valmoneteelectrum');
	var MoneteOro = document.getElementById('valmoneteoro');
	var MonetePlatino = document.getElementById('valmoneteplatino');

    var ArrReadonly = [MoneteRame, MoneteArgento, MoneteElectrum, MoneteOro, MonetePlatino];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}
}

function ModificaRicchezzeUIonModifica(){
	unsetRicchezzeReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	btnModifica = document.getElementById('BtnModificaRicchezze');
	btnSalva = document.getElementById('BtnSalvaRicchezze');

	btnSalva.removeAttribute('hidden');
	btnModifica.setAttribute('hidden', 'hidden');
}

function unsetRicchezzeReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var MoneteRame = document.getElementById('valmoneterame');
	var MoneteArgento = document.getElementById('valmoneteargento');
	var MoneteElectrum = document.getElementById('valmoneteelectrum');
	var MoneteOro = document.getElementById('valmoneteoro');
	var MonetePlatino = document.getElementById('valmoneteplatino');

    var ArrReadonly = [MoneteRame, MoneteArgento, MoneteElectrum, MoneteOro, MonetePlatino];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}
}