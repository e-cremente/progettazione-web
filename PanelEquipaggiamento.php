<?php
function getPanelEquipaggiamento() {

    $panel7 = new clsUIFieldSet('Equipaggiamento del personaggio', 'nocampiobbligatori');
    /**********************************************************************
        sezione EQUIPAGGIAMENTO della scheda
    **********************************************************************/
    $divequipaggiamento = new clsUIDiv('divequipaggiamento');
    $equipaggiamento = creaTextArea(['label'=>'EQUIPAGGIAMENTO', 'name'=>'equipaggiamento', 'class'=>'titoloequipaggiamento', 'value'=>getValue('equipaggiamento')]);
    $divequipaggiamento->addElemento($equipaggiamento);

    $panel7->addElemento($divequipaggiamento);

    $divsalvaequip = new clsUIDiv('divsalvataggio');
    $BtnSalvaEquip = new clsButton('Salva Equipaggiamento', 'BtnSalvaEquipaggiamento', 'button', 'BtnSalvaEquipaggiamento', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvaequip->addElemento($BtnSalvaEquip);
    $BtnModificaEquip = new clsButton('Modifica', 'BtnModificaEquipaggiamento', 'button', 'BtnModificaEquip', null, 'hidden');
    $divsalvaequip->addElemento($BtnModificaEquip);
    $ErroreEquipaggiamento = new clsUIParagrafo(["id"=>"msgerrequipaggiamento", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvaequip->addElemento($ErroreEquipaggiamento);

    $panel7->addElemento($divsalvaequip);

    return $panel7;
    
}
?>
