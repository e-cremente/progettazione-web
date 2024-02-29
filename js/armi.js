var cbCategoria = document.getElementById('cbcategoria');
if(cbCategoria != null) cbCategoria.addEventListener('change', function(){getArmiCategoria('cbcategoria', 'cbarma')});
var btnAggiungi = document.getElementById('aggiungiarmabtn');
if(btnAggiungi != null) btnAggiungi.addEventListener('click', function(){aggiungiArma('cbarma', 'cbcategoria', 'msgerrarmi', gestisciResponseAggiungiArma)});

function getArmiCategoria(pIdCategoria, pIdArma){
	let categoria = document.getElementById(pIdCategoria).value;

	var qs = 'ToCall=getArmiCategoria';
	qs += '&Value=' + categoria;
	qs += '&IdCbArma=' + pIdArma;

	ajaxRequestGet("funcs/AjaxRequestHandler.php", qs, gestisciResponseArmi);
}

function gestisciResponseArmi(recSet){
	//la prima riga del result set è fissa, dove il primo valore è 0 e il secondo è l'id del menu a tendina da dove compaiono le armi.
	var IdCbArma = recSet[0]['Nome'];	
	var cbArma = document.getElementById(IdCbArma);
	for (var i = cbArma.length - 1; i >= 1; i--) {
		cbArma.remove(i);
	}
	for(var i = 1; i < recSet.length; i++){
		var rec = recSet[i];
		var opt = document.createElement("option");
		opt.value = rec["idArma"];
		opt.text = rec["Nome"];
		cbArma.appendChild(opt);
	}
}

function aggiungiArma(pIdCbArma, pIdCbCategoria, pErrore, pSuccessFunction){
	var cbArma = document.getElementById(pIdCbArma).value;
	var cbCategoria = document.getElementById(pIdCbCategoria).value;
	rimuoviErrore(pErrore);
	if (cbCategoria == 'nochoice' || cbArma == 'nochoice'){
		var errmsg = document.getElementById(pErrore);
		var msg = document.createTextNode("Scegli prima l'arma da aggiungere!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('"+pErrore+"')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
		return false;
	}

	ajaxRequestGet("funcs/AjaxRequestHandler.php", "ToCall=aggiungiArma&Value=" + cbArma, pSuccessFunction);
}

function creaInputSettato(pId, pValue, pNumRighe){
	var input = document.createElement('input');
	input.setAttribute('type', 'text');
	input.setAttribute('id', pId+'-'+pNumRighe);
	input.setAttribute('name', pId+'-'+pNumRighe);
	input.setAttribute('readonly', 'readonly');
	input.setAttribute('value', pValue);
	return input;
}

function creaInputLibero(pId, pNumRighe){
	var input = document.createElement('input');
	input.setAttribute('type', 'text');
	input.setAttribute('id', pId+'-'+pNumRighe);
	input.setAttribute('name', pId+'-'+pNumRighe);
	input.setAttribute('readonly', 'readonly');
	return input;
}

function creaBottone(pId, pHidden, pNumRighe){
	var button = document.createElement('button');
	var text = document.createTextNode(pId);
	button.appendChild(text);
	button.setAttribute('type', 'button');
	button.setAttribute('id', pId+'-'+pNumRighe);
	button.setAttribute('name', pId+'-'+pNumRighe);
	button.setAttribute('onclick', (pId == 'Modifica' ? 'ModificaRigaOnModifica(' : 'ValidateRiga(')+pNumRighe+')');
	if (pHidden == 1) {
		button.setAttribute('hidden', 'hidden');
	}
	return button;	
}

function ModificaRigaOnModifica(pNum){
	var AtkRound = document.getElementById('at-'+pNum);
	var ModAtkDanno = document.getElementById('modad-'+pNum);
	var Thaco = document.getElementById('thaco-'+pNum);
	var Raggio = document.getElementById('raggio-'+pNum);
	var BtnModifica = document.getElementById('Modifica-'+pNum);
	var BtnSalva = document.getElementById('Salva-'+pNum);

	var arrReadOnly = [AtkRound, ModAtkDanno, Thaco, Raggio];

	for(var i = 0; i < arrReadOnly.length; i++){
		arrReadOnly[i].removeAttribute('readonly');
	}

	BtnModifica.setAttribute('hidden', 'hidden');
	BtnSalva.removeAttribute('hidden');
}

var arrSfondiGialliArmi = [];

var lvTabComb = document.getElementById('tabcombattimento');
if(lvTabComb != null){
	var lvRows = lvTabComb.rows.length;
	for (var i = 0; i < lvRows; i++) {
	    var lvBitArrayArmi = ['at-'+i, 'modad-'+i, 'thaco-'+i, 'raggio-'+i];
	    var lvSfondiGialliArma = new clsBitMask(lvBitArrayArmi);
	    arrSfondiGialliArmi[i] = lvSfondiGialliArma;
	}
}


function ValidateRiga(pNum){
	var errmsg = document.getElementById('msgerrarmi');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(arrSfondiGialliArmi[pNum].maschera != 0){
		var msg = document.createTextNode("Riempi correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idArma = document.getElementById('id-'+pNum);
	var AtkRound = document.getElementById('at-'+pNum);
	var ModAtkDanno = document.getElementById('modad-'+pNum);
	var Thaco = document.getElementById('thaco-'+pNum);
	var Raggio = document.getElementById('raggio-'+pNum);

	var qs = 'ToCall=UpdPgArma';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArma=' + idArma.value;
	qs += '&pAtkRound=' + isNull(AtkRound.value, 'null');
	qs += '&pModAtkDanno=' + isNull(ModAtkDanno.value, 'null');
	qs += '&pThaco=' + isNull(Thaco.value, 'null');
	qs += '&pRaggio=' + isNull(Raggio.value, 'null');
	qs += '&pNum=' + pNum;
	
	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdPgArmaSuccess);
}

function onUpdPgArmaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	var pNum = ResTextArray[1];
	ModificaRigaOnSave(pNum);	
}

function ModificaRigaOnSave(pNum){
	var AtkRound = document.getElementById('at-'+pNum);
	var ModAtkDanno = document.getElementById('modad-'+pNum);
	var Thaco = document.getElementById('thaco-'+pNum);
	var Raggio = document.getElementById('raggio-'+pNum);
	var BtnModifica = document.getElementById('Modifica-'+pNum);
	var BtnSalva = document.getElementById('Salva-'+pNum);

	var arrReadOnly = [AtkRound, ModAtkDanno, Thaco, Raggio];

	for(var i = 0; i < arrReadOnly.length; i++){
		arrReadOnly[i].setAttribute('readonly', 'readonly');
	}

	BtnModifica.removeAttribute('hidden');
	BtnSalva.setAttribute('hidden', 'hidden');
}


function gestisciResponseAggiungiArma(recSet){
	if (recSet['Tipo'] == null) recSet['Tipo'] = '-';
	if (recSet['FattoreVelocita'] == null) recSet['FattoreVelocita'] = '-';
	if (recSet['DannoPM'] == null) recSet['DannoPM'] = '-';
	if (recSet['DannoG'] == null) recSet['DannoG'] = '-';

	//prendo la tabella delle armi
	var table = document.getElementById('tabcombattimento');
	//controllo quante righe sono già state inserite. questo mi aiuta a mettere sempre id diversi man mano che aggiungo armi
	var curNumRighe = table.rows.length;
	//creo la nuova riga
	var newrow = table.insertRow(curNumRighe);
	newrow.setAttribute('class', 'tabellariga');
	newrow.setAttribute('id', 'riganum-'+curNumRighe);
	//creo la prima cella 
	var cellaid = newrow.insertCell(0);
	cellaid.setAttribute('class', 'cellavalore');
	cellaid.setAttribute('hidden', 'hidden');
	var idarma = creaInputSettato('id', recSet['idArma'], curNumRighe);
	cellaid.appendChild(idarma);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomearma = creaInputSettato('arma', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomearma);
	//creo la terza cella
	var cellaAtkRound = newrow.insertCell(2);
	cellaAtkRound.setAttribute('class', 'cellavalore');
	var atkround = creaInputLibero('at', curNumRighe);
	atkround.setAttribute('onchange', 'checkRigaFormat("at-'+curNumRighe+'")');
	cellaAtkRound.appendChild(atkround);
	//creo la quarta cella
	var cellaModAd = newrow.insertCell(3);
	cellaModAd.setAttribute('class', 'cellavalore');
	var modad = creaInputLibero('modad', curNumRighe);
	modad.setAttribute('onchange', 'checkRigaFormat("modad-'+curNumRighe+'")');
	cellaModAd.appendChild(modad);
	//creo la quinta cella
	var cellaThaco = newrow.insertCell(4);
	cellaThaco.setAttribute('class', 'cellavalore');
	var thaco = creaInputLibero('thaco', curNumRighe);
	thaco.setAttribute('onchange', 'checkRigaFormat("thaco-'+curNumRighe+'")');
	cellaThaco.appendChild(thaco);
	//creo la sesta cella
	var cellaDanni = newrow.insertCell(5);
	cellaDanni.setAttribute('class', 'cellavalore');
	var danni = creaInputSettato('danni', recSet['DannoPM'] + " / " + recSet['DannoG'], curNumRighe);
	cellaDanni.appendChild(danni);
	//creo la settima cella
	var cellaRaggio = newrow.insertCell(6);
	cellaRaggio.setAttribute('class', 'cellavalore');
	var raggio = creaInputLibero('raggio', curNumRighe);
	raggio.setAttribute('onchange', 'checkRigaFormat("raggio-'+curNumRighe+'")');
	cellaRaggio.appendChild(raggio);
	//creo l'ottava cella
	var cellaPeso = newrow.insertCell(7);
	cellaPeso.setAttribute('class', 'cellavalore');
	var peso = creaInputSettato('peso', recSet['Peso'] + " kg", curNumRighe);
	cellaPeso.appendChild(peso);
	//creo la nona cella
	var cellaTaglia = newrow.insertCell(8);
	cellaTaglia.setAttribute('class', 'cellavalore');
	var taglia = creaInputSettato('taglia', recSet['Taglia'], curNumRighe);
	cellaTaglia.appendChild(taglia);
	//creo la decima cella
	var cellaTipo = newrow.insertCell(9);
	cellaTipo.setAttribute('class', 'cellavalore');
	var tipo = creaInputSettato('tipo', recSet['Tipo'], curNumRighe);
	cellaTipo.appendChild(tipo);
	//creo l'undicesima cella
	var cellaVelocita = newrow.insertCell(10);
	cellaVelocita.setAttribute('class', 'cellavalore');
	var velocita = creaInputSettato('velocita', recSet['FattoreVelocita'], curNumRighe);
	cellaVelocita.appendChild(velocita);
	//creo la dodicesima cella
	var cellaSalvaModifica = newrow.insertCell(11);
	cellaSalvaModifica.setAttribute('class', 'cellavalore');
	var Modifica = creaBottone('Modifica', 0, curNumRighe);
	var Salva = creaBottone('Salva', 1, curNumRighe);
	cellaSalvaModifica.appendChild(Modifica);
	cellaSalvaModifica.appendChild(Salva);
	//creo la tredicesima cella
	var cellaRimuovi = newrow.insertCell(12);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRiga(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	var bitArrayArmi = ['at-'+curNumRighe, 'modad-'+curNumRighe, 'thaco-'+curNumRighe, 'raggio-'+curNumRighe];

	var SfondiGialliArma = new clsBitMask(bitArrayArmi);

	arrSfondiGialliArmi[curNumRighe] = SfondiGialliArma;

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsArma';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArma=' + recSet['idArma'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsArmaSuccess);
}

function checkRigaFormat(pId){
	var toCheck = document.getElementById(pId);
	var prex = pId.split('-')[0];
	var numriga = pId.split('-')[1];
	var regex1 = /^[1-9]?$/
	var regex2 = /^((\+|-)[0-9][0-9]?\/(\+|-)[0-9][0-9]?)?$/
	var regex3 = /^([1-9][0-9]?)?$/
	switch(prex){
		case 'at':
			if (regex1.test(toCheck.value)) arrSfondiGialliArmi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliArmi[numriga].setYellow(toCheck);
			break;
		case 'modad':
			if (regex2.test(toCheck.value)) arrSfondiGialliArmi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliArmi[numriga].setYellow(toCheck);
			break;
		case 'thaco':
			if (regex3.test(toCheck.value)) arrSfondiGialliArmi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliArmi[numriga].setYellow(toCheck);
			break;
		case 'raggio':
			if (regex3.test(toCheck.value)) arrSfondiGialliArmi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliArmi[numriga].setYellow(toCheck);
			break;
		default:
			break;
	}
}

function onChkInsArmaSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrarmi');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tabcombattimento');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già questo tipo di arma!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrarmi')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function rimuoviErrore(pId){
	var errmsg = document.getElementById(pId);
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
}

function rimuoviRiga(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere l'arma?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idArma = document.getElementById('id-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabcombattimento');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelArma';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArma=' + idArma.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}

function onRimuoviRigaSuccess(pResponseText){
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
}
