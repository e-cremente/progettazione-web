var BtnSalvaAbilitaLadri = document.getElementById('BtnSalvaAbilitaLadri');
if(BtnSalvaAbilitaLadri != null) BtnSalvaAbilitaLadri.addEventListener('click', ValidateAbilitaDeiLadri);
var BtnModificaAbilitaLadri = document.getElementById('BtnModificaAbilitaLadri');
if(BtnModificaAbilitaLadri != null) BtnModificaAbilitaLadri.addEventListener('click', ModificaAbilitaLadriUIonModifica);

function ValidateAbilitaDeiLadri(){
	var errmsg = document.getElementById('msgerrabilitaladri');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	if(SfondiGialliAbilitaLadri.maschera != 0){
		var msg = document.createTextNode("Assicurati di riempire correttamente i campi a sfondo giallo!");
		errmsg.appendChild(msg);
		errmsg.removeAttribute("hidden");
		return false;
	}

	var idPersonaggio = document.getElementById('idPersonaggio');

	var ArrayColonna = ['-base', '-razza', '-destr', '-arm', '-tratti', '-oggetti', '-livello', '-speciale'];
	var ArrayRiga = ['svuotaretasche', 'scassinareserrature', 'trappole', 'movsil', 'nascondersi', 'sentirerumori', 'scalarepareti', 'letturalinguaggi',
                 'individuazionemagico', 'individuazioneillusioni', 'corrompere', 'scavarepassaggi', 'svincolarsi'];

    var ArrayTotali = ['valsvuotaretasche-totale', 'valscassinareserrature-totale', 'valtrappole-totale', 'valmovsil-totale', 'valnascondersi-totale',
	                   'valsentirerumori-totale', 'valscalarepareti-totale', 'valletturalinguaggi-totale', 'valindividuazionemagico-totale',
	                   'valindividuazioneillusioni-totale', 'valcorrompere-totale', 'valscavarepassaggi-totale', 'valsvincolarsi-totale'];

	for(var i = 0; i < ArrayTotali.length; i++){
		if(document.getElementById(ArrayTotali[i]).value == '') continue;

		var qs = 'ToCall=InsUpdAbilitaDeiLadri';
		qs += '&idPersonaggio=' + idPersonaggio.value;
		qs += '&pIdAbilitaladri=' + (i+1);
		qs += '&pBase=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[0]).value, null);
		qs += '&pRazza=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[1]).value, null);
		qs += '&pDestr=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[2]).value, null);
		qs += '&pArm=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[3]).value, null);
		qs += '&pTratti=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[4]).value, null);
		qs += '&pOggetti=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[5]).value, null);
		qs += '&pLivello=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[6]).value, null);
		qs += '&pSpeciale=' + isNull(document.getElementById('val'+ArrayRiga[i]+ArrayColonna[7]).value, null);


		ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdAbilitaDeiLadriSuccess);
	}

	var Pugnalare = document.getElementById('valpugnalaretotale');

	if (Pugnalare.value != '') {
		var qs = 'ToCall=InsUpdAbilitaDeiLadri';
		qs += '&idPersonaggio=' + idPersonaggio.value;
		qs += '&pIdAbilitaladri=14';
		qs += '&pBase=' + Pugnalare.value;
		qs += '&pRazza=' + null;
		qs += '&pDestr=' + null;
		qs += '&pArm=' + null;
		qs += '&pTratti=' + null;
		qs += '&pOggetti=' + null;
		qs += '&pLivello=' + null;
		qs += '&pSpeciale=' + null;

		ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onInsUpdAbilitaDeiLadriSuccess);
	}

}


function onInsUpdAbilitaDeiLadriSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaAbilitaLadriUIonSave();	
}

function ModificaAbilitaLadriUIonSave(){
	btnModifica = document.getElementById('BtnModificaAbilitaLadri');
	btnSalva = document.getElementById('BtnSalvaAbilitaLadri');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setAbilitaLadriReadonly();
	}
}

function setAbilitaLadriReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var ArrayColonna = ['-base', '-razza', '-destr', '-arm', '-tratti', '-oggetti', '-livello', '-speciale'];
	var ArrayRiga = ['svuotaretasche', 'scassinareserrature', 'trappole', 'movsil', 'nascondersi', 'sentirerumori', 'scalarepareti', 'letturalinguaggi',
                 'individuazionemagico', 'individuazioneillusioni', 'corrompere', 'scavarepassaggi', 'svincolarsi'];

    for(var i = 0; i < ArrayRiga.length; i++){
    	for(var j = 0; j < ArrayColonna.length; j++){
    		var obj = document.getElementById('val'+ArrayRiga[i]+ArrayColonna[j]);
    		obj.setAttribute('readonly', 'readonly');
    	}
	}
}

function ModificaAbilitaLadriUIonModifica(){
	unsetAbilitaLadriReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	btnModifica = document.getElementById('BtnModificaAbilitaLadri');
	btnSalva = document.getElementById('BtnSalvaAbilitaLadri');

	btnSalva.removeAttribute('hidden');
	btnModifica.setAttribute('hidden', 'hidden');
}

function unsetAbilitaLadriReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var ArrayColonna = ['-base', '-razza', '-destr', '-arm', '-tratti', '-oggetti', '-livello', '-speciale'];
	var ArrayRiga = ['svuotaretasche', 'scassinareserrature', 'trappole', 'movsil', 'nascondersi', 'sentirerumori', 'scalarepareti', 'letturalinguaggi',
                 'individuazionemagico', 'individuazioneillusioni', 'corrompere', 'scavarepassaggi', 'svincolarsi'];

    for(var i = 0; i < ArrayRiga.length; i++){
    	for(var j = 0; j < ArrayColonna.length; j++){
    		var obj = document.getElementById('val'+ArrayRiga[i]+ArrayColonna[j]);
    		obj.removeAttribute('readonly');
    	}
	}
}