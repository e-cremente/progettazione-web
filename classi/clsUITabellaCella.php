<?php

class clsUITabellaCella{
    private $tipo;
    public $hidden;
    public $classe;
    public $rowspan = 1;
    public $colspan = 1;
    // Contenuto
    public $label;
    public $placeholder;
    public $id;
    public $name;
    public $value;
    public $disabled;
    public $readonly;
    public $onchange;
    public $bottoni;

    function __construct($pInitArray){
        if (!in_array("tipo", array_keys($pInitArray))) {
            throw new \Exception("Il parametro tipo &egrave; obbligatorio per il costruttore di".__CLASS__);
        }
        $this->tipo = $pInitArray["tipo"];
        if ($this->tipo == "1" || $this->tipo == "title") {
            $this->constructTH($pInitArray);
        } else if ($this->tipo == "2" || $this->tipo == "text") {
            $this->constructTD($pInitArray);
        } else if ($this->tipo == "3" || $this->tipo == "button") {
            $this->constructTD($pInitArray);
        } else if ($this->tipo == "4" || $this->tipo == "checkbox") {
            $this->constructTD($pInitArray);
        }
    }

    function constructTH($pInitArray){
        if (isset($pInitArray["hidden"])) $this->hidden = $pInitArray["hidden"];
        if (isset($pInitArray["classe"])) $this->classe = $pInitArray["classe"];
        if (isset($pInitArray["rowspan"])) $this->rowspan = $pInitArray["rowspan"];
        if (isset($pInitArray["colspan"])) $this->colspan = $pInitArray["colspan"];
        //
        if (isset($pInitArray["id"])) $this->id = $pInitArray["id"];
        if (isset($pInitArray["value"])) $this->value = $pInitArray["value"];
        if (isset($pInitArray["label"])) $this->label = $pInitArray["label"];
    }

    function constructTD($pInitArray){
        if (isset($pInitArray["hidden"])) $this->hidden = $pInitArray["hidden"];
        if (isset($pInitArray["classe"])) $this->classe = $pInitArray["classe"];
        if (isset($pInitArray["rowspan"])) $this->rowspan = $pInitArray["rowspan"];
        if (isset($pInitArray["colspan"])) $this->colspan = $pInitArray["colspan"];
        //
        if (isset($pInitArray["id"])) $this->id = $pInitArray["id"];
        if (isset($pInitArray["name"])) $this->name = $pInitArray["name"];
        if (isset($pInitArray["value"])) $this->value = $pInitArray["value"];
        if (isset($pInitArray["placeholder"])) $this->placeholder = $pInitArray["placeholder"];
        if (isset($pInitArray["disabled"])) $this->disabled = $pInitArray["disabled"];
        if (isset($pInitArray["readonly"])) $this->readonly = $pInitArray["readonly"];
        if (isset($pInitArray["onchange"])) $this->onchange = $pInitArray["onchange"];
        if (isset($pInitArray["bottoni"])) $this->bottoni = $pInitArray["bottoni"];
    }

    /*******************************************************************
    ** function render()
    ** - Se $this->tipo == "1" ==> <th>...</th>
    ** - Se $this->tipo == "2" ==> <td>...</td>
    **   - Se $this->name == null && $this->id == null ==> <td> ... </td>
    **   - Se $this->name != null || $this->id != null ==> <td> <input readonly value /></td>
    *******************************************************************/
    function render(){
        if ($this->tipo == "1" || $this->tipo == "title") {
            echo '<th '.
                ($this->hidden !== null ? 'hidden="'. $this->hidden.'" ' : '') .
                ($this->classe !== null ? 'class="'. $this->classe.'" ' : '') .
                ($this->rowspan > 1 ? 'rowspan="' . $this->rowspan . '" ' : '') .
                ($this->colspan > 1 ? 'colspan="' . $this->colspan . '" ' : '') .
                '>' . $this->label . '</th>';
        } else if ($this->tipo == "2" || $this->tipo == "text"){
            echo '<td '.
                ($this->hidden != null ? 'hidden="'. $this->hidden.'" ' : '') .
                ($this->classe != null ? 'class="'. $this->classe.'" ' : '') .
                ($this->rowspan > 1 ? 'rowspan="' . $this->rowspan . '" ' : '') .
                ($this->colspan > 1 ? 'colspan="' . $this->colspan . '" ' : '') .
                '>' . ($this->name == null && $this->id == null ? '' :
                    '<input type="text" ' .
                        ($this->readonly != null ? 'readonly ' : '') .
                        'id="' . coalesce($this->id, $this->name) . '" ' .
                        'name="' . coalesce($this->name, $this->id) . '" ' .
                        ($this->value != null ? 'value="' . $this->value.'" ' : '') .
                        ($this->onchange != null ? 'onchange="' . $this->onchange.'" ' : '') .
                        ($this->placeholder != null ? 'placeholder="' . $this->placeholder.'" ' : '') .
                    '/>').
                '</td>';            
        } else if ($this->tipo == "3" || $this->tipo == "button"){
            echo '<td '.
                ($this->hidden != null ? 'hidden="'. $this->hidden.'" ' : '') .
                ($this->classe != null ? 'class="'. $this->classe.'" ' : '') .
                ($this->rowspan > 1 ? 'rowspan="' . $this->rowspan . '" ' : '') .
                ($this->colspan > 1 ? 'colspan="' . $this->colspan . '" ' : '') .
                '>';
            foreach($this->bottoni as $lvBtn){
                echo '<button type="button" ' .
                     (isset($lvBtn["id"]) ? 'id="' . $lvBtn["id"] .'" ' : '') .
                     (isset($lvBtn["classe"]) ? 'class="' . $lvBtn["classe"] .'" ' : '') .
                     (isset($lvBtn["hidden"]) ? 'hidden ' : '') .
                     'onclick="' . $lvBtn["onclick"] . '"' .
                    '>' . $lvBtn["label"] . '</button>';
            }
        } else if ($this->tipo == "4" || $this->tipo == "checkbox"){
            echo '<td '.
                ($this->hidden != null ? 'hidden="'. $this->hidden.'" ' : '') .
                ($this->classe != null ? 'class="'. $this->classe.'" ' : '') .
                ($this->rowspan > 1 ? 'rowspan="' . $this->rowspan . '" ' : '') .
                ($this->colspan > 1 ? 'colspan="' . $this->colspan . '" ' : '') .
                '>' .
                    '<input type="checkbox" ' .
                        ($this->disabled != null ? 'disabled ' : '') .
                        'id="' . coalesce($this->id, $this->name) . '" ' .
                        'name="' . coalesce($this->name, $this->id) . '" ' .
                        ($this->value == 1 ? 'checked ' : '') .
                        ($this->onchange != null ? 'onchange="'.$this->onchange.'" ' : '') .
                    '/>'.
                '</td>';            
        }
    }

    function render_old(){
        if ($this->placeholder == null && $this->name == null) {
            echo '<th '.
                ($this->hidden !== null ? 'hidden="'.$this->hidden.'"' : '') .
                ($this->classe !== null ? 'class="'.$this->classe.'"' : '') .
                ($this->id !== null ? 'id="'.$this->id.'"' : '') .
                ' rowspan="'.$this->rowspan . '" colspan="'.$this->colspan.
                '">'.$this->label.'</th>';
        } else if ($this->readonly != null){
            echo '<td '. ($this->hidden !== null ? 'hidden="'.$this->hidden.'"' : '') .
                ($this->classe !== null ? 'class="'.$this->classe.'"' : '') .
                ($this->id !== null ? 'id="'.$this->id.'"' : '') .
                ' rowspan="'.$this->rowspan.'" colspan="'.$this->colspan.'">
                  <input readonly type="text" id="'.$this->name.'" name="'.$this->name.'" '. ($this->value == '' ? '' : 'value="'.$this->value.'"') .'></td>';            
        } else if ($this->label == null){
            echo '<td '.
                ($this->hidden !== null ? 'hidden="'.$this->hidden.'"' : '') .
                ($this->classe !== null ? 'class="'.$this->classe.'"' : '') .
                ($this->id !== null ? 'id="'.$this->id.'"' : '') .
                ' rowspan="'.$this->rowspan.'" colspan="'.$this->colspan.'">
                  <input type="text" id="'.$this->name.'" name="'.$this->name.'" placeholder ="'.$this->placeholder.'" '. ($this->value == '' ? '' : 'value="'.$this->value.'"') .'></td>';
        }
            
    }

}
