<?php

class clsUITextBox{
	public $label;
	public $placeholder;
	public $name;
	public $value;
	public $hidden;
	public $divid;
	public $readonly;

	function clsUITextBox($pLabel, $pName, $pPlaceholder = null, $pValue = null, $pHidden = null, $pDivId = null, $pReadonly = null){
		$this->label = $pLabel;
		$this->name = $pName;
		$this->placeholder = $pPlaceholder;
		$this->value = $pValue;
		$this->hidden = $pHidden;
		$this->divid = $pDivId;
		$this->readonly = $pReadonly;
	}

	function render(){
		echo '<div class="inputcontainer" '.($this->hidden !== null ? 'hidden ' : ''). ($this->divid !== null ? 'id="'.$this->divid.'" ' : '') .'><div class="etichetta">'. $this->label .'</div>';
		echo '<input type="text" id="'.$this->name.'" name="'.$this->name.'" '. ($this->placeholder !== null ? 'placeholder ="'.$this->placeholder.'" ' : '') . ($this->value !== null ? 'value ="'.$this->value.'" ' : '') . ($this->readonly !== null ? 'readonly' : '') .'>';
		echo '</div>';
	}

}