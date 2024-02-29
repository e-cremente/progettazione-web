var btnEliminaPersonaggio = document.getElementById('BtnEliminaPersonaggio');
if(btnEliminaPersonaggio != null) btnEliminaPersonaggio.addEventListener('click', EliminaPersonaggio);

function EliminaPersonaggio(){
	if(!confirm('Sei sicuro di voler eliminare questo personaggio?\nATTENZIONE: QUESTA AZIONE È IRREVERSIBILE')){
		return false;
	}

	var qs = 'ToCall=DelPersonaggio';
	qs += '&idPersonaggio=' + idPersonaggio.value;

	ajaxRequestPost('funcs/AjaxRequestHandler.php', qs, onDelPersonaggioSuccess);

	
}

function onDelPersonaggioSuccess(pResponseText) {
	// la risposta ok è: success=...
	//alert(pResponseText);	
	var ResTextArray = pResponseText.split('=');
	if(ResTextArray[0] != "success") return alert('Si sono verificati dei problemi con il server, per favore riprovare più tardi');
	if (pResponseText == 'success=true') alert('Il personaggio è stato eliminato');
	location.assign('/RPADnD2Ed/index.php');
}