var btnAggiungiSvantaggio = document.getElementById('aggiungisvantaggiobtn');
if(btnAggiungiSvantaggio != null) btnAggiungiSvantaggio.addEventListener('click', function(){aggiungiSvantaggio('cbsvantaggi', 'msgerrsvantaggi', gestisciResponseAggiungiSvantaggio)});

function aggiungiSvantaggio(pIdCbSvantaggio, pErrore, pSuccessFunction){
	var cbSvantaggio = document.getElementById(pIdCbSvantaggio).value;
	rimuoviErrore(pErrore);
	if (cbSvantaggio == 'nochoice'){
		var errmsg = document.getElementById(pErrore);
		var msg = document.createTextNode("Scegli lo svantaggio da aggiungere!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('"+pErrore+"')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
		return false;
	}

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiSvantaggio&Value=" + cbSvantaggio, pSuccessFunction);
}

function gestisciResponseAggiungiSvantaggio(recSet){
	recSet['Nome'] = recSet['Nome'].replace('&agrave;', 'à');
	if (recSet['PPGrave'] == null) recSet['PPGrave'] = '-';

	//prendo la tabella degli svantaggi
	var table = document.getElementById('tabsvantaggi');
	//controllo quante righe sono già state inserite. questo mi aiuta a mettere sempre id diversi man mano che aggiungo svantaggi
	var curNumRighe = table.rows.length;
	//creo la nuova riga
	var newrow = table.insertRow(curNumRighe);
	newrow.setAttribute('class', 'tabellariga');
	newrow.setAttribute('id', 'riganum-'+curNumRighe);
	//creo la prima cella 
	var cellaid = newrow.insertCell(0);
	cellaid.setAttribute('class', 'cellavalore');
	cellaid.setAttribute('hidden', 'hidden');
	var idsvantaggio = creaInputSettato('idsvantaggio', recSet['idSvantaggio'], curNumRighe);
	cellaid.appendChild(idsvantaggio);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomesvantaggio = creaInputSettato('svantaggio', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomesvantaggio);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputSettato('PPsvantaggio', recSet['PPModerato'], curNumRighe);
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaPPgrave = newrow.insertCell(3);
	cellaPPgrave.setAttribute('class', 'cellavalore');
	var PPgrave = creaInputSettato('PPgrave', recSet['PPGrave'], curNumRighe);
	cellaPPgrave.appendChild(PPgrave);
	//creo la quinta cella
	var cellaGrave = newrow.insertCell(4);
	cellaGrave.setAttribute('class', 'cellavalore');
	var grave = creaCheckBox('grave', 'checkgroupsv', curNumRighe);
	cellaGrave.appendChild(grave);
	//creo la sesta cella
	var cellaSalvaModifica = newrow.insertCell(5);
	cellaSalvaModifica.setAttribute('class', 'cellavalore');
	var Modifica = creaBottoneSvantaggio('modificasvantaggio', 'Modifica', 0, curNumRighe);
	var Salva = creaBottoneSvantaggio('salvasvantaggio', 'Salva', 1, curNumRighe);
	cellaSalvaModifica.appendChild(Modifica);
	cellaSalvaModifica.appendChild(Salva);
	//creo la settima cella
	var cellaRimuovi = newrow.insertCell(6);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaSvantaggio(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsSvantaggio';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdSvantaggio=' + recSet['idSvantaggio'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsSvantaggioSuccess);
}

function onChkInsSvantaggioSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrsvantaggi');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tabsvantaggi');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto questo svantaggio!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrsvantaggi')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function creaBottoneSvantaggio(pId, pLabel, pHidden, pNumRighe){
	var button = document.createElement('button');
	var text = document.createTextNode(pLabel);
	button.appendChild(text);
	button.setAttribute('type', 'button');
	button.setAttribute('id', pId+'-'+pNumRighe);
	button.setAttribute('name', pId+'-'+pNumRighe);
	button.setAttribute('onclick', (pId == 'modificasvantaggio' ? 'ModificaRigaSvantaggioOnModifica(' : 'ValidateRigaSvantaggio(')+pNumRighe+')');
	if (pHidden == 1) {
		button.setAttribute('hidden', 'hidden');
	}
	return button;	
}

function ModificaRigaSvantaggioOnModifica(pNum){
	var Grave = document.getElementById('grave-'+pNum);
	var BtnModifica = document.getElementById('modificasvantaggio-'+pNum);
	var BtnSalva = document.getElementById('salvasvantaggio-'+pNum);

	Grave.removeAttribute('disabled');

	BtnModifica.setAttribute('hidden', 'hidden');
	BtnSalva.removeAttribute('hidden');
}

function ValidateRigaSvantaggio(pNum){

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idSvantaggio = document.getElementById('idsvantaggio-'+pNum);
	var Grave = document.getElementById('grave-'+pNum);

	var qs = 'ToCall=UpdPgSvantaggio';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdSvantaggio=' + idSvantaggio.value;
	qs += '&pGrave=' + (Grave.checked ? 1 : 0);
	qs += '&pNum=' + pNum;
	
	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdPgSvantaggioSuccess);
}

function onUpdPgSvantaggioSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	var pNum = ResTextArray[1];
	ModificaRigaSvantaggioOnSave(pNum);	
}

function ModificaRigaSvantaggioOnSave(pNum){
	var Grave = document.getElementById('grave-'+pNum);
	var BtnModifica = document.getElementById('modificasvantaggio-'+pNum);
	var BtnSalva = document.getElementById('salvasvantaggio-'+pNum);

	Grave.setAttribute('disabled', 'disabled');

	BtnModifica.removeAttribute('hidden');
	BtnSalva.setAttribute('hidden', 'hidden');
}

function rimuoviRigaSvantaggio(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere questo svantaggio?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idSvantaggio = document.getElementById('idsvantaggio-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabsvantaggi');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgSvantaggio';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdSvantaggio=' + idSvantaggio.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}