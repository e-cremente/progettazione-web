<?php
function getPanelProficienze() {

    $panel3 = new clsUIFieldSet('Informazioni per le Proficienze', 'nocampiobbligatori');
    /**********************************************************************
        sezione PROFICIENZE della scheda
    **********************************************************************/
    $divproficienze = new clsUIDiv('divproficienze');
    $tabproficienze = new clsUITabella('tabproficienze', null, 'PROFICIENZE');

    //riga dei titoli
    $rigatitoliproficienze = new clsUITabellaRiga('tabellariga proficienze');

    $cellatitoloidproficienze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idproficienze", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitoliproficienze->addCella($cellatitoloidproficienze);

    $cellatitoloproficienza = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nomeproficienza", "label"=>"Proficienza"]);
    $rigatitoliproficienze->addCella($cellatitoloproficienza);

    $cellatitoloPPproficienze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPproficienza", "label"=>"PP"]);
    $rigatitoliproficienze->addCella($cellatitoloPPproficienze);

    $cellatitoloabilitaproficienze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"abilitaproficienza", "label"=>"Abilit&agrave;"]);
    $rigatitoliproficienze->addCella($cellatitoloabilitaproficienze);

    $cellatitolovaloreproficienze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"valoreproficienza", "label"=>"Valore"]);
    $rigatitoliproficienze->addCella($cellatitolovaloreproficienze);

    $cellatitolisalvaproficienze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvarigaproficienza", "label"=>"M/S"]);
    $rigatitoliproficienze->addCella($cellatitolisalvaproficienze);

    $cellatitolirimuoviproficienze = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigaproficienza", "label"=>"Rimuovi"]);
    $rigatitoliproficienze->addCella($cellatitolirimuoviproficienze);

    $tabproficienze->addRiga($rigatitoliproficienze);

    // Se ci sono proficienze salvate sul DB Creo le relative righe
    global $gvPersonaggio;
    if ($gvPersonaggio != null && $gvPersonaggio->pg_proficienze != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_proficienze); $i++) {
            $lvProf = $gvPersonaggio->pg_proficienze[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idproficienza-".$i,
                "hidden"=>"hidden", "value"=>$lvProf->idProficienza
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellProf = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"proficienza-".$i,
                "value"=>$lvProf->proficienza->Nome
            ]);
            $lvRow->addCella($lvCellProf);
            //
            $lvCellPPProf = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPproficienza-".$i,
                "value"=>$lvProf->proficienza->CostoPP
            ]);
            $lvRow->addCella($lvCellPPProf);
            //
            $lvCellAbilProf = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"abilitaproficienza-".$i,
                "value"=>$lvProf->proficienza->Abilita
            ]);
            $lvRow->addCella($lvCellAbilProf);
            //
            $lvCellValProf = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"valproficienza-".$i,
                "onchange"=>"checkValProficienza('valproficienza-".$i."')", "value"=>$lvProf->proficienza->ValoreBase
            ]);
            $lvRow->addCella($lvCellValProf);
            // BOTTONI
            $lvCellaModifica = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"salvaproficienza-".$i, "label"=>"Salva", "hidden"=>"hidden", "onclick"=>"ValidateRigaProficienza(".$i.")"],
                ["id"=>"modificaproficienza-".$i, "label"=>"Modifica", "onclick"=>"ModificaRigaProficienzaOnModifica(".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaModifica);
            $lvCellaRimuovi = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"rimuoviproficienza-".$i, "classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaProficienza(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabproficienze->addRiga($lvRow);
        }
    }

    $divproficienze->addElemento($tabproficienze);

    $divconfigproficienze = new clsUIDiv('configarmi');

    $rsCategoriaProficienze = selectCategoriaProficienze();
    $cbCategoriaProficienze = creaCombobox('Categoria', 'cbcategoriaproficienze', $rsCategoriaProficienze, 'Categoria', 'Categoria');

    $divconfigproficienze->addElemento($cbCategoriaProficienze);

    $rsProficienze = selectProficienze(null, null);
    $cbProficienze = creaCombobox('Proficienza', 'cbproficienze', $rsProficienze, 'idProficienza', 'Nome');

    $divconfigproficienze->addElemento($cbProficienze);

    $aggiungiproficienzabtn = new clsButton('Aggiungi', 'aggiungiproficienzabtn', 'button', 'aggiungiproficienzabtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigproficienze->addElemento($aggiungiproficienzabtn);   

    $ErroreProficienze = new clsUIParagrafo(["id"=>"msgerrproficienze", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigproficienze->addElemento($ErroreProficienze);

    $divproficienze->addElemento($divconfigproficienze);

    $panel3->addElemento($divproficienze);

    /**********************************************************************
        sezione TRATTI della scheda
    **********************************************************************/
    $divcontenitoretrattiesvantaggi = new clsUIDiv('divcontenitoretrattiesvantaggi');
    $divtrattiesvantaggi = new clsUIDiv('divtrattiesvantaggi');
    $divtratti = new clsUIDiv('divtratti');
    $tabtratti = new clsUITabella('tabtratti', null, 'TRATTI');

    //riga dei titoli
    $rigatitolitratti = new clsUITabellaRiga('tabellariga tratti');

    $cellatitoloidtratti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idtratti", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitolitratti->addCella($cellatitoloidtratti);

    $cellatitolotratto = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nometratto", "label"=>"Tratto"]);
    $rigatitolitratti->addCella($cellatitolotratto);

    $cellatitoloPPtratti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPtratto", "label"=>"PP"]);
    $rigatitolitratti->addCella($cellatitoloPPtratti);

    $cellatitolirimuovitratti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigatratto", "label"=>"Rimuovi"]);
    $rigatitolitratti->addCella($cellatitolirimuovitratti);

    $tabtratti->addRiga($rigatitolitratti);

    // Se ci sono tratti salvati sul DB Creo le relative righe
    if ($gvPersonaggio != null && $gvPersonaggio->pg_tratti != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_tratti); $i++) {
            $lvTratto = $gvPersonaggio->pg_tratti[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idtratto-".$i,
                "hidden"=>"hidden", "value"=>$lvTratto->idTratto
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellTratto = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"tratto-".$i,
                "value"=>$lvTratto->tratto->Nome
            ]);
            $lvRow->addCella($lvCellTratto);
            //
            $lvCellPPTratto = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPtratto-".$i,
                "value"=>$lvTratto->tratto->CostoPP
            ]);
            $lvRow->addCella($lvCellPPTratto);
            // BOTTONI
            $lvCellaRimuovi = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"rimuovitratto-".$i, "classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaTratto(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabtratti->addRiga($lvRow);
        }
    }

    $divtratti->addElemento($tabtratti);

    $divconfigtratti = new clsUIDiv('configarmi tratti');

    $rsTratti = selectTratti();
    $cbTratti = creaCombobox('Tratto', 'cbtratti', $rsTratti, 'idTratto', 'Nome');

    $divconfigtratti->addElemento($cbTratti);

    $aggiungitrattobtn = new clsButton('Aggiungi', 'aggiungitrattobtn', 'button', 'aggiungitrattobtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigtratti->addElemento($aggiungitrattobtn);   

    $ErroreTratti = new clsUIParagrafo(["id"=>"msgerrtratti", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigtratti->addElemento($ErroreTratti);

    $divtratti->addElemento($divconfigtratti);

    $divtrattiesvantaggi->addElemento($divtratti);

    /**********************************************************************
        sezione SVANTAGGI della scheda
    **********************************************************************/
    $divsvantaggi = new clsUIDiv('divsvantaggi');
    $tabsvantaggi = new clsUITabella('tabsvantaggi', null, 'SVANTAGGI');

    //riga dei titoli
    $rigatitolisvantaggi = new clsUITabellaRiga('tabellariga svantaggi');

    $cellatitoloidsvantaggi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idsvantaggi", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitolisvantaggi->addCella($cellatitoloidsvantaggi);

    $cellatitolosvantaggio = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nomesvantaggio", "label"=>"Svantaggio"]);
    $rigatitolisvantaggi->addCella($cellatitolosvantaggio);

    $cellatitoloPPsvantaggi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPsvantaggio", "label"=>"PP"]);
    $rigatitolisvantaggi->addCella($cellatitoloPPsvantaggi);

    $cellatitoloPPsvantaggigrave = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPsvantaggiograve", "label"=>"PP (Grave)"]);
    $rigatitolisvantaggi->addCella($cellatitoloPPsvantaggigrave);

    $cellatitolocheckgrave = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"checkgrave", "label"=>"Grave"]);
    $rigatitolisvantaggi->addCella($cellatitolocheckgrave);

    $cellatitolisalvasvantaggi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvarigasvantaggi", "label"=>"M/S"]);
    $rigatitolisvantaggi->addCella($cellatitolisalvasvantaggi);

    $cellatitolirimuovisvantaggi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigasvantaggio", "label"=>"Rimuovi"]);
    $rigatitolisvantaggi->addCella($cellatitolirimuovisvantaggi);

    $tabsvantaggi->addRiga($rigatitolisvantaggi);

    // Se ci sono svantaggi salvati sul DB Creo le relative righe
    if ($gvPersonaggio != null && $gvPersonaggio->pg_svantaggi != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_svantaggi); $i++) {
            $lvSvantaggio = $gvPersonaggio->pg_svantaggi[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idsvantaggio-".$i,
                "hidden"=>"hidden", "value"=>$lvSvantaggio->idSvantaggio
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellSvantaggio = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"svantaggio-".$i,
                "value"=>$lvSvantaggio->svantaggio->Nome
            ]);
            $lvRow->addCella($lvCellSvantaggio);
            //
            $lvCellPPSvantaggio = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPsvantaggio-".$i,
                "value"=>$lvSvantaggio->svantaggio->PPModerato
            ]);
            $lvRow->addCella($lvCellPPSvantaggio);
            //
            $lvCellPPGrave = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPgrave-".$i,
                "value"=>$lvSvantaggio->svantaggio->PPGrave
            ]);
            $lvRow->addCella($lvCellPPGrave);
            //
            $lvCellGrave = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"grave-".$i,
                 "name"=>"checkgroupsv-".$i, "value"=>$lvSvantaggio->Grave
            ]);
            $lvRow->addCella($lvCellGrave);
            // BOTTONI
            $lvCellaModifica = creaCella(["tipo"=>"button", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"salvasvantaggio-".$i, "label"=>"Salva", "hidden"=>"hidden", "onclick"=>"ValidateRigaSvantaggio(".$i.")"],
                ["id"=>"modificasvantaggio-".$i, "label"=>"Modifica", "onclick"=>"ModificaRigaSvantaggioOnModifica(".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaModifica);
            $lvCellaRimuovi = creaCella(["tipo"=>"button", "classe"=>"cellavalore", "bottoni"=>[
                ["classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaSvantaggio(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabsvantaggi->addRiga($lvRow);
        }
    }

    $divsvantaggi->addElemento($tabsvantaggi);

    $divconfigsvantaggi = new clsUIDiv('configarmi svantaggi');

    $rsSvantaggi = selectSvantaggi();
    $cbSvantaggi = creaCombobox('Svantaggio', 'cbsvantaggi', $rsSvantaggi, 'idSvantaggio', 'Nome');

    $divconfigsvantaggi->addElemento($cbSvantaggi);

    $aggiungisvantaggiobtn = new clsButton('Aggiungi', 'aggiungisvantaggiobtn', 'button', 'aggiungisvantaggiobtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigsvantaggi->addElemento($aggiungisvantaggiobtn);   

    $ErroreSvantaggi = new clsUIParagrafo(["id"=>"msgerrsvantaggi", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigsvantaggi->addElemento($ErroreSvantaggi);

    $divsvantaggi->addElemento($divconfigsvantaggi);

    $divtrattiesvantaggi->addElemento($divsvantaggi);

    $divcontenitoretrattiesvantaggi->addElemento($divtrattiesvantaggi);

    $panel3->addElemento($divcontenitoretrattiesvantaggi);

    /**********************************************************************
        sezione ABILITA DI RAZZA della scheda
    **********************************************************************/
    $divcontenitoreabilitarazzaeclasse = new clsUIDiv('divcontenitoreabilitarazzaeclasse');
    $divabilitarazzaeclasse = new clsUIDiv('divabilitarazzaeclasse');
    $divabilitadirazza = new clsUIDiv('divabilitadirazza');
    $tababilitadirazza = new clsUITabella('tababilitadirazza', null, 'ABILIT&Agrave; DI RAZZA');

    //riga dei titoli
    $rigatitoliabrazza = new clsUITabellaRiga('tabellariga abrazza');

    $cellatitoloidabrazza = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idabrazza", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitoliabrazza->addCella($cellatitoloidabrazza);

    $cellatitoloabrazza = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nomeabrazza", "label"=>"Abilit&agrave;"]);
    $rigatitoliabrazza->addCella($cellatitoloabrazza);

    $cellatitoloPPabrazza = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPabrazza", "label"=>"PP"]);
    $rigatitoliabrazza->addCella($cellatitoloPPabrazza);

    $cellatitolirimuoviabrazza = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigaabrazza", "label"=>"Rimuovi"]);
    $rigatitoliabrazza->addCella($cellatitolirimuoviabrazza);

    $tababilitadirazza->addRiga($rigatitoliabrazza);

    // Se ci sono abilita di razza salvate sul DB Creo le relative righe
    if ($gvPersonaggio != null && $gvPersonaggio->pg_abilitadirazza != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_abilitadirazza); $i++) {
            $lvAbilRazza = $gvPersonaggio->pg_abilitadirazza[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idabrazza-".$i,
                "hidden"=>"hidden", "value"=>$lvAbilRazza->idAbilitadirazza
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellAbilRazza = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"nomeabrazza-".$i,
                "value"=>$lvAbilRazza->abilitadirazza->Nome
            ]);
            $lvRow->addCella($lvCellAbilRazza);
            //
            $lvCellCostoPP = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPabrazza-".$i,
                "value"=>$lvAbilRazza->abilitadirazza->CostoPP
            ]);
            $lvRow->addCella($lvCellCostoPP);
            //
            // BOTTONI
            $lvCellaRimuovi = creaCella(["tipo"=>"button", "classe"=>"cellavalore", "bottoni"=>[
                ["classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaAbRazza(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tababilitadirazza->addRiga($lvRow);
        }
    }

    $divabilitadirazza->addElemento($tababilitadirazza);

    $divconfigabrazza = new clsUIDiv('configarmi abrazza');

    //questo combobox deve essere alimentato solo dopo che l'utente ha salvato la razza del personaggio, quindi per ora lo creo vuoto

    $rsAbRazza = [];
    $cbAbRazza = creaCombobox('Abilit&agrave;', 'cbabrazza', $rsAbRazza, 'null', 'null');

    $divconfigabrazza->addElemento($cbAbRazza);

    $aggiungiabrazzabtn = new clsButton('Aggiungi', 'aggiungiabrazzabtn', 'button', 'aggiungiabrazzabtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigabrazza->addElemento($aggiungiabrazzabtn);   

    $ErroreAbRazza = new clsUIParagrafo(["id"=>"msgerrabrazza", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigabrazza->addElemento($ErroreAbRazza);

    $divabilitadirazza->addElemento($divconfigabrazza);

    $divabilitarazzaeclasse->addElemento($divabilitadirazza);

    /**********************************************************************
        sezione ABILITA DI CLASSE della scheda
    **********************************************************************/
    $divabilitadiclasse = new clsUIDiv('divabilitadiclasse');
    $tababilitadiclasse = new clsUITabella('tababilitadiclasse', null, 'ABILIT&Agrave; DI CLASSE');

    //riga dei titoli
    $rigatitoliabclasse = new clsUITabellaRiga('tabellariga abclasse');

    $cellatitoloidabclasse = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idabclasse", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitoliabclasse->addCella($cellatitoloidabclasse);

    $cellatitoloabclasse = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"nomeabclasse", "label"=>"Abilit&agrave;"]);
    $rigatitoliabclasse->addCella($cellatitoloabclasse);

    $cellatitoloPPabclasse = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPabclasse", "label"=>"PP"]);
    $rigatitoliabclasse->addCella($cellatitoloPPabclasse);

    $cellatitolirimuoviabclasse = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigaabclasse", "label"=>"Rimuovi"]);
    $rigatitoliabclasse->addCella($cellatitolirimuoviabclasse);

    $tababilitadiclasse->addRiga($rigatitoliabclasse);

    // Se ci sono abilita di classe salvate sul DB Creo le relative righe
    if ($gvPersonaggio != null && $gvPersonaggio->pg_abilitadiclasse != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_abilitadiclasse); $i++) {
            $lvAbilClasse = $gvPersonaggio->pg_abilitadiclasse[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            //
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idabclasse-".$i,
                "hidden"=>"hidden", "value"=>$lvAbilClasse->idAbilitadiclasse
            ]);
            $lvRow->addCella($lvCellId);
            //
            $lvCellAbilClasse = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"nomeabclasse-".$i,
                "value"=>$lvAbilClasse->abilitadiclasse->Nome
            ]);
            $lvRow->addCella($lvCellAbilClasse);
            //
            $lvCellCostoPP = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PPabclasse-".$i,
                "value"=>$lvAbilClasse->abilitadiclasse->CostoPP
            ]);
            $lvRow->addCella($lvCellCostoPP);
            //
            // BOTTONI
            $lvCellaRimuovi = creaCella(["tipo"=>"button", "classe"=>"cellavalore", "bottoni"=>[
                ["classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaAbClasse(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tababilitadiclasse->addRiga($lvRow);
        }
    }

    $divabilitadiclasse->addElemento($tababilitadiclasse);

    $divconfigabclasse = new clsUIDiv('configarmi abclasse');

    //questo combobox deve essere alimentato solo dopo che l'utente ha salvato la classe del personaggio, quindi per ora lo creo vuoto

    $rsAbClasse = [];
    $cbAbClasse = creaCombobox('Abilit&agrave;', 'cbabclasse', $rsAbClasse, 'null', 'null');

    $divconfigabclasse->addElemento($cbAbClasse);

    $aggiungiabclassebtn = new clsButton('Aggiungi', 'aggiungiabclassebtn', 'button', 'aggiungiabclassebtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigabclasse->addElemento($aggiungiabclassebtn);   

    $ErroreAbClasse = new clsUIParagrafo(["id"=>"msgerrabclasse", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigabclasse->addElemento($ErroreAbClasse);

    $divabilitadiclasse->addElemento($divconfigabclasse);

    $divabilitarazzaeclasse->addElemento($divabilitadiclasse);

    $divcontenitoreabilitarazzaeclasse->addElemento($divabilitarazzaeclasse);

    $panel3->addElemento($divcontenitoreabilitarazzaeclasse);

    return $panel3;
}
?>
