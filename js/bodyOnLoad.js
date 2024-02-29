//FUNZIONE CHE DEVE ESEGUIRE IL BODY DOPO AVER CARICATO UN PERSONAGGIO. SOSTANZIALMENTE CONTIENE TUTTE QUELLE FUNZIONI CHE DI NORMA VENGONO
//CHIAMATE SULL'ONCHANGE DI UN CAMPO, E CHE QUINDI NON VENGONO ESEGUITE AL MOMENTO DI CARICARE UN PERSONAGGIO, LASCIANDO DI FATTO DEI CAMPI VUOTI.
//LE RICHIAMO QUINDI QUI "MANUALMENTE".

function EseguiFunzioniJavascript(){
	//alimenta le due tabelle abilità di razza e di classe, leggendo la razza e la classe del personaggio
	selectAbilitaDiClasse('cbabclasse');
	selectAbilitaDiRazza('cbabrazza');

	//aggiusta i sottocampi della forza
	let energia = document.getElementById("valenergia");
	let muscoli = document.getElementById("valmuscoli");
	aggiustaSottocampiEnergia(energia.value);
	aggiustaSottocampiMuscoli(muscoli.value);

	//aggiusta i sottocampi della destrezza
	let mira = document.getElementById("valmira");
	let equilibrio = document.getElementById("valequilibrio");
	aggiustaSottocampiMira(mira.value);
	aggiustaSottocampiEquilibrio(equilibrio.value);

	//aggiusta i sottocampi della costituzione
	let salute = document.getElementById("valsalute");
	let formafisica = document.getElementById("valformafisica");
	aggiustaSottocampiSalute(salute.value);
	aggiustaSottocampiFormaFisica(formafisica.value);

	//aggiusta i sottocampi dell'intelligenza
	let ragione = document.getElementById("valragione");
	let conoscenza = document.getElementById("valconoscenza");
	aggiustaSottocampiRagione(ragione.value);
	aggiustaSottocampiConoscenza(conoscenza.value);

	//aggiusta i sottocampi della saggezza
	let intuizione = document.getElementById("valintuizione");
	let fdivolonta = document.getElementById("valfdivolonta");
	aggiustaSottocampiIntuizione(intuizione.value);
	aggiustaSottocampiFDiVolonta(fdivolonta.value);

	//aggiusta i sottocampi del carisma
	let comando = document.getElementById("valcomando");
	let fascino = document.getElementById("valfascino");
	aggiustaSottocampiComando(comando.value);
	aggiustaSottocampiFascino(fascino.value);

	//aggiusta i tiri salvezza
	let classe = document.getElementById('cls');
	let livello = document.getElementById('lvl');

	setTiriSalvezza(classe.value, livello.value);

	var arrTS = ['1', '2', '3', '4', '5'];
	for(var i = 0; i < arrTS.length; i++){
		checkMod(arrTS[i]);
	}

	//aggiusta i punti ferita
	ModificaRimanenti(1);

	//aggiusta le monete
	checkTotaleRicchezze();

	//aggiusta il totale delle abilità dei ladri
	checkTotaleAbilitaLadri();
}