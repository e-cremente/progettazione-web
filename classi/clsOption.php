<?php

class clsOption{
	public $valore;
	public $descrizione;
	public $disabled;
	public $label;
	public $selected;

	function clsOption($pValore, $pDescrizione){
		$this->valore = $pValore;
		$this->descrizione = $pDescrizione;
		$this->disabled = null;
		$this->label = null;
		$this->selected = null;
	}

	function render(){
		echo '<option value="'. $this->valore .'" '. ($this->selected !== null ? 'selected' : '') .'>'. $this->descrizione .'</option>';
	}

}
