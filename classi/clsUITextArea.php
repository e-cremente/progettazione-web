<?php

class clsUITextArea{
	public $label;
	public $placeholder;
	public $name;
	public $value;
	public $cols;
	public $rows;
	public $maxlength;
	public $class;

	function clsUITextArea($array){
		if (isset($array['label'])) $this->label = $array['label'];
		if (isset($array['name'])) $this->name = $array['name'];
		if (isset($array['placeholder'])) $this->placeholder = $array['placeholder'];
		if (isset($array['value'])) $this->value = $array['value'];
		if (isset($array['cols'])) $this->cols = $array['cols'];
		if (isset($array['rows'])) $this->rows = $array['rows'];
		if (isset($array['maxlength'])) $this->maxlength = $array['maxlength'];
		if (isset($array['class'])) $this->class = $array['class'];
	}

	function render(){
		echo '<div><div class="'.$this->class.'">'. $this->label .'</div>';
		echo '<textarea id="'.$this->name.'" name="'.$this->name.'" '. ($this->placeholder !== null ? 'placeholder ="'.$this->placeholder.'"' : '') . 
		     ' '. ($this->cols !== null ? 'cols="'.$this->cols.'"' : '') .' '. ($this->rows !== null ? 'rows="'.$this->rows.'"' : '') .
		     ' '. ($this->maxlength !== null ? 'maxlength="'.$this->maxlength.'"' : '') .'>'. ($this->value !== null ? $this->value : '') .'</textarea>';
		echo '</div>';
	}

}