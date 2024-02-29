var btnAggiungiAbClasse = document.getElementById('aggiungiabclassebtn');
if(btnAggiungiAbClasse != null) btnAggiungiAbClasse.addEventListener('click', function(){aggiungiAbClasse('cbabclasse', 'msgerrabclasse', gestisciResponseAggiungiAbClasse)});

function aggiungiAbClasse(pIdCbAbClasse, pErrore, pSuccessFunction){
	var cbAbClasse = document.getElementById(pIdCbAbClasse).value;
	rimuoviErrore(pErrore);
	if (cbAbClasse == 'nochoice'){
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

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiAbClasse&Value=" + cbAbClasse, pSuccessFunction);
}

function gestisciResponseAggiungiAbClasse(recSet){
	recSet['Nome'] = recSet['Nome'].replace('&agrave;', 'à');

	//prendo la tabella delle abilità di classe
	var table = document.getElementById('tababilitadiclasse');
	//controllo quante righe sono già state inserite. questo mi aiuta a mettere sempre id diversi man mano che aggiungo abilità di classe
	var curNumRighe = table.rows.length;
	//creo la nuova riga
	var newrow = table.insertRow(curNumRighe);
	newrow.setAttribute('class', 'tabellariga');
	newrow.setAttribute('id', 'riganum-'+curNumRighe);
	//creo la prima cella 
	var cellaid = newrow.insertCell(0);
	cellaid.setAttribute('class', 'cellavalore');
	cellaid.setAttribute('hidden', 'hidden');
	var idabclasse = creaInputSettato('idabclasse', recSet['idAbilitadiclasse'], curNumRighe);
	cellaid.appendChild(idabclasse);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomeabclasse = creaInputSettato('nomeabclasse', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomeabclasse);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputSettato('PPabclasse', recSet['CostoPP'], curNumRighe);
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaRimuovi = newrow.insertCell(3);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaAbClasse(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsAbClasse';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdAbClasse=' + recSet['idAbilitadiclasse'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsAbClasseSuccess);
}

function onChkInsAbClasseSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrabclasse');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tababilitadiclasse');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto quest'abilità!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrabclasse')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function rimuoviRigaAbClasse(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere quest'abilità di classe?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idAbClasse = document.getElementById('idabclasse-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tababilitadiclasse');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgAbClasse';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdAbClasse=' + idAbClasse.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}