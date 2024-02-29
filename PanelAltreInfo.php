<?php
function getPanelAltreInfo() {

    $panel4 = new clsUIFieldSet('Ultime info del personaggio', 'nocampiobbligatori');
    /**********************************************************************
        sezione STILI DI COMBATTIMENTO della scheda
    **********************************************************************/
    $divstilicombattimento = new clsUIDiv('divstilicombattimento');
    $tabstilicombattimento = new clsUITabella('tabstilicombattimento', null, 'STILI DI COMBATTIMENTO');

    //riga dei titoli
    $rigatitolistilicomb = new clsUITabellaRiga('tabellariga stilicomb');

    $cellatitoloidstilicomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idstilicomb", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitolistilicomb->addCella($cellatitoloidstilicomb);

    $cellatitolostilecomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nomestilecomb", "label"=>"Stile"]);
    $rigatitolistilicomb->addCella($cellatitolostilecomb);

    $cellaPPstilecomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPstilecomb", "label"=>"PP"]);
    $rigatitolistilicomb->addCella($cellaPPstilecomb);

    $cellaspecstilecomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"specstilecomb", "label"=>"Spec."]);
    $rigatitolistilicomb->addCella($cellaspecstilecomb);

    $cellaeffettostilecomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"effettostilecomb", "label"=>"Effetto"]);
    $rigatitolistilicomb->addCella($cellaeffettostilecomb);

    $cellatitolisalvastilecomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvarigastilecomb", "label"=>"M/S"]);
    $rigatitolistilicomb->addCella($cellatitolisalvastilecomb);

    $cellatitolirimuovistilecomb = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigastilecomb", "label"=>"Rimuovi"]);
    $rigatitolistilicomb->addCella($cellatitolirimuovistilecomb);

    $tabstilicombattimento->addRiga($rigatitolistilicomb);

    // Se ci sono stili di combattimento salvati sul DB Creo le relative righe
    global $gvPersonaggio;
    if ($gvPersonaggio != null && $gvPersonaggio->pg_stilicombattimento != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_stilicombattimento); $i++) {
            $lvStilComb = $gvPersonaggio->pg_stilicombattimento[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idstilecomb-".$i,
                "hidden"=>"hidden", "value"=>$lvStilComb->idStile
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellStileComb = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"stilecomb-".$i,
                "value"=>$lvStilComb->stile->Nome
            ]);
            $lvRow->addCella($lvCellStileComb);
            //
            $lvCellPPStileComb = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPstilecomb-".$i,
                "onchange"=>"checkValStileComb('PPstilecomb-".$i."')", "value"=>$lvStilComb->PP
            ]);
            $lvRow->addCella($lvCellPPStileComb);
            //
            $lvCellSpecStileComb = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"specializzatostilecomb-".$i,
                "name"=>"checkgroupstilecomb-".$i, "value"=>$lvStilComb->Specializzato
            ]);
            $lvRow->addCella($lvCellSpecStileComb);
            //
            $lvCellEffettoStileComb = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"effettostilecomb-".$i,
                "value"=>$lvStilComb->stile->Effetto
            ]);
            $lvRow->addCella($lvCellEffettoStileComb);
            // BOTTONI
            $lvCellaModifica = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"salvastilecomb-".$i, "label"=>"Salva", "hidden"=>"hidden", "onclick"=>"ValidateRigaStileComb(".$i.")"],
                ["id"=>"modificastilecomb-".$i, "label"=>"Modifica", "onclick"=>"ModificaRigaStileCombOnModifica(".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaModifica);
            $lvCellaRimuovi = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"rimuovistilecomb-".$i, "classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaStileComb(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabstilicombattimento->addRiga($lvRow);
        }
    }

    $divstilicombattimento->addElemento($tabstilicombattimento);

    $divconfigstilecomb = new clsUIDiv('configarmi');

    $rsStiliComb = selectStiliComb();
    $cbStiliComb = creaCombobox('Stile', 'cbstilicomb', $rsStiliComb, 'idStile', 'Nome');

    $divconfigstilecomb->addElemento($cbStiliComb);

    $aggiungistilecombbtn = new clsButton('Aggiungi', 'aggiungistilecombbtn', 'button', 'aggiungistilecombbtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigstilecomb->addElemento($aggiungistilecombbtn);   

    $ErroreStileComb = new clsUIParagrafo(["id"=>"msgerrstilicomb", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigstilecomb->addElemento($ErroreStileComb);

    $divstilicombattimento->addElemento($divconfigstilecomb);

    $panel4->addElemento($divstilicombattimento);

    //Sezione unica dove inserire i PP rimanenti, i punti magia rimanenti e la Velocità di movimento generica
    $divinfogeneriche = new clsUIDiv('divinfogeneriche');
    $tabellainfogeneriche = new clsUITabella('tabinfogeneriche');

    $rigatitoliinfogeneriche = new clsUITabellaRiga('tabellariga');

    $cellaPPRimanenti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPRimanenti", "label"=>"PP Rimanenti"]);
    $rigatitoliinfogeneriche->addCella($cellaPPRimanenti);

    $cellapuntimagiarimanenti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"puntimagiarimanenti", "label"=>"Punti Magia Rimanenti"]);
    $rigatitoliinfogeneriche->addCella($cellapuntimagiarimanenti);

    $cellapuntimagiatotali = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"puntimagiatotali", "label"=>"Punti Magia Totali"]);
    $rigatitoliinfogeneriche->addCella($cellapuntimagiatotali);

    $cellavelocitamovimento = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"velocitamovimento", "label"=>"Vel. Movimento"]);
    $rigatitoliinfogeneriche->addCella($cellavelocitamovimento);

    $tabellainfogeneriche->addRiga($rigatitoliinfogeneriche);

    $rigavaloriinfogeneriche = new clsUITabellaRiga('tabellariga');

    $cellavalorePPRimanenti = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valPPRimanenti", "value"=>getValue('valPPRimanenti')]);
    $rigavaloriinfogeneriche->addCella($cellavalorePPRimanenti);

    $cellavalorepuntimagiarimanenti = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valpuntimagiarimanenti", "value"=>getValue('valpuntimagiarimanenti')]);
    $rigavaloriinfogeneriche->addCella($cellavalorepuntimagiarimanenti);

    $cellavalorepuntimagiatotali = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valpuntimagiatotali", "value"=>getValue('valpuntimagiatotali')]);
    $rigavaloriinfogeneriche->addCella($cellavalorepuntimagiatotali);

    $cellavalorevelocitamovimento = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valvelocitamovimento", "value"=>getValue('valvelocitamovimento')]);
    $rigavaloriinfogeneriche->addCella($cellavalorevelocitamovimento);

    $tabellainfogeneriche->addRiga($rigavaloriinfogeneriche);

    $divinfogeneriche->addElemento($tabellainfogeneriche);
    $panel4->addElemento($divinfogeneriche);

    $divsalvainfogeneriche = new clsUIDiv('divsalvataggio');
    $BtnSalvaInfoGeneriche = new clsButton('Salva', 'BtnSalvaInfoGeneriche', 'button', 'BtnSalvaInfoGeneriche', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvainfogeneriche->addElemento($BtnSalvaInfoGeneriche);
    $BtnModificaInfoGeneriche = new clsButton('Modifica', 'BtnModificaInfoGeneriche', 'button', 'BtnModificaInfoGeneriche', null, 'hidden');
    $divsalvainfogeneriche->addElemento($BtnModificaInfoGeneriche);
    $ErroreInfoGeneriche = new clsUIParagrafo(["id"=>"msgerrinfogeneriche", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvainfogeneriche->addElemento($ErroreInfoGeneriche);

    $panel4->addElemento($divsalvainfogeneriche);

    //Sezione delle RICCHEZZE
    $divricchezze = new clsUIDiv('divricchezze');
    $tabricchezze = new clsUITabella('tabricchezze', null, 'RICCHEZZE');

    //PRIMA RIGA
    $rigarameargento = new clsUITabellaRiga('tabellariga ricchezze');

    $cellatitolorame = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"moneterame", "label"=>"Mon. di Rame"]);
    $rigarameargento->addCella($cellatitolorame);

    $cellavalorerame = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmoneterame", "value"=>getValue('valmoneterame')]);
    $rigarameargento->addCella($cellavalorerame);

    $cellatitoloargento = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"moneteargento", "label"=>"Mon. d'Argento"]);
    $rigarameargento->addCella($cellatitoloargento);

    $cellavaloreargento = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmoneteargento", "value"=>getValue('valmoneteargento')]);
    $rigarameargento->addCella($cellavaloreargento);

    $tabricchezze->addRiga($rigarameargento);

    //SECONDA RIGA
    $rigaelectrumoro = new clsUITabellaRiga('tabellariga ricchezze');

    $cellatitoloelectrum = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"moneteelectrum", "label"=>"Mon. di Electrum"]);
    $rigaelectrumoro->addCella($cellatitoloelectrum);

    $cellavaloreelectrum = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmoneteelectrum", "value"=>getValue('valmoneteelectrum')]);
    $rigaelectrumoro->addCella($cellavaloreelectrum);

    $cellatitolooro = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"moneteoro", "label"=>"Mon. d'Oro"]);
    $rigaelectrumoro->addCella($cellatitolooro);

    $cellavaloreoro = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmoneteoro", "value"=>getValue('valmoneteoro')]);
    $rigaelectrumoro->addCella($cellavaloreoro);

    $tabricchezze->addRiga($rigaelectrumoro);

    //TERZA RIGA
    $rigaplatinototale = new clsUITabellaRiga('tabellariga ricchezze');

    $cellatitoloplatino = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"moneteplatino", "label"=>"Mon. di Platino"]);
    $rigaplatinototale->addCella($cellatitoloplatino);

    $cellavaloreplatino = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmoneteplatino", "value"=>getValue('valmoneteplatino')]);
    $rigaplatinototale->addCella($cellavaloreplatino);

    $cellatitolototricchezze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"totalericchezze", "label"=>"Totale (in M.O.)"]);
    $rigaplatinototale->addCella($cellatitolototricchezze);

    $cellavaloretotricchezze = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valtotalericchezze", "readonly"=>"readonly"]);
    $rigaplatinototale->addCella($cellavaloretotricchezze);

    $tabricchezze->addRiga($rigaplatinototale);

    $divricchezze->addElemento($tabricchezze);

    $panel4->addElemento($divricchezze);

    $divsalvaricchezze = new clsUIDiv('divsalvataggio');
    $BtnSalvaRicchezze = new clsButton('Salva Ricchezze', 'BtnSalvaRicchezze', 'button', 'BtnSalvaRicchezze', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvaricchezze->addElemento($BtnSalvaRicchezze);
    $BtnModificaRicchezze = new clsButton('Modifica', 'BtnModificaRicchezze', 'button', 'BtnModificaRicchezze', null, 'hidden');
    $divsalvaricchezze->addElemento($BtnModificaRicchezze);
    $ErroreRicchezze = new clsUIParagrafo(["id"=>"msgerrricchezze", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvaricchezze->addElemento($ErroreRicchezze);

    $panel4->addElemento($divsalvaricchezze);

    return $panel4;
}
?>
