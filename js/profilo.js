var BtnModificaProfilo = document.getElementById('btnmodificaprofilo');
if(BtnModificaProfilo != null) BtnModificaProfilo.addEventListener('click', ModificaProfilo);
var BtnSalvaProfilo = document.getElementById('btnsalvaprofilo');
if(BtnSalvaProfilo != null) BtnSalvaProfilo.addEventListener('click', SalvaProfilo);
var BtnAnnulla = document.getElementById('btnannulla');
if(BtnAnnulla != null) BtnAnnulla.addEventListener('click', AnnullaCambiamentiProfilo);
var BtnEliminaProfilo = document.getElementById('btneliminaprofilo');
if(BtnEliminaProfilo != null) BtnEliminaProfilo.addEventListener('click', EliminaProfilo);

var tmp = document.getElementById('profilemail');
if(tmp != null) var email = tmp.value;

function ModificaProfilo(){
	var errmsg = document.getElementById('msgerrprofilo');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	errmsg.setAttribute('class', 'saveerror');

	var BtnModificaProfilo = document.getElementById('btnmodificaprofilo');
	var BtnSalvaProfilo = document.getElementById('btnsalvaprofilo');
	var BtnAnnulla = document.getElementById('btnannulla');
	var DivNuovaPwd = document.getElementById('divnewpwd');
	var DivPwdCorrente = document.getElementById('divcurrentpwd');
	var Username = document.getElementById('profileuser');
	var Email = document.getElementById('profilemail');
	var BtnEliminaProfilo = document.getElementById('btneliminaprofilo');

	BtnEliminaProfilo.setAttribute('hidden', 'hidden');
	BtnModificaProfilo.setAttribute('hidden', 'hidden');
	Username.setAttribute('disabled', 'disabled');
	Email.removeAttribute('readonly');

	var arrRemoveHidden = [BtnSalvaProfilo, DivNuovaPwd, DivPwdCorrente, BtnAnnulla];

	for(var i = 0; i < arrRemoveHidden.length; i++){
		arrRemoveHidden[i].removeAttribute('hidden');
	}
}

function AnnullaCambiamentiProfilo(){
	var errmsg = document.getElementById('msgerrprofilo');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	var BtnModificaProfilo = document.getElementById('btnmodificaprofilo');
	var BtnSalvaProfilo = document.getElementById('btnsalvaprofilo');
	var BtnAnnulla = document.getElementById('btnannulla');
	var DivNuovaPwd = document.getElementById('divnewpwd');
	var NuovaPwd = document.getElementById('newpwd');
	var DivPwdCorrente = document.getElementById('divcurrentpwd');
	var PwdCorrente = document.getElementById('currentpwd');
	var Username = document.getElementById('profileuser');
	var Email = document.getElementById('profilemail');

	BtnModificaProfilo.removeAttribute('hidden');
	BtnEliminaProfilo.removeAttribute('hidden');
	BtnSalvaProfilo.setAttribute('hidden', 'hidden');
	BtnAnnulla.setAttribute('hidden', 'hidden');

	NuovaPwd.value = '';
	DivNuovaPwd.setAttribute('hidden', 'hidden');

	PwdCorrente.value = '';
	DivPwdCorrente.setAttribute('hidden', 'hidden');

	Username.removeAttribute('disabled');

	Email.value = email;
	Email.setAttribute('readonly', 'readonly');
}

function SalvaProfilo(){
	var errmsg = document.getElementById('msgerrprofilo');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	var Pwd = document.getElementById('currentpwd');
	var Email = document.getElementById('profilemail');

	if(Pwd.value == ''){
		var msg = document.createTextNode("Inserisci password attuale");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	if(Email.value == ''){
		var msg = document.createTextNode("Inserisci una mail");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var Username = document.getElementById('profileuser');
	var NewPwd = document.getElementById('newpwd');
	var CurPwd = document.getElementById('currentpwd');

	var qs = 'ToCall=UpdProfilo';
	qs += '&pUser=' + Username.value;
	qs += '&pNewEmail=' + Email.value;
	qs += '&pNewPwd=' + isNull(NewPwd.value, 'null');
	qs += '&pCurPwd=' + CurPwd.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdProfiloSuccess)
}

function onUpdProfiloSuccess(pResponseText) {
	// la risposta ok è: result=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrprofilo');
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "result") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	switch(ResTextArray[1]){
		case 'samepwd':
			var msg = document.createTextNode("Nuova e vecchia password coincidono");
			errmsg.appendChild(msg);
			errmsg.removeAttribute("hidden");
			return false;
			break;
		case 'wrongpwd':
			var msg = document.createTextNode("Password errata");
			errmsg.appendChild(msg);
			errmsg.removeAttribute("hidden");
			return false;
			break;
		case 'badmail':
			var msg = document.createTextNode("Mail non valida");
			errmsg.appendChild(msg);
			errmsg.removeAttribute("hidden");
			return false;
			break;
		case 'true':
			var msg = document.createTextNode("Profilo aggiornato");
			errmsg.setAttribute('class', 'verde');
			errmsg.appendChild(msg);
			errmsg.removeAttribute("hidden");
			break;
	}

	var BtnModificaProfilo = document.getElementById('btnmodificaprofilo');
	var BtnSalvaProfilo = document.getElementById('btnsalvaprofilo');
	var BtnAnnulla = document.getElementById('btnannulla');
	var DivNuovaPwd = document.getElementById('divnewpwd');
	var NuovaPwd = document.getElementById('newpwd');
	var DivPwdCorrente = document.getElementById('divcurrentpwd');
	var PwdCorrente = document.getElementById('currentpwd');
	var Username = document.getElementById('profileuser');
	var Email = document.getElementById('profilemail');

	BtnModificaProfilo.removeAttribute('hidden');
	BtnEliminaProfilo.removeAttribute('hidden');
	BtnSalvaProfilo.setAttribute('hidden', 'hidden');
	BtnAnnulla.setAttribute('hidden', 'hidden');

	NuovaPwd.value = '';
	DivNuovaPwd.setAttribute('hidden', 'hidden');
	PwdCorrente.value = '';
	DivPwdCorrente.setAttribute('hidden', 'hidden');
	Username.setAttribute('readonly', 'readonly');
	Email.setAttribute('readonly', 'readonly');

}

function EliminaProfilo(){
	if(!confirm('ATTENZIONE: Sei sicuro di voler eliminare il tuo profilo? L\'azione è irreversibile, e tutti i tuoi personaggi (se ne hai creati) saranno cancellati con esso.')){
		return false;
	}

	var Username = document.getElementById('profileuser');

	var qs = 'ToCall=DelProfilo';
	qs += '&pUser=' + Username.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onDelProfiloSuccess)
}

function onDelProfiloSuccess(pResponseText) {
	// la risposta ok è: result=<messaggio>
	alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "result") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == 'true'){
		location.replace('index.php');
		alert('Il tuo profilo è stato cancellato.');
	}
}
