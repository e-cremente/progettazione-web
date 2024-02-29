<?php
function getPanelCombattimento() {

    $panel2 = new clsUIFieldSet('Informazioni per il Combattimento');
    /**********************************************************************
        sezione ARMATURA della scheda
    **********************************************************************/
    $divclassearmatura = new clsUIDiv('divclassearmatura');

    $rsArmatura = selectArmatura();
    $cbArmatura = creaCombobox('Armatura Predefinita', 'predarmor', $rsArmatura, 'idArmatura', 'Categoria', getValue('predarmor'));
    $divclassearmatura->addElemento($cbArmatura);

    $classearmatura = creaTextbox('Classe Armatura*', 'CA', null, coalesce(getValue('CA'), 10));
    $divclassearmatura->addElemento($classearmatura);

    $divcacentro = new clsUIDiv('divcacentro');

    $sorpreso = creaTextbox('Sorpreso', 'sorpreso', 'Valore Numerico', getValue('sorpreso'));
    $divcacentro->addElemento($sorpreso);

    $senzascudo = creaTextbox('Senza Scudo', 'senzascudo', 'Valore Numerico', getValue('senzascudo'));
    $divcacentro->addElemento($senzascudo);

    $allespalle = creaTextbox('Alle Spalle', 'allespalle', 'Valore Numerico', getValue('allespalle'));
    $divcacentro->addElemento($allespalle);

    $incantesimi = creaTextbox('Incantesimi', 'caincantesimi', 'Valore Numerico', getValue('caincantesimi'));
    $divcacentro->addElemento($incantesimi);

    $divcadestra = new clsUIDiv('divcadestra');

    $difese = creaTextArea(['label'=>'Difese', 'name'=>'difese', 'cols'=>'50', 'rows'=>'4', 'class'=>'etichetta', 'maxlength'=>'200', "value"=>getValue('difese')]);
    $divcadestra->addElemento($difese);

    $panel2->addElemento($divclassearmatura);
    $panel2->addElemento($divcacentro);
    $panel2->addElemento($divcadestra);

    $divsalvaarmatura = new clsUIDiv('divsalvataggio');
    $BtnSalvaArmatura = new clsButton('Salva Classe Armatura', 'BtnSalvaArmatura', 'button', 'BtnSalvaArmatura', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvaarmatura->addElemento($BtnSalvaArmatura);
    $BtnModificaArmatura = new clsButton('Modifica', 'BtnModificaArmatura', 'button', 'BtnModificaArmatura', null, 'hidden');
    $divsalvaarmatura->addElemento($BtnModificaArmatura);
    $ErroreArmatura = new clsUIParagrafo(["id"=>"msgerrarmatura", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvaarmatura->addElemento($ErroreArmatura);

    $panel2->addElemento($divsalvaarmatura);

    //Sezione dove andranno inseriti i punti ferita totali e quelli rimasti
    $divpuntiferita = new clsUIDiv('divpuntiferita');
    $tabellapuntiferita = new clsUITabella('tabpuntiferita');

    $rigatitolipf = new clsUITabellaRiga('tabellariga');

    $cellapuntiferita = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"puntiferita", "label"=>"Punti Ferita"]);
    $rigatitolipf->addCella($cellapuntiferita);

    $cellaferite = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"ferite", "label"=>"Ferite"]);
    $rigatitolipf->addCella($cellaferite);

    $cellarimanenti = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"pfrimanenti", "label"=>"Rimanenti"]);
    $rigatitolipf->addCella($cellarimanenti);

    $tabellapuntiferita->addRiga($rigatitolipf);

    $rigavaloripf = new clsUITabellaRiga('tabellariga');

    $cellavalorepuntiferita = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valpuntiferita", "value"=>getValue('valpuntiferita')]);
    $rigavaloripf->addCella($cellavalorepuntiferita);

    $cellavaloreferite = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valferite", "value"=>getValue('valferite')]);
    $rigavaloripf->addCella($cellavaloreferite);

    $cellavalorerimanenti = creaCella(["tipo"=>"2", "classe"=>"cellavalore", "name"=>"valrimanenti", "readonly"=>"readonly"]);
    $rigavaloripf->addCella($cellavalorerimanenti);

    $tabellapuntiferita->addRiga($rigavaloripf);

    $divpuntiferita->addElemento($tabellapuntiferita);
    $panel2->addElemento($divpuntiferita);

    $divsalvapuntiferita = new clsUIDiv('divsalvataggio');
    $BtnSalvaPuntiFerita = new clsButton('Salva Punti Ferita', 'BtnSalvaPuntiFerita', 'button', 'BtnSalvaPuntiFerita', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvapuntiferita->addElemento($BtnSalvaPuntiFerita);
    $BtnModificaPuntiFerita = new clsButton('Modifica', 'BtnModificaPuntiFerita', 'button', 'BtnModificaPuntiFerita', null, 'hidden');
    $divsalvapuntiferita->addElemento($BtnModificaPuntiFerita);
    $ErrorePuntiFerita = new clsUIParagrafo(["id"=>"msgerrpuntiferita", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvapuntiferita->addElemento($ErrorePuntiFerita);

    $panel2->addElemento($divsalvapuntiferita);

    /*******************************************************
        sezione COMBATTIMENTO della scheda
    *******************************************************/
    $divcombattimento = new clsUIDiv('divcombattimento');
    $tabcombattimento = new clsUITabella('tabcombattimento', null, 'COMBATTIMENTO');

    //riga dei titoli
    $rigatitolicombatt = new clsUITabellaRiga('tabellariga combattimento');

    $cellatitoloid = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idarma", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitolicombatt->addCella($cellatitoloid);

    $cellatitoloarma = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"arma", "label"=>"Arma"]);
    $rigatitolicombatt->addCella($cellatitoloarma);

    $cellatitoloAT = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"at", "label"=>"Attacchi/Round"]);
    $rigatitolicombatt->addCella($cellatitoloAT);

    $cellatitolomodad = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"modad", "label"=>"Mod. Attacco/Danno"]);
    $rigatitolicombatt->addCella($cellatitolomodad);

    $cellatitolothaco = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"thaco", "label"=>"Thac0"]);
    $rigatitolicombatt->addCella($cellatitolothaco);

    $cellatitolodanni = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"danni", "label"=>"Danni (PM/G)"]);
    $rigatitolicombatt->addCella($cellatitolodanni);

    $cellatitoloraggio = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"raggio", "label"=>"Raggio"]);
    $rigatitolicombatt->addCella($cellatitoloraggio);

    $cellatitolopeso = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"peso", "label"=>"Peso"]);
    $rigatitolicombatt->addCella($cellatitolopeso);

    $cellatitolotaglia = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"taglia", "label"=>"Taglia"]);
    $rigatitolicombatt->addCella($cellatitolotaglia);

    $cellatitolotipologia = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"tipologia", "label"=>"Tipologia"]);
    $rigatitolicombatt->addCella($cellatitolotipologia);

    $cellatitolivelocita = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"velocita", "label"=>"Velocit&agrave;"]);
    $rigatitolicombatt->addCella($cellatitolivelocita);

    $cellatitolisalva = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvariga", "label"=>"M/S"]);
    $rigatitolicombatt->addCella($cellatitolisalva);

    $cellatitolirimuovi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuoviriga", "label"=>"Rimuovi"]);
    $rigatitolicombatt->addCella($cellatitolirimuovi);

    $tabcombattimento->addRiga($rigatitolicombatt);

    $divcombattimento->addElemento($tabcombattimento);
    
    // Se ci sono armi salvate sul DB Creo le relative righe
    global $gvPersonaggio;
    if ($gvPersonaggio != null && $gvPersonaggio->pg_arma != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_arma); $i++) {
            $lvArma = $gvPersonaggio->pg_arma[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            $lvCellId = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"id-".$i,
                "hidden"=>"hidden", "value"=>$lvArma->idArma
            ]);
            $lvRow->addCella($lvCellId);
            $lvCellArma = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"arma-".$i,
                "value"=>$lvArma->arma->Nome
            ]);
            $lvRow->addCella($lvCellArma);
            $lvCellAt = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"at-".$i,
                "onchange"=>"checkRigaFormat('at-".$i."')", "value"=>$lvArma->AtkRound
            ]);
            $lvRow->addCella($lvCellAt);
            $lvCellModad = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"modad-".$i,
                "onchange"=>"checkRigaFormat('modad-".$i."')", "value"=>$lvArma->ModAtkDanno
            ]);
            $lvRow->addCella($lvCellModad);
            $lvCellThaco = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"thaco-".$i,
                "onchange"=>"checkRigaFormat('thaco-".$i."')", "value"=>$lvArma->Thaco
            ]);
            $lvRow->addCella($lvCellThaco);
            $lvCellDanni = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"danni-".$i,
                "value"=>$lvArma->arma->DannoPM." / ".$lvArma->arma->DannoG
            ]);
            $lvRow->addCella($lvCellDanni);
            $lvCellRaggio = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"raggio-".$i,
                "onchange"=>"checkRigaFormat('raggio-".$i."')", "value"=>$lvArma->Raggio
            ]);
            $lvRow->addCella($lvCellRaggio);
            $lvCellPeso = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"peso-".$i,
                "value"=>$lvArma->arma->Peso
            ]);
            $lvRow->addCella($lvCellPeso);
            $lvCellTaglia = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"taglia-".$i,
                "value"=>$lvArma->arma->Taglia
            ]);
            $lvRow->addCella($lvCellTaglia);
            $lvCellTipo = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"tipo-".$i,
                "value"=>$lvArma->arma->Tipo
            ]);
            $lvRow->addCella($lvCellTipo);
            $lvCellVelocita = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"velocita-".$i,
                "value"=>$lvArma->arma->FattoreVelocita
            ]);
            $lvRow->addCella($lvCellVelocita);
            // BOTTONI
            $lvCellaModifica = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"Salva-".$i, "label"=>"Salva", "hidden"=>"hidden", "onclick"=>"ValidateRiga(".$i.")"],
                ["id"=>"Modifica-".$i, "label"=>"Modifica", "onclick"=>"ModificaRigaOnModifica(".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaModifica);
            $lvCellaRimuovi = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"Rimuovi-".$i, "classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRiga(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabcombattimento->addRiga($lvRow);
        }
    }

    $divconfigarmi = new clsUIDiv('configarmi');

    $rsCategoria = selectCategoriaArma();
    $cbCategoriaArma = creaCombobox('Categoria', 'cbcategoria', $rsCategoria, 'Categoria', 'Categoria');

    $divconfigarmi->addElemento($cbCategoriaArma);

    $rsArma = selectArmi(null, null);
    $cbArma = creaCombobox('Arma', 'cbarma', $rsArma, 'idArma', 'Nome');

    $divconfigarmi->addElemento($cbArma);

    $aggiungiarmabtn = new clsButton('Aggiungi', 'aggiungiarmabtn', 'button', 'aggiungiarmabtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigarmi->addElemento($aggiungiarmabtn);   

    $ErroreArmi = new clsUIParagrafo(["id"=>"msgerrarmi", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigarmi->addElemento($ErroreArmi);

    $divcombattimento->addElemento($divconfigarmi);

    $panel2->addElemento($divcombattimento);

    /*******************************************************
        sezione PROFICIENZE ARMI della scheda
    *******************************************************/

    $divproficienzearmi = new clsUIDiv('divproficienzearmi');
    $tabproficienzearmi = new clsUITabella('tabproficienzearmi', null, 'PROFICIENZE CON LE ARMI');

    //riga dei titoli
    $rigatitoliprofarmi = new clsUITabellaRiga('tabellariga combattimento');

    $cellatitoloidprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"idprofarmi", "label"=>"ID", "hidden"=>"hidden"]);
    $rigatitoliprofarmi->addCella($cellatitoloidprofarmi);

    $cellatitoloarmaprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"armaprofarmi", "label"=>"Arma"]);
    $rigatitoliprofarmi->addCella($cellatitoloarmaprofarmi);

    $cellatitoloPPprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"PPprofarmi", "label"=>"PP"]);
    $rigatitoliprofarmi->addCella($cellatitoloPPprofarmi);

    $cellatitolosceltaprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"sceltaprofarmi", "label"=>"Scelta"]);
    $rigatitoliprofarmi->addCella($cellatitolosceltaprofarmi);

    $cellatitoloespertoprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"espertoprofarmi", "label"=>"Esperto"]);
    $rigatitoliprofarmi->addCella($cellatitoloespertoprofarmi);

    $cellatitolospecprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"specprofarmi", "label"=>"Spec."]);
    $rigatitoliprofarmi->addCella($cellatitolospecprofarmi);

    $cellatitolomaestroprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"maestroprofarmi", "label"=>"Maestro"]);
    $rigatitoliprofarmi->addCella($cellatitolomaestroprofarmi);

    $cellatitoloaltoprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"altoprofarmi", "label"=>"Alto"]);
    $rigatitoliprofarmi->addCella($cellatitoloaltoprofarmi);

    $cellatitolograndeprofarmi = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"grandeprofarmi", "label"=>"Grande"]);
    $rigatitoliprofarmi->addCella($cellatitolograndeprofarmi);

    $cellatitolisalvaprof = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"salvarigaprof", "label"=>"M/S"]);
    $rigatitoliprofarmi->addCella($cellatitolisalvaprof);

    $cellatitolirimuoviprof = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"rimuovirigaprof", "label"=>"Rimuovi"]);
    $rigatitoliprofarmi->addCella($cellatitolirimuoviprof);

    $tabproficienzearmi->addRiga($rigatitoliprofarmi);

    // Se ci sono proficienze con le armi salvate sul DB Creo le relative righe
    if ($gvPersonaggio != null && $gvPersonaggio->pg_proficienzearmi != null) {
        for($i = 0; $i < count($gvPersonaggio->pg_proficienzearmi); $i++) {
            $lvProfArma = $gvPersonaggio->pg_proficienzearmi[$i];
            $lvRow = new clsUITabellaRiga('tabellariga');
            $lvCellIdProf = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"idprof-".$i,
                "hidden"=>"hidden", "value"=>$lvProfArma->idArma
            ]);
            $lvRow->addCella($lvCellIdProf);
            //
            $lvCellArmaProf = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"armaprof-".$i,
                "value"=>$lvProfArma->arma->Nome
            ]);
            $lvRow->addCella($lvCellArmaProf);
            //
            $lvCellPP = creaCella(["tipo"=>"2", "readonly"=>"readonly", "classe"=>"cellavalore", "id"=>"PP-".$i,
                "onchange"=>"checkPPFormat('PP-".$i."')", "value"=>$lvProfArma->PP
            ]);
            $lvRow->addCella($lvCellPP);
            //
            $lvCellScelta = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"scelta-".$i,
                "name"=>"checkgroup-".$i, "value"=>$lvProfArma->Scelta
            ]);
            $lvRow->addCella($lvCellScelta);
            //
            $lvCellEsperto = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"esperto-".$i,
                "name"=>"checkgroup-".$i, "value"=>$lvProfArma->Esperto
            ]);
            $lvRow->addCella($lvCellEsperto);
            //
            $lvCellSpec = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"spec-".$i,
                "name"=>"checkgroup-".$i, "value"=>$lvProfArma->Specializzato
            ]);
            $lvRow->addCella($lvCellSpec);
            //
            $lvCellMaestro = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"maestro-".$i,
                "name"=>"checkgroup-".$i, "value"=>$lvProfArma->Maestro
            ]);
            $lvRow->addCella($lvCellMaestro);
            //
            $lvCellAlto = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"alto-".$i,
                "name"=>"checkgroup-".$i, "value"=>$lvProfArma->Alto
            ]);
            $lvRow->addCella($lvCellAlto);
            //
            $lvCellGrande = creaCella(["tipo"=>"checkbox", "disabled"=>"disabled", "classe"=>"cellavalore", "id"=>"grande-".$i,
                "value"=>$lvProfArma->Grande
            ]);
            $lvRow->addCella($lvCellGrande);
            //
            // BOTTONI
            $lvCellaModifica = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"salvaprof-".$i, "label"=>"Salva", "hidden"=>"hidden", "onclick"=>"ValidateRigaProf(".$i.")"],
                ["id"=>"modificaprof-".$i, "label"=>"Modifica", "onclick"=>"ModificaRigaProfOnModifica(".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaModifica);
            $lvCellaRimuovi = creaCella(["tipo"=>"3", "classe"=>"cellavalore", "bottoni"=>[
                ["id"=>"RimuoviProf-".$i, "classe"=>"removebutton", "label"=>"", "onclick"=>"rimuoviRigaProf(this, ".$i.")"],
            ]]);
            $lvRow->addCella($lvCellaRimuovi);
            //
            $tabproficienzearmi->addRiga($lvRow);
        }
    }

    $divproficienzearmi->addElemento($tabproficienzearmi);

    $divconfigarmiprof = new clsUIDiv('configarmi');

    $rsCategoriaProf = selectCategoriaArma();
    $cbCategoriaArmaProf = creaCombobox('Categoria', 'cbcategoriaprof', $rsCategoriaProf, 'Categoria', 'Categoria');

    $divconfigarmiprof->addElemento($cbCategoriaArmaProf);

    $rsArmaProf = selectArmi(null, null);
    $cbArmaProf = creaCombobox('Arma', 'cbarmaprof', $rsArmaProf, 'idArma', 'Nome');

    $divconfigarmiprof->addElemento($cbArmaProf);

    $aggiungiarmaprofbtn = new clsButton('Aggiungi', 'aggiungiarmaprofbtn', 'button', 'aggiungiarmaprofbtn', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divconfigarmiprof->addElemento($aggiungiarmaprofbtn);   

    $ErroreArmiProf = new clsUIParagrafo(["id"=>"msgerrarmiprof", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divconfigarmiprof->addElemento($ErroreArmiProf);

    $divproficienzearmi->addElemento($divconfigarmiprof);

    $panel2->addElemento($divproficienzearmi);
    //
    return $panel2;

}
?>
