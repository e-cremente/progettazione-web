<?php

class clsUITabellaRiga{
	public $arrcolonne;
	public $classe;

	function clsUITabellaRiga($pClasse = null){
		$this->arrcolonne = array();
		$this->classe = $pClasse;
	}

	function addCella($pCella){
		$this->arrcolonne[] = $pCella;
	}

	function render(){
		$length = count($this->arrcolonne);
		echo '<tr '.($this->classe !== null ? 'class="'.$this->classe.'"' : '') .'>';
		for ($x=0; $x < $length; $x++) { 
			$this->arrcolonne[$x]->render();
		}
		echo '</tr>';
	}

}