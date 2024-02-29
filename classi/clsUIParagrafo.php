<?php

class clsUIParagrafo{
	public $id;
	public $class;
	public $hidden;

	function clsUIParagrafo($array){
		if(isset($array['id'])) $this->id = $array['id'];
		if(isset($array['class'])) $this->class = $array['class'];
		if(isset($array['hidden'])) $this->hidden = $array['hidden'];
	}

	function render(){
		echo '<div class=divparagrafo><p id="'.$this->id.'" class="'.$this->class.'" '.($this->hidden !== null ? 'hidden' : '').'></p></div>';
	}
}