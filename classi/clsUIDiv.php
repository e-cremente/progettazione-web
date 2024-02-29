<?php

class clsUIDiv{
	public $classe;
	public $id;
	public $arrcontenuto;

	function clsUIDiv($pClasse, $pId = null){
		$this->classe = $pClasse;
		$this->id = $pId;
		$this->arrcontenuto = array();
	}

	function addElemento($pElemento){
		$this->arrcontenuto[] = $pElemento;
	}

	function render(){
		echo '<div '. ($this->id == null ? '' : 'id='.$this->id) .' class="'. $this->classe .'">';

		$length = count($this->arrcontenuto);
		for($x = 0; $x < $length; $x++){
			$this->arrcontenuto[$x]->render();
		}

		echo '</div>';
	}
}