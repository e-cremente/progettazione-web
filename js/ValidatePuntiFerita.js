var BtnSalvaPuntiFerita = document.getElementById('BtnSalvaPuntiFerita');
if(BtnSalvaPuntiFerita != null) BtnSalvaPuntiFerita.addEventListener('click', ValidatePuntiFerita);
var BtnModificaPuntiFerita = document.getElementById('BtnModificaPuntiFerita');
if(BtnModificaPuntiFerita != null) BtnModificaPuntiFerita.addEventListener('click', ModificaPuntiFeritaUIonModifica);

function ValidatePuntiFerita(){
	var errmsg = document.getElementById('msgerrpuntiferita');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	var PuntiFerita = document.getElementById('valpuntiferita');

	if(PuntiFerita.value == ''){
		var msg = document.createTextNode("Inserisci il valore dei Punti Ferita");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	if(SfondiGialliPuntiFerita.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var Ferite = document.getElementById('valferite');

	var qs = 'ToCall=UpdPuntiFerita';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pPuntiFerita=' + PuntiFerita.value;
	qs += '&pFerite=' + Ferite.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdPuntiFeritaSuccess);
}

function onUpdPuntiFeritaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaPuntiFeritaUIonSave();	
}

function ModificaPuntiFeritaUIonSave(){
	btnModifica = document.getElementById('BtnModificaPuntiFerita');
	btnSalva = document.getElementById('BtnSalvaPuntiFerita');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setPuntiFeritaReadonly();
	}
}

function setPuntiFeritaReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var PuntiFerita = document.getElementById('valpuntiferita');
	var Ferite = document.getElementById('valferite');

    var ArrReadonly = [PuntiFerita, Ferite];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}
}

function ModificaPuntiFeritaUIonModifica(){
	unsetPuntiFeritaReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	var BtnSalvaPuntiFerita = document.getElementById('BtnSalvaPuntiFerita');
	var BtnModificaPuntiFerita = document.getElementById('BtnModificaPuntiFerita');

	BtnSalvaPuntiFerita.removeAttribute('hidden');
	BtnModificaPuntiFerita.setAttribute('hidden', 'hidden');
}

function unsetPuntiFeritaReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var PuntiFerita = document.getElementById('valpuntiferita');
	var Ferite = document.getElementById('valferite');

    var ArrReadonly = [PuntiFerita, Ferite];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}

}