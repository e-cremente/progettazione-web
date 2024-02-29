<?php

class clsUITabella{
	public $arrrighe;
	public $id;
	public $msgcode;
	public $caption;

	function clsUITabella($pId, $pMsgcode = null, $pCaption = null){
		$this->arrrighe = array();
		$this->id = $pId;
		$this->msgcode = $pMsgcode;
		$this->caption = $pCaption;
	}

	function addRiga($pRiga){
		$this->arrrighe[] = $pRiga;
	}

	function render(){
		$length = count($this->arrrighe);
		//$this->msgcode != null ? stampaMessaggio($this->msgcode) : pulisciErrore();	
		echo '<table id="'.$this->id.'">';
		echo '<caption id="'.$this->id.'-cap">'.$this->caption.'</caption>';
		for ($x=0; $x < $length; $x++) { 
			$this->arrrighe[$x]->render();
		}
		echo '</table>';
	}

}