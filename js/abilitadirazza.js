var btnAggiungiAbRazza = document.getElementById('aggiungiabrazzabtn');
if(btnAggiungiAbRazza != null) btnAggiungiAbRazza.addEventListener('click', function(){aggiungiAbRazza('cbabrazza', 'msgerrabrazza', gestisciResponseAggiungiAbRazza)});

function aggiungiAbRazza(pIdCbAbRazza, pErrore, pSuccessFunction){
	var cbAbRazza = document.getElementById(pIdCbAbRazza).value;
	rimuoviErrore(pErrore);
	if (cbAbRazza == 'nochoice'){
		var errmsg = document.getElementById(pErrore);
		var msg = document.createTextNode("Scegli l'abilità da aggiungere!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('"+pErrore+"')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
		return false;
	}

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiAbRazza&Value=" + cbAbRazza, pSuccessFunction);
}

function gestisciResponseAggiungiAbRazza(recSet){
	recSet['Nome'] = recSet['Nome'].replace('&agrave;', 'à');

	//prendo la tabella delle abilità di razza
	var table = document.getElementById('tababilitadirazza');
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
	var idabrazza = creaInputSettato('idabrazza', recSet['idAbilitadirazza'], curNumRighe);
	cellaid.appendChild(idabrazza);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomeabrazza = creaInputSettato('nomeabrazza', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomeabrazza);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputSettato('PPabrazza', recSet['CostoPP'], curNumRighe);
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaRimuovi = newrow.insertCell(3);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaAbRazza(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsAbRazza';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdAbRazza=' + recSet['idAbilitadirazza'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsAbRazzaSuccess);
}

function onChkInsAbRazzaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrabrazza');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tababilitadirazza');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto quest'abilità!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrabrazza')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function rimuoviRigaAbRazza(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere quest'abilità di razza?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idAbRazza = document.getElementById('idabrazza-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tababilitadirazza');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgAbRazza';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdAbRazza=' + idAbRazza.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}