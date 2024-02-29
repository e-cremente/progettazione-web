<?php

class clsButton{
	public $id;	
	public $type;
	public $name;
	public $class;
	public $label;
	public $hidden;
	public $elimina;

	function clsButton($pLabel, $pId, $pType, $pName, $pClass = null, $pHidden = null, $pElimina = null){
		$this->label = $pLabel;
		$this->id = $pId;
		$this->type = $pType;
		$this->name = $pName;
		$this->class = $pClass;
		$this->hidden = $pHidden;
		$this->elimina = $pElimina;
	}

	function render(){
		echo '<div class='. ($this->elimina !== null ? $this->elimina : 'divbutton').'><button id="'. $this->id .'" type="'. $this->type .'" name="'. $this->name .'" '. ($this->class !== null ? 'class="'. $this->class .'"' : '') . 
		       ($this->hidden !== null ? 'hidden' : '') .'>'. $this->label .'</button></div>';
	}

}