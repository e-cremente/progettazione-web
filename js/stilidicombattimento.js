var btnAggiungiStileComb = document.getElementById('aggiungistilecombbtn');
if(btnAggiungiStileComb != null) btnAggiungiStileComb.addEventListener('click', function(){aggiungiStileComb('cbstilicomb', 'msgerrstilicomb', gestisciResponseAggiungiStileComb)});

var arrSfondiGialliStiliComb = [];

var lvTabStileComb = document.getElementById('tabstilicombattimento');
if(lvTabStileComb != null){
	var lvRows = lvTabStileComb.rows.length;
	for (var i = 0; i < lvRows; i++) {
	    var lvBitArrayStiliComb = ['PPstilecomb-'+i];
	    var lvSfondiGialliStiliComb = new clsBitMask(lvBitArrayStiliComb);
	    arrSfondiGialliStiliComb[i] = lvSfondiGialliStiliComb;
	}
}
	
function aggiungiStileComb(pIdCbStileComb, pErrore, pSuccessFunction){
	var cbStileComb = document.getElementById(pIdCbStileComb).value;
	rimuoviErrore(pErrore);
	if (cbStileComb == 'nochoice'){
		var errmsg = document.getElementById(pErrore);
		var msg = document.createTextNode("Scegli lo stile da aggiungere!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('"+pErrore+"')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
		return false;
	}

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiStileComb&Value=" + cbStileComb, pSuccessFunction);
}

function gestisciResponseAggiungiStileComb(recSet){
	//alert(recSet);
	recSet['Nome'] = recSet['Nome'].replace('&agrave;', 'à');

	//prendo la tabella degli stili di combattimento
	var table = document.getElementById('tabstilicombattimento');
	//controllo quante righe sono già state inserite. questo mi aiuta a mettere sempre id diversi man mano che aggiungo stili
	var curNumRighe = table.rows.length;
	//creo la nuova riga
	var newrow = table.insertRow(curNumRighe);
	newrow.setAttribute('class', 'tabellariga');
	newrow.setAttribute('id', 'riganum-'+curNumRighe);
	//creo la prima cella 
	var cellaid = newrow.insertCell(0);
	cellaid.setAttribute('class', 'cellavalore');
	cellaid.setAttribute('hidden', 'hidden');
	var idstilecomb = creaInputSettato('idstilecomb', recSet['idStile'], curNumRighe);
	cellaid.appendChild(idstilecomb);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomestilecomb = creaInputSettato('stilecomb', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomestilecomb);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputLibero('PPstilecomb', curNumRighe);
	PP.setAttribute('onchange', 'checkValStileComb("PPstilecomb-'+curNumRighe+'")');
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaSpec = newrow.insertCell(3);
	cellaSpec.setAttribute('class', 'cellavalore');
	var specializzato = creaCheckBox('specializzatostilecomb', 'checkgroupstilecomb', curNumRighe);
	cellaSpec.appendChild(specializzato);
	//creo la quinta cella
	var cellaEffetto = newrow.insertCell(4);
	cellaEffetto.setAttribute('class', 'cellavalore');
	var effetto = creaInputSettato('effettostilecomb', recSet['Effetto'], curNumRighe);
	cellaEffetto.appendChild(effetto);
	//creo la sesta cella
	var cellaSalvaModifica = newrow.insertCell(5);
	cellaSalvaModifica.setAttribute('class', 'cellavalore');
	var Modifica = creaBottoneStileComb('modificastilecomb', 'Modifica', 0, curNumRighe);
	var Salva = creaBottoneStileComb('salvastilecomb', 'Salva', 1, curNumRighe);
	cellaSalvaModifica.appendChild(Modifica);
	cellaSalvaModifica.appendChild(Salva);
	//creo la settima cella
	var cellaRimuovi = newrow.insertCell(6);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaStileComb(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsStileComb';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdStile=' + recSet['idStile'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsStileCombSuccess);
}

function onChkInsStileCombSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrstilicomb');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tabstilicombattimento');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto questo stile!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrstilicomb')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function ValidateRigaStileComb(pNum){
	var errmsg = document.getElementById('msgerrstilicomb');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(arrSfondiGialliStiliComb[pNum].maschera != 0){
		var msg = document.createTextNode("Riempi correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idStile = document.getElementById('idstilecomb-'+pNum);
	var PP = document.getElementById('PPstilecomb-'+pNum);
	var Spec = document.getElementById('specializzatostilecomb-'+pNum);

	var qs = 'ToCall=UpdPgStileComb';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdStile=' + idStile.value;
	qs += '&pPP=' + isNull(PP.value, null);
	qs += '&pSpec=' + (Spec.checked ? 1 : 0);
	qs += '&pNum=' + pNum;
	
	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdStileCombSuccess);
}

function onUpdStileCombSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	var pNum = ResTextArray[1];
	ModificaRigaStileCombOnSave(pNum);	
}

function ModificaRigaStileCombOnSave(pNum){
	var Spec = document.getElementById('specializzatostilecomb-'+pNum);

	var PP = document.getElementById('PPstilecomb-'+pNum);

	var BtnModifica = document.getElementById('modificastilecomb-'+pNum);
	var BtnSalva = document.getElementById('salvastilecomb-'+pNum);

	PP.setAttribute('readonly', 'readonly');

	Spec.setAttribute('disabled', 'disabled');

	BtnModifica.removeAttribute('hidden');
	BtnSalva.setAttribute('hidden', 'hidden');
}

function creaBottoneStileComb(pId, pLabel, pHidden, pNumRighe){
	var button = document.createElement('button');
	var text = document.createTextNode(pLabel);
	button.appendChild(text);
	button.setAttribute('type', 'button');
	button.setAttribute('id', pId+'-'+pNumRighe);
	button.setAttribute('name', pId+'-'+pNumRighe);
	button.setAttribute('onclick', (pId == 'modificastilecomb' ? 'ModificaRigaStileCombOnModifica(' : 'ValidateRigaStileComb(')+pNumRighe+')');
	if (pHidden == 1) {
		button.setAttribute('hidden', 'hidden');
	}
	return button;	
}

function ModificaRigaStileCombOnModifica(pNum){
	var Spec = document.getElementById('specializzatostilecomb-'+pNum);

	var PP = document.getElementById('PPstilecomb-'+pNum);

	var BtnModifica = document.getElementById('modificastilecomb-'+pNum);
	var BtnSalva = document.getElementById('salvastilecomb-'+pNum);

	PP.removeAttribute('readonly');

	Spec.removeAttribute('disabled');

	BtnModifica.setAttribute('hidden', 'hidden');
	BtnSalva.removeAttribute('hidden');
}

function checkValStileComb(pId){
	var toCheck = document.getElementById(pId);
	var prex = pId.split('-')[0];
	var numriga = pId.split('-')[1];
	var regex = /^([1-9][0-9]?)?$/;

	if (regex.test(toCheck.value) || toCheck.value == '') arrSfondiGialliStiliComb[numriga].unsetYellow(toCheck);
	else arrSfondiGialliStiliComb[numriga].setYellow(toCheck);
}

function rimuoviRigaStileComb(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere questo stile?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idStile = document.getElementById('idstilecomb-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabstilicombattimento');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgStileComb';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdStile=' + idStile.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}