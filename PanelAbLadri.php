<?php
function getPanelAbLadri() {

    $panel5 = new clsUIFieldSet('Abilit&agrave; dei ladri', 'nocampiobbligatori');
        /**********************************************************************
            sezione ABILITA DEI LADRI della scheda
        **********************************************************************/
        $divabilitaladri = new clsUIDiv('divabilitaladri');
        $tababilitaladri = new clsUITabella('tababilitaladri', null, 'ABILIT&Agrave; DEI LADRI');

        //PRIMA RIGA
        $rigatitoliabladri = new clsUITabellaRiga('tabellariga titoliladri');

        $cellatitoloabladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"abladri", "label"=>"Abilit&agrave;"]);
        $rigatitoliabladri->addCella($cellatitoloabladri);

        $cellatitolobaseladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"baseladri", "label"=>"Base"]);
        $rigatitoliabladri->addCella($cellatitolobaseladri);

        $cellatitolorazzaladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"razzaladri", "label"=>"Razza"]);
        $rigatitoliabladri->addCella($cellatitolorazzaladri);

        $cellatitolodestrladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"destrladri", "label"=>"Destr."]);
        $rigatitoliabladri->addCella($cellatitolodestrladri);

        $cellatitoloarmladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"armladri", "label"=>"Arm."]);
        $rigatitoliabladri->addCella($cellatitoloarmladri);

        $cellatitolotrattiladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"trattiladri", "label"=>"Tratti"]);
        $rigatitoliabladri->addCella($cellatitolotrattiladri);

        $cellatitolooggettiladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"oggettiladri", "label"=>"Oggetti"]);
        $rigatitoliabladri->addCella($cellatitolooggettiladri);

        $cellatitololivelloladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"livelloladri", "label"=>"Livello"]);
        $rigatitoliabladri->addCella($cellatitololivelloladri);

        $cellatitolospecialeladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"specialeladri", "label"=>"Speciale"]);
        $rigatitoliabladri->addCella($cellatitolospecialeladri);

        $cellatitolototaleladri = creaCella(["tipo"=>"1", "classe"=>"titolocella", "id"=>"totaleladri", "label"=>"Totale"]);
        $rigatitoliabladri->addCella($cellatitolototaleladri);

        $tababilitaladri->addRiga($rigatitoliabladri);

        //SECONDA RIGA

        $rigasvuotaretasche = new clsUITabellaRiga('tabellariga svuotaretasche');

        $cellatitolosvuotaretasche = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"svuotaretascheladri", "label"=>"Svuotare Tasche"]);
        $rigasvuotaretasche->addCella($cellatitolosvuotaretasche);

        $cellavaloresvtaschebase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-base", "value"=>getValue('valsvuotaretasche-base')]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschebase);

        $cellavaloresvtascherazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-razza", "value"=>getValue('valsvuotaretasche-razza')]);
        $rigasvuotaretasche->addCella($cellavaloresvtascherazza);

        $cellavaloresvtaschedestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-destr", "value"=>getValue('valsvuotaretasche-destr')]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschedestr);

        $cellavaloresvtaschearm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-arm", "value"=>getValue('valsvuotaretasche-arm')]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschearm);

        $cellavaloresvtaschetratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-tratti", "value"=>getValue('valsvuotaretasche-tratti')]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschetratti);

        $cellavaloresvtascheoggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-oggetti", "value"=>getValue('valsvuotaretasche-oggetti')]);
        $rigasvuotaretasche->addCella($cellavaloresvtascheoggetti);

        $cellavaloresvtaschelivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-livello", "value"=>getValue('valsvuotaretasche-livello')]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschelivello);

        $cellavaloresvtaschespeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-speciale", "value"=>getValue('valsvuotaretasche-speciale')]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschespeciale);

        $cellavaloresvtaschetotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvuotaretasche-totale", "readonly"=>"readonly"]);
        $rigasvuotaretasche->addCella($cellavaloresvtaschetotale);

        $tababilitaladri->addRiga($rigasvuotaretasche);

        //TERZA RIGA
        $rigascassinareserrature = new clsUITabellaRiga('tabellariga scassinareserrature');

        $cellatitoloscassinareserrature = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"scassinareserratureladri", "label"=>"Scassinare Serrature"]);
        $rigascassinareserrature->addCella($cellatitoloscassinareserrature);

        $cellavalorescserrbase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-base", "value"=>getValue('valscassinareserrature-base')]);
        $rigascassinareserrature->addCella($cellavalorescserrbase);

        $cellavalorescserrrazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-razza", "value"=>getValue('valscassinareserrature-razza')]);
        $rigascassinareserrature->addCella($cellavalorescserrrazza);

        $cellavalorescserrdestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-destr", "value"=>getValue('valscassinareserrature-destr')]);
        $rigascassinareserrature->addCella($cellavalorescserrdestr);

        $cellavalorescserrarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-arm", "value"=>getValue('valscassinareserrature-arm')]);
        $rigascassinareserrature->addCella($cellavalorescserrarm);

        $cellavalorescserrtratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-tratti", "value"=>getValue('valscassinareserrature-tratti')]);
        $rigascassinareserrature->addCella($cellavalorescserrtratti);

        $cellavalorescserroggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-oggetti", "value"=>getValue('valscassinareserrature-oggetti')]);
        $rigascassinareserrature->addCella($cellavalorescserroggetti);

        $cellavalorescserrlivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-livello", "value"=>getValue('valscassinareserrature-livello')]);
        $rigascassinareserrature->addCella($cellavalorescserrlivello);

        $cellavalorescserrspeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-speciale", "value"=>getValue('valscassinareserrature-speciale')]);
        $rigascassinareserrature->addCella($cellavalorescserrspeciale);

        $cellavalorescserrtotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscassinareserrature-totale", "readonly"=>"readonly"]);
        $rigascassinareserrature->addCella($cellavalorescserrtotale);

        $tababilitaladri->addRiga($rigascassinareserrature);

        //QUARTA RIGA
        $rigatrappole = new clsUITabellaRiga('tabellariga trappole');

        $cellatitolotrappole = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"trappoleladri", "label"=>"Scoprire/Rimuovere Trappole"]);
        $rigatrappole->addCella($cellatitolotrappole);

        $cellavaloretrappolebase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-base", "value"=>getValue('valtrappole-base')]);
        $rigatrappole->addCella($cellavaloretrappolebase);

        $cellavaloretrappolerazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-razza", "value"=>getValue('valtrappole-razza')]);
        $rigatrappole->addCella($cellavaloretrappolerazza);

        $cellavaloretrappoledestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-destr", "value"=>getValue('valtrappole-destr')]);
        $rigatrappole->addCella($cellavaloretrappoledestr);

        $cellavaloretrappolearm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-arm", "value"=>getValue('valtrappole-arm')]);
        $rigatrappole->addCella($cellavaloretrappolearm);

        $cellavaloretrappoletratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-tratti", "value"=>getValue('valtrappole-tratti')]);
        $rigatrappole->addCella($cellavaloretrappoletratti);

        $cellavaloretrappoleoggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-oggetti", "value"=>getValue('valtrappole-oggetti')]);
        $rigatrappole->addCella($cellavaloretrappoleoggetti);

        $cellavaloretrappolelivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-livello", "value"=>getValue('valtrappole-livello')]);
        $rigatrappole->addCella($cellavaloretrappolelivello);

        $cellavaloretrappolespeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-speciale", "value"=>getValue('valtrappole-speciale')]);
        $rigatrappole->addCella($cellavaloretrappolespeciale);

        $cellavaloretrappoletotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valtrappole-totale", "readonly"=>"readonly"]);
        $rigatrappole->addCella($cellavaloretrappoletotale);

        $tababilitaladri->addRiga($rigatrappole);   

        //QUINTA RIGA
        $rigamuoversisilenz = new clsUITabellaRiga('tabellariga muoversisilenziosamente');

        $cellatitolomovsil = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"muoversisilenziosamenteladri", "label"=>"Muoversi Silenziosamente"]);
        $rigamuoversisilenz->addCella($cellatitolomovsil);

        $cellavaloremovsilbase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-base", "value"=>getValue('valmovsil-base')]);
        $rigamuoversisilenz->addCella($cellavaloremovsilbase);

        $cellavaloremovsilrazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-razza", "value"=>getValue('valmovsil-razza')]);
        $rigamuoversisilenz->addCella($cellavaloremovsilrazza);

        $cellavaloremovsildestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-destr", "value"=>getValue('valmovsil-destr')]);
        $rigamuoversisilenz->addCella($cellavaloremovsildestr);

        $cellavaloremovsilarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-arm", "value"=>getValue('valmovsil-arm')]);
        $rigamuoversisilenz->addCella($cellavaloremovsilarm);

        $cellavaloremovsiltratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-tratti", "value"=>getValue('valmovsil-tratti')]);
        $rigamuoversisilenz->addCella($cellavaloremovsiltratti);

        $cellavaloremovsiloggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-oggetti", "value"=>getValue('valmovsil-oggetti')]);
        $rigamuoversisilenz->addCella($cellavaloremovsiloggetti);

        $cellavaloremovsillivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-livello", "value"=>getValue('valmovsil-livello')]);
        $rigamuoversisilenz->addCella($cellavaloremovsillivello);

        $cellavaloremovsilspeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-speciale", "value"=>getValue('valmovsil-speciale')]);
        $rigamuoversisilenz->addCella($cellavaloremovsilspeciale);

        $cellavaloremovsiltotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valmovsil-totale", "readonly"=>"readonly"]);
        $rigamuoversisilenz->addCella($cellavaloremovsiltotale);

        $tababilitaladri->addRiga($rigamuoversisilenz);

        //SESTA RIGA
        $riganascondersi = new clsUITabellaRiga('tabellariga nascondersinelleombre');

        $cellatitolonascondersi = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"nascondersinelleombreladri", "label"=>"Nascondersi nelle Ombre"]);
        $riganascondersi->addCella($cellatitolonascondersi);

        $cellavalorenascondersibase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-base", "value"=>getValue('valnascondersi-base')]);
        $riganascondersi->addCella($cellavalorenascondersibase);

        $cellavalorenascondersirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-razza", "value"=>getValue('valnascondersi-razza')]);
        $riganascondersi->addCella($cellavalorenascondersirazza);

        $cellavalorenascondersidestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-destr", "value"=>getValue('valnascondersi-destr')]);
        $riganascondersi->addCella($cellavalorenascondersidestr);

        $cellavalorenascondersiarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-arm", "value"=>getValue('valnascondersi-arm')]);
        $riganascondersi->addCella($cellavalorenascondersiarm);

        $cellavalorenascondersitratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-tratti", "value"=>getValue('valnascondersi-tratti')]);
        $riganascondersi->addCella($cellavalorenascondersitratti);

        $cellavalorenascondersioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-oggetti", "value"=>getValue('valnascondersi-oggetti')]);
        $riganascondersi->addCella($cellavalorenascondersioggetti);

        $cellavalorenascondersilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-livello", "value"=>getValue('valnascondersi-livello')]);
        $riganascondersi->addCella($cellavalorenascondersilivello);

        $cellavalorenascondersispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-speciale", "value"=>getValue('valnascondersi-speciale')]);
        $riganascondersi->addCella($cellavalorenascondersispeciale);

        $cellavalorenascondersitotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valnascondersi-totale", "readonly"=>"readonly"]);
        $riganascondersi->addCella($cellavalorenascondersitotale);

        $tababilitaladri->addRiga($riganascondersi);

        //SETTIMA RIGA
        $rigasentirerumori = new clsUITabellaRiga('tabellariga sentirerumori');

        $cellatitolosentirerumori = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"sentirerumoriladri", "label"=>"Sentire Rumori"]);
        $rigasentirerumori->addCella($cellatitolosentirerumori);

        $cellavaloresentirerumoribase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-base", "value"=>getValue('valsentirerumori-base')]);
        $rigasentirerumori->addCella($cellavaloresentirerumoribase);

        $cellavaloresentirerumorirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-razza", "value"=>getValue('valsentirerumori-razza')]);
        $rigasentirerumori->addCella($cellavaloresentirerumorirazza);

        $cellavaloresentirerumoridestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-destr", "value"=>getValue('valsentirerumori-destr')]);
        $rigasentirerumori->addCella($cellavaloresentirerumoridestr);

        $cellavaloresentirerumoriarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-arm", "value"=>getValue('valsentirerumori-arm')]);
        $rigasentirerumori->addCella($cellavaloresentirerumoriarm);

        $cellavaloresentirerumoritratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-tratti", "value"=>getValue('valsentirerumori-tratti')]);
        $rigasentirerumori->addCella($cellavaloresentirerumoritratti);

        $cellavaloresentirerumorioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-oggetti", "value"=>getValue('valsentirerumori-oggetti')]);
        $rigasentirerumori->addCella($cellavaloresentirerumorioggetti);

        $cellavaloresentirerumorilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-livello", "value"=>getValue('valsentirerumori-livello')]);
        $rigasentirerumori->addCella($cellavaloresentirerumorilivello);

        $cellavaloresentirerumorispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-speciale", "value"=>getValue('valsentirerumori-speciale')]);
        $rigasentirerumori->addCella($cellavaloresentirerumorispeciale);

        $cellavaloresentirerumoritotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsentirerumori-totale", "readonly"=>"readonly"]);
        $rigasentirerumori->addCella($cellavaloresentirerumoritotale);

        $tababilitaladri->addRiga($rigasentirerumori);

        //OTTAVA RIGA
        $rigascalarepareti = new clsUITabellaRiga('tabellariga scalarepareti');

        $cellatitoloscalarepareti = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"scalareparetiladri", "label"=>"Scalare Pareti"]);
        $rigascalarepareti->addCella($cellatitoloscalarepareti);

        $cellavalorescalareparetibase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-base", "value"=>getValue('valscalarepareti-base')]);
        $rigascalarepareti->addCella($cellavalorescalareparetibase);

        $cellavalorescalareparetirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-razza", "value"=>getValue('valscalarepareti-razza')]);
        $rigascalarepareti->addCella($cellavalorescalareparetirazza);

        $cellavalorescalareparetidestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-destr", "value"=>getValue('valscalarepareti-destr')]);
        $rigascalarepareti->addCella($cellavalorescalareparetidestr);

        $cellavalorescalareparetiarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-arm", "value"=>getValue('valscalarepareti-arm')]);
        $rigascalarepareti->addCella($cellavalorescalareparetiarm);

        $cellavalorescalareparetitratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-tratti", "value"=>getValue('valscalarepareti-tratti')]);
        $rigascalarepareti->addCella($cellavalorescalareparetitratti);

        $cellavalorescalareparetioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-oggetti", "value"=>getValue('valscalarepareti-oggetti')]);
        $rigascalarepareti->addCella($cellavalorescalareparetioggetti);

        $cellavalorescalareparetilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-livello", "value"=>getValue('valscalarepareti-livello')]);
        $rigascalarepareti->addCella($cellavalorescalareparetilivello);

        $cellavalorescalareparetispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-speciale", "value"=>getValue('valscalarepareti-speciale')]);
        $rigascalarepareti->addCella($cellavalorescalareparetispeciale);

        $cellavalorescalareparetitotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscalarepareti-totale", "readonly"=>"readonly"]);
        $rigascalarepareti->addCella($cellavalorescalareparetitotale);

        $tababilitaladri->addRiga($rigascalarepareti);

        //NONA RIGA
        $rigaletturalinguaggi = new clsUITabellaRiga('tabellariga letturalinguaggi');

        $cellatitololetturalinguaggi = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"letturalinguaggiladri", "label"=>"Lettura Linguaggi"]);
        $rigaletturalinguaggi->addCella($cellatitololetturalinguaggi);

        $cellavaloreletturalinguaggibase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-base", "value"=>getValue('valletturalinguaggi-base')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggibase);

        $cellavaloreletturalinguaggirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-razza", "value"=>getValue('valletturalinguaggi-razza')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggirazza);

        $cellavaloreletturalinguaggidestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-destr", "value"=>getValue('valletturalinguaggi-destr')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggidestr);

        $cellavaloreletturalinguaggiarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-arm", "value"=>getValue('valletturalinguaggi-arm')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggiarm);

        $cellavaloreletturalinguaggitratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-tratti", "value"=>getValue('valletturalinguaggi-tratti')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggitratti);

        $cellavaloreletturalinguaggioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-oggetti", "value"=>getValue('valletturalinguaggi-oggetti')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggioggetti);

        $cellavaloreletturalinguaggilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-livello", "value"=>getValue('valletturalinguaggi-livello')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggilivello);

        $cellavaloreletturalinguaggispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-speciale", "value"=>getValue('valletturalinguaggi-speciale')]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggispeciale);

        $cellavaloreletturalinguaggitotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valletturalinguaggi-totale", "readonly"=>"readonly"]);
        $rigaletturalinguaggi->addCella($cellavaloreletturalinguaggitotale);

        $tababilitaladri->addRiga($rigaletturalinguaggi);

        //DECIMA RIGA
        $rigaindividuazionemagico = new clsUITabellaRiga('tabellariga individuazionemagico');

        $cellatitoloindividuazionemagico = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"individuazionemagicoladri", "label"=>"Individuazione del Magico"]);
        $rigaindividuazionemagico->addCella($cellatitoloindividuazionemagico);

        $cellavaloreindividuazionemagicobase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-base", "value"=>getValue('valindividuazionemagico-base')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicobase);

        $cellavaloreindividuazionemagicorazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-razza", "value"=>getValue('valindividuazionemagico-razza')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicorazza);

        $cellavaloreindividuazionemagicodestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-destr", "value"=>getValue('valindividuazionemagico-destr')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicodestr);

        $cellavaloreindividuazionemagicoarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-arm", "value"=>getValue('valindividuazionemagico-arm')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicoarm);

        $cellavaloreindividuazionemagicotratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-tratti", "value"=>getValue('valindividuazionemagico-tratti')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicotratti);

        $cellavaloreindividuazionemagicooggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-oggetti", "value"=>getValue('valindividuazionemagico-oggetti')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicooggetti);

        $cellavaloreindividuazionemagicolivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-livello", "value"=>getValue('valindividuazionemagico-livello')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicolivello);

        $cellavaloreindividuazionemagicospeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-speciale", "value"=>getValue('valindividuazionemagico-speciale')]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicospeciale);

        $cellavaloreindividuazionemagicototale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazionemagico-totale", "readonly"=>"readonly"]);
        $rigaindividuazionemagico->addCella($cellavaloreindividuazionemagicototale);

        $tababilitaladri->addRiga($rigaindividuazionemagico);

        //UNDICESIMA RIGA
        $rigaindividuazioneillusioni = new clsUITabellaRiga('tabellariga individuazioneillusioni');

        $cellatitoloindividuazioneillusioni = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"individuazioneillusioniladri", "label"=>"Individuazione delle Illusioni"]);
        $rigaindividuazioneillusioni->addCella($cellatitoloindividuazioneillusioni);

        $cellavaloreindividuazioneillusionibase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-base", "value"=>getValue('valindividuazioneillusioni-base')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionibase);

        $cellavaloreindividuazioneillusionirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-razza", "value"=>getValue('valindividuazioneillusioni-razza')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionirazza);

        $cellavaloreindividuazioneillusionidestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-destr", "value"=>getValue('valindividuazioneillusioni-destr')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionidestr);

        $cellavaloreindividuazioneillusioniarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-arm", "value"=>getValue('valindividuazioneillusioni-arm')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusioniarm);

        $cellavaloreindividuazioneillusionitratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-tratti", "value"=>getValue('valindividuazioneillusioni-tratti')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionitratti);

        $cellavaloreindividuazioneillusionioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-oggetti", "value"=>getValue('valindividuazioneillusioni-oggetti')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionioggetti);

        $cellavaloreindividuazioneillusionilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-livello", "value"=>getValue('valindividuazioneillusioni-livello')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionilivello);

        $cellavaloreindividuazioneillusionispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-speciale", "value"=>getValue('valindividuazioneillusioni-speciale')]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionispeciale);

        $cellavaloreindividuazioneillusionitotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valindividuazioneillusioni-totale", "readonly"=>"readonly"]);
        $rigaindividuazioneillusioni->addCella($cellavaloreindividuazioneillusionitotale);

        $tababilitaladri->addRiga($rigaindividuazioneillusioni);

        //DODICESIMA RIGA
        $rigacorrompere = new clsUITabellaRiga('tabellariga corrompere');

        $cellatitolocorrompere = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"corrompereladri", "label"=>"Corrompere"]);
        $rigacorrompere->addCella($cellatitolocorrompere);

        $cellavalorecorromperebase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-base", "value"=>getValue('valcorrompere-base')]);
        $rigacorrompere->addCella($cellavalorecorromperebase);

        $cellavalorecorrompererazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-razza", "value"=>getValue('valcorrompere-razza')]);
        $rigacorrompere->addCella($cellavalorecorrompererazza);

        $cellavalorecorromperedestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-destr", "value"=>getValue('valcorrompere-destr')]);
        $rigacorrompere->addCella($cellavalorecorromperedestr);

        $cellavalorecorromperearm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-arm", "value"=>getValue('valcorrompere-arm')]);
        $rigacorrompere->addCella($cellavalorecorromperearm);

        $cellavalorecorromperetratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-tratti", "value"=>getValue('valcorrompere-tratti')]);
        $rigacorrompere->addCella($cellavalorecorromperetratti);

        $cellavalorecorrompereoggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-oggetti", "value"=>getValue('valcorrompere-oggetti')]);
        $rigacorrompere->addCella($cellavalorecorrompereoggetti);

        $cellavalorecorromperelivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-livello", "value"=>getValue('valcorrompere-livello')]);
        $rigacorrompere->addCella($cellavalorecorromperelivello);

        $cellavalorecorromperespeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-speciale", "value"=>getValue('valcorrompere-speciale')]);
        $rigacorrompere->addCella($cellavalorecorromperespeciale);

        $cellavalorecorromperetotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valcorrompere-totale", "readonly"=>"readonly"]);
        $rigacorrompere->addCella($cellavalorecorromperetotale);

        $tababilitaladri->addRiga($rigacorrompere);

        //TREDICESIMA RIGA
        $rigascavarepassaggi = new clsUITabellaRiga('tabellariga scavarepassaggi');

        $cellatitoloscavarepassaggi = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"scavarepassaggiladri", "label"=>"Scavare Passaggi"]);
        $rigascavarepassaggi->addCella($cellatitoloscavarepassaggi);

        $cellavalorescavarepassaggibase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-base", "value"=>getValue('valscavarepassaggi-base')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggibase);

        $cellavalorescavarepassaggirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-razza", "value"=>getValue('valscavarepassaggi-razza')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggirazza);

        $cellavalorescavarepassaggidestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-destr", "value"=>getValue('valscavarepassaggi-destr')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggidestr);

        $cellavalorescavarepassaggiarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-arm", "value"=>getValue('valscavarepassaggi-arm')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggiarm);

        $cellavalorescavarepassaggitratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-tratti", "value"=>getValue('valscavarepassaggi-tratti')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggitratti);

        $cellavalorescavarepassaggioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-oggetti", "value"=>getValue('valscavarepassaggi-oggetti')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggioggetti);

        $cellavalorescavarepassaggilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-livello", "value"=>getValue('valscavarepassaggi-livello')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggilivello);

        $cellavalorescavarepassaggispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-speciale", "value"=>getValue('valscavarepassaggi-speciale')]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggispeciale);

        $cellavalorescavarepassaggitotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valscavarepassaggi-totale", "readonly"=>"readonly"]);
        $rigascavarepassaggi->addCella($cellavalorescavarepassaggitotale);

        $tababilitaladri->addRiga($rigascavarepassaggi);

        //QUATTORDICESIMA RIGA
        $rigasvincolarsi = new clsUITabellaRiga('tabellariga svincolarsi');

        $cellatitolosvincolarsi = creaCella(["tipo"=>"1", "classe"=>"titolocella azzurro colonnaladri bordo", "id"=>"svincolarsiladri", "label"=>"Svincolarsi"]);
        $rigasvincolarsi->addCella($cellatitolosvincolarsi);

        $cellavaloresvincolarsibase = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-base", "value"=>getValue('valsvincolarsi-base')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsibase);

        $cellavaloresvincolarsirazza = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-razza", "value"=>getValue('valsvincolarsi-razza')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsirazza);

        $cellavaloresvincolarsidestr = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-destr", "value"=>getValue('valsvincolarsi-destr')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsidestr);

        $cellavaloresvincolarsiarm = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-arm", "value"=>getValue('valsvincolarsi-arm')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsiarm);

        $cellavaloresvincolarsitratti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-tratti", "value"=>getValue('valsvincolarsi-tratti')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsitratti);

        $cellavaloresvincolarsioggetti = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-oggetti", "value"=>getValue('valsvincolarsi-oggetti')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsioggetti);

        $cellavaloresvincolarsilivello = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-livello", "value"=>getValue('valsvincolarsi-livello')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsilivello);

        $cellavaloresvincolarsispeciale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-speciale", "value"=>getValue('valsvincolarsi-speciale')]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsispeciale);

        $cellavaloresvincolarsitotale = creaCella([ "tipo"=>"2", "classe"=>"cellavalore bordo", "name"=>"valsvincolarsi-totale", "readonly"=>"readonly"]);
        $rigasvincolarsi->addCella($cellavaloresvincolarsitotale);

        $tababilitaladri->addRiga($rigasvincolarsi);

        //QUINDICESIMA RIGA
        $rigapugnalare = new clsUITabellaRiga('tabellariga pugnalare');

        $cellatitolopugnalare = creaCella(["tipo"=>"1", "classe"=>"titolocella blu colonnaladri bordo", "id"=>"pugnalareladri", "label"=>"Pugnalare alle Spalle"]);
        $rigapugnalare->addCella($cellatitolopugnalare);

        $cellatitoloX = creaCella(["tipo"=>"1", "classe"=>"titolocella testodestra", "id"=>"Xladri", "label"=>"X"]);
        $rigapugnalare->addCella($cellatitoloX);

        $cellavalorepugnalare = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valpugnalaretotale", "value"=>getValue('valpugnalaretotale')]);
        $rigapugnalare->addCella($cellavalorepugnalare);

        $tababilitaladri->addRiga($rigapugnalare);

        $divabilitaladri->addElemento($tababilitaladri);

        $panel5->addElemento($divabilitaladri);

        $divsalvaabilitaladri = new clsUIDiv('divsalvataggio');
        $BtnSalvaAbilitaLadri = new clsButton('Salva Abilit&agrave; dei Ladri', 'BtnSalvaAbilitaLadri', 'button', 'BtnSalvaAbilitaLadri', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
        $divsalvaabilitaladri->addElemento($BtnSalvaAbilitaLadri);
        $BtnModificaAbilitaLadri = new clsButton('Modifica', 'BtnModificaAbilitaLadri', 'button', 'BtnModificaAbilitaLadri', null, 'hidden');
        $divsalvaabilitaladri->addElemento($BtnModificaAbilitaLadri);
        $ErroreAbilitaLadri = new clsUIParagrafo(["id"=>"msgerrabilitaladri", "class"=>"saveerror", "hidden"=>"hidden"]);
        $divsalvaabilitaladri->addElemento($ErroreAbilitaLadri);

        $panel5->addElemento($divsalvaabilitaladri);

        return $panel5;
}
?>
