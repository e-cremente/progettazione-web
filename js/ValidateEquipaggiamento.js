var BtnSalvaEquipaggiamento = document.getElementById('BtnSalvaEquipaggiamento');
if(BtnSalvaEquipaggiamento != null) BtnSalvaEquipaggiamento.addEventListener('click', ValidateEquipaggiamento);
var BtnModificaEquipaggiamento = document.getElementById('BtnModificaEquipaggiamento');
if(BtnModificaEquipaggiamento != null) BtnModificaEquipaggiamento.addEventListener('click', ModificaEquipaggiamentoUIonModifica);

function ValidateEquipaggiamento(){
	var errmsg = document.getElementById('msgerrequipaggiamento');
	if(errmsg.hasChildNodes()) errmsg.removeChild(errmsg.childNodes[0]);
	errmsg.setAttribute("hidden", "hidden");

	var idPersonaggio = document.getElementById('idPersonaggio');
	var Equipaggiamento = document.getElementById('equipaggiamento');

	var qs = 'ToCall=UpdEquipaggiamento';
	qs += '&idPersonaggio=' + idPersonaggio.value;
	qs += '&pEquipaggiamento=' + Equipaggiamento.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onUpdEquipaggiamentoSuccess);
}

function onUpdEquipaggiamentoSuccess(pResponseText) {
	// la risposta ok è: success=<messaggio>
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	ModificaEquipaggiamentoUIonSave();	
}

function ModificaEquipaggiamentoUIonSave(){
	btnModifica = document.getElementById('BtnModificaEquipaggiamento');
	btnSalva = document.getElementById('BtnSalvaEquipaggiamento');
	if(!btnSalva.hasAttribute('hidden')){
		btnSalva.setAttribute('hidden', 'hidden');
		btnModifica.removeAttribute('hidden');
		setEquipaggiamentoReadonly();
	}
}

function setEquipaggiamentoReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var Equipaggiamento = document.getElementById('equipaggiamento');

    Equipaggiamento.setAttribute('readonly', 'readonly');
}

function ModificaEquipaggiamentoUIonModifica(){
	unsetEquipaggiamentoReadonly();

	//nascondo il tasto di modifica e rendo nuovamente visibile quello del salvataggio
	var BtnSalvaEquipaggiamento = document.getElementById('BtnSalvaEquipaggiamento');
	var BtnModificaEquipaggiamento = document.getElementById('BtnModificaEquipaggiamento');

	BtnSalvaEquipaggiamento.removeAttribute('hidden');
	BtnModificaEquipaggiamento.setAttribute('hidden', 'hidden');
}

function unsetEquipaggiamentoReadonly(){
	//creo un array con le textbox che devono essere messe a readonly
	var Equipaggiamento = document.getElementById('equipaggiamento');

    Equipaggiamento.removeAttribute('readonly');
}