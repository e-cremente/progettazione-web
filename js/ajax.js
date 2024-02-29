function ajaxRequestGet(pPage, pValue, pSuccessFun){
	//var xmlHttp = new XMLHttpRequest();
	try { xmlHttp = new XMLHttpRequest(); }
	catch (e) {
		try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } //IE (recent versions)
		catch (e) {
			try { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); }
			//IE (older versions)
			catch (e) {
				window.alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	xmlHttp.onreadystatechange = function () {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			pSuccessFun(JSON.parse(xmlHttp.responseText));
		}
	}
	xmlHttp.open("GET", pPage+"?"+pValue, true);
	xmlHttp.send();
} 

/*function useHttpResponseGet() {
	if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		var recSet = JSON.parse(xmlHttp.responseText);
		switch (gvCaller){
			case "getArmiCategoria":

				gestisciResponseArmi(recSet);
				break;
			case "aggiungiArma":
				gestisciResponseAggiungiArma(recSet);
				break;
			default: null;
		}
	}
}*/

function ajaxRequestPost(pPage, pValue, pSuccessFun){
	try { xmlHttp = new XMLHttpRequest(); }
	catch (e) {
		try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } //IE (recent versions)
		catch (e) {
			try { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); }
			//IE (older versions)
			catch (e) {
				window.alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	xmlHttp.open("POST", pPage);
	xmlHttp.onreadystatechange = function () {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			pSuccessFun(JSON.parse(xmlHttp.responseText));
		}
	}
	xmlHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttp.send(pValue);
}


