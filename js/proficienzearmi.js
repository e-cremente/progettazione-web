var cbCategoriaProf = document.getElementById('cbcategoriaprof');
if(cbCategoriaProf != null) cbCategoriaProf.addEventListener('change', function(){getArmiCategoria('cbcategoriaprof', 'cbarmaprof')});
var btnAggiungiProf = document.getElementById('aggiungiarmaprofbtn');
if(btnAggiungiProf != null) btnAggiungiProf.addEventListener('click', function(){aggiungiArma('cbarmaprof', 'cbcategoriaprof', 'msgerrarmiprof', gestisciResponseAggiungiArmaProf)});

var arrSfondiGialliArmiProf = [];

var lvTabProf = document.getElementById('tabproficienzearmi');
if(lvTabProf != null){
	var lvRows = lvTabProf.rows.length;
	for (var i = 0; i < lvRows; i++) {
		var lvBitArrayArmi = ['PP-'+i];
		var lvSfondiGialliArmaProf = new clsBitMask(lvBitArrayArmi);
		arrSfondiGialliArmiProf[i] = lvSfondiGialliArmaProf;
	}
}
	


function gestisciResponseAggiungiArmaProf(recSet){
	//prendo la tabella delle proficienze con le armi
	var table = document.getElementById('tabproficienzearmi');
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
	var idarma = creaInputSettato('idprof', recSet['idArma'], curNumRighe);
	cellaid.appendChild(idarma);
	//creo la seconda cella
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomearma = creaInputSettato('armaprof', recSet['Nome'], curNumRighe);
	cellanome.appendChild(nomearma);
	//creo la terza cella
	var cellaPP = newrow.insertCell(2);
	cellaPP.setAttribute('class', 'cellavalore');
	var PP = creaInputLibero('PP', curNumRighe);
	PP.setAttribute('onchange', 'checkPPFormat("PP-'+curNumRighe+'")');
	cellaPP.appendChild(PP);
	//creo la quarta cella
	var cellaScelta = newrow.insertCell(3);
	cellaScelta.setAttribute('class', 'cellavalore');
	var scelta = creaCheckBox('scelta', 'checkgroup', curNumRighe);
	cellaScelta.appendChild(scelta);
	//creo la quinta cella
	var cellaEsperto = newrow.insertCell(4);
	cellaEsperto.setAttribute('class', 'cellavalore');
	var esperto = creaCheckBox('esperto', 'checkgroup', curNumRighe);
	cellaEsperto.appendChild(esperto);
	//creo la sesta cella
	var cellaSpec = newrow.insertCell(5);
	cellaSpec.setAttribute('class', 'cellavalore');
	var spec = creaCheckBox('spec', 'checkgroup', curNumRighe);
	cellaSpec.appendChild(spec);
	//creo la settima cella
	var cellaMaestro = newrow.insertCell(6);
	cellaMaestro.setAttribute('class', 'cellavalore');
	var maestro = creaCheckBox('maestro', 'checkgroup', curNumRighe);
	cellaMaestro.appendChild(maestro);
	//creo l'ottava cella
	var cellaAlto = newrow.insertCell(7);
	cellaAlto.setAttribute('class', 'cellavalore');
	var alto = creaCheckBox('alto', 'checkgroup', curNumRighe);
	cellaAlto.appendChild(alto);
	//creo la nona cella
	var cellaGrande = newrow.insertCell(8);
	cellaGrande.setAttribute('class', 'cellavalore');
	var grande = creaCheckBox('grande', 'checkgroup', curNumRighe);
	cellaGrande.appendChild(grande);
	//creo la decima cella
	var cellaSalvaModifica = newrow.insertCell(9);
	cellaSalvaModifica.setAttribute('class', 'cellavalore');
	var Modifica = creaBottoneProf('modificaprof', 'Modifica', 0, curNumRighe);
	var Salva = creaBottoneProf('salvaprof', 'Salva', 1, curNumRighe);
	cellaSalvaModifica.appendChild(Modifica);
	cellaSalvaModifica.appendChild(Salva);
	//creo l'undicesima cella
	var cellaRimuovi = newrow.insertCell(10);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaProf(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);


	var bitArrayArmi = ['PP-'+curNumRighe];

	var SfondiGialliArmaProf = new clsBitMask(bitArrayArmi);

	arrSfondiGialliArmiProf[curNumRighe] = SfondiGialliArmaProf;

	var idPersonaggio = document.getElementById('idPersonaggio');

	var qs = 'ToCall=ChkInsArmaProf';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArma=' + recSet['idArma'];

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsArmaProfSuccess);
}

function creaCheckBox(pId, pNome, pNumRighe){
	var check = document.createElement('input');
	check.setAttribute('type', 'checkbox');
	check.setAttribute('id', pId+'-'+pNumRighe);
	check.setAttribute('name', pNome+'-'+pNumRighe);
	check.setAttribute('disabled', 'disabled');
	return check;
}

function creaBottoneProf(pId, pLabel, pHidden, pNumRighe){
	var button = document.createElement('button');
	var text = document.createTextNode(pLabel);
	button.appendChild(text);
	button.setAttribute('type', 'button');
	button.setAttribute('id', pId+'-'+pNumRighe);
	button.setAttribute('name', pId+'-'+pNumRighe);
	button.setAttribute('onclick', (pId == 'modificaprof' ? 'ModificaRigaProfOnModifica(' : 'ValidateRigaProf(')+pNumRighe+')');
	if (pHidden == 1) {
		button.setAttribute('hidden', 'hidden');
	}
	return button;	
}

function checkPPFormat(pId){
	var toCheck = document.getElementById(pId);
	var prex = pId.split('-')[0];
	var numriga = pId.split('-')[1];
	var regex = /^([1-9][0-9]?)?$/;

	if (regex.test(toCheck.value)) arrSfondiGialliArmiProf[numriga].unsetYellow(toCheck);
	else arrSfondiGialliArmiProf[numriga].setYellow(toCheck);
}

function ModificaRigaProfOnModifica(pNum){
	var PP = document.getElementById('PP-'+pNum);
	var Scelta = document.getElementById('scelta-'+pNum);
	var Esperto = document.getElementById('esperto-'+pNum);
	var Spec = document.getElementById('spec-'+pNum);
	var Maestro = document.getElementById('maestro-'+pNum);
	var Alto = document.getElementById('alto-'+pNum);
	var Grande = document.getElementById('grande-'+pNum);
	var BtnModifica = document.getElementById('modificaprof-'+pNum);
	var BtnSalva = document.getElementById('salvaprof-'+pNum);

	PP.removeAttribute('readonly');

	var arrDisabled = [Scelta, Esperto, Spec, Maestro, Alto, Grande];

	for(var i = 0; i < arrDisabled.length; i++){
		arrDisabled[i].removeAttribute('disabled');
	}

	BtnModifica.setAttribute('hidden', 'hidden');
	BtnSalva.removeAttribute('hidden');
}

function ValidateRigaProf(pNum){
	var errmsg = document.getElementById('msgerrarmiprof');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(arrSfondiGialliArmiProf[pNum].maschera != 0){
		var msg = document.createTextNode("Riempi correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idArma = document.getElementById('idprof-'+pNum);
	var PP = document.getElementById('PP-'+pNum);
	var Scelta = document.getElementById('scelta-'+pNum);
	var Esperto = document.getElementById('esperto-'+pNum);
	var Spec = document.getElementById('spec-'+pNum);
	var Maestro = document.getElementById('maestro-'+pNum);
	var Alto = document.getElementById('alto-'+pNum);
	var Grande = document.getElementById('grande-'+pNum);

	var qs = 'ToCall=UpdPgArmaProf';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArma=' + idArma.value;
	qs += '&pPP=' + isNull(PP.value, 'null');
	qs += '&pScelta=' + (Scelta.checked ? 1 : 0);
	qs += '&pEsperto=' + (Esperto.checked ? 1 : 0);
	qs += '&pSpec=' + (Spec.checked ? 1 : 0);
	qs += '&pMaestro=' + (Maestro.checked ? 1 : 0);
	qs += '&pAlto=' + (Alto.checked ? 1 : 0);
	qs += '&pGrande=' + (Grande.checked ? 1 : 0);
	qs += '&pNum=' + pNum;
	
	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdPgArmaProfSuccess);
}

function rimuoviRigaProf(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere la proficienza con quest'arma?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var idArma = document.getElementById('idprof-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabproficienzearmi');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelArmaProf';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pIdArma=' + idArma.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}

function onChkInsArmaProfSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrarmiprof');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == "false") {
		var table = document.getElementById('tabproficienzearmi');
		var RigaDaCancellare = table.rows.length - 1;
		table.deleteRow(RigaDaCancellare);
		var msg = document.createTextNode("Hai già scelto quest'arma!");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrarmiprof')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
}

function onUpdPgArmaProfSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	var pNum = ResTextArray[1];
	ModificaRigaProfOnSave(pNum);	
}

function ModificaRigaProfOnSave(pNum){
	var PP = document.getElementById('PP-'+pNum);
	var Scelta = document.getElementById('scelta-'+pNum);
	var Esperto = document.getElementById('esperto-'+pNum);
	var Spec = document.getElementById('spec-'+pNum);
	var Maestro = document.getElementById('maestro-'+pNum);
	var Alto = document.getElementById('alto-'+pNum);
	var Grande = document.getElementById('grande-'+pNum);
	var BtnModifica = document.getElementById('modificaprof-'+pNum);
	var BtnSalva = document.getElementById('salvaprof-'+pNum);

	PP.setAttribute('readonly', 'readonly');

	var arrDisabled = [Scelta, Esperto, Spec, Maestro, Alto, Grande];

	for(var i = 0; i < arrDisabled.length; i++){
		arrDisabled[i].setAttribute('disabled', 'disabled');
	}

	BtnModifica.removeAttribute('hidden');
	BtnSalva.setAttribute('hidden', 'hidden');
}
