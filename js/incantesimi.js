var btnAggiungi = document.getElementById('aggiungiincantesimibtn');
if(btnAggiungi != null) btnAggiungi.addEventListener('click', aggiungiRigaIncantesimi);

var arrSfondiGialliIncantesimi = [];

var lvTabIncantesimi = document.getElementById('tabincantesimi');
if(lvTabIncantesimi != null){
	var lvRows = lvTabIncantesimi.rows.length;
	for (var i = 0; i < lvRows; i++) {
		var lvBitArrayIncantesimi = ['incantesimo-'+i, 'livincantesimo-'+i, 'compincantesimo-'+i, 'durataincantesimo-'+i, 'raggioincantesimo-'+i, 
		                             'tirosalvincantesimo-'+i, 'velocitaincantesimo-'+i, 'effettoincantesimo-'+i];
		var lvSfondiGialliIncantesimi = new clsBitMask(lvBitArrayIncantesimi);
		arrSfondiGialliIncantesimi[i] = lvSfondiGialliIncantesimi;
	}
}
	
function aggiungiRigaIncantesimi(){
	//prendo la tabella degli incantesimi 
	var table = document.getElementById('tabincantesimi');
	//controllo quante righe sono già state inserite. questo mi aiuta a mettere sempre id diversi man mano che aggiungo armi
	var curNumRighe = table.rows.length - 1;
	//creo la nuova riga
	var newrow = table.insertRow(curNumRighe + 1);
	newrow.setAttribute('class', 'tabellariga');
	newrow.setAttribute('id', 'riganum-'+curNumRighe);
	//creo la prima cella 
	var cellaid = newrow.insertCell(0);
	cellaid.setAttribute('class', 'cellavalore');
	cellaid.setAttribute('hidden', 'hidden');
	var idincantesimo = creaInputSettato('idincantesimo', null, curNumRighe);
	cellaid.appendChild(idincantesimo);
	//creo la prima cella 
	var cellanome = newrow.insertCell(1);
	cellanome.setAttribute('class', 'cellavalore');
	var nomeincantesimo = creaInputLibero('incantesimo', curNumRighe);
	nomeincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("incantesimo-'+curNumRighe+'")');
	cellanome.appendChild(nomeincantesimo);
	//creo la seconda cella 
	var cellaLivello = newrow.insertCell(2);
	cellaLivello.setAttribute('class', 'cellavalore');
	var livincantesimo = creaInputLibero('livincantesimo', curNumRighe);
	livincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("livincantesimo-'+curNumRighe+'")');
	cellaLivello.appendChild(livincantesimo);
	//creo la terza cella 
	var cellaComponenti = newrow.insertCell(3);
	cellaComponenti.setAttribute('class', 'cellavalore');
	var compincantesimo = creaInputLibero('compincantesimo', curNumRighe);
	compincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("compincantesimo-'+curNumRighe+'")');
	cellaComponenti.appendChild(compincantesimo);
	//creo la quarta cella 
	var cellaDurata = newrow.insertCell(4);
	cellaDurata.setAttribute('class', 'cellavalore');
	var durataincantesimo = creaInputLibero('durataincantesimo', curNumRighe);
	durataincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("durataincantesimo-'+curNumRighe+'")');
	cellaDurata.appendChild(durataincantesimo);
	//creo la quinta cella 
	var cellaRaggio = newrow.insertCell(5);
	cellaRaggio.setAttribute('class', 'cellavalore');
	var raggioincantesimo = creaInputLibero('raggioincantesimo', curNumRighe);
	raggioincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("raggioincantesimo-'+curNumRighe+'")');
	cellaRaggio.appendChild(raggioincantesimo);
	//creo la sesta cella 
	var cellaTiroSalv = newrow.insertCell(6);
	cellaTiroSalv.setAttribute('class', 'cellavalore');
	var tirosalvincantesimo = creaInputLibero('tirosalvincantesimo', curNumRighe);
	tirosalvincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("tirosalvincantesimo-'+curNumRighe+'")');
	cellaTiroSalv.appendChild(tirosalvincantesimo);
	//creo la settima cella 
	var cellaVelocita = newrow.insertCell(7);
	cellaVelocita.setAttribute('class', 'cellavalore');
	var velocitaincantesimo = creaInputLibero('velocitaincantesimo', curNumRighe);
	velocitaincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("velocitaincantesimo-'+curNumRighe+'")');
	cellaVelocita.appendChild(velocitaincantesimo);
	//creo l'ottava cella 
	var cellaEffetto = newrow.insertCell(8);
	cellaEffetto.setAttribute('class', 'cellavalore');
	var effettoincantesimo = creaInputLibero('effettoincantesimo', curNumRighe);
	effettoincantesimo.setAttribute('onchange', 'checkIncantesimiFormat("effettoincantesimo-'+curNumRighe+'")');
	cellaEffetto.appendChild(effettoincantesimo);
	//creo la nona cella
	var cellaSalvaModifica = newrow.insertCell(9);
	cellaSalvaModifica.setAttribute('class', 'cellavalore');
	var Modifica = creaBottoneIncantesimi('modificaincantesimo', 'Modifica', 0, curNumRighe);
	var Salva = creaBottoneIncantesimi('salvaincantesimo', 'Salva', 1, curNumRighe);
	cellaSalvaModifica.appendChild(Modifica);
	cellaSalvaModifica.appendChild(Salva);
	//creo la decima cella
	var cellaRimuovi = newrow.insertCell(10);
	cellaRimuovi.setAttribute('class', 'cellavalore');
	var Rimuovi = document.createElement('button');
	Rimuovi.setAttribute('class', 'removebutton');
	Rimuovi.setAttribute('type', 'button');
	Rimuovi.setAttribute('onclick', 'rimuoviRigaIncantesimi(this, '+curNumRighe+')');
	cellaRimuovi.appendChild(Rimuovi);

	ModificaRigaIncantesimoOnModifica(curNumRighe);

	document.getElementById('incantesimo-'+curNumRighe).removeAttribute('readonly');

	var BitArrayIncantesimi = ['incantesimo-'+curNumRighe, 'livincantesimo-'+curNumRighe, 'compincantesimo-'+curNumRighe, 'durataincantesimo-'+curNumRighe, 'raggioincantesimo-'+curNumRighe, 
	                           'tirosalvincantesimo-'+curNumRighe, 'velocitaincantesimo-'+curNumRighe, 'effettoincantesimo-'+curNumRighe];

	var SfondiGialliIncantesimi = new clsBitMask(BitArrayIncantesimi);

	arrSfondiGialliIncantesimi[curNumRighe] = SfondiGialliIncantesimi;

}

function ValidateRigaIncantesimo(pNum){
	var errmsg = document.getElementById('msgerrincantesimi');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	var arrayCheck = ['incantesimo-'+pNum, 'livincantesimo-'+pNum, 'compincantesimo-'+pNum, 'durataincantesimo-'+pNum, 'raggioincantesimo-'+pNum, 
	                  'tirosalvincantesimo-'+pNum, 'velocitaincantesimo-'+pNum, 'effettoincantesimo-'+pNum];

	for(var i = 0; i < arrayCheck.length; i++){
		checkIncantesimiFormat(arrayCheck[i]);
	}

	if(arrSfondiGialliIncantesimi[pNum].maschera != 0){
		var msg = document.createTextNode("Riempi correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');
	var Nome = document.getElementById('incantesimo-'+pNum);	
	var idIncantesimo = document.getElementById('idincantesimo-'+pNum);
	var Livello = document.getElementById('livincantesimo-'+pNum);
	var Componenti = document.getElementById('compincantesimo-'+pNum);
	var Durata = document.getElementById('durataincantesimo-'+pNum);
	var Raggio = document.getElementById('raggioincantesimo-'+pNum);
	var TiroSalvezza = document.getElementById('tirosalvincantesimo-'+pNum);
	var Velocita = document.getElementById('velocitaincantesimo-'+pNum);
	var Effetto = document.getElementById('effettoincantesimo-'+pNum);

	var qs = 'ToCall=ChkInsPgIncantesimo';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pNome=' + Nome.value;
	qs += '&pIdIncantesimo=' + isNull(idIncantesimo.value, 'null');
	qs += '&pLivello=' + Livello.value;
	qs += '&pComponenti=' + Componenti.value;
	qs += '&pDurata=' + Durata.value;
	qs += '&pRaggio=' + Raggio.value;
	qs += '&pTiroSalvezza=' + TiroSalvezza.value;
	qs += '&pVelocita=' + Velocita.value;
	qs += '&pEffetto=' + Effetto.value;
	qs += '&pNum=' + pNum;
	
	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onChkInsPgIncantesimoSuccess);
}

function onChkInsPgIncantesimoSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var errmsg = document.getElementById('msgerrincantesimi');
	while(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	var SplitVirgola = pResponseText.split(',');
	var ResTextArray = SplitVirgola[0].split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if(ResTextArray[1] == ''){
		var msg = document.createTextNode("Hai già un incantesimo con questo nome! Scegliere un nome diverso per salvare l'incantesimo");
		var btncanc = document.createElement('button');
		btncanc.setAttribute('type', 'button');
		btncanc.setAttribute('class', 'removebutton');
		btncanc.setAttribute('onclick', "rimuoviErrore('msgerrincantesimi')");
		errmsg.appendChild(msg);
		errmsg.appendChild(btncanc);
		errmsg.removeAttribute("hidden");
	}
	else{
		//alert('idincantesimo-'+SplitVirgola[1]);
		//alert(ResTextArray[1]);
		var id = document.getElementById('idincantesimo-'+SplitVirgola[1]);
		id.value = ResTextArray[1];
		ModificaRigaIncantesimoOnSalva(Number(SplitVirgola[1]));
	}
}

function creaBottoneIncantesimi(pId, pLabel, pHidden, pNumRighe){
	var button = document.createElement('button');
	var text = document.createTextNode(pLabel);
	button.appendChild(text);
	button.setAttribute('type', 'button');
	button.setAttribute('id', pId+'-'+pNumRighe);
	button.setAttribute('name', pId+'-'+pNumRighe);
	button.setAttribute('onclick', (pId == 'modificaincantesimo' ? 'ModificaRigaIncantesimoOnModifica(' : 'ValidateRigaIncantesimo(')+pNumRighe+')');
	if (pHidden == 1) {
		button.setAttribute('hidden', 'hidden');
	}
	return button;	
}

function ModificaRigaIncantesimoOnSalva(pNum){
	var BtnModifica = document.getElementById('modificaincantesimo-'+pNum);
	var BtnSalva = document.getElementById('salvaincantesimo-'+pNum);

	arrReadonly = ['incantesimo-', 'livincantesimo-', 'compincantesimo-', 'durataincantesimo-', 'raggioincantesimo-', 'tirosalvincantesimo-',
	               'velocitaincantesimo-', 'effettoincantesimo-'];

	for(var i = 0; i < arrReadonly.length; i++){
		var readonly = document.getElementById(arrReadonly[i]+pNum);
		if(!readonly.hasAttribute('readonly')) readonly.setAttribute('readonly', 'readonly');
	}

	BtnSalva.setAttribute('hidden', 'hidden');
	BtnModifica.removeAttribute('hidden');
}

function ModificaRigaIncantesimoOnModifica(pNum){
	var BtnModifica = document.getElementById('modificaincantesimo-'+pNum);
	var BtnSalva = document.getElementById('salvaincantesimo-'+pNum);

	arrReadonly = ['livincantesimo-', 'compincantesimo-', 'durataincantesimo-', 'raggioincantesimo-', 'tirosalvincantesimo-',
	               'velocitaincantesimo-', 'effettoincantesimo-'];

	for(var i = 0; i < arrReadonly.length; i++){
		var readonly = document.getElementById(arrReadonly[i]+pNum);
		readonly.removeAttribute('readonly');
	}

	BtnModifica.setAttribute('hidden', 'hidden');
	BtnSalva.removeAttribute('hidden');
}

function checkIncantesimiFormat(pId){
	var toCheck = document.getElementById(pId);
	var prex = pId.split('-')[0];
	var numriga = pId.split('-')[1];
	var regex1 = /^([1-9][0-9]?)?$/;

	switch(prex){
		case "incantesimo":
			if (toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "livincantesimo":
			if (regex1.test(toCheck.value) && toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "compincantesimo":
			if (toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "durataincantesimo":
			if (toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "raggioincantesimo":
			if (toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "tirosalvincantesimo":
			if (toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "velocitaincantesimo":
			if (regex1.test(toCheck.value) && toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
		case "effettoincantesimo":
			if (toCheck.value != '') arrSfondiGialliIncantesimi[numriga].unsetYellow(toCheck);
			else arrSfondiGialliIncantesimi[numriga].setYellow(toCheck);
			break;
	}
}

function rimuoviRigaIncantesimi(pThis, pNum){
	if(!confirm("Sei sicuro di voler rimuovere questo incantesimo?")) return false;

	var idPersonaggio = document.getElementById('idPersonaggio');
	var NomeIncantesimo = document.getElementById('incantesimo-'+pNum);
	var i = pThis.parentNode.parentNode.rowIndex;
	var Tabella = document.getElementById('tabincantesimi');

	Tabella.deleteRow(i);

	var qs = 'ToCall=DelPgIncantesimo';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pNomeIncantesimo=' + NomeIncantesimo.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onRimuoviRigaSuccess)
}