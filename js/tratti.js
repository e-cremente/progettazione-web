var btnAggiungiTratto = document.getElementById('aggiungitrattobtn');
if(btnAggiungiTratto != null) btnAggiungiTratto.addEventListener('click', function(){aggiungiTratto('cbtratti', 'msgerrtratti', gestisciResponseAggiungiTratto)});

function aggiungiTratto(pIdCbTratto, pErrore, pSuccessFunction){
	var cbTratto = document.getElementById(pIdCbTratto).value;
	rimuoviErrore(pErrore);
	if (cbTratto == 'nochoice'){
		var errmsg = document.getElementById(pErrore);
		var msg = document.createTextNode("Scegli il tratto da aggiungere!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('"+pErrore+"')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
		return false;
	}

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiTratto&Value=" + cbTratto, pSuccessFunction);
}

function gestisciResponseAggiungiTratto(recSet){
	recSet['Nome'] = recSet['Nome'].replace('&agrave;', 'à');

	//prendo la tabella delle proficienze
	var table = document.getElementById('tabtratti');
	//controllo quante righe sono già state inserite. questo mi aiuta a mettere sempre id diversi man mano che aggiungo proficienze
	var curNumRighe = table.rows.length;
	//creo la nuova riga
	var newrow = table.insertRow(curNumRighe);
	newrow.setAttribute('class', 'tabellariga');
	newrow.setAttribute('id', 'riganum-'+curNumRighe);
	//creo la prima cella 
	var cellaid = newrow.insertCell(0);
	cellaid.setAttribute('class', 'cellavalore');
	cellaid.setAttribute('hidden', 'hidden');
	var idtratto = creaInputSettato('idtratto', recSet['idTratto'], curNumRighe);
	cellaid.appendChild(idtratto);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nometratto = creaInputSettato('tratto', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nometratto);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputSettato('PPtratto', recSet['CostoPP'], curNumRighe);
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaRimuovi = newrow.insertCell(3);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaTratto(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsTratto';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdTratto=' + recSet['idTratto'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsTrattoSuccess);
}

function onChkInsTrattoSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrtratti');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tabtratti');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto questo tratto!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrtratti')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function rimuoviRigaTratto(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere questo tratto?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idTratto = document.getElementById('idtratto-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabtratti');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgTratto';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdTratto=' + idTratto.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}