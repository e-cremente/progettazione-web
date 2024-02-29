var BtnSalvaInfoGeneriche = document.getElementById('BtnSalvaInfoGeneriche');
if(BtnSalvaInfoGeneriche != null) BtnSalvaInfoGeneriche.addEventListener('click', ValidateInfoGeneriche);
var BtnModificaInfoGeneriche = document.getElementById('BtnModificaInfoGeneriche');
if(BtnModificaInfoGeneriche != null) BtnModificaInfoGeneriche.addEventListener('click', ModificaInfoGenericheUIonModifica);

function ValidateInfoGeneriche(){
	var errmsg = document.getElementById('msgerrinfogeneriche');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(SfondiGialliInfoGeneriche.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var PPRimanenti = document.getElementById('valPPRimanenti');
	var PuntiMagiaRimanenti = document.getElementById('valpuntimagiarimanenti');
	var PuntiMagiaTotali = document.getElementById('valpuntimagiatotali');
	var VelMovimento = document.getElementById('valvelocitamovimento');

	var qs = 'ToCall=UpdInfoGeneriche';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pPPRimanenti=' + isNull(PPRimanenti.value, null);
	qs += '&pPuntiMagiaRimanenti=' + isNull(PuntiMagiaRimanenti.value, null);
	qs += '&pPuntiMagiaTotali=' + isNull(PuntiMagiaTotali.value, null);
	qs += '&pVelMovimento=' + isNull(VelMovimento.value, null);

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdInfoGenericheSuccess);
}

function onUpdInfoGenericheSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaInfoGenericheUIonSave();	
}

function ModificaInfoGenericheUIonSave(){
	btnModifica = document.getElementById('BtnModificaInfoGeneriche');
	btnSalva = document.getElementById('BtnSalvaInfoGeneriche');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setInfoGenericheReadonly();
	}
}

function setInfoGenericheReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var PPRimanenti = document.getElementById('valPPRimanenti');
	var PuntiMagiaRimanenti = document.getElementById('valpuntimagiarimanenti');
	var PuntiMagiaTotali = document.getElementById('valpuntimagiatotali');
	var VelMovimento = document.getElementById('valvelocitamovimento');

    var ArrReadonly = [PPRimanenti, PuntiMagiaRimanenti, PuntiMagiaTotali, VelMovimento];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}
}

function ModificaInfoGenericheUIonModifica(){
	unsetInfoGenericheReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	btnModifica = document.getElementById('BtnModificaInfoGeneriche');
	btnSalva = document.getElementById('BtnSalvaInfoGeneriche');

	btnSalva.removeAttribute('hidden');
	btnModifica.setAttribute('hidden', 'hidden');
}

function unsetInfoGenericheReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var PPRimanenti = document.getElementById('valPPRimanenti');
	var PuntiMagiaRimanenti = document.getElementById('valpuntimagiarimanenti');
	var PuntiMagiaTotali = document.getElementById('valpuntimagiatotali');
	var VelMovimento = document.getElementById('valvelocitamovimento');

    var ArrReadonly = [PPRimanenti, PuntiMagiaRimanenti, PuntiMagiaTotali, VelMovimento];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}

}