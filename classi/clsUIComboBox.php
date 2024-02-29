<?php

class clsUIComboBox{
	public $label;
	public $name;
	public $selectarr;

	function clsUIComboBox($pLabel, $pName, $arr, $colvalue, $coldescr){
		$this->label = $pLabel;
		$this->name = $pName;
		$this->selectarr = array();
		if (is_object($arr)) {
			while ($row = $arr->fetch_assoc()) {
				$opt = new clsOption($row[$colvalue], $row[$coldescr]);
				$this->selectarr[] = $opt;
			}
		} else if (is_array($arr)){
			$length = count($arr);
			for ($x = 0; $x < $length; $x++){
				$opt = new clsOption($arr[$x][$colvalue], $arr[$x][$coldescr]);
				$this->selectarr[] = $opt;
			}
		}
	}

	function selectValue($selectedValue){
		$length = count($this->selectarr);
		for ($x = 0; $x < $length; $x++) {
			if($this->selectarr[$x]->valore == $selectedValue) $this->selectarr[$x]->selected = 'selected';
		}		
	}

	function render(){
		$length = count($this->selectarr);
		//echo '<div>'. ($this->label !== null ? $this->label : '') ;
		echo '<div class="divcombobox"><div class="etichetta">'. $this->label .'</div>';
		echo '<select id="'.$this->name.'" name="'. $this->name .'">';
		echo '<option value="nochoice">---</option>';
		for ($x = 0; $x < $length; $x++) {
			$this->selectarr[$x]->render();
		}
		echo '</select>';
		echo '</div>';

	}

}