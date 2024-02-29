
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
				"valint", "valragione", "valconoscenza", "valsag", "valintuizione", "valfdivolonta", "valcar", "valcomando", "valfascino",
				"valmod1", "valmod2", "valmod3", "valmod4", "valmod5"];

var SfondiGialli = new clsBitMask(bitArray);

function ValidateForm(){
	if (SfondiGialli.maschera > 0) {
		alert('Riempire correttamente i campi con sfondo giallo');
		return false;
	}
	//lvRisposta = confirm('Sei sicuro di voler procedere con la creazione del personaggio?');
	if (lvRisposta == false) return false;
	return true;
}


/*
bitmask ={
	"valforza":       0b000000000000000000000001,
	"secvalforza":    0b000000000000000000000010,
	"valenergia":     0b000000000000000000000100,
	"valmuscoli":     0b000000000000000000001000,
	"valdes":         0b000000000000000000010000,
	"valmira":        0b000000000000000000100000,
	"valequilibrio":  0b000000000000000001000000,
	"valcos":         0b000000000000000010000000,
	"valsalute":      0b000000000000000100000000,
	"valformafisica": 0b000000000000001000000000,
	"valint":         0b000000000000010000000000,
	"valragione":     0b000000000000100000000000,
	"valconoscenza":  0b000000000001000000000000,
	"valsag":         0b000000000010000000000000,
	"valintuizione":  0b000000000100000000000000,
	"valfdivolonta":  0b000000001000000000000000,
	"valcar":         0b000000010000000000000000,
	"valcomando":     0b000000100000000000000000,
	"valfascino":     0b000001000000000000000000,
	"valmod1": 		  0b000010000000000000000000,
	"valmod2":        0b000100000000000000000000,
	"valmod3":        0b001000000000000000000000,
	"valmod4":        0b010000000000000000000000,
	"valmod5":        0b100000000000000000000000,
}

function setYellow(pCtrl){
	pCtrl.style.backgroundColor = 'yellow';	
	SfondiGialli |= bitmask[pCtrl.name];
}

function unsetYellow(pCtrl){
	pCtrl.style.backgroundColor = 'white';		
	SfondiGialli &= ~bitmask[pCtrl.name];
}
*/
//l'oggetto tabelle contiene tutte le tabelle presenti nel manuale riguardanti le caratteristiche principali, con i relativi valori
tabelle = {

	tabPesoTrasportabile: {
		1: 0.5, 2: 0.5,
		3: 2.5,
		4: 4.5, 5: 4.5,
		6: 9.0, 7: 9.0,
		8: 16.0, 9: 16.0,
		10: 18.0, 11: 18.0,
		12: 20.5, 13: 20.5,
		14: 25.0, 15: 25.0,
		16: 31.5,
		17: 38.5,
		18: [49.5, 61, 72, 83.5, 106, 151],
		19: 218.5,
		20: 241.0,
		21: 286.0,
		22: 353.5,
		23: 421.0,
		24: 556.0,
		25: 691.0
	},

	tabModColpo: {
		1: '-5', 
		2: '-3', 3: '-3',
		4: '-2', 5: '-2',
		6: '-1', 7: '-1',
		8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 15: 0, 16: 0,
		17: '+1',
		18: ['+1', '+1', '+2', '+2', '+2', '+3'],
		19: '+3', 20: '+3',
		21: '+4', 22: '+4',
		23: '+5',
		24: '+6',
		25: '+7'
	},

	tabModDanni: {
		1: '-4', 
		2: '-2', 
		3: '-1', 4: '-1', 
		5: 0, 6: 0, 7: 0, 8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 15: 0, 
		16: '+1', 17: '+1',
		18: ['+2', '+3', '+3', '+4', '+5', '+6'],
		19: '+7', 
		20: '+8',
		21: '+9', 
		22: '+10',
		23: '+11',
		24: '+12',
		25: '+14'
	},

	tabLevaMax: {
		1: 1.5, 
		2: 2.5, 
		3: 4.5, 
		4: 11.5, 5: 11.5, 
		6: 25, 7: 25, 
		8: 40.5, 9: 40.5, 
		10: 49.5, 11: 49.5, 
		12: 63, 13: 63, 
		14: 76.5, 15: 76.5, 
		16: 88, 
		17: 99,
		18: [115, 126, 137.5, 148.5, 171, 216],
		19: 288, 
		20: 315,
		21: 364.5, 
		22: 436.5,
		23: 508.5,
		24: 648,
		25: 787.5
	}, 

	tabAprirePorte: {
		1: 1, 2: 1, 
		3: 2, 
		4: 3, 5: 3, 
		6: 4, 7: 4, 
		8: 5, 9: 5, 
		10: 6, 11: 6, 
		12: 7, 13: 7, 
		14: 8, 15: 8, 
		16: 9, 
		17: 10,
		18: [11, 12, 13, 14, '15(3)', '16(6)'],
		19: '16(8)', 
		20: '17(10)',
		21: '17(12)', 
		22: '18(14)',
		23: '18(16)',
		24: '19(17)',
		25: '19(18)'
	}, 

	tabPiegareSbarre: {
		1: '0%', 2: '0%', 3: '0%', 4: '0%', 5: '0%', 6: '0%', 7: '0%', 
		8: '1%', 9: '1%', 
		10: '2%', 11: '2%', 
		12: '4%', 13: '4%', 
		14: '7%', 15: '7%', 
		16: '10%', 
		17: '13%',
		18: ['16%', '20%', '25%', '30%', '35%', '40%'],
		19: '50%', 
		20: '60%',
		21: '70%', 
		22: '80%',
		23: '90%',
		24: '95%',
		25: '99%'
	}, 

	tabModLancioEReaz: {
		1: '-6', 
		2: '-4', 
		3: '-3', 
		4: '-2', 
		5: '-1', 
		6: 0, 7: 0, 8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 15: 0, 
		16: '+1', 
		17: '+2', 18: '+2',
		19: '+3', 20: '+3',
		21: '+4', 22: '+4', 23: '+4',
		24: '+5', 25: '+5'
	}, 

	tabModDifens: {
		1: '+5', 2: '+5', 
		3: '+4', 
		4: '+3', 
		5: '+2', 
		6: '+1',
		7: 0, 8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 
		15: '-1', 
		16: '-2', 
		17: '-3', 
		18: '-4', 19: '-4', 20: '-4',
		21: '-5', 22: '-5', 23: '-5',
		24: '-6', 25: '-6'
	}, 

	tabChocCorporeo: {
		1: '25%', 
		2: '30%', 
		3: '35%', 
		4: '40%', 
		5: '45%', 
		6: '50%',
		7: '55%', 
		8: '60%', 
		9: '65%', 
		10: '70%', 
		11: '75%', 
		12: '80%', 
		13: '85%', 
		14: '88%', 
		15: '90%', 
		16: '95%', 
		17: '97%', 
		18: '99%', 19: '99%', 20: '99%', 21: '99%', 22: '99%', 23: '99%', 24: '99%', 
		25: '100%'
	}, 

	tabTiroSalvVSVeleni: {
		1: '-2', 
		2: '-1', 
		3: 0, 4: 0, 5: 0, 6: 0, 7: 0, 8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 15: 0, 16: 0, 17: 0, 18: 0, 
		19: '+1', 20: '+1', 
		21: '+2', 22: '+2', 
		23: '+3', 24: '+3', 
		25: '+4'
	}, 

	tabModPuntiFerita: {
		1: '-3', 
		2: '-2', 3: '-2',
		4: '-1', 5: '-1', 6: '-1',
		7: 0, 8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 
		15: '+1', 
		16: '+2', 
		17: '+2(+3)', 
		18: '+2(+4)', 
		19: '+2(+5)', 20: '+2(+5)', 
		21: '+2(+6)', 22: '+2(+6)', 23: '+2(+6)', 
		24: '+2(+7)', 25: '+2(+7)'
	}, 

	tabProbResurrezione: {
		1: '30%', 
		2: '35%', 
		3: '40%', 
		4: '45%', 
		5: '50%',
		6: '55%', 
		7: '60%', 
		8: '65%', 
		9: '70%', 
		10: '75%', 
		11: '80%', 
		12: '85%', 
		13: '90%', 
		14: '92%',
		15: '94%', 
		16: '96%', 
		17: '98%', 
		18: '100%', 19: '100%', 20: '100%', 21: '100%', 22: '100%', 23: '100%', 24: '100%', 25: '100%'
	}, 

	tabLvIncantesimi: {
		1: '-', 2: '-', 3: '-', 4: '-', 5: '-',6: '-', 7: '-', 8: '-', 
		9: '4°', 
		10: '5°', 11: '5°', 
		12: '6°', 13: '6°', 
		14: '7°', 15: '7°', 
		16: '8°', 17: '8°', 
		18: '9°', 19: '9°', 20: '9°', 21: '9°', 22: '9°', 23: '9°', 24: '9°', 25: '9°'
	}, 

	tabMaxNumIncantesimi: {
		1: '-', 2: '-', 3: '-', 4: '-', 5: '-',6: '-', 7: '-', 8: '-', 
		9: '6', 
		10: '7', 11: '7', 12: '7', 
		13: '9', 14: '9', 
		15: '11', 16: '11', 
		17: '14', 
		18: '18', 
		19: 'Tutti', 20: 'Tutti', 21: 'Tutti', 22: 'Tutti', 23: 'Tutti', 24: 'Tutti', 25: 'Tutti'
	}, 

	tabImmunitaInc: {
		1: '-', 2: '-', 3: '-', 4: '-', 5: '-',6: '-', 7: '-', 8: '-', 9: '-', 10: '-', 11: '-', 12: '-', 13: '-', 14: '-', 15: '-', 16: '-', 17: '-', 18: '-', 
		19: '1° liv', 
		20: '2° liv', 
		21: '3° liv', 
		22: '4° liv', 
		23: '5° liv', 
		24: '6° liv', 
		25: '7° liv'
	}, 

	tabProficienzeBonus: {
		1: 0, 
		2: 1, 3: 1, 4: 1, 5: 1,6: 1, 7: 1, 8: 1, 
		9: 2, 10: 2, 11: 2, 
		12: 3, 13: 3, 
		14: 4, 15: 4, 
		16: 5, 
		17: 6, 
		18: 7, 
		19: 8, 
		20: 9, 
		21: 10, 
		22: 11, 
		23: 12, 
		24: 15, 
		25: 20
	}, 

	tabImparareIncantesimi: {
		1: '-', 2: '-', 3: '-', 4: '-', 5: '-',6: '-', 7: '-', 8: '-', 
		9: '35%', 
		10: '40%', 
		11: '45%', 
		12: '50%', 
		13: '55%', 
		14: '60%', 
		15: '65%', 
		16: '70%', 
		17: '75%', 
		18: '85%', 
		19: '95%', 
		20: '96%', 
		21: '97%', 
		22: '98%', 
		23: '99%', 
		24: '100%', 
		25: '100%'
	}, 

	tabIncantesimiBonus: {
		1: '-', 2: '-', 3: '-', 4: '-', 5: '-',6: '-', 7: '-', 8: '-', 
		9: 0, 10: 0, 11: 0, 12: 0, 
		13: '1°', 14: '1°', 
		15: '2°', 16: '2°', 
		17: '3°', 
		18: '4°', 
		19: '1°,3°', 
		20: '2°,4°', 
		21: '3°,5°', 
		22: '4°,5°', 
		23: '1°,6°', 
		24: '5°,6°', 
		25: '6°,7°'
	}, 

	tabFallireIncantesimi: {
		1: '80%', 
		2: '60%', 
		3: '50%', 
		4: '45%', 
		5: '40%',
		6: '35%', 
		7: '30%', 
		8: '25%', 
		9: '20%', 
		10: '15%', 
		11: '10%', 
		12: '5%', 
		13: '0%', 14: '0%', 15: '0%', 16: '0%', 17: '0%', 18: '0%', 19: '0%', 20: '0%', 21: '0%', 22: '0%', 23: '0%', 24: '0%', 25: '0%'
	}, 

	tabModDifesaMagia: {
		1: '-6', 
		2: '-4', 
		3: '-3', 
		4: '-2', 
		5: '-1', 6: '-1', 7: '-1', 
		8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 14: 0, 
		15: '+1', 
		16: '+2', 
		17: '+3',
		18: '+4', 19: '+4', 20: '+4', 21: '+4', 22: '+4', 23: '+4', 24: '+4', 25: '+4'
	}, 

	tabImmunitaIncantesimi: {
		1: '-', 2: '-', 3: '-', 4: '-', 5: '-',6: '-', 7: '-', 8: '-', 9: '-', 10: '-', 11: '-', 12: '-', 13: '-', 14: '-', 15: '-', 16: '-', 17: '-', 18: '-', 
		19: 'Incuti Paura, Charme, Comando, Amicizia, Ipnosi', 
		20: 'Oblio, Bloccapersone, Raggio di indebolimento, Intimorire', 
		21: 'Paura', 
		22: 'Charmare mostri, Confusione, Emozione, Goffaggine, Suggestione', 
		23: 'Caos, Regressione mentale, Bloccamostri, Giara magica, Ricerca', 
		24: 'Costrizione, Suggestione di massa, Verga del dominio', 
		25: 'Antipatia/Simpatia, Incantesimo della morte, Charme di massa'
	}, 

	tabFattoreFedelta: {
		1: '-8', 
		2: '-7', 
		3: '-6', 
		4: '-5', 
		5: '-4', 
		6: '-3', 
		7: '-2', 
		8: '-1', 
		9: 0, 10: 0, 11: 0, 12: 0, 13: 0, 
		14: '+1', 
		15: '+3', 
		16: '+4', 
		17: '+6',
		18: '+8', 
		19: '+10', 
		20: '+12', 
		21: '+14', 
		22: '+16', 
		23: '+18', 
		24: '+20', 25: '+20'
	}, 

	tabMaxNumeroSeguaci: {
		1: 0, 
		2: 1, 3: 1, 4: 1, 
		5: 2, 6: 2, 
		7: 3, 8: 3, 
		9: 4, 10: 4, 11: 4, 
		12: 5, 13: 5, 
		14: 6, 
		15: 7, 
		16: 8, 
		17: 10,
		18: 15, 
		19: 20, 
		20: 25, 
		21: 30, 
		22: 35, 
		23: 40, 
		24: 45, 
		25: 50
	}, 

	tabModReazioniCarisma: {
		1: '-7', 
		2: '-6',
		3: '-5', 
		4: '-4', 
		5: '-3', 
		6: '-2', 
		7: '-1', 
		8: 0, 9: 0, 10: 0, 11: 0, 12: 0, 
		13: '+1', 
		14: '+2', 
		15: '+3', 
		16: '+5', 
		17: '+6',
		18: '+7', 
		19: '+8', 
		20: '+9', 
		21: '+10', 
		22: '+11', 
		23: '+12', 
		24: '+13', 
		25: '+14'
	}, 

	tabCombattente1: {
		0: 14,
		1: 16,
		2: 15,
		3: 17,
		4: 17
	},

	tabCombattente2: {
		0: 13,
		1: 15,
		2: 14,
		3: 16,
		4: 16
	},

	tabCombattente3: {
		0: 11,
		1: 13,
		2: 12,
		3: 13,
		4: 14
	},

	tabCombattente4: {
		0: 10,
		1: 12,
		2: 11,
		3: 12,
		4: 13
	},

	tabCombattente5: {
		0: 8,
		1: 10,
		2: 9,
		3: 9,
		4: 11
	},

	tabCombattente6: {
		0: 7,
		1: 9,
		2: 8,
		3: 8,
		4: 10
	},

	tabCombattente7: {
		0: 5,
		1: 7,
		2: 6,
		3: 5,
		4: 8
	},

	tabCombattente8: {
		0: 4,
		1: 6,
		2: 5,
		3: 4,
		4: 7
	},

	tabCombattente9: {
		0: 3,
		1: 5,
		2: 4,
		3: 4,
		4: 6
	},

	tabStregone1: {
		0: 14,
		1: 11,
		2: 13,
		3: 15,
		4: 12
	},

	tabStregone2: {
		0: 13,
		1: 9,
		2: 11,
		3: 13,
		4: 10
	},

	tabStregone3: {
		0: 11,
		1: 7,
		2: 9,
		3: 11,
		4: 8
	},

	tabStregone4: {
		0: 10,
		1: 5,
		2: 7,
		3: 9,
		4: 6
	},

	tabStregone5: {
		0: 8,
		1: 3,
		2: 5,
		3: 7,
		4: 4
	},

	tabSacerdote1: {
		0: 10,
		1: 14,
		2: 13,
		3: 16,
		4: 15
	},

	tabSacerdote2: {
		0: 9,
		1: 13,
		2: 12,
		3: 15,
		4: 14
	},

	tabSacerdote3: {
		0: 7,
		1: 11,
		2: 10,
		3: 13,
		4: 12
	},

	tabSacerdote4: {
		0: 6,
		1: 10,
		2: 9,
		3: 12,
		4: 11
	},

	tabSacerdote5: {
		0: 5,
		1: 9,
		2: 8,
		3: 11,
		4: 10
	},

	tabSacerdote6: {
		0: 4,
		1: 8,
		2: 7,
		3: 10,
		4: 9
	},

	tabSacerdote7: {
		0: 2,
		1: 6,
		2: 5,
		3: 8,
		4: 7
	},

	tabVagabondo1: {
		0: 13,
		1: 14,
		2: 12,
		3: 16,
		4: 15
	},

	tabVagabondo2: {
		0: 12,
		1: 12,
		2: 11,
		3: 15,
		4: 13
	},

	tabVagabondo3: {
		0: 11,
		1: 10,
		2: 10,
		3: 14,
		4: 11
	},

	tabVagabondo4: {
		0: 10,
		1: 8,
		2: 9,
		3: 13,
		4: 9
	},

	tabVagabondo5: {
		0: 9,
		1: 6,
		2: 8,
		3: 12,
		4: 7
	},

	tabVagabondo6: {
		0: 8,
		1: 4,
		2: 7,
		3: 11,
		4: 5
	}

}

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
			if (livello == 1 || livello == 2) numero = '1';
			else if (livello == 3 || livello == 4) numero = '2';
			else if (livello == 5 || livello == 6) numero = '3';
			else if (livello == 7 || livello == 8) numero = '4';
			else if (livello == 9 || livello == 10) numero = '5';
			else if (livello == 11 || livello == 12) numero = '6';
			else if (livello == 13 || livello == 14) numero = '7';
			else if (livello == 15 || livello == 16) numero = '8';
			else if (livello >= 17) numero = '9';
			break;
		case 'Stregone':
			if (livello >= 1 && livello <= 5) numero = '1';
			else if (livello >= 6 && livello <= 10) numero = '2';
			else if (livello >= 11 && livello <= 15) numero = '3';
			else if (livello >= 16 && livello <= 20) numero = '4';
			else if (livello >= 21) numero = '5';
			break;
		case 'Sacerdote':
			if (livello >= 1 && livello <= 3) numero = '1';
			else if (livello >= 4 && livello <= 6) numero = '2';
			else if (livello >= 7 && livello <= 9) numero = '3';
			else if (livello >= 10 && livello <= 12) numero = '4';
			else if (livello >= 13 && livello <= 15) numero = '5';
			else if (livello >= 16 && livello <= 18) numero = '6';
			else if (livello >= 19) numero = '7';
			break;
		case 'Vagabondo':
			if (livello >= 1 && livello <= 4) numero = '1';
			else if (livello >= 5 && livello <= 8) numero = '2';
			else if (livello >= 9 && livello <= 12) numero = '3';
			else if (livello >= 13 && livello <= 16) numero = '4';
			else if (livello >= 17 && livello <= 20) numero = '5';
			else if (livello >= 21) numero = '6';
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
		SfondiGialli.unsetYellow(valmod);
	} else {
		SfondiGialli.setYellow(valmod);
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