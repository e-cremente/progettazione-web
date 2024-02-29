<?php
function getPanelPersonaggio() {
    $panel = new clsUIFieldSet('Caratteristiche Principali del Personaggio');

    $divsinistra = new clsUIDiv('divscheda');
    $divdestra = new clsUIDiv('divscheda');

    //creazione textbox nome personaggio
    $tbNomePersonaggio = creaTextbox('Nome Personaggio*', 'nomepg', 'Solo lettere o spazi', getValue('nomepg'));
    $divsinistra->addElemento($tbNomePersonaggio);

    //creazione combobox allineamento
    $rsAllineamento = selectAllineamento();
    $cbAllineamento = creaCombobox('Allineamento*', 'alignment', $rsAllineamento, 'idAllineamento', 'Tipologia', getValue('alignment'));
    $divsinistra->addElemento($cbAllineamento);

    //creazione combobox razza
    $rsRazza = selectRazza();
    $cbRazza = creaCombobox('Razza*', 'race', $rsRazza, 'idRazza', 'Nome', getValue('race'));
    $divsinistra->addElemento($cbRazza);

    //creazione combobox classe
    $rsClasse = selectClasse();
    $cbClasse = creaCombobox('Classe*', 'cls', $rsClasse, 'idClasse', 'Nome', getValue('cls'));
    $divsinistra->addElemento($cbClasse);

    //creazione textbox per classi secondarie o specializzazioni
    $tbSpecializzazioni = creaTextbox('Classi Secondarie o Specializzazioni', 'secondaryclass', '---', getValue('secondaryclass'));
    $divsinistra->addElemento($tbSpecializzazioni);

    //creazione textbox livello
    $tbLivello = creaTextbox('Livello*', 'lvl', 'Valore Numerico', getValue('lvl'));
    $divsinistra->addElemento($tbLivello);

    //creazione textbox per eventuali livelli delle specializzazioni
    $tbLivelloSec = creaTextbox('Livello delle Classi Secondarie', 'secondarylvl', '---', getValue('secondarylvl'));
    $divsinistra->addElemento($tbLivelloSec);

    //creazione textbox per punti esperienza
    $tbEsperienza = creaTextbox('Punti Esperienza*', 'exp', 'Valore Numerico', getValue('exp'));
    $divsinistra->addElemento($tbEsperienza);

    //creazione textbox per origine
    $tbOrigine = creaTextbox('Origine', 'origin', 'Solo lettere o spazi', getValue('origin'));
    $divsinistra->addElemento($tbOrigine);

    //creazione textbox per famiglia
    $tbFamiglia = creaTextbox('Famiglia', 'family', 'Solo lettere o spazi', getValue('family'));
    $divsinistra->addElemento($tbFamiglia);

    //creazione textbox per stirpe o clan
    $tbClan = creaTextbox('Stirpe o Clan', 'clan', 'Solo lettere o spazi', getValue('clan'));
    $divdestra->addElemento($tbClan);

    //creazione textbox per religione
    $tbReligione = creaTextbox('Religione', 'rel', 'Solo lettere o spazi', getValue('rel'));
    $divdestra->addElemento($tbReligione);
    /*$rsReligione = selectReligione();
    $cbReligione = creaCombobox('Religione', 'rel', $rsReligione, )
    $divdestra->addElemento($cdReligione);*/

    //creazione textbox per classe sociale
    $tbClasseSociale = creaTextbox('Classe Sociale', 'socclass', 'Solo lettere o spazi', getValue('socclass'));
    $divdestra->addElemento($tbClasseSociale);

    //creazione textbox per fratelli o sorelle
    $tbFrattelli = creaTextbox('Fratelli o Sorelle', 'fratsis', 'Solo lettere o spazi', getValue('fratsis'));
    $divdestra->addElemento($tbFrattelli);

    //creazione combobox sesso
    $rsSesso = [
        ["valore" => "F", "descrizione" => "Femmina"],
        ["valore" => "M", "descrizione" => "Maschio"]
    ];
    $cbSesso = creaCombobox('Sesso*', 'sex', $rsSesso, 'valore', 'descrizione', getValue('sex'));
    $divdestra->addElemento($cbSesso);

    //creazione textbox per anni
    $tbAnni = creaTextbox('Et&agrave;*', 'age', 'Valore Numerico', getValue('age'));
    $divdestra->addElemento($tbAnni);

    //creazione textbox per altezza
    $tbAltezza = creaTextbox('Altezza', 'heigth', 'Valore Numerico (in cm)', getValue('heigth'));
    $divdestra->addElemento($tbAltezza);

    //creazione textbox per peso
    $tbPeso = creaTextbox('Peso', 'weigth', 'Valore Numerico (in kg)', getValue('weigth'));
    $divdestra->addElemento($tbPeso);

    //creazione textbox per capelli
    $tbCapelli = creaTextbox('Capelli', 'hair', 'Solo lettere o spazi', getValue('hair'));
    $divdestra->addElemento($tbCapelli);

    //creazione textbox per occhi
    $tbOcchi = creaTextbox('Occhi', 'eyes', 'Solo lettere o spazi', getValue('eyes'));
    $divdestra->addElemento($tbOcchi);

    //creazione textbox per aspetto
    $tbAspetto = creaTextbox('Aspetto', 'appearance', 'Solo lettere o spazi', getValue('appearance'));
    $divdestra->addElemento($tbAspetto);

    $panel->addElemento($divsinistra);
    $panel->addElemento($divdestra);

    $divsalvaanagrafica = new clsUIDiv('divsalvataggio');
    $BtnSalvaAnagrafica = new clsButton('Salva Parametri Anagrafici', 'BtnSalvaAnagrafica', 'button', 'BtnSalvaAnagrafica');
    $divsalvaanagrafica->addElemento($BtnSalvaAnagrafica);
    $BtnModificaAnagrafica = new clsButton('Modifica', 'BtnModificaAnagrafica', 'button', 'BtnModificaAnagrafica', null, 'hidden');
    $divsalvaanagrafica->addElemento($BtnModificaAnagrafica);
    $ErroreAnagrafica = new clsUIParagrafo(["id"=>"msgerranagr", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvaanagrafica->addElemento($ErroreAnagrafica);
    $panel->addElemento($divsalvaanagrafica);
    //***********************************************************************************************************************************
    //creo tabella statistiche
    $divtabella = new clsUIDiv('tabellacaratteristiche');
    $tabellacaratt = new clsUITabella('caratteristiche', 'tableindication');

    //***********FORZA******************
    //creo la riga della forza
    $rigaforza = new clsUITabellaRiga('tabellariga forza');

    //cella della forza
    $cellaforza = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"forza", "label"=>"FORZA*", "rowspan"=>"2" ]);
    $rigaforza->addCella($cellaforza);
    //cella dove inserire il valore della forza
    $cellavaloreforza = creaCella(["tipo"=>"2", "name"=>"valforza", "rowspan"=>"2", "classe"=>"cellavaloreforzasx", "value"=>getValue('valforza')]);
    $rigaforza->addCella($cellavaloreforza);
    $cellasecvaloreforza = creaCella(["tipo"=>"2", "name"=>"secvalforza", "rowspan"=>"2", "classe"=>"cellavaloreforzadx", "value"=>getValue('secvalforza')]);
    $cellasecvaloreforza->readonly = ($cellavaloreforza->value == 18 ? null : 'readonly');
    $rigaforza->addCella($cellasecvaloreforza);

    //cella dell'energia
    $cellaenergia = creaCella(["tipo"=>"1", "classe"=>"titolocella", "label"=>"Energia*"]);
    $rigaforza->addCella($cellaenergia);
    //cella dove inserire il valore dell'energia
    $cellavaloreenergia = creaCella(["tipo"=>"2", "name"=>"valenergia", "value"=>getValue('valenergia')]);
    $rigaforza->addCella($cellavaloreenergia);

    //cella peso trasportabile
    $cellapesotrasp = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Peso Trasport. (kg)" ]);
    $rigaforza->addCella($cellapesotrasp);
    //cella dove viene calcolato il peso trasportabile
    $cellavalorepesotrasp = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valpesotrasp", "readonly"=>"readonly" ]);
    $rigaforza->addCella($cellavalorepesotrasp);

    //cella colspan 8
    $cellacolspan = creaCella([ "tipo"=>"1", "colspan"=>"8" ]);
    $rigaforza->addCella($cellacolspan);

    //creo la riga che deve stare sotto l'energia (quella dei muscoli)
    $sottorigamuscoli = new clsUITabellaRiga('tabellariga forza');

    //cella dei muscoli
    $cellamuscoli = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Muscoli*" ]);
    $sottorigamuscoli->addCella($cellamuscoli);
    //cella dove inserire il valore dei muscoli
    $cellavaloremuscoli = creaCella([ "tipo"=>"2", "name"=>"valmuscoli", "value"=>getValue('valmuscoli') ]);
    $sottorigamuscoli->addCella($cellavaloremuscoli);

    //cella modificatore colpo
    $cellamodcolpo = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mod. Colpo" ]);
    $sottorigamuscoli->addCella($cellamodcolpo);
    //cella dove viene calcolato il modificatore colpo
    $cellavaloremodcolpo = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmodcolpo", "readonly"=>"readonly" ]);
    $sottorigamuscoli->addCella($cellavaloremodcolpo);

    //cella modificatore danni
    $cellamoddanni = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mod. Danni" ]);
    $sottorigamuscoli->addCella($cellamoddanni);
    //cella dove viene calcolato il modificatore danni
    $cellavaloremoddanni = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmoddanni", "readonly"=>"readonly" ]);
    $sottorigamuscoli->addCella($cellavaloremoddanni);

    //cella lev. max
    $cellalevamax = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Lev. Max." ]);
    $sottorigamuscoli->addCella($cellalevamax);
    //cella dove viene calcolato lev. max
    $cellavalorelevamax = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"vallevamax", "readonly"=>"readonly" ]);
    $sottorigamuscoli->addCella($cellavalorelevamax);

    //cella aprire porte
    $cellaaprireporte = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Aprire Porte" ]);
    $sottorigamuscoli->addCella($cellaaprireporte);
    //cella dove viene calcolato aprire porte
    $cellavaloreaprireporte = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valaprireporte", "readonly"=>"readonly" ]);
    $sottorigamuscoli->addCella($cellavaloreaprireporte);

    //cella piegare sbarre
    $cellapiegsbar = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"P.S./S.S." ]);
    $sottorigamuscoli->addCella($cellapiegsbar);
    //cella dove viene calcolato aprire porte
    $cellavalorepiegsbar = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valpiegsbar", "readonly"=>"readonly" ]);
    $sottorigamuscoli->addCella($cellavalorepiegsbar);

    $tabellacaratt->addRiga($rigaforza);
    $tabellacaratt->addRiga($sottorigamuscoli); 
    
    //*****************DESTREZZA*******************************************************************************
    //creo la riga della destrezza
    $rigades = new clsUITabellaRiga('tabellariga dex');

    //cella della destrezza
    $cellades = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"destrezza", "label"=>"DESTREZZA*", "rowspan"=>"2" ]);
    $rigades->addCella($cellades);
    //cella dove inserire il valore della destrezza
    $cellavaloredes = creaCella([ "tipo"=>"2", "name"=>"valdes", "rowspan"=>"2", "colspan"=>"2", "value"=>getValue('valdes')]);
    $rigades->addCella($cellavaloredes);

    //cella della mira
    $cellamira = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mira*" ]);
    $rigades->addCella($cellamira);
    //cella dove inserire il valore della mira
    $cellavaloremira = creaCella([ "tipo"=>"2", "name"=>"valmira", "value"=>getValue('valmira')]);
    $rigades->addCella($cellavaloremira);

    //cella modificatore lancio
    $cellamodlancio = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mod. Lancio" ]);
    $rigades->addCella($cellamodlancio);
    //cella dove viene calcolato il modificatore lancio
    $cellavaloremodlancio = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmodlancio", "readonly"=>"readonly" ]);
    $rigades->addCella($cellavaloremodlancio);

       /* //cella svuotare tasche
    $cellasvuottasche = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Svuotare Tasche" ]);
    $rigades->addCella($cellasvuottasche);
    //cella dove viene calcolato svuotare tasche
    $cellavaloresvuottasche = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valsvuottasche", "readonly"=>"readonly" ]);
    $rigades->addCella($cellavaloresvuottasche); 
    //cella scassinare serrature
    $cellascasser = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Scassinare Serrature" ]);
    $rigades->addCella($cellascasser);
    //cella dove viene calcolato scassinare serrature
    $cellavalorescasser = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valscasser", "readonly"=>"readonly" ]);
    $rigades->addCella($cellavalorescasser);*/

    //cella colspan 8
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"8" ]);
    $rigades->addCella($cellacolspan);

    //creo la riga che deve stare sotto la mira (quella dell'equilibrio)
    $sottorigaequilibrio = new clsUITabellaRiga('tabellariga dex');

    //cella dell'equilibrio
    $cellaequilibrio = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Equilibrio*" ]);
    $sottorigaequilibrio->addCella($cellaequilibrio);
    //cella dove inserire il valore dell'equilibrio
    $cellavaloreequilibrio = creaCella([ "tipo"=>"2", "name"=>"valequilibrio", "value"=>getValue('valequilibrio')]);
    $sottorigaequilibrio->addCella($cellavaloreequilibrio);

    //cella modificatore reazioni
    $cellamodreaz = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mod. Reaz." ]);
    $sottorigaequilibrio->addCella($cellamodreaz);
    //cella dove viene calcolato il modificatore reazioni
    $cellavaloremodreaz = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmodreaz", "readonly"=>"readonly" ]);
    $sottorigaequilibrio->addCella($cellavaloremodreaz);

    //cella modificatore difensivo
    $cellamoddifens = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mod. Difens." ]);
    $sottorigaequilibrio->addCella($cellamoddifens);
    //cella dove viene calcolato il modificatore difensivo
    $cellavaloremoddifens = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmoddifens", "readonly"=>"readonly" ]);
    $sottorigaequilibrio->addCella($cellavaloremoddifens);

       /* //cella muoversi silenziosamente
    $cellamuovsilenz = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Muov. Silenz." ]);
    $sottorigaequilibrio->addCella($cellamuovsilenz);
    //cella dove viene calcolato muoversi silenziosamente
    $cellavaloremuovsilenz = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmuovsilenz", "readonly"=>"readonly" ]);
    $sottorigaequilibrio->addCella($cellavaloremuovsilenz);

    //cella scalare pareti
    $cellascalpar = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Scalare Pareti" ]);
    $sottorigaequilibrio->addCella($cellascalpar);
    //cella dove viene calcolato scalare pareti
    $cellavalorescalpar = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valscalpar", "readonly"=>"readonly" ]);
    $sottorigaequilibrio->addCella($cellavalorescalpar);*/

    //cella colspan 6
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"6" ]);
    $sottorigaequilibrio->addCella($cellacolspan);

    $tabellacaratt->addRiga($rigades);
    $tabellacaratt->addRiga($sottorigaequilibrio); 

    //*****************COSTITUZIONE*******************************************************************************
    //creo la riga della costituzione
    $rigacos = new clsUITabellaRiga('tabellariga cos');

    //cella della costituzione
    $cellacos = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"costituzione", "label"=>"COSTITUZIONE*", "rowspan"=>"2" ]);
    $rigacos->addCella($cellacos);
    //cella dove inserire il valore della costituzione
    $cellavalorecos = creaCella([ "tipo"=>"2", "name"=>"valcos", "rowspan"=>"2", "colspan"=>"2", "value"=>getValue('valcos')]);
    $rigacos->addCella($cellavalorecos);

    //cella della salute
    $cellasalute = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Salute*" ]);
    $rigacos->addCella($cellasalute);
    //cella dove inserire il valore della salute
    $cellavaloresalute = creaCella([ "tipo"=>"2", "name"=>"valsalute", "value"=>getValue('valsalute')]);
    $rigacos->addCella($cellavaloresalute);

    //cella choc corporeo
    $cellachoccorp = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Choc Corporeo" ]);
    $rigacos->addCella($cellachoccorp);
    //cella dove viene calcolato choc corporeo
    $cellavalorechoccorp = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valchoccorp", "readonly"=>"readonly" ]);
    $rigacos->addCella($cellavalorechoccorp);

    //cella tiro salvezza contro veleni
    $cellatsvel = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"TS contro Veleni" ]);
    $rigacos->addCella($cellatsvel);
    //cella dove viene calcolato il tiro salvezza contro veleni
    $cellavaloretsvel = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valtsvel", "readonly"=>"readonly" ]);
    $rigacos->addCella($cellavaloretsvel);

    //cella colspan 6
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"6" ]);
    $rigacos->addCella($cellacolspan);

    //creo la riga che deve stare sotto la salute (quella della forma fisica)
    $sottorigaformafisica = new clsUITabellaRiga('tabellariga cos');

    //cella della forma fisica
    $cellaformafisica = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Forma Fisica*" ]);
    $sottorigaformafisica->addCella($cellaformafisica);
    //cella dove inserire il valore della forma fisica
    $cellavaloreformafisica = creaCella([ "tipo"=>"2", "name"=>"valformafisica", "value"=>getValue('valformafisica')]);
    $sottorigaformafisica->addCella($cellavaloreformafisica);
    //cella modificatore punti ferita
    $cellamodpf = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Modificatore Punti-Ferita" ]);
    $sottorigaformafisica->addCella($cellamodpf);
    //cella dove viene calcolato il modificatore punti ferita
    $cellavaloremodpf = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmodpf", "readonly"=>"readonly" ]);
    $sottorigaformafisica->addCella($cellavaloremodpf);

    //cella probabilita resurrezione
    $cellaprobres = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Probabilit&agrave; Resurrezione" ]);
    $sottorigaformafisica->addCella($cellaprobres);
    //cella dove viene calcolata la probabilita resurrezione
    $cellavaloreprobres = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valprobres", "readonly"=>"readonly" ]);
    $sottorigaformafisica->addCella($cellavaloreprobres);

    //cella colspan 6
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"6" ]);
    $sottorigaformafisica->addCella($cellacolspan);

    $tabellacaratt->addRiga($rigacos);
    $tabellacaratt->addRiga($sottorigaformafisica);

    //*****************INTELLIGENZA*******************************************************************************
    //creo la riga dell'intelligenza
    $rigaint = new clsUITabellaRiga('tabellariga int');

    //cella dell'intelligenza
    $cellaint = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"intelligenza", "label"=>"INTELLIGENZA*", "rowspan"=>"2" ]);
    $rigaint->addCella($cellaint);
    //cella dove inserire il valore dell'intelligenza
    $cellavaloreint = creaCella([ "tipo"=>"2", "name"=>"valint", "rowspan"=>"2", "colspan"=>"2", "value"=>getValue('valint')]);
    $rigaint->addCella($cellavaloreint);

    //cella della ragione
    $cellaragione = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Ragione*" ]);
    $rigaint->addCella($cellaragione);
    //cella dove inserire il valore della ragione
    $cellavaloreragione = creaCella([ "tipo"=>"2", "name"=>"valragione", "value"=>getValue('valragione')]);
    $rigaint->addCella($cellavaloreragione);


    //cella Livello di Incantesimi
    $cellalivinc = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Livello di Incant." ]);
    $rigaint->addCella($cellalivinc);
    //cella dove viene calcolato il Livello di Incantesimi
    $cellavalorelivinc = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"vallivinc", "readonly"=>"readonly" ]);
    $rigaint->addCella($cellavalorelivinc);

    //cella max num incantesimi
    $cellamaxinc = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Max # Incant." ]);
    $rigaint->addCella($cellamaxinc);
    //cella dove viene calcolato il max num incantesimi
    $cellavaloremaxinc = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmaxinc", "readonly"=>"readonly" ]);
    $rigaint->addCella($cellavaloremaxinc);

    //cella immunita incantesimi
    $cellaimminc = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Immunit&agrave; Incant." ]);
    $rigaint->addCella($cellaimminc);
    //cella dove viene calcolata l'immunita incantesimi
    $cellavaloreimminc = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valimminc", "readonly"=>"readonly" ]);
    $rigaint->addCella($cellavaloreimminc);

    //cella colspan 4
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"4" ]);
    $rigaint->addCella($cellacolspan);

    //creo la riga che deve stare sotto la ragione (quella della conoscenza)
    $sottorigaconoscenza = new clsUITabellaRiga('tabellariga int');

    //cella della conoscenza
    $cellaconoscenza = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Conoscenza*" ]);
    $sottorigaconoscenza->addCella($cellaconoscenza);
    //cella dove inserire il valore della conoscenza
    $cellavaloreconoscenza = creaCella([ "tipo"=>"2", "name"=>"valconoscenza", "value"=>getValue('valconoscenza')]);
    $sottorigaconoscenza->addCella($cellavaloreconoscenza);

    //cella delle proficienze bonus
    $cellaprofbonus = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Prof. Bonus/ Punti Pers." ]);
    $sottorigaconoscenza->addCella($cellaprofbonus);
    //cella dove vengono calcolate le proficienze bonus
    $cellavaloreprofbonus = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valprofbonus", "readonly"=>"readonly" ]);
    $sottorigaconoscenza->addCella($cellavaloreprofbonus);

    //cella imparare incantesimi
    $cellaimpinc = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Imparare Incantesimi" ]);
    $sottorigaconoscenza->addCella($cellaimpinc);
    //cella dove viene calcolato imparare incantesimi
    $cellavaloreimpinc = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valimpinc", "readonly"=>"readonly" ]);
    $sottorigaconoscenza->addCella($cellavaloreimpinc);

    //cella colspan 6
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"6" ]);
    $sottorigaconoscenza->addCella($cellacolspan);

    $tabellacaratt->addRiga($rigaint);
    $tabellacaratt->addRiga($sottorigaconoscenza);

    //*****************SAGGEZZA*******************************************************************************
    //creo la riga della saggezza
    $rigasag = new clsUITabellaRiga('tabellariga sag');

    //cella della saggezza
    $cellasag = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"saggezza", "label"=>"SAGGEZZA*", "rowspan"=>"2" ]);
    $rigasag->addCella($cellasag);
    //cella dove inserire il valore della saggezza
    $cellavaloresag = creaCella([ "tipo"=>"2", "name"=>"valsag", "rowspan"=>"2", "colspan"=>"2", "value"=>getValue('valsag')]);
    $rigasag->addCella($cellavaloresag);

    //cella dell'intuizione
    $cellaintuizione = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Intuizione*" ]);
    $rigasag->addCella($cellaintuizione);
    //cella dove inserire il valore dell'intuizione
    $cellavaloreintuizione = creaCella([ "tipo"=>"2", "name"=>"valintuizione", "value"=>getValue('valintuizione')]);
    $rigasag->addCella($cellavaloreintuizione);

    //cella Incantesimi bonus
    $cellaincbonus = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Incant. Bonus/ Punti Magia" ]);
    $rigasag->addCella($cellaincbonus);
    //cella dove vengono calcolati gli incantesimi bonus
    $cellavaloreincbonus = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valincbonus", "readonly"=>"readonly" ]);
    $rigasag->addCella($cellavaloreincbonus);

    //cella fallire incantesimi
    $cellafallinc = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Fallire Incantesimi" ]);
    $rigasag->addCella($cellafallinc);
    //cella dove viene calcolato fallire incantesimi
    $cellavalorefallinc = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valfallinc", "readonly"=>"readonly" ]);
    $rigasag->addCella($cellavalorefallinc);

    //cella colspan 6
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"6" ]);
    $rigasag->addCella($cellacolspan);

    //creo la riga che deve stare sotto l'intuizione (quella della forza di volonta)
    $sottorigafdivolonta = new clsUITabellaRiga('tabellariga sag');

    //cella della forza di volonta
    $cellafdivolonta = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"F. di Volont&agrave;*" ]);
    $sottorigafdivolonta->addCella($cellafdivolonta);
    //cella dove inserire il valore della forza di volonta
    $cellavalorefdivolonta = creaCella([ "tipo"=>"2", "name"=>"valfdivolonta", "value"=>getValue('valfdivolonta')]);
    $sottorigafdivolonta->addCella($cellavalorefdivolonta);

    //cella modificatore difesa magia
    $cellamoddifmag = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Mod. Difesa Magia" ]);
    $sottorigafdivolonta->addCella($cellamoddifmag);
    //cella dove viene calcolato modificatore difesa magia
    $cellavaloremoddifmag = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmoddifmag", "readonly"=>"readonly" ]);
    $sottorigafdivolonta->addCella($cellavaloremoddifmag);

    //cella immunita agli incantesimi
    $cellaimmunitainc = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Immunit&agrave; agli Incantesimi" ]);
    $sottorigafdivolonta->addCella($cellaimmunitainc);
    //cella dove viene calcolata l'immunita agli incantesimi
    $cellavaloreimmunitainc = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "colspan"=>"6", "name"=>"valimmunitainc", "readonly"=>"readonly" ]);
    $sottorigafdivolonta->addCella($cellavaloreimmunitainc);

    //cella colspan 1
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"1" ]);
    $sottorigafdivolonta->addCella($cellacolspan); 

    $tabellacaratt->addRiga($rigasag);
    $tabellacaratt->addRiga($sottorigafdivolonta);

    //*****************CARISMA*******************************************************************************
    //creo la riga del carisma
    $rigacar = new clsUITabellaRiga('tabellariga car');

    //cella del carisma
    $cellacar = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"carisma", "label"=>"CARISMA*", "rowspan"=>"2" ]);
    $rigacar->addCella($cellacar);
    //cella dove inserire il valore del carisma
    $cellavalorecar = creaCella([ "tipo"=>"2", "name"=>"valcar", "rowspan"=>"2", "colspan"=>"2", "value"=>getValue('valcar')]);
    $rigacar->addCella($cellavalorecar);

    //cella del comando
    $cellacomando = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Comando*" ]);
    $rigacar->addCella($cellacomando);
    //cella dove inserire il valore del comando
    $cellavalorecomando = creaCella([ "tipo"=>"2", "name"=>"valcomando", "value"=>getValue('valcomando')]);
    $rigacar->addCella($cellavalorecomando);

    //cella fattore fedelta
    $cellafattorefed = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Fattore Fedelt&agrave;" ]);
    $rigacar->addCella($cellafattorefed);
    //cella dove viene calcolato il fattore fedelta
    $cellavalorefattorefed = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valfattorefed", "readonly"=>"readonly" ]);
    $rigacar->addCella($cellavalorefattorefed);

    //cella max numero seguaci
    $cellamaxseguaci = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Max # Seguaci" ]);
    $rigacar->addCella($cellamaxseguaci);
    //cella dove viene calcolato il max numero seguaci
    $cellavaloremaxseguaci = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmaxseguaci", "readonly"=>"readonly" ]);
    $rigacar->addCella($cellavaloremaxseguaci);

    //cella colspan 6
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"6" ]);
    $rigacar->addCella($cellacolspan);

    //creo la riga che deve stare sotto al comando (quella del fascino)
    $sottorigafascino = new clsUITabellaRiga('tabellariga car');

    //cella del fascino
    $cellafascino = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Fascino*" ]);
    $sottorigafascino->addCella($cellafascino);
    //cella dove inserire il valore del fascino
    $cellavalorefascino = creaCella([ "tipo"=>"2", "name"=>"valfascino", "value"=>getValue('valfascino')]);
    $sottorigafascino->addCella($cellavalorefascino);

    //cella modificatore reazioni carisma
    $cellamodreazcar = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "label"=>"Modificatore Reazioni" ]);
    $sottorigafascino->addCella($cellamodreazcar);
    //cella dove viene calcolato modificatore reazioni carisma
    $cellavaloremodreazcar = creaCella([ "tipo"=>"2", "classe"=>"cellavalore secondario", "name"=>"valmodreazcar", "readonly"=>"readonly" ]);
    $sottorigafascino->addCella($cellavaloremodreazcar);

    //cella colspan 8
    $cellacolspan = creaCella([ "tipo"=>"2", "colspan"=>"8" ]);
    $sottorigafascino->addCella($cellacolspan);

    $tabellacaratt->addRiga($rigacar);
    $tabellacaratt->addRiga($sottorigafascino);

    //*************************************************************************************************************
    $divtabella->addElemento($tabellacaratt);

    $divsalvatabellacaratt = new clsUIDiv('divsalvataggio');
    $BtnSalvaCaratteristiche = new clsButton('Salva Punteggi di Caratteristica', 'BtnSalvaCaratteristiche', 'button', 'BtnSalvaCaratteristiche', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvatabellacaratt->addElemento($BtnSalvaCaratteristiche);
    $BtnModificaCaratteristiche = new clsButton('Modifica', 'BtnModificaCaratteristiche', 'button', 'BtnModificaCaratteristiche', null, 'hidden');
    $divsalvatabellacaratt->addElemento($BtnModificaCaratteristiche);
    $ErroreCaratteristiche = new clsUIParagrafo(["id"=>"msgerrcaratt", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvatabellacaratt->addElemento($ErroreCaratteristiche);

    $panel->addElemento($divtabella);
    $panel->addElemento($divsalvatabellacaratt);

    //*************************************************************************************************************
    //creo una tabella per i tiri salvezza
    $divtabellats = new clsUIDiv('divtabellats');
    $tabellats = new clsUITabella('tabellats');

    //creo la riga titolo della tabella
    $riganometabella = new clsUITabellaRiga('tabellariga');

    $cellanometabella = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"titolotabella", "label"=>"Tabella dei Tiri Salvezza", "colspan"=>"3"]);      
    $riganometabella->addCella($cellanometabella);

    $tabellats->addRiga($riganometabella);  

    //creo la riga con i titoli
    $rigatitoli = new clsUITabellaRiga('tabellariga');

    //cella modificatori
    $cellamodificatori = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"titolomodificatori", "label"=>"Modificatori"]);
    $rigatitoli->addCella($cellamodificatori);
    //cella vs
    $cellavs = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"titolovs", "label"=>"VS"]);
    $rigatitoli->addCella($cellavs);
    //cella salvezza
    $cellasalvezza = creaCella([ "tipo"=>"1", "classe"=>"titolocella", "id"=>"titolosalvezza", "label"=>"Salvezza"]);
    $rigatitoli->addCella($cellasalvezza);

    $tabellats->addRiga($rigatitoli);

    //creo la riga paralisi/veleno/morte
    $rigaparvelmorte = new clsUITabellaRiga('tabellariga');

    //cella input modificatore
    $cellamodificatore1 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmod1", "value"=>getValue('valmod1')]);
    $rigaparvelmorte->addCella($cellamodificatore1);
    // cella paralisi/veleno/morte
    $cellaparvelmorte = creaCella([ "tipo"=>"1", "classe"=>"inputlabel", "id"=>"parvelmorte", "label"=>"Paralisi/Veleno/Morte"]);
    $rigaparvelmorte->addCella($cellaparvelmorte);
    //cella input readonly salvezza
    $cellasalvezza1 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valsalv1", "readonly"=>"readonly", "value"=>"0"]);
    $rigaparvelmorte->addCella($cellasalvezza1);

    $tabellats->addRiga($rigaparvelmorte);

    //creo la riga Verghe/Bastoni/Bacchette
    $rigaverbastbac = new clsUITabellaRiga('tabellariga');

    //cella input modificatore
    $cellamodificatore2 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmod2", "value"=>getValue('valmod2')]);
    $rigaverbastbac->addCella($cellamodificatore2);
    // cella verghe/bastoni/bacchette
    $cellaverbastbac = creaCella([ "tipo"=>"1", "classe"=>"inputlabel", "id"=>"verbastbac", "label"=>"Verghe/Bast./Bacch."]);
    $rigaverbastbac->addCella($cellaverbastbac);
    //cella input readonly salvezza
    $cellasalvezza2 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valsalv2", "readonly"=>"readonly", "value"=>"0"]);
    $rigaverbastbac->addCella($cellasalvezza2);

    $tabellats->addRiga($rigaverbastbac);

    //creo la riga Pietrificazione/Pol.
    $rigapietrificazione = new clsUITabellaRiga('tabellariga');

    //cella input modificatore
    $cellamodificatore3 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmod3", "value"=>getValue('valmod3')]);
    $rigapietrificazione->addCella($cellamodificatore3);
    // cella Pietrificazione/Pol.
    $cellapietrificazione = creaCella([ "tipo"=>"1", "classe"=>"inputlabel", "id"=>"pietrificazione", "label"=>"Pietrificazione/Pol."]);
    $rigapietrificazione->addCella($cellapietrificazione);
    //cella input readonly salvezza
    $cellasalvezza3 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valsalv3", "readonly"=>"readonly", "value"=>"0"]);
    $rigapietrificazione->addCella($cellasalvezza3);

    $tabellats->addRiga($rigapietrificazione);

    //creo la riga Soffio
    $rigasoffio = new clsUITabellaRiga('tabellariga');

    //cella input modificatore
    $cellamodificatore4 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmod4", "value"=>getValue('valmod4')]);
    $rigasoffio->addCella($cellamodificatore4);
    // cella Soffio
    $cellasoffio = creaCella([ "tipo"=>"1", "classe"=>"inputlabel", "id"=>"soffio", "label"=>"Soffio"]);
    $rigasoffio->addCella($cellasoffio);
    //cella input readonly salvezza
    $cellasalvezza4 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valsalv4", "readonly"=>"readonly", "value"=>"0"]);
    $rigasoffio->addCella($cellasalvezza4);

    $tabellats->addRiga($rigasoffio);

    //creo la riga Incantesimi
    $rigaincantesimi = new clsUITabellaRiga('tabellariga');

    //cella input modificatore
    $cellamodificatore5 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valmod5", "value"=>getValue('valmod5')]);
    $rigaincantesimi->addCella($cellamodificatore5);
    // cella Incantesimi
    $cellaincantesimi = creaCella([ "tipo"=>"1", "classe"=>"inputlabel", "id"=>"soffio", "label"=>"Incantesimi"]);
    $rigaincantesimi->addCella($cellaincantesimi);
    //cella input readonly salvezza
    $cellasalvezza5 = creaCella([ "tipo"=>"2", "classe"=>"cellavalore", "name"=>"valsalv5", "readonly"=>"readonly", "value"=>"0"]);
    $rigaincantesimi->addCella($cellasalvezza5);

    $tabellats->addRiga($rigaincantesimi);

    $divtabellats->addElemento($tabellats);

    $divsalvatirisalv = new clsUIDiv('divsalvataggio');
    $BtnSalvaTiriSalvezza = new clsButton('Salva Modificatori', 'BtnSalvaTiriSalvezza', 'button', 'BtnSalvaTiriSalvezza', null, (!isset($_GET['idPersonaggio']) ? 'hidden' : null));
    $divsalvatirisalv->addElemento($BtnSalvaTiriSalvezza);
    $BtnModificaTiriSalvezza = new clsButton('Modifica', 'BtnModificaTiriSalvezza', 'button', 'BtnModificaTiriSalvezza', null, 'hidden');
    $divsalvatirisalv->addElemento($BtnModificaTiriSalvezza);
    $ErroreTiriSalvezza = new clsUIParagrafo(["id"=>"msgerrtirisalv", "class"=>"saveerror", "hidden"=>"hidden"]);
    $divsalvatirisalv->addElemento($ErroreTiriSalvezza);

    $panel->addElemento($divtabellats);
    $panel->addElemento($divsalvatirisalv);
    //
    return $panel;
}
