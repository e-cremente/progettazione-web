var ArrayColonna = ['-base', '-razza', '-destr', '-arm', '-tratti', '-oggetti', '-livello', '-speciale'];
var ArrayRiga = ['svuotaretasche', 'scassinareserrature', 'trappole', 'movsil', 'nascondersi', 'sentirerumori', 'scalarepareti', 'letturalinguaggi',
                 'individuazionemagico', 'individuazioneillusioni', 'corrompere', 'scavarepassaggi', 'svincolarsi'];

var bitArrayAbilitaLadri = [];

for(var i = 0; i < ArrayRiga.length; i++){
	for(var j = 0; j < ArrayColonna.length; j++){
		var id = 'val'+ArrayRiga[i]+ArrayColonna[j];
		bitArrayAbilitaLadri.push(id);
		if(document.getElementById(id) != null){
			document.getElementById(id).addEventListener('change', function(){checkAbilitaLadri(this);});
		} 
	}
}

var pugnalare = document.getElementById('valpugnalaretotale');
if(pugnalare != null) pugnalare.addEventListener('change', function(){checkAbilitaLadri(this)});

bitArrayAbilitaLadri.push('valpugnalaretotale');

var SfondiGialliAbilitaLadri = new clsBitMask(bitArrayAbilitaLadri);

function checkAbilitaLadri(obj){

	let regex = /^[1-9][0-9]?$/;
	if(regex.test(obj.value) || obj.value == ''){
		SfondiGialliAbilitaLadri.unsetYellow(obj);
	} else {
		SfondiGialliAbilitaLadri.setYellow(obj);
	}
	
	if (SfondiGialliAbilitaLadri.maschera == 0){
		checkTotaleAbilitaLadri();
	}
}

function checkTotaleAbilitaLadri(){
	var ArrayTotali = ['valsvuotaretasche-totale', 'valscassinareserrature-totale', 'valtrappole-totale', 'valmovsil-totale', 'valnascondersi-totale',
	                   'valsentirerumori-totale', 'valscalarepareti-totale', 'valletturalinguaggi-totale', 'valindividuazionemagico-totale',
	                   'valindividuazioneillusioni-totale', 'valcorrompere-totale', 'valscavarepassaggi-totale', 'valsvincolarsi-totale'];

	for(var i = 0; i < ArrayTotali.length; i++){
		var prex = ArrayTotali[i].split('-')[0];

		var Base = isNull(Number(document.getElementById(prex+'-base').value), 0);
		var Razza = isNull(Number(document.getElementById(prex+'-razza').value), 0);
		var Destr = isNull(Number(document.getElementById(prex+'-destr').value), 0);
		var Arm = isNull(Number(document.getElementById(prex+'-arm').value), 0);
		var Tratti = isNull(Number(document.getElementById(prex+'-tratti').value), 0);
		var Oggetti = isNull(Number(document.getElementById(prex+'-oggetti').value), 0);
		var Livello = isNull(Number(document.getElementById(prex+'-livello').value), 0);
		var Speciale = isNull(Number(document.getElementById(prex+'-speciale').value), 0);

		var Totale = document.getElementById(ArrayTotali[i]);

		var somma = Base+Razza+Destr+Arm+Tratti+Oggetti+Livello+Speciale;

		Totale.value = (somma == 0 ? '' : somma);

	}

}