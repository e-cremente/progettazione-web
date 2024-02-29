var BtnSalvaCaratteristiche = document.getElementById('BtnSalvaCaratteristiche');
if(BtnSalvaCaratteristiche != null) BtnSalvaCaratteristiche.addEventListener('click', ValidateCaratteristiche);
var BtnModificaCaratteristiche = document.getElementById('BtnModificaCaratteristiche');
if(BtnModificaCaratteristiche != null) BtnModificaCaratteristiche.addEventListener('click', ModificaCaratteristicheUIonModifica);

function checkCaratteristicheObbligatorie(arrayTB){
	for(var i = 0; i < arrayTB.length; i++){
        if(arrayTB[i].value == '') return false;
    }
    return true;
}

function ValidateCaratteristiche(){
	var errmsg = document.getElementById('msgerrcaratt');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	
	//creo un array con le textbox che devono essere obbligatoriamente riempite
	var forza = document.getElementById("valforza");
    var energia = document.getElementById("valenergia");
    var muscoli = document.getElementById("valmuscoli");
    var destrezza = document.getElementById("valdes");
    var mira = document.getElementById("valmira");
    var equilibrio = document.getElementById("valequilibrio");
    var costituzione = document.getElementById("valcos");
    var salute = document.getElementById("valsalute");
    var formafisica = document.getElementById("valformafisica");
    var intelligenza = document.getElementById("valint");
    var ragione = document.getElementById("valragione");
    var conoscenza = document.getElementById("valconoscenza");
    var saggezza = document.getElementById("valsag");
    var intuizione = document.getElementById("valintuizione");
    var fdivolonta = document.getElementById("valfdivolonta");
    var carisma = document.getElementById("valcar");
    var comando = document.getElementById("valcomando");
    var fascino = document.getElementById("valfascino");
    var obligedArrayTB = [forza, energia, muscoli, destrezza, mira, equilibrio, costituzione, salute, formafisica, intelligenza, ragione, conoscenza,
                          saggezza, intuizione, fdivolonta, carisma, comando, fascino];

    //controllo i campi obbligatori
	if (!checkCaratteristicheObbligatorie(obligedArrayTB)) {
		var msg = document.createTextNode("Riempi tutti i campi segnati con l'asterisco!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	if(SfondiGialli.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	for(var i = 0; i < 6; i++){
		var qs = creaQueryString(i);
		ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdCaratteristicaSuccess);
	}	

}

function onInsUpdCaratteristicaSuccess(pResponseText){
	// la risposta ok è: success=<Messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaCaratteristicheUIonSave();
}

function ModificaCaratteristicheUIonSave(){
	btnModifica = document.getElementById('BtnModificaCaratteristiche');
	btnSalva = document.getElementById('BtnSalvaCaratteristiche');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setCaratteristicheReadonly();
	}
}

function setCaratteristicheReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var forza = document.getElementById("valforza");
    var energia = document.getElementById("valenergia");
    var muscoli = document.getElementById("valmuscoli");
    var destrezza = document.getElementById("valdes");
    var mira = document.getElementById("valmira");
    var equilibrio = document.getElementById("valequilibrio");
    var costituzione = document.getElementById("valcos");
    var salute = document.getElementById("valsalute");
    var formafisica = document.getElementById("valformafisica");
    var intelligenza = document.getElementById("valint");
    var ragione = document.getElementById("valragione");
    var conoscenza = document.getElementById("valconoscenza");
    var saggezza = document.getElementById("valsag");
    var intuizione = document.getElementById("valintuizione");
    var fdivolonta = document.getElementById("valfdivolonta");
    var carisma = document.getElementById("valcar");
    var comando = document.getElementById("valcomando");
    var fascino = document.getElementById("valfascino");
    var ArrReadonly = [forza, energia, muscoli, destrezza, mira, equilibrio, costituzione, salute, formafisica, intelligenza, ragione, conoscenza,
                       saggezza, intuizione, fdivolonta, carisma, comando, fascino];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}
}

function unsetCaratteristicheReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var forza = document.getElementById("valforza");
    var energia = document.getElementById("valenergia");
    var muscoli = document.getElementById("valmuscoli");
    var destrezza = document.getElementById("valdes");
    var mira = document.getElementById("valmira");
    var equilibrio = document.getElementById("valequilibrio");
    var costituzione = document.getElementById("valcos");
    var salute = document.getElementById("valsalute");
    var formafisica = document.getElementById("valformafisica");
    var intelligenza = document.getElementById("valint");
    var ragione = document.getElementById("valragione");
    var conoscenza = document.getElementById("valconoscenza");
    var saggezza = document.getElementById("valsag");
    var intuizione = document.getElementById("valintuizione");
    var fdivolonta = document.getElementById("valfdivolonta");
    var carisma = document.getElementById("valcar");
    var comando = document.getElementById("valcomando");
    var fascino = document.getElementById("valfascino");
    var ArrReadonly = [forza, energia, muscoli, destrezza, mira, equilibrio, costituzione, salute, formafisica, intelligenza, ragione, conoscenza,
                       saggezza, intuizione, fdivolonta, carisma, comando, fascino];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}
}

function ModificaCaratteristicheUIonModifica(){
	unsetCaratteristicheReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	var BtnSalvaCaratteristiche = document.getElementById('BtnSalvaCaratteristiche');
	var BtnModificaCaratteristiche = document.getElementById('BtnModificaCaratteristiche');

	BtnSalvaCaratteristiche.removeAttribute('hidden');
	BtnModificaCaratteristiche.setAttribute('hidden', 'hidden');
}

function creaQueryString(numAbilita){
	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=InsUpdCaratteristica';
	qs += '&idPersonaggio=' + idPersonaggio.value;

	switch (numAbilita){
		case 0:
			var forza = document.getElementById("valforza");
			var forzasec = document.getElementById("secvalforza");
    		var energia = document.getElementById("valenergia");
    		var muscoli = document.getElementById("valmuscoli");
			qs += '&idAbilita=1';
			qs += '&Val_Abilita=' + forza.value + (forzasec.value == '' ? '' : '/'+forzasec.value);
			qs += '&Val_Skill1=' + energia.value;
			qs += '&Val_Skill2=' + muscoli.value;
			break;
		case 1:
			var destrezza = document.getElementById("valdes");
    		var mira = document.getElementById("valmira");
    		var equilibrio = document.getElementById("valequilibrio");
    		qs += '&idAbilita=2';
			qs += '&Val_Abilita=' + destrezza.value;
			qs += '&Val_Skill1=' + mira.value;
			qs += '&Val_Skill2=' + equilibrio.value;
			break;
		case 2:
			var costituzione = document.getElementById("valcos");
    		var salute = document.getElementById("valsalute");
    		var formafisica = document.getElementById("valformafisica");
    		qs += '&idAbilita=3';
			qs += '&Val_Abilita=' + costituzione.value;
			qs += '&Val_Skill1=' + salute.value;
			qs += '&Val_Skill2=' + formafisica.value;
			break;
		case 3:
			var intelligenza = document.getElementById("valint");
    		var ragione = document.getElementById("valragione");
    		var conoscenza = document.getElementById("valconoscenza");
    		qs += '&idAbilita=4';
			qs += '&Val_Abilita=' + intelligenza.value;
			qs += '&Val_Skill1=' + ragione.value;
			qs += '&Val_Skill2=' + conoscenza.value;
			break;
		case 4:
			var saggezza = document.getElementById("valsag");
    		var intuizione = document.getElementById("valintuizione");
    		var fdivolonta = document.getElementById("valfdivolonta");
    		qs += '&idAbilita=5';
			qs += '&Val_Abilita=' + saggezza.value;
			qs += '&Val_Skill1=' + intuizione.value;
			qs += '&Val_Skill2=' + fdivolonta.value;
			break;
		case 5:
			var carisma = document.getElementById("valcar");
    		var comando = document.getElementById("valcomando");
    		var fascino = document.getElementById("valfascino");
    		qs += '&idAbilita=6';
			qs += '&Val_Abilita=' + carisma.value;
			qs += '&Val_Skill1=' + comando.value;
			qs += '&Val_Skill2=' + fascino.value;
			break;
	}

	return qs;
}