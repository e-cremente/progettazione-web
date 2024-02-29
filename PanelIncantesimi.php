<?php
function getPanelIncantesimi() {

    $panel6 = new clsUIFieldSet('Incantesimi', 'nocampiobbligatori');
    /**********************************************************************
        sezione INCANTESIMI della scheda
    **********************************************************************/
    $divincantesimi = new clsUIDiv('divincantesimi');
    $tabincantesimi = new clsUITabella('tabincantesimi', null, 'INCANTESIMI');

    //riga dei titoli
    $rigatitoliincantesimi = new clsUITabellaRiga('tabellariga incantesimi');

    $cellatitolonomeincantesimo = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nomeincantesimo", "label"=>"Incantesimo Conosciuto"]);
    $rigatitoliincantesimi->addCella($cellatitolonomeincantesimo);

    $cellatitololivelloincantesimo = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"livelloincantesimo", "label"=>"Liv."]);
    $rigatitoliincantesimi->addCella($cellatitololivelloincantesimo);

    $cellatitolocomponenti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"componentiincantesimo", "label"=>"Comp."]);
    $rigatitoliincantesimi->addCella($cellatitolocomponenti);

    $cellatitolodurata = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"durataincantesimo", "label"=>"Durata"]);
    $rigatitoliincantesimi->addCella($cellatitolodurata);

    $cellatitoloraggio = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"raggioincantesimo", "label"=>"Raggio"]);
    $rigatitoliincantesimi->addCella($cellatitoloraggio);

    $cellatitolosalvezza = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvezzaincantesimo", "label"=>"Tiro Salv."]);
    $rigatitoliincantesimi->addCella($cellatitolosalvezza);

    $cellatitolovelocita = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"velocitaincantesimo", "label"=>"Vel."]);
    $rigatitoliincantesimi->addCella($cellatitolovelocita);

    $cellatitoloeffetto = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"effettoincantesimo", "label"=>"Effetto"]);
    $rigatitoliincantesimi->addCella($cellatitoloeffetto);

    $cellatitolisalvaincantesimi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvarigaincantesimi", "label"=>"M/S"]);
    $rigatitoliincantesimi->addCella($cellatitolisalvaincantesimi);

    $cellatitolirimuoviincantesimi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigaincantesimi", "label"=>"Rimuovi"]);
    $rigatitoliincantesimi->addCella($cellatitolirimuoviincantesimi);

    $tabincantesimi->addRiga($rigatitoliincantesimi);

    // Se ci sono incantesimi salvati sul DB Creo le relative righe
    global $gvPersonaggio;
    if ($gvPersonaggio != null && $gvPersonaggio->pg_incantesimi != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_incantesimi); $i++) {
            $lvIncantesimo = $gvPersonaggio->pg_incantesimi[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idincantesimo-".$i,
                "hidden"=>"hidden", "value"=>$lvIncantesimo->Incantesimo->idIncantesimo
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellNome = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"incantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('incantesimo-".$i."')", "value"=>$lvIncantesimo->Nome
            ]);
            $lvRow->addCella($lvCellNome);
            //
            $lvCellLiv = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"livincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('livincantesimo-".$i."')", "value"=>$lvIncantesimo->Livello
            ]);
            $lvRow->addCella($lvCellLiv);
            //
            $lvCellComp = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"compincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('compincantesimo-".$i."')", "value"=>$lvIncantesimo->Componenti
            ]);
            $lvRow->addCella($lvCellComp);
            //
            $lvCellDurata = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"durataincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('durataincantesimo-".$i."')", "value"=>$lvIncantesimo->Durata
            ]);
            $lvRow->addCella($lvCellDurata);
            //
            $lvCellRaggio = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"raggioincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('raggioincantesimo-".$i."')", "value"=>$lvIncantesimo->Raggio
            ]);
            $lvRow->addCella($lvCellRaggio);
            //
            $lvCellTiroSalv = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"tirosalvincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('tirosalvincantesimo-".$i."')", "value"=>$lvIncantesimo->TiroSalvezza
            ]);
            $lvRow->addCella($lvCellTiroSalv);
            //
            $lvCellVel = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"velocitaincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('velocitaincantesimo-".$i."')", "value"=>$lvIncantesimo->Velocita
            ]);
            $lvRow->addCella($lvCellVel);
            //
            $lvCellEffetto = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"effettoincantesimo-".$i,
                "onchange"=>"checkIncantesimiFormat('effettoincantesimo-".$i."')", "value"=>$lvIncantesimo->Effetto
            ]);
            $lvRow->addCella($lvCellEffetto);
            // BOTTONI
            $lvCellaModifica = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"salvaincantesimo-".$i, "label"=>"Salva", "hidden"=>"hidden", "onclick"=>"ValidateRigaIncantesimo(".$i.")"],
                ["id"=>"modificaincantesimo-".$i, "label"=>"Modifica", "onclick"=>"ModificaRigaIncantesimoOnModifica(".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaModifica);
            $lvCellaRimuovi = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaIncantesimi(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabincantesimi->addRiga($lvRow);
        }
    }

    $divincantesimi->addElemento($tabincantesimi);

    $divconfigincantesimi = new clsUIDiv('configincantesimi');

    $aggiungiincantesimibtn = new clsButton('Aggiungi Una Riga', 'aggiungiincantesimibtn', 'button', 'aggiungiincantesimibtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigincantesimi->addElemento($aggiungiincantesimibtn);

    $ErroreArmi = new clsUIParagrafo(["id"=>"msgerrincantesimi", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigincantesimi->addElemento($ErroreArmi);

    $divincantesimi->addElemento($divconfigincantesimi);

    $panel6->addElemento($divincantesimi);

    return $panel6;
    
}
?>
