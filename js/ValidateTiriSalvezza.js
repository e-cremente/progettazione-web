var BtnSalvaTiriSalvezza = document.getElementById('BtnSalvaTiriSalvezza');
if(BtnSalvaTiriSalvezza != null) BtnSalvaTiriSalvezza.addEventListener('click', ValidateTiriSalvezza);
var BtnModificaTiriSalvezza = document.getElementById('BtnModificaTiriSalvezza');
if(BtnModificaTiriSalvezza != null) BtnModificaTiriSalvezza.addEventListener('click', ModificaTiriSalvezzaUIonModifica);

function ValidateTiriSalvezza(){
	var errmsg = document.getElementById('msgerrtirisalv');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(SfondiGialliTS.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var mod1 = document.getElementById("valmod1");
    var mod2 = document.getElementById("valmod2");
    var mod3 = document.getElementById("valmod3");
    var mod4 = document.getElementById("valmod4");
    var mod5 = document.getElementById("valmod5");

	var qs = 'ToCall=InsUpdTiroSalvezza';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdTiroSalvezza0=1';
	qs += '&pModificatore0=' + mod1.value;
	qs += '&pIdTiroSalvezza1=2';
	qs += '&pModificatore1=' + mod2.value;
	qs += '&pIdTiroSalvezza2=3';
	qs += '&pModificatore2=' + mod3.value;
	qs += '&pIdTiroSalvezza3=4';
	qs += '&pModificatore3=' + mod4.value;
	qs += '&pIdTiroSalvezza4=5';
	qs += '&pModificatore4=' + mod5.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdTiroSalvezzaSuccess);

}

function onInsUpdTiroSalvezzaSuccess(pResponseText){
	// la risposta ok è: success=<Messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaTiriSalvezzaUIonSave();
}

function ModificaTiriSalvezzaUIonSave(){
	btnModifica = document.getElementById('BtnModificaTiriSalvezza');
	btnSalva = document.getElementById('BtnSalvaTiriSalvezza');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setTiriSalvezzaReadonly();
	}
}

function setTiriSalvezzaReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var mod1 = document.getElementById("valmod1");
    var mod2 = document.getElementById("valmod2");
    var mod3 = document.getElementById("valmod3");
    var mod4 = document.getElementById("valmod4");
    var mod5 = document.getElementById("valmod5");

    var ArrReadonly = [mod1, mod2, mod3, mod4, mod5];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}
}

function ModificaTiriSalvezzaUIonModifica(){
	unsetTiriSalvezzaReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	var BtnSalvaTiriSalvezza = document.getElementById('BtnSalvaTiriSalvezza');
	var BtnModificaTiriSalvezza = document.getElementById('BtnModificaTiriSalvezza');

	BtnSalvaTiriSalvezza.removeAttribute('hidden');
	BtnModificaTiriSalvezza.setAttribute('hidden', 'hidden');
}

function unsetTiriSalvezzaReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var mod1 = document.getElementById("valmod1");
    var mod2 = document.getElementById("valmod2");
    var mod3 = document.getElementById("valmod3");
    var mod4 = document.getElementById("valmod4");
    var mod5 = document.getElementById("valmod5");
    var ArrReadonly = [mod1, mod2, mod3, mod4, mod5];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}
}