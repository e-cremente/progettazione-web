<?php

class clsUITabbedPanes {
    public $m_id;
    public $m_TabNames;
    public $m_TabContents;

    function clsUITabbedPanes($pInitArray) {
//echo "<pre>";print_r($pInitArray); echo "</pre>";
        $this->m_id = $pInitArray["id"];
        $this->m_TabNames = $pInitArray["tabNames"];
    }

    function addContent ($pContent){
        $this->m_TabContents[] = $pContent;
    }

    function render(){
        $lvCurrNumTab = 1;
        echo "<div class='divTabbed'>";
        foreach($this->m_TabNames as $lvTabName) {
            echo "<input name='{$this->m_id}' id='{$this->m_id}{$lvCurrNumTab}' type='radio'".($lvCurrNumTab == 1 ? "checked='checked'" : ""). "/>";
            echo "<section>";
            echo "<h1><label for='{$this->m_id}{$lvCurrNumTab}'>{$lvTabName}</label></h1>";
            $this->m_TabContents[$lvCurrNumTab-1]->render();
            echo "</section>";
            $lvCurrNumTab++;
        }
        echo "</div>";
    }

}
