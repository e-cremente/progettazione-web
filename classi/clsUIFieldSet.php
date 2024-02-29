<?php

class clsUIFieldSet{
	public $legend;
	public $fsArr;
	public $campiobbligatori;

	function clsUIFieldSet($pLegend, $pCampiObbligatori = null){
		$this->legend = $pLegend;
		$this->fsArr = array();
		$this->campiobbligatori = $pCampiObbligatori;
	}

	function addElemento($pElemento){
		$this->fsArr[] = $pElemento;
	}

	function render(){
		echo '<div><fieldset><legend>'. $this->legend .'</legend>';

		$length = count($this->fsArr);
		for($x = 0; $x < $length; $x++){
			$this->fsArr[$x]->render();
		}

		if ($this->campiobbligatori == null) {
			echo '<div id="campiobbligatori" >*Campi obbligatori</div>';
		}		
		echo '</fieldset></div>';
	}
}