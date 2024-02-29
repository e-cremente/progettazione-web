var BtnSalvaArmatura = document.getElementById('BtnSalvaArmatura');
if(BtnSalvaArmatura != null) BtnSalvaArmatura.addEventListener('click', ValidateArmatura);
var BtnModificaArmatura = document.getElementById('BtnModificaArmatura');
if(BtnModificaArmatura != null) BtnModificaArmatura.addEventListener('click', ModificaArmaturaUIonModifica);

function ValidateArmatura(){
	var errmsg = document.getElementById('msgerrarmatura');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	var ClasseArmatura = document.getElementById('CA');

	//la classe armatura è l'unico campo in questo caso che deve obbligatoriamente essere riempito
	if(ClasseArmatura.value == ''){
		var msg = document.createTextNode("Inserisci il valore della Classe Armatura generale");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	if(SfondiGialliArmatura.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idArmatura = (document.getElementById('predarmor').value == 'nochoice' ? 12 : document.getElementById('predarmor').value);
	var Sorpreso = document.getElementById('sorpreso');
	var SenzaScudo = document.getElementById('senzascudo');
	var AlleSpalle = document.getElementById('allespalle');
	var Incantesimi = document.getElementById('caincantesimi');
	var Difese = document.getElementById('difese');

	var qs = 'ToCall=InsUpdArmatura';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArmatura=' + idArmatura;
	qs += '&pCA=' + ClasseArmatura.value;
	qs += '&pSorpreso=' + isNull(Sorpreso.value, 'null');
	qs += '&pSenzaScudo=' + isNull(SenzaScudo.value, 'null');
	qs += '&pAlleSpalle=' + isNull(AlleSpalle.value, 'null');
	qs += '&pIncantesimi=' + isNull(Incantesimi.value, 'null');
	qs += '&pDifese=' + isNull(Difese.value, 'null');

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdArmaturaSuccess);
}

function onInsUpdArmaturaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaArmaturaUIonSave();	
}

function ModificaArmaturaUIonSave(){
	btnModifica = document.getElementById('BtnModificaArmatura');
	btnSalva = document.getElementById('BtnSalvaArmatura');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setArmaturaReadonly();
	}
}

function setArmaturaReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var ClasseArmatura = document.getElementById('CA');
	var idPersonaggio = document.getElementById('idPersonaggio');
	var Sorpreso = document.getElementById('sorpreso');
	var SenzaScudo = document.getElementById('senzascudo');
	var AlleSpalle = document.getElementById('allespalle');
	var Incantesimi = document.getElementById('caincantesimi');
	var Difese = document.getElementById('difese');
    var ArrReadonly = [ClasseArmatura, idPersonaggio, Sorpreso, SenzaScudo, AlleSpalle, Incantesimi, Difese];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}

	var ArmaturaPredefinita = document.getElementById('predarmor');
	ArmaturaPredefinita.setAttribute('disabled', 'disabled');
	ArmaturaPredefinita.setAttribute('class', 'black');
}

function ModificaArmaturaUIonModifica(){
	unsetArmaturaReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	var BtnSalvaArmatura = document.getElementById('BtnSalvaArmatura');
	var BtnModificaArmatura = document.getElementById('BtnModificaArmatura');

	BtnSalvaArmatura.removeAttribute('hidden');
	BtnModificaArmatura.setAttribute('hidden', 'hidden');
}

function unsetArmaturaReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var ClasseArmatura = document.getElementById('CA');
	var idPersonaggio = document.getElementById('idPersonaggio');
	var Sorpreso = document.getElementById('sorpreso');
	var SenzaScudo = document.getElementById('senzascudo');
	var AlleSpalle = document.getElementById('allespalle');
	var Incantesimi = document.getElementById('caincantesimi');
	var Difese = document.getElementById('difese');
    var ArrReadonly = [ClasseArmatura, idPersonaggio, Sorpreso, SenzaScudo, AlleSpalle, Incantesimi, Difese];

    for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}

	var ArmaturaPredefinita = document.getElementById('predarmor');
	ArmaturaPredefinita.removeAttribute('disabled');
}