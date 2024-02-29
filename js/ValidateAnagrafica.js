var BtnSalvaAnagrafica = document.getElementById('BtnSalvaAnagrafica');
if(BtnSalvaAnagrafica != null) BtnSalvaAnagrafica.addEventListener('click', ValidateAnagrafica);
var BtnModificaAnagrafica = document.getElementById('BtnModificaAnagrafica');
if(BtnModificaAnagrafica != null) BtnModificaAnagrafica.addEventListener('click', ModificaAnagraficaUIonModifica);

function isNull(pValue, pValueIfNull) {
	return (pValue == undefined || pValue == null || pValue == "") ? pValueIfNull : pValue; 
}
//funzione che controlla i campi obbligatori e restituisce false se qualcuno dei campi obbligatori non è stato riempito
function checkCampiObbligatori(arrayTB, arrayCB){
    for(var i = 0; i < arrayTB.length; i++){
        if(arrayTB[i].value == '') return false;
    }

    for(var i = 0; i < arrayCB.length; i++){
        if(arrayCB[i].value == 'nochoice') return false;
    }

    return true;
}

//funzione che controlla il formato dei dati inseriti e restituisce false se qualcuno dei dati non ha rispettato il pattern stabilito
function checkCorrectFormat(regex, arr){
    for(var i = 0; i < arr.length; i++){
    	if (arr[i] == null) alert(i);
        if(arr[i].value != '' && !regex.test(arr[i].value)) return false;
    }

    return true;
}

function ValidateAnagrafica(){
	var errmsg = document.getElementById('msgerranagr');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");
	//creo un array con le textbox che devono essere obbligatoriamente riempite
	var nomepg = document.getElementById('nomepg');
	var livello = document.getElementById('lvl');
	var anni = document.getElementById('age');
	var esperienza = document.getElementById('exp');	
	var obligedArrayTB = [nomepg, livello, esperienza, anni];

	//creo un array con le combo box che devono essere obbligatoriamente riempite con una scelta diversa da quella di default
	var allineamento = document.getElementById('alignment');
	var razza = document.getElementById('race');
	var classe = document.getElementById('cls');
	var sesso = document.getElementById('sex');
	var obligedArrayCB = [allineamento, razza, classe, sesso];

	//controllo i campi obbligatori
	if (!checkCampiObbligatori(obligedArrayTB, obligedArrayCB)) {
		var msg = document.createTextNode("Riempi tutti i campi segnati con l'asterisco!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	//creo un array con tutti i campi che devono rispettare il formato "/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/"
	var origine = document.getElementById('origin');
	var famiglia = document.getElementById('family');
	var clan = document.getElementById('clan');
	var classesociale = document.getElementById('socclass');
	var religione = document.getElementById('rel');
	var fratellisorelle = document.getElementById('fratsis');
	var capelli = document.getElementById('hair');
	var occhi = document.getElementById('eyes');
	var aspetto = document.getElementById('appearance');
	var regex1 = /^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/;
	var arrayregex1 = [nomepg, origine, famiglia, clan, religione, classesociale, fratellisorelle, capelli, occhi, aspetto];
	//creo un array con tutti i campi che devono rispettare il formato "/^[0-9]*$/"	
	var altezza = document.getElementById('heigth');
	var peso = document.getElementById('weigth');
	var regex2 = /^[0-9]*$/;
	var arrayregex2 = [livello, esperienza, anni, altezza, peso];

	if(!checkCorrectFormat(regex1, arrayregex1) || !checkCorrectFormat(regex2, arrayregex2)){
		var msg = document.createTextNode("Per favore rispetta il formato specificato nelle caselle.");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var classisecondarie = document.getElementById('secondaryclass');
	var seclvl = document.getElementById('secondarylvl');
	var idPersonaggio = document.getElementById('idPersonaggio');
	var Creatore = document.getElementById('Creatore');
	if(Creatore.value == ''){
		alert('Attenzione: come utente non registrato non puoi salvare un personaggio. Registrati, o esegui l\'accesso se sei già registrato, per salvarne uno');
		return false;
	} 

	var HiddenRazza = document.getElementById('HiddenRazza');
	var HiddenClasse = document.getElementById('HiddenClasse');
	//se idPersonaggio non è null, sono in fase di aggiornamento, e quindi devo controllare la classe e la razza per vedere se sono cambiate
	if (idPersonaggio.value != '') {
		if(checkRazzaEClasse()) {
			var qs = 'ToCall=DelPersonaggioByChange';
			qs += '&idPersonaggio=' + idPersonaggio.value;

			ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onDelPersonaggioByChangeSuccess);
		}
		else{
			razza.value = HiddenRazza.value;
			classe.value = HiddenClasse.value;
		}
	}

	var qs = 'ToCall=InsUpdPersonaggio';
	qs += '&idPersonaggio=' + isNull(idPersonaggio.value, 'null');
	qs += '&pCreatore=' + Creatore.value;
	qs += '&pNome=' + nomepg.value;
	qs += '&pRazza=' + razza.value;
	qs += '&pClasse=' + classe.value;
	qs += '&pClassi_Secondarie=' + isNull(classisecondarie.value, 'null');
	qs += '&pAllineamento=' + allineamento.value;
	qs += '&pLivello=' + livello.value;
	qs += '&pLivelli_Secondari=' + isNull(seclvl.value, 'null');
	qs += '&pEsperienza=' + esperienza.value;
	qs += '&pOrigine=' + isNull(origine.value, 'null');
	qs += '&pFamiglia=' + isNull(famiglia.value, 'null');
	qs += '&pStirpe_Clan=' + isNull(clan.value, 'null');
	qs += '&pReligione=' + isNull(religione.value, 'null');
	qs += '&pClasse_Sociale=' + isNull(classesociale.value, 'null');
	qs += '&pFratelli_Sorelle=' + isNull(fratellisorelle.value, 'null');
	qs += '&pSesso=' + sesso.value;
	qs += '&pAnni=' + anni.value;
	qs += '&pAltezza=' + isNull(altezza.value, 'null');
	qs += '&pPeso=' + isNull(peso.value, 'null');
	qs += '&pCapelli=' + isNull(capelli.value, 'null');
	qs += '&pOcchi=' + isNull(occhi.value, 'null');
	qs += '&pAspetto=' + isNull(aspetto.value, 'null');

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdPersonaggioSuccess);

	HiddenRazza.value = razza.value;
	HiddenClasse.value = classe.value;

}

function selectAbilitaDiRazza(pIdCbAbRazza){
	let razza = document.getElementById('race').value;

	var qs = 'ToCall=selectAbilitaDiRazza';
	qs += '&Value=' + razza;
	qs += '&IdCbAbRazza=' + pIdCbAbRazza;

	ajaxRequestGet("funcs/AjaxRequestHandler.php", qs, gestisciResponseAbilitaDiRazza);
}

function selectAbilitaDiClasse(pIdCbAbClasse){
	let classe = document.getElementById('cls').value;

	var qs = 'ToCall=selectAbilitaDiClasse';
	qs += '&Value=' + classe;
	qs += '&IdCbAbClasse=' + pIdCbAbClasse;

	ajaxRequestGet("funcs/AjaxRequestHandler.php", qs, gestisciResponseAbilitaDiClasse);
}

function gestisciResponseAbilitaDiRazza(recSet){
	//la prima riga del result set è fissa, dove il primo valore è 0 e il secondo è l'id del menu a tendina da dove compaiono le abilità di razza.
	var IdCbAbRazza = recSet[0]['Nome'];	
	var cbAbRazza = document.getElementById(IdCbAbRazza);
	for (var i = cbAbRazza.length - 1; i >= 1; i--) {
		cbAbRazza.remove(i);
	}
	for(var i = 1; i < recSet.length; i++){
		var rec = recSet[i];
		var opt = document.createElement("option");
		opt.value = rec["idAbilitadirazza"];
		opt.text = rec["Nome"].replace('&agrave;', 'à');
		cbAbRazza.appendChild(opt);
	}

	selectAbilitaDiClasse('cbabclasse');
}

function gestisciResponseAbilitaDiClasse(recSet){
	//la prima riga del result set è fissa, dove il primo valore è 0 e il secondo è l'id del menu a tendina da dove compaiono le abilità di classe.
	var IdCbAbClasse = recSet[0]['Nome'];	
	var cbAbClasse = document.getElementById(IdCbAbClasse);
	for (var i = cbAbClasse.length - 1; i >= 1; i--) {
		cbAbClasse.remove(i);
	}
	for(var i = 1; i < recSet.length; i++){
		var rec = recSet[i];
		var opt = document.createElement("option");
		opt.value = rec["idAbilitadiclasse"];
		opt.text = rec["Nome"].replace('&agrave;', 'à');
		cbAbClasse.appendChild(opt);
	}
}

//questa funzione controlla se la razza o la classe sono cambiate, e restituisce true o false in base alla decisione dell'utente
function checkRazzaEClasse(){
	var HiddenRazza = document.getElementById('HiddenRazza').value;
	var HiddenClasse = document.getElementById('HiddenClasse').value;
	var razza = document.getElementById('race').value;
	var classe = document.getElementById('cls').value;

	if (HiddenRazza != razza || HiddenClasse != classe) {
		return confirm("ATTENZIONE: Cambiando la Razza o la Classe, cancellerai TUTTE le informazioni relative al personaggio (escluse le parti di anagrafica). In altre parole, se vorrai mantenere le informazioni del personaggio intatte, dovrai salvarle tutte di nuovo, o al prossimo refresh verranno svuotate. Sei sicuro di voler continuare?");
	}

	return false;
}

function onInsUpdPersonaggioSuccess(pResponseText) {
	// la risposta ok è: idPersonaggio=<ID>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "idPersonaggio") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	selectAbilitaDiRazza('cbabrazza');
	ModificaAnagraficaUIonSave(ResTextArray[1]);	
}

function onDelPersonaggioByChangeSuccess(pResponseText) {
	// la risposta ok è: success=...
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
}

function ModificaAnagraficaUIonSave(pIdPersonaggio){
	lvHiddenIdPersonaggio = document.getElementById("idPersonaggio");
	btnModifica = document.getElementById('BtnModificaAnagrafica');
	btnSalva = document.getElementById('BtnSalvaAnagrafica');
	lvHiddenIdPersonaggio.value = pIdPersonaggio;
	btnSalva.setAttribute('hidden', 'hidden');
	btnModifica.removeAttribute('hidden');
	setAnagraficaReadonly();
}

function setAnagraficaReadonly(){
	var nomepg = document.getElementById('nomepg');
	var livello = document.getElementById('lvl');
	var anni = document.getElementById('age');
	var esperienza = document.getElementById('exp');
	var allineamento = document.getElementById('alignment');
	var razza = document.getElementById('race');
	var classe = document.getElementById('cls');
	var sesso = document.getElementById('sex');
	var origine = document.getElementById('origin');
	var famiglia = document.getElementById('family');
	var clan = document.getElementById('clan');
	var classesociale = document.getElementById('socclass');
	var religione = document.getElementById('rel');
	var fratellisorelle = document.getElementById('fratsis');
	var capelli = document.getElementById('hair');
	var occhi = document.getElementById('eyes');
	var aspetto = document.getElementById('appearance');
	var altezza = document.getElementById('heigth');
	var peso = document.getElementById('weigth');
	var classisecondarie = document.getElementById('secondaryclass');
	var seclvl = document.getElementById('secondarylvl');

	//array dei campi readonly
	var ArrReadonly = [nomepg, classisecondarie, livello, seclvl, esperienza, origine, famiglia, clan, religione, classesociale, fratellisorelle,
	                   anni, altezza, peso, capelli, occhi, aspetto];

	for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].setAttribute('readonly', 'readonly');
	}

	//array dei campi unselectable
	var ArrUnselectable = [allineamento, razza, classe, sesso];

	for(var i = 0; i < ArrUnselectable.length; i++){
		ArrUnselectable[i].setAttribute('disabled', 'disabled');
		ArrUnselectable[i].setAttribute('class', 'black');
	}

	//scrivo l'elenco dei tasti che devono apparire dopo la prima volta che salvo i dati di anagrafica
	var BtnSalvaCaratteristiche = document.getElementById('BtnSalvaCaratteristiche');
	var BtnSalvaTiriSalvezza = document.getElementById('BtnSalvaTiriSalvezza');
	var BtnSalvaArmatura = document.getElementById('BtnSalvaArmatura');
	var BtnSalvaPuntiFerita = document.getElementById('BtnSalvaPuntiFerita');
	var BtnSalvaInfoGeneriche = document.getElementById('BtnSalvaInfoGeneriche');
	var BtnSalvaRicchezze = document.getElementById('BtnSalvaRicchezze');
	var BtnSalvaAbilitaLadri = document.getElementById('BtnSalvaAbilitaLadri');
	var BtnSalvaEquip = document.getElementById('BtnSalvaEquipaggiamento');

	//inserisco i tasti in un array per poterly scorrere e poterli attivare tutti insieme
	var ArrBtnSalvataggi = [BtnSalvaCaratteristiche, BtnSalvaTiriSalvezza, BtnSalvaArmatura, BtnSalvaPuntiFerita, BtnSalvaInfoGeneriche,
	                        BtnSalvaRicchezze, BtnSalvaAbilitaLadri, BtnSalvaEquip];

	//scrivo l'elenco dei tasti "modifica" affiancati ai vari tasti salva dei vari paragrafi. Devo testare anche quelli per assicurarmi
	//che sia la prima volta che i dati di anagrafica vengono salvati (infatti in questo caso, entrambi i tasti di modifica e salva saranno ancora nascosti)
	var BtnModificaCaratteristiche = document.getElementById('BtnModificaCaratteristiche');
	var BtnModificaTiriSalvezza = document.getElementById('BtnModificaTiriSalvezza');
	var BtnModificaArmatura = document.getElementById('BtnModificaArmatura');
	var BtnModificaPuntiFerita = document.getElementById('BtnModificaPuntiFerita');
	var BtnModificaInfoGeneriche = document.getElementById('BtnModificaInfoGeneriche');
	var BtnModificaRicchezze = document.getElementById('BtnModificaRicchezze');
	var BtnModificaAbilitaLadri = document.getElementById('BtnModificaAbilitaLadri');
	var BtnModificaEquip = document.getElementById('BtnModificaEquipaggiamento');

	var ArrBtnModifiche = [BtnModificaCaratteristiche, BtnModificaTiriSalvezza, BtnModificaArmatura, BtnModificaPuntiFerita, BtnModificaInfoGeneriche,
	                       BtnModificaRicchezze, BtnModificaAbilitaLadri, BtnModificaEquip];

	for(var i = 0; i < ArrBtnSalvataggi.length; i++){
		if (ArrBtnSalvataggi[i].hasAttribute('hidden') && ArrBtnModifiche[i].hasAttribute('hidden')){
			ArrBtnSalvataggi[i].removeAttribute('hidden');
		}
	}

	//qui inserisco eventuali tasti che devono mostrarsi ma che non hanno la controparte salva/modifica
	var BtnAggiungiArma = document.getElementById('aggiungiarmabtn');
	var BtnAggiungiArmaProf = document.getElementById('aggiungiarmaprofbtn');
	var BtnAggiungiProficienza = document.getElementById('aggiungiproficienzabtn');
	var BtnAggiungiTratto = document.getElementById('aggiungitrattobtn');
	var BtnAggiungiSvantaggio = document.getElementById('aggiungisvantaggiobtn');
	var BtnAggiungiAbilitaDiRazza = document.getElementById('aggiungiabrazzabtn');
	var BtnAggiungiAbilitaDiClasse = document.getElementById('aggiungiabclassebtn');
	var BtnAggiungiStileCombattimento = document.getElementById('aggiungistilecombbtn');
	var BtnAggiungiIncantesimi = document.getElementById('aggiungiincantesimibtn');

	var ArrBtnSingoli = [BtnAggiungiArma, BtnAggiungiArmaProf, BtnAggiungiProficienza, BtnAggiungiTratto, BtnAggiungiSvantaggio,
	                     BtnAggiungiAbilitaDiRazza, BtnAggiungiAbilitaDiClasse, BtnAggiungiStileCombattimento, BtnAggiungiIncantesimi];

	for(var i = 0; i < ArrBtnSingoli.length; i++){
			if (ArrBtnSingoli[i].hasAttribute('hidden')) ArrBtnSingoli[i].removeAttribute('hidden');
	}
}

function ModificaAnagraficaUIonModifica(){
	unsetAnagraficaReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	var BtnSalvaAnagrafica = document.getElementById('BtnSalvaAnagrafica');
	var BtnModificaAnagrafica = document.getElementById('BtnModificaAnagrafica');

	BtnSalvaAnagrafica.removeAttribute('hidden');
	BtnModificaAnagrafica.setAttribute('hidden', 'hidden');
}

function unsetAnagraficaReadonly(){
	var nomepg = document.getElementById('nomepg');
	var livello = document.getElementById('lvl');
	var anni = document.getElementById('age');
	var esperienza = document.getElementById('exp');
	var allineamento = document.getElementById('alignment');
	var razza = document.getElementById('race');
	var classe = document.getElementById('cls');
	var sesso = document.getElementById('sex');
	var origine = document.getElementById('origin');
	var famiglia = document.getElementById('family');
	var clan = document.getElementById('clan');
	var classesociale = document.getElementById('socclass');
	var religione = document.getElementById('rel');
	var fratellisorelle = document.getElementById('fratsis');
	var capelli = document.getElementById('hair');
	var occhi = document.getElementById('eyes');
	var aspetto = document.getElementById('appearance');
	var altezza = document.getElementById('heigth');
	var peso = document.getElementById('weigth');
	var classisecondarie = document.getElementById('secondaryclass');
	var seclvl = document.getElementById('secondarylvl');

	//array dei campi readonly
	var ArrReadonly = [nomepg, classisecondarie, livello, seclvl, esperienza, origine, famiglia, clan, religione, classesociale, fratellisorelle,
	                   anni, altezza, peso, capelli, occhi, aspetto];

	for(var i = 0; i < ArrReadonly.length; i++){
		ArrReadonly[i].removeAttribute('readonly');
	}

	//array dei campi unselectable
	var ArrUnselectable = [allineamento, razza, classe, sesso];

	for(var i = 0; i < ArrUnselectable.length; i++){
		ArrUnselectable[i].removeAttribute('disabled');
	}
}