
//Event Listeners per la tabella delle caratteristiche
var forza = document.getElementById("valforza");
if(forza != null) forza.addEventListener("change", checkForza);
var forzasec = document.getElementById("secvalforza");
if(forzasec != null) forzasec.addEventListener("change", checkSecForza);
var energia = document.getElementById("valenergia");
if(energia != null) energia.addEventListener("change", checkSkillForza);
var muscoli = document.getElementById("valmuscoli");
if(muscoli != null) muscoli.addEventListener("change", checkSkillForza);
var destrezza = document.getElementById("valdes");
if(destrezza != null) destrezza.addEventListener("change", checkDestrezza);
var mira = document.getElementById("valmira");
if(mira != null) mira.addEventListener("change", checkSkillDestrezza);
var equilibrio = document.getElementById("valequilibrio");
if(equilibrio != null) equilibrio.addEventListener("change", checkSkillDestrezza);
var costituzione = document.getElementById("valcos");
if(costituzione != null) costituzione.addEventListener("change", checkCostituzione);
var salute = document.getElementById("valsalute");
if(salute != null) salute.addEventListener("change", checkSkillCostituzione);
var formafisica = document.getElementById("valformafisica");
if(formafisica != null) addEventListener("change", checkSkillCostituzione);
var intelligenza = document.getElementById("valint");
if(intelligenza != null) intelligenza.addEventListener("change", checkIntelligenza);
var ragione = document.getElementById("valragione");
if(ragione != null) ragione.addEventListener("change", checkSkillIntelligenza);
var conoscenza = document.getElementById("valconoscenza");
if(conoscenza != null) conoscenza.addEventListener("change", checkSkillIntelligenza);
var saggezza = document.getElementById("valsag");
if(saggezza != null) saggezza.addEventListener("change", checkSaggezza);
var intuizione = document.getElementById("valintuizione");
if(intuizione != null) intuizione.addEventListener("change", checkSkillSaggezza);
var fdivolonta = document.getElementById("valfdivolonta");
if(fdivolonta != null) fdivolonta.addEventListener("change", checkSkillSaggezza);
var carisma = document.getElementById("valcar");
if(carisma != null) carisma.addEventListener("change", checkCarisma);
var comando = document.getElementById("valcomando");
if(comando != null) comando.addEventListener("change", checkSkillCarisma);
var fascino = document.getElementById("valfascino");
if(fascino != null) fascino.addEventListener("change", checkSkillCarisma);

//Event Listeners per la tabella dei tiri salvezza
var livello = document.getElementById("lvl");
if(livello != null) livello.addEventListener("change", checkClasseELivello);
var classe = document.getElementById("cls");
if(classe != null) classe.addEventListener("change", checkClasseELivello);
var mod1 = document.getElementById("valmod1");
if(mod1 != null) mod1.addEventListener("change", function(){checkMod('1')});
var mod2 = document.getElementById("valmod2");
if(mod2 != null) mod2.addEventListener("change", function(){checkMod('2')});
var mod3 = document.getElementById("valmod3");
if(mod3 != null) mod3.addEventListener("change", function(){checkMod('3')});
var mod4 = document.getElementById("valmod4");
if(mod4 != null) mod4.addEventListener("change", function(){checkMod('4')});
var mod5 = document.getElementById("valmod5");
if(mod5 != null) mod5.addEventListener("change", function(){checkMod('5')});

var bitArray = ["valforza", "secvalforza", "valenergia", "valmuscoli", "valdes", "valmira", "valequilibrio", "valcos", "valsalute", "valformafisica",
				"valint", "valragione", "valconoscenza", "valsag", "valintuizione", "valfdivolonta", "valcar", "valcomando", "valfascino"];

var bitArrayModTS = ["valmod1", "valmod2", "valmod3", "valmod4", "valmod5"];

var SfondiGialli = new clsBitMask(bitArray);
var SfondiGialliTS = new clsBitMask(bitArrayModTS);

//funzione chiamata piu volte dalle funzioni che devono correggere i valori dei sottocampi, in forma generica per abbreviare il codice
function aggiustaSottocampo(valorepadre, sottocampo, tabella){
	if (valorepadre >= 1 && valorepadre <= 25){
		sottocampo.value = tabella[valorepadre];
	} else {
		sottocampo.value = '';
	}
}

//***************************** FUNZIONI PER LA FORZA ***********************************

//funzione di servizio che calcola l'indice corretto della tabella
function secForzaToIndex(valsecforza){
	if (valsecforza >= 1 && valsecforza <= 50) return 1;
	if (valsecforza >= 51 && valsecforza <= 75) return 2;
	if (valsecforza >= 76 && valsecforza <= 90) return 3;
	if (valsecforza >= 91 && valsecforza <= 99) return 4;
	if (valsecforza == 100) return 5;
	return 0;
}

//funzione chiamata ogni volta che varia il campo primario della forza
function aggiustaSecvalforza(valforza) {
	let secforza = document.getElementById("secvalforza");
	if (valforza == 18) {
		SfondiGialli.setYellow(secforza);
		secforza.removeAttribute("readonly");
	} else {
		SfondiGialli.unsetYellow(secforza);
		secforza.value = '';
		if (!secforza.hasAttribute("readonly")) secforza.setAttribute("readonly", "readonly");
	}
}

//funzione chiamata ogni volta che cambia il valore della forza, o ogni volta che cambiano i valori delle skill della forza
function aggiustaSkillsForza(valforza) {
	let energia = document.getElementById("valenergia");
	let muscoli = document.getElementById("valmuscoli");

	if (valforza == '') {
		energia.value = '';
		muscoli.value = '';
		SfondiGialli.unsetYellow(muscoli);
		SfondiGialli.unsetYellow(energia);
	} else if((Number(energia.value) + Number(muscoli.value)) == (valforza * 2)){
		SfondiGialli.unsetYellow(muscoli);
		SfondiGialli.unsetYellow(energia);
	} else {
		SfondiGialli.setYellow(muscoli);
		SfondiGialli.setYellow(energia);
	}
	aggiustaSottocampiEnergia(energia.value);
	aggiustaSottocampiMuscoli(muscoli.value);
}

//funzione chiamata piu volte dalle funzioni che devono correggere i valori dei sottocampi, in forma generica per abbreviare il codice
function aggiustaSottocampoForza(valorepadre, sottocampo, tabella){
	let secforza = document.getElementById("secvalforza");

	if (valorepadre == 18) {
		let index = secForzaToIndex(secforza.value);
		sottocampo.value = tabella[valorepadre][index];
	} else if (valorepadre >= 1 && valorepadre <= 25){
		sottocampo.value = tabella[valorepadre];
	} else {
		sottocampo.value = '';
	}
}

//funzione chiamata ogni volta che viene modificato il valore secondario della forza oppure il valore dell'energia. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiEnergia(valenergia) {
	let pesotrasportabile = document.getElementById("valpesotrasp");
	
	aggiustaSottocampoForza(valenergia, pesotrasportabile, tabelle.tabPesoTrasportabile);

}

//funzione chiamata ogni volta che viene modificato il valore secondario della forza oppure il valore dei muscoli. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiMuscoli(valmuscoli) {
	let modcolpo = document.getElementById("valmodcolpo");
	let moddanni = document.getElementById("valmoddanni");
	let levamax = document.getElementById("vallevamax");
	let aprireporte = document.getElementById("valaprireporte");
	let piegaresbarre = document.getElementById("valpiegsbar");

	aggiustaSottocampoForza(valmuscoli, modcolpo, tabelle.tabModColpo);
	aggiustaSottocampoForza(valmuscoli, moddanni, tabelle.tabModDanni);
	aggiustaSottocampoForza(valmuscoli, levamax, tabelle.tabLevaMax);
	aggiustaSottocampoForza(valmuscoli, aprireporte, tabelle.tabAprirePorte);
	aggiustaSottocampoForza(valmuscoli, piegaresbarre, tabelle.tabPiegareSbarre);

}

//event handler del campo primario della forza
function checkForza(){
	// Gestisco il textbox valforza
	let forza = document.getElementById("valforza");
    let reNumeric = /^([1-9]|1[0-9]|2[0-5])$/;
    if (forza.value == '' || reNumeric.test(forza.value)) {
		SfondiGialli.unsetYellow(forza);
	} else {
		SfondiGialli.setYellow(forza);
	}
	// secvalforza = f(valforza) ==> chiamo la funzione che la gestisce
	aggiustaSecvalforza (forza.value);
	// valenergia  e valmuscoli = f(valforza) ==> chiamo la funzione che li gestisce
	aggiustaSkillsForza (forza.value);
}

//event handler del campo secondario della forza
function checkSecForza(){
	let secforza = document.getElementById("secvalforza");
	let energia = document.getElementById("valenergia");
	let muscoli = document.getElementById("valmuscoli");

	if (secforza.value >= 1 && secforza.value <= 100) {
		SfondiGialli.unsetYellow(secforza);
	} else {
		SfondiGialli.setYellow(secforza);
	}
	aggiustaSottocampiEnergia(energia.value);
	aggiustaSottocampiMuscoli(muscoli.value);

}

//event handler dei campi delle skill della forza (energia e muscoli)
function checkSkillForza(){
	let forza = document.getElementById("valforza");
	let energia = document.getElementById("valenergia");
	let muscoli = document.getElementById("valmuscoli");

	aggiustaSkillsForza(forza.value);

	if(Math.abs(Number(forza.value) - Number(energia.value)) > 2){
		SfondiGialli.setYellow(muscoli);
		SfondiGialli.setYellow(energia);
	}
	aggiustaSottocampiEnergia(energia.value);
	aggiustaSottocampiMuscoli(muscoli.value);
}

//***************************** FUNZIONI PER LA DESTREZZA ***********************************

//funzione chiamata ogni volta che viene modificato il valore della mira. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiMira(valmira) {
	let modlancio = document.getElementById("valmodlancio");
	
	aggiustaSottocampo(valmira, modlancio, tabelle.tabModLancioEReaz);

}

//funzione chiamata ogni volta che viene modificato il valore dell'equilibrio. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiEquilibrio(valequilibrio) {
	let modreaz = document.getElementById("valmodreaz");
	let moddifens = document.getElementById("valmoddifens");
	
	aggiustaSottocampo(valequilibrio, modreaz, tabelle.tabModLancioEReaz);
	aggiustaSottocampo(valequilibrio, moddifens, tabelle.tabModDifens);

}

//funzione chiamata ogni volta che cambia il valore della destrezza, o ogni volta che cambiano i valori delle skill della destrezza
function aggiustaSkillsDestrezza(valdestrezza) {
	let mira = document.getElementById("valmira");
	let equilibrio = document.getElementById("valequilibrio");

	if (valdestrezza == '') {
		mira.value = '';
		equilibrio.value = '';
		SfondiGialli.unsetYellow(mira);
		SfondiGialli.unsetYellow(equilibrio);		
	} else if((Number(mira.value) + Number(equilibrio.value)) == (valdestrezza * 2)){
		SfondiGialli.unsetYellow(mira);
		SfondiGialli.unsetYellow(equilibrio);
	} else {
		SfondiGialli.setYellow(mira);
		SfondiGialli.setYellow(equilibrio);
	}
	aggiustaSottocampiMira(mira.value);
	aggiustaSottocampiEquilibrio(equilibrio.value);
}

//event handler del campo della destrezza
function checkDestrezza(){
	// Gestisco il textbox valdes
	let destrezza = document.getElementById("valdes");
    let reNumeric = /^([1-9]|1[0-9]|2[0-5])$/;
    if (destrezza.value == '' || reNumeric.test(destrezza.value)) {
		SfondiGialli.unsetYellow(destrezza);	    	
	} else {
		SfondiGialli.setYellow(destrezza);	
	}
	// valmira  e valequilibrio = f(valdestrezza) ==> chiamo la funzione che li gestisce
	aggiustaSkillsDestrezza (destrezza.value);
}

//event handler dei campi delle skill della destrezza (mira e equilibrio)
function checkSkillDestrezza(){
	let destrezza = document.getElementById("valdes");
	let mira = document.getElementById("valmira");
	let equilibrio = document.getElementById("valequilibrio");

	aggiustaSkillsDestrezza(destrezza.value);

	if(Math.abs(Number(destrezza.value) - Number(mira.value)) > 2){
		SfondiGialli.setYellow(mira);
		SfondiGialli.setYellow(equilibrio);
	}
	aggiustaSottocampiMira(mira.value);
	aggiustaSottocampiEquilibrio(equilibrio.value);
}

//***************************** FUNZIONI PER LA COSTITUZIONE ***********************************

//funzione chiamata ogni volta che viene modificato il valore della salute. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiSalute(valsalute) {
	let choc = document.getElementById("valchoccorp");
	let tsvel = document.getElementById("valtsvel");
	
	aggiustaSottocampo(valsalute, choc, tabelle.tabChocCorporeo);
	aggiustaSottocampo(valsalute, tsvel, tabelle.tabTiroSalvVSVeleni);

}

//funzione chiamata ogni volta che viene modificato il valore della forma fisica. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiFormaFisica(valformafisica) {
	let modpf = document.getElementById("valmodpf");
	let probres = document.getElementById("valprobres");
	
	aggiustaSottocampo(valformafisica, modpf, tabelle.tabModPuntiFerita);
	aggiustaSottocampo(valformafisica, probres, tabelle.tabProbResurrezione);

}

//funzione chiamata ogni volta che cambia il valore della costituzione, o ogni volta che cambiano i valori delle skill della costituzione
function aggiustaSkillsCostituzione(valcostituzione) {
	let salute = document.getElementById("valsalute");
	let formafisica = document.getElementById("valformafisica");

	if (valcostituzione == '') {
		salute.value = '';
		formafisica.value = '';
		SfondiGialli.unsetYellow(salute);
		SfondiGialli.unsetYellow(formafisica);		
	} else if((Number(salute.value) + Number(formafisica.value)) == (valcostituzione * 2)){
		SfondiGialli.unsetYellow(salute);
		SfondiGialli.unsetYellow(formafisica);
	} else {
		SfondiGialli.setYellow(salute);
		SfondiGialli.setYellow(formafisica);
	}
	aggiustaSottocampiSalute(salute.value);
	aggiustaSottocampiFormaFisica(formafisica.value);
}

//event handler del campo della costituzione
function checkCostituzione(){
	// Gestisco il textbox valcos
	let costituzione = document.getElementById("valcos");
    let reNumeric = /^([1-9]|1[0-9]|2[0-5])$/;
    if (costituzione.value == '' || reNumeric.test(costituzione.value)) {
		SfondiGialli.unsetYellow(costituzione);	    	
	} else {
		SfondiGialli.setYellow(costituzione);	
	}
	// valsalute  e valformafisica = f(valcos) ==> chiamo la funzione che li gestisce
	aggiustaSkillsCostituzione (costituzione.value);
}

//event handler dei campi delle skill della costituzione (salute e forma fisica)
function checkSkillCostituzione(){
	let costituzione = document.getElementById("valcos");
	let salute = document.getElementById("valsalute");
	let formafisica = document.getElementById("valformafisica");

	aggiustaSkillsCostituzione(costituzione.value);

	if(Math.abs(Number(costituzione.value) - Number(salute.value)) > 2){
		SfondiGialli.setYellow(salute);
		SfondiGialli.setYellow(formafisica);
	}
	aggiustaSottocampiSalute(salute.value);
	aggiustaSottocampiFormaFisica(formafisica.value);
}

//***************************** FUNZIONI PER L'INTELLIGENZA ***********************************

//funzione chiamata ogni volta che viene modificato il valore della ragione. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiRagione(valragione) {
	let lvincantesimi = document.getElementById("vallivinc");
	let maxnumincantesimi = document.getElementById("valmaxinc");
	let immunitainc = document.getElementById("valimminc");
	
	aggiustaSottocampo(valragione, lvincantesimi, tabelle.tabLvIncantesimi);
	aggiustaSottocampo(valragione, maxnumincantesimi, tabelle.tabMaxNumIncantesimi);
	aggiustaSottocampo(valragione, immunitainc, tabelle.tabImmunitaInc);
}

//funzione chiamata ogni volta che viene modificato il valore della conoscenza. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiConoscenza(valconoscenza) {
	let profbonus = document.getElementById("valprofbonus");
	let impinc = document.getElementById("valimpinc");
	
	aggiustaSottocampo(valconoscenza, profbonus, tabelle.tabProficienzeBonus);
	aggiustaSottocampo(valconoscenza, impinc, tabelle.tabImparareIncantesimi);

}

//funzione chiamata ogni volta che cambia il valore dell'intelligenza, o ogni volta che cambiano i valori delle skill dell'intelligenza
function aggiustaSkillsIntelligenza(valintelligenza) {
	let ragione = document.getElementById("valragione");
	let conoscenza = document.getElementById("valconoscenza");

	if (valintelligenza == '') {
		ragione.value = '';
		conoscenza.value = '';
		SfondiGialli.unsetYellow(ragione);
		SfondiGialli.unsetYellow(conoscenza);		
	} else if((Number(ragione.value) + Number(conoscenza.value)) == (valintelligenza * 2)){
		SfondiGialli.unsetYellow(ragione);
		SfondiGialli.unsetYellow(conoscenza);
	} else {
		SfondiGialli.setYellow(ragione);
		SfondiGialli.setYellow(conoscenza);
	}
	aggiustaSottocampiRagione(ragione.value);
	aggiustaSottocampiConoscenza(conoscenza.value);
}

//event handler del campo dell'intelligenza
function checkIntelligenza(){
	// Gestisco il textbox valint
	let intelligenza = document.getElementById("valint");
    let reNumeric = /^([1-9]|1[0-9]|2[0-5])$/;
    if (intelligenza.value == '' || reNumeric.test(intelligenza.value)) {
		SfondiGialli.unsetYellow(intelligenza);	    	
	} else {
		SfondiGialli.setYellow(intelligenza);	
	}
	// valragione  e valconoscenza = f(valint) ==> chiamo la funzione che li gestisce
	aggiustaSkillsIntelligenza (intelligenza.value);
}

//event handler dei campi delle skill dell'intelligenza (ragione e conoscenza)
function checkSkillIntelligenza(){
	let intelligenza = document.getElementById("valint");
	let ragione = document.getElementById("valragione");
	let conoscenza = document.getElementById("valconoscenza");

	aggiustaSkillsIntelligenza(intelligenza.value);

	if(Math.abs(Number(intelligenza.value) - Number(ragione.value)) > 2){
		SfondiGialli.setYellow(ragione);
		SfondiGialli.setYellow(conoscenza);
	}
	aggiustaSottocampiRagione(ragione.value);
	aggiustaSottocampiConoscenza(conoscenza.value);
}

//***************************** FUNZIONI PER LA SAGGEZZA ***********************************

//funzione chiamata ogni volta che viene modificato il valore dell'intuizione. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiIntuizione(valintuizione) {
	let incantesimibonus = document.getElementById("valincbonus");
	let fallireincantesimi = document.getElementById("valfallinc");
	
	aggiustaSottocampo(valintuizione, incantesimibonus, tabelle.tabIncantesimiBonus);
	aggiustaSottocampo(valintuizione, fallireincantesimi, tabelle.tabFallireIncantesimi);
}

//funzione chiamata ogni volta che viene modificato il valore della f. di volonta. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiFDiVolonta(valfdivolonta) {
	let moddifesamagia = document.getElementById("valmoddifmag");
	let immunitaincsag = document.getElementById("valimmunitainc");
	
	aggiustaSottocampo(valfdivolonta, moddifesamagia, tabelle.tabModDifesaMagia);
	aggiustaSottocampo(valfdivolonta, immunitaincsag, tabelle.tabImmunitaIncantesimi);

}

//funzione chiamata ogni volta che cambia il valore della saggezza, o ogni volta che cambiano i valori delle skill della saggezza
function aggiustaSkillsSaggezza(valsaggezza) {
	let intuizione = document.getElementById("valintuizione");
	let fdivolonta = document.getElementById("valfdivolonta");

	if (valsaggezza == '') {
		intuizione.value = '';
		fdivolonta.value = '';
		SfondiGialli.unsetYellow(intuizione);
		SfondiGialli.unsetYellow(fdivolonta);		
	} else if((Number(intuizione.value) + Number(fdivolonta.value)) == (valsaggezza * 2)){
		SfondiGialli.unsetYellow(intuizione);
		SfondiGialli.unsetYellow(fdivolonta);
	} else {
		SfondiGialli.setYellow(intuizione);
		SfondiGialli.setYellow(fdivolonta);
	}
	aggiustaSottocampiIntuizione(intuizione.value);
	aggiustaSottocampiFDiVolonta(fdivolonta.value);
}

//event handler del campo della saggezza
function checkSaggezza(){
	// Gestisco il textbox valsag
	let saggezza = document.getElementById("valsag");
    let reNumeric = /^([1-9]|1[0-9]|2[0-5])$/;
    if (saggezza.value == '' || reNumeric.test(saggezza.value)) {
		SfondiGialli.unsetYellow(saggezza);	    	
	} else {
		SfondiGialli.setYellow(saggezza);	
	}
	// valintuizione  e valfdivolonta = f(valsag) ==> chiamo la funzione che li gestisce
	aggiustaSkillsSaggezza (saggezza.value);
}

//event handler dei campi delle skill della saggezza (intuizione e f. di volonta)
function checkSkillSaggezza(){
	let saggezza = document.getElementById("valsag");
	let intuizione = document.getElementById("valintuizione");
	let fdivolonta = document.getElementById("valfdivolonta");

	aggiustaSkillsSaggezza(saggezza.value);

	if(Math.abs(Number(saggezza.value) - Number(intuizione.value)) > 2){
		SfondiGialli.setYellow(intuizione);
		SfondiGialli.setYellow(fdivolonta);
	}
	aggiustaSottocampiIntuizione(intuizione.value);
	aggiustaSottocampiFDiVolonta(fdivolonta.value);
}

//***************************** FUNZIONI PER IL CARISMA ***********************************

//funzione chiamata ogni volta che viene modificato il valore del comando. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiComando(valcomando) {
	let fattorefedelta = document.getElementById("valfattorefed");
	let maxnumseguaci = document.getElementById("valmaxseguaci");
	
	aggiustaSottocampo(valcomando, fattorefedelta, tabelle.tabFattoreFedelta);
	aggiustaSottocampo(valcomando, maxnumseguaci, tabelle.tabMaxNumeroSeguaci);
}

//funzione chiamata ogni volta che viene modificato il valore del fascino. Mette il corretto valore ai sottocampi.
function aggiustaSottocampiFascino(valfascino) {
	let modreazionicarisma = document.getElementById("valmodreazcar");

	aggiustaSottocampo(valfascino, modreazionicarisma, tabelle.tabModReazioniCarisma);

}

//funzione chiamata ogni volta che cambia il valore del carisma, o ogni volta che cambiano i valori delle skill del carisma
function aggiustaSkillsCarisma(valcarisma) {
	let comando = document.getElementById("valcomando");
	let fascino = document.getElementById("valfascino");

	if (valcarisma == '') {
		comando.value = '';
		fascino.value = '';
		SfondiGialli.unsetYellow(comando);
		SfondiGialli.unsetYellow(fascino);		
	} else if((Number(comando.value) + Number(fascino.value)) == (valcarisma * 2)){
		SfondiGialli.unsetYellow(comando);
		SfondiGialli.unsetYellow(fascino);
	} else {
		SfondiGialli.setYellow(comando);
		SfondiGialli.setYellow(fascino);
	}
	aggiustaSottocampiComando(comando.value);
	aggiustaSottocampiFascino(fascino.value);
}

//event handler del campo del carisma
function checkCarisma(){
	// Gestisco il textbox valcar
	let carisma = document.getElementById("valcar");
    let reNumeric = /^([1-9]|1[0-9]|2[0-5])$/;
    if (carisma.value == '' || reNumeric.test(carisma.value)) {
		SfondiGialli.unsetYellow(carisma);	    	
	} else {
		SfondiGialli.setYellow(carisma);	
	}
	// valcomando  e valfascino = f(valcar) ==> chiamo la funzione che li gestisce
	aggiustaSkillsCarisma (carisma.value);
}

//event handler dei campi delle skill del carisma (comando e fascino)
function checkSkillCarisma(){
	let carisma = document.getElementById("valcar");
	let comando = document.getElementById("valcomando");
	let fascino = document.getElementById("valfascino");

	aggiustaSkillsCarisma(carisma.value);

	if(Math.abs(Number(carisma.value) - Number(comando.value)) > 2){
		SfondiGialli.setYellow(comando);
		SfondiGialli.setYellow(fascino);
	}
	aggiustaSottocampiComando(comando.value);
	aggiustaSottocampiFascino(fascino.value);
}

//***************FUNZIONI PER I TIRI SALVEZZA********************

function aggiustaTiriSalvezza(tabella){
	let valsalv = 
	[
		document.getElementById("valsalv1"),
	    document.getElementById("valsalv2"),
	    document.getElementById("valsalv3"),
	    document.getElementById("valsalv4"),
	    document.getElementById("valsalv5")
    ];

    let valmod = 
    [
    	document.getElementById("valmod1"),
    	document.getElementById("valmod2"),
    	document.getElementById("valmod3"),
    	document.getElementById("valmod4"),
    	document.getElementById("valmod5")
    ];

    for(var i = 0; i < valsalv.length; i++){
    	valsalv[i].value = tabella[i] - (valmod[i].value == null ? 0 : Number(valmod[i].value));
    }

}

//crea il nome della tabella da dove prendere le informazioni e chiama la funzione che riempie i campi
function putTiriSalvezza(categoria, livello){
	let numero;

	switch (categoria){
		case 'Combattente':
			numero = Math.min(9, Math.ceil(livello / 2)); // 1 ogni 2 fino a un massimo di 9
			break;
		case 'Stregone':
			numero = Math.min(5, Math.ceil(livello / 5)); // // 1 ogni 5 fino a un massimo di 5
			break;
		case 'Sacerdote':
			numero = Math.min(7, Math.ceil(livello / 3));  //  // 1 ogni 3 fino a un massimo di 7
			break;
		case 'Vagabondo':
			numero = Math.min(6, Math.ceil(livello / 4)); //  // 1 ogni 4 fino a un massimo di 6
			break;
		default: null;
	}

	let nometabella = 'tab' + categoria + numero;
	aggiustaTiriSalvezza(tabelle[nometabella]);
}

function setTiriSalvezza(classe, livello){
	if (classe == 1 || classe == 2 || classe == 3) putTiriSalvezza('Combattente', livello);
	else if (classe == 4) putTiriSalvezza('Stregone', livello);
	else if (classe == 5 || classe == 6) putTiriSalvezza('Sacerdote', livello);
	else if (classe == 7 || classe == 8) putTiriSalvezza('Vagabondo', livello);
}

function svuotaTiriSalvezza(){
	let valsalv = 
	[
		document.getElementById("valsalv1"),
	    document.getElementById("valsalv2"),
	    document.getElementById("valsalv3"),
	    document.getElementById("valsalv4"),
	    document.getElementById("valsalv5")
    ];

    for(var i = 0; i < valsalv.length; i++){
    	valsalv[i].value = '';
    }

}

function checkClasseELivello(){
	let classe = document.getElementById("cls");
	let livello = document.getElementById("lvl");

	if (classe.value == 'nochoice' || livello.value == ''){
		svuotaTiriSalvezza();
		return;	
	} 

	setTiriSalvezza(classe.value, livello.value);
}

//mi serve sapere qual era lo scorso modificatore e qual e adesso
var valmod1 = document.getElementById("valmod1");
if(valmod1 != null) var prevmod1 = (valmod1.value != null ? Number(valmod1.value) : 0);
var valmod2 = document.getElementById("valmod2");
if(valmod2 != null) var prevmod2 = (valmod2.value != null ? Number(valmod2.value) : 0);
var valmod3 = document.getElementById("valmod3");
if(valmod3 != null) var prevmod3 = (valmod3.value != null ? Number(valmod3.value) : 0);
var valmod4 = document.getElementById("valmod4");
if(valmod4 != null) var prevmod4 = (valmod4.value != null ? Number(valmod4.value) : 0);
var valmod5 = document.getElementById("valmod5");
if(valmod5 != null) var prevmod5 = (valmod5.value != null ? Number(valmod5.value) : 0);

function checkMod(val){
	let valmod = document.getElementById("valmod" + val);
	let valsalv = document.getElementById("valsalv" + val);

	let reNumeric = /^(\+|-)[1-9][0-9]*$/;
    if (valmod.value == '' || reNumeric.test(valmod.value)) {
		SfondiGialliTS.unsetYellow(valmod);
	} else {
		SfondiGialliTS.setYellow(valmod);
		return;
	}

	switch(val){
		case '1':
			valsalv.value = Number(valsalv.value) + prevmod1 - (valmod.value == null ? 0 : Number(valmod.value));
			prevmod1 = Number(valmod.value);
			break;
		case '2':
			valsalv.value = Number(valsalv.value) + prevmod2 - (valmod.value == null ? 0 : Number(valmod.value));
			prevmod2 = Number(valmod.value);
			break;
		case '3':
			valsalv.value = Number(valsalv.value) + prevmod3 - (valmod.value == null ? 0 : Number(valmod.value));
			prevmod3 = Number(valmod.value);
			break;
		case '4':
			valsalv.value = Number(valsalv.value) + prevmod4 - (valmod.value == null ? 0 : Number(valmod.value));
			prevmod4 = Number(valmod.value);
			break;
		case '5':
			valsalv.value = Number(valsalv.value) + prevmod5 - (valmod.value == null ? 0 : Number(valmod.value));
			prevmod5 = Number(valmod.value);
			break;
		default: null;
	}
}