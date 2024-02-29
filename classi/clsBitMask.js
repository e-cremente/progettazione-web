function clsBitMask(array){
	this.array = [];
	this.maschera = 0;
	for(var i = 0; i < array.length; i++){
		this.array[array[i]] = 1 << i;
	}
}

clsBitMask.prototype.setYellow = function (pCtrl) {
	pCtrl.style.background = "yellow";
	this.maschera |= this.array[pCtrl.name];
}

clsBitMask.prototype.unsetYellow = function (pCtrl) {
	pCtrl.style.background = "white";
	this.maschera &= ~this.array[pCtrl.name];
}

clsBitMask.prototype.checkMaschera = function () {
	if(this.maschera != 0){
		alert(this.maschera.toString(2));
	} else {
		alert("La maschera è tutta azzerata, ergo non dovrebbero esserci campi gialli, " + this.maschera);
	}
}