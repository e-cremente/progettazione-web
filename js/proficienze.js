var cbCategoriaProficienze = document.getElementById('cbcategoriaproficienze');
if(cbCategoriaProficienze != null) cbCategoriaProficienze.addEventListener('change', function(){getProficienzeCategoria('cbcategoriaproficienze', 'cbproficienze')});
var btnAggiungiProficienza = document.getElementById('aggiungiproficienzabtn');
if(btnAggiungiProficienza != null) btnAggiungiProficienza.addEventListener('click', function(){aggiungiProficienza('cbproficienze', 'cbcategoriaproficienze', 'msgerrproficienze', gestisciResponseAggiungiProficienza)});

var arrSfondiGialliProficienze = [];

var lvTabProf = document.getElementById('tabproficienze');
if(lvTabProf != null){
	var lvRows = lvTabProf.rows.length;
	for (var i = 0; i < lvRows; i++) {
		var lvBitArrayProficienze = ['valproficienza-'+i];
		var lvSfondiGialliProficienze = new clsBitMask(lvBitArrayProficienze);
		arrSfondiGialliProficienze[i] = lvSfondiGialliProficienze;
	}
}
	

function getProficienzeCategoria(pIdCategoria, pIdCbProficienze){
	let categoria = document.getElementById(pIdCategoria).value;

	var qs = 'ToCall=selectProficienze';
	qs += '&Value=' + categoria;
	qs += '&IdCbProficienze=' + pIdCbProficienze;

	ajaxRequestGet("funcs/AjaxRequestHandler.php", qs, gestisciResponseProficienze);
}

function gestisciResponseProficienze(recSet){
	//la prima riga del result set è fissa, dove il primo valore è 0 e il secondo è l'id del menu a tendina da dove compaiono le proficienze.
	var pIdCbProficienza = recSet[0]['Nome'];	
	var cbProficienza = document.getElementById(pIdCbProficienza);
	for (var i = cbProficienza.length - 1; i >= 1; i--) {
		cbProficienza.remove(i);
	}
	for(var i = 1; i < recSet.length; i++){
		var rec = recSet[i];
		var opt = document.createElement("option");
		opt.value = rec["idProficienza"];
		opt.text = rec["Nome"];
		cbProficienza.appendChild(opt);
	}
}

function aggiungiProficienza(pIdCbProficienza, pIdCbCategoria, pErrore, pSuccessFunction){
	var cbProficienza = document.getElementById(pIdCbProficienza).value;
	var cbCategoria = document.getElementById(pIdCbCategoria).value;
	rimuoviErrore(pErrore);
	if (cbCategoria == 'nochoice' || cbProficienza == 'nochoice'){
		var errmsg = document.getElementById(pErrore);
		var msg = document.createTextNode("Scegli prima la proficienza da aggiungere!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('"+pErrore+"')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
		return false;
	}

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiProficienza&Value=" + cbProficienza, pSuccessFunction);
}

function gestisciResponseAggiungiProficienza(recSet){
	//prendo la tabella delle proficienze
	var table = document.getElementById('tabproficienze');
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
	var idproficienza = creaInputSettato('idproficienza', recSet['idProficienza'], curNumRighe);
	cellaid.appendChild(idproficienza);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomeproficienza = creaInputSettato('proficienza', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomeproficienza);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputSettato('PPproficienza', recSet['CostoPP'], curNumRighe);
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaAbilita = newrow.insertCell(3);
	cellaAbilita.setAttribute('class', 'cellavalore');
	var abilitaproficienza = creaInputSettato('abilitaproficienza', recSet['Abilita'], curNumRighe);
	cellaAbilita.appendChild(abilitaproficienza);
	//creo la quinta cella
	var cellaValore = newrow.insertCell(4);
	cellaValore.setAttribute('class', 'cellavalore');
	var valproficienza = creaInputLibero('valproficienza', curNumRighe);
	var valproficienza = creaInputSettato('valproficienza', recSet['ValoreBase'], curNumRighe);
	valproficienza.setAttribute('onchange', 'checkValProficienza("valproficienza-'+curNumRighe+'")');
	cellaValore.appendChild(valproficienza);
	//creo la sesta cella
	var cellaSalvaModifica = newrow.insertCell(5);
	cellaSalvaModifica.setAttribute('class', 'cellavalore');
	var Modifica = creaBottoneProficienza('modificaproficienza', 'Modifica', 0, curNumRighe);
	var Salva = creaBottoneProficienza('salvaproficienza', 'Salva', 1, curNumRighe);
	cellaSalvaModifica.appendChild(Modifica);
	cellaSalvaModifica.appendChild(Salva);
	//creo la settima cella
	var cellaRimuovi = newrow.insertCell(6);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaProficienza(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var bitArrayProficienze = ['valproficienza-'+curNumRighe];

	var SfondiGialliProficienza = new clsBitMask(bitArrayProficienze);

	arrSfondiGialliProficienze[curNumRighe] = SfondiGialliProficienza;

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsProficienza';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdProficienza=' + recSet['idProficienza'];
	qs += '&pValore=' + recSet['ValoreBase'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsProficienzaSuccess);
}

function creaBottoneProficienza(pId, pLabel, pHidden, pNumRighe){
	var button = document.createElement('button');
	var text = document.createTextNode(pLabel);
	button.appendChild(text);
	button.setAttribute('type', 'button');
	button.setAttribute('id', pId+'-'+pNumRighe);
	button.setAttribute('name', pId+'-'+pNumRighe);
	button.setAttribute('onclick', (pId == 'modificaproficienza' ? 'ModificaRigaProficienzaOnModifica(' : 'ValidateRigaProficienza(')+pNumRighe+')');
	if (pHidden == 1) {
		button.setAttribute('hidden', 'hidden');
	}
	return button;	
}

function rimuoviRigaProficienza(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere questa proficienza?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idProficienza = document.getElementById('idproficienza-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabproficienze');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgProficienza';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdProficienza=' + idProficienza.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}

function ModificaRigaProficienzaOnModifica(pNum){
	var Valore = document.getElementById('valproficienza-'+pNum);
	var BtnModifica = document.getElementById('modificaproficienza-'+pNum);
	var BtnSalva = document.getElementById('salvaproficienza-'+pNum);

	Valore.removeAttribute('readonly');

	BtnModifica.setAttribute('hidden', 'hidden');
	BtnSalva.removeAttribute('hidden');
}

function ValidateRigaProficienza(pNum){
	var errmsg = document.getElementById('msgerrproficienze');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(arrSfondiGialliProficienze[pNum].maschera != 0){
		var msg = document.createTextNode("Riempi correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idProficienza = document.getElementById('idproficienza-'+pNum);
	var Valore = document.getElementById('valproficienza-'+pNum);

	var qs = 'ToCall=UpdPgProficienza';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdProficienza=' + idProficienza.value;
	qs += '&pValore=' + Valore.value;
	qs += '&pNum=' + pNum;
	
	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdPgProficienzaSuccess);
}

function onUpdPgProficienzaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	var pNum = ResTextArray[1];
	ModificaRigaProficienzaOnSave(pNum);	
}

function ModificaRigaProficienzaOnSave(pNum){
	var Valore = document.getElementById('valproficienza-'+pNum);
	var BtnModifica = document.getElementById('modificaproficienza-'+pNum);
	var BtnSalva = document.getElementById('salvaproficienza-'+pNum);

	Valore.setAttribute('readonly', 'readonly');

	BtnModifica.removeAttribute('hidden');
	BtnSalva.setAttribute('hidden', 'hidden');
}

function onChkInsProficienzaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrproficienze');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tabproficienze');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto questa proficienza!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrproficienze')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function checkValProficienza(pId){
	var toCheck = document.getElementById(pId);
	var prex = pId.split('-')[0];
	var numriga = pId.split('-')[1];
	var regex = /^([1-9][0-9]?)?$/;

	if (regex.test(toCheck.value)) arrSfondiGialliProficienze[numriga].unsetYellow(toCheck);
	else arrSfondiGialliProficienze[numriga].setYellow(toCheck);
}
