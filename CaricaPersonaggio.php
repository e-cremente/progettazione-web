<?php
    $gvPersonaggio = null;
    if (!isset($_GET['idPersonaggio'])) return;
    $lvIdPersonaggio = $_GET['idPersonaggio'];
//echo "Devo caricare i dati del personaggio: ".$lvIdPersonaggio;
    $gvPersonaggio = new clsPersonaggio($lvIdPersonaggio);
//echo "<pre>";print_r($gvPersonaggio->pg_abilitaladri);echo "</pre>";

    function getValue($pNomeCampo) {
        global $gvPersonaggio;
        if ($gvPersonaggio == null) return null;
        switch($pNomeCampo) {
            // Campi del pannello PERSONAGGIO
            case 'idPersonaggio': return $gvPersonaggio->idPersonaggio; break;
            case 'HiddenRazza': return $gvPersonaggio->Razza; break;
            case 'HiddenClasse': return $gvPersonaggio->Classe; break;
            case 'nomepg': return $gvPersonaggio->Nome; break;
            case 'alignment': return $gvPersonaggio->Allineamento; break;
            case 'race': return $gvPersonaggio->Razza; break;
            case 'cls': return $gvPersonaggio->Classe; break;
            case 'secondaryclass': return $gvPersonaggio->Classi_Secondarie; break;
            case 'lvl': return $gvPersonaggio->Livello; break;
            case 'secondarylvl': return $gvPersonaggio->Livelli_Secondari; break;
            case 'exp': return $gvPersonaggio->Esperienza; break;
            case 'origin': return $gvPersonaggio->Origine; break;
            case 'family': return $gvPersonaggio->Famiglia; break;
            case 'clan': return $gvPersonaggio->Stirpe_Clan; break;
            case 'rel': return $gvPersonaggio->Religione; break;
            case 'socclass': return $gvPersonaggio->Classe_Sociale; break;
            case 'fratsis': return $gvPersonaggio->Fratelli_Sorelle; break;
            case 'sex': return $gvPersonaggio->Sesso; break;
            case 'age': return $gvPersonaggio->Anni; break;
            case 'heigth': return $gvPersonaggio->Altezza; break;
            case 'weigth': return $gvPersonaggio->Peso; break;
            case 'hair': return $gvPersonaggio->Capelli; break;
            case 'eyes': return $gvPersonaggio->Occhi; break;
            case 'appearance': return $gvPersonaggio->Aspetto; break;
            case 'valforza':
                $tmp = getElementArray($gvPersonaggio->pg_abilita, 0, 'Val_Abilita');
                if($tmp != null){
                    $tmp2 = explode("/", $tmp);
                    return $tmp2[0];
                }
                break;
            case 'secvalforza':
                $tmp = getElementArray($gvPersonaggio->pg_abilita, 0, 'Val_Abilita');
                if($tmp != null){
                    $tmp2 = explode("/", $tmp);
                    return count($tmp2) > 1 ? $tmp2[1] : '';
                }
                break;
            case 'valenergia':
                return getElementArray($gvPersonaggio->pg_abilita, 0, 'Val_Skill1');
                break;
            case 'valmuscoli': 
                return getElementArray($gvPersonaggio->pg_abilita, 0, 'Val_Skill2');
                break;
            case 'valdes': 
                return getElementArray($gvPersonaggio->pg_abilita, 1, 'Val_Abilita');
                break;
            case 'valmira': 
                return getElementArray($gvPersonaggio->pg_abilita, 1, 'Val_Skill1');
                break;
            case 'valequilibrio': 
                return getElementArray($gvPersonaggio->pg_abilita, 1, 'Val_Skill2');
                break;
            case 'valcos': 
                return getElementArray($gvPersonaggio->pg_abilita, 2, 'Val_Abilita');
                break;
            case 'valsalute':  
                return getElementArray($gvPersonaggio->pg_abilita, 2, 'Val_Skill1');
                break;
            case 'valformafisica':  
                return getElementArray($gvPersonaggio->pg_abilita, 2, 'Val_Skill2');
                break;
            case 'valint':  
                return getElementArray($gvPersonaggio->pg_abilita, 3, 'Val_Abilita');
                break;
            case 'valragione':  
                return getElementArray($gvPersonaggio->pg_abilita, 3, 'Val_Skill1');
                break;
            case 'valconoscenza':  
                return getElementArray($gvPersonaggio->pg_abilita, 3, 'Val_Skill2');
                break;
            case 'valsag':  
                return getElementArray($gvPersonaggio->pg_abilita, 4, 'Val_Abilita');
                break;
            case 'valintuizione':  
                return getElementArray($gvPersonaggio->pg_abilita, 4, 'Val_Skill1');
                break;
            case 'valfdivolonta':  
                return getElementArray($gvPersonaggio->pg_abilita, 4, 'Val_Skill2');
                break;
            case 'valcar':  
                return getElementArray($gvPersonaggio->pg_abilita, 5, 'Val_Abilita');
                break;
            case 'valcomando':  
                return getElementArray($gvPersonaggio->pg_abilita, 5, 'Val_Skill1');
                break;
            case 'valfascino':  
                return getElementArray($gvPersonaggio->pg_abilita, 5, 'Val_Skill2');
                break;
            case 'valmod1': return getModificatoreTiroSalvezza($gvPersonaggio->pg_tirosalv_mod, 1); break;
            case 'valmod2': return getModificatoreTiroSalvezza($gvPersonaggio->pg_tirosalv_mod, 2); break;
            case 'valmod3': return getModificatoreTiroSalvezza($gvPersonaggio->pg_tirosalv_mod, 3); break;
            case 'valmod4': return getModificatoreTiroSalvezza($gvPersonaggio->pg_tirosalv_mod, 4); break;
            case 'valmod5': return getModificatoreTiroSalvezza($gvPersonaggio->pg_tirosalv_mod, 5); break;
            // Campi del pannello COMBATTIMENTO
            case 'predarmor':
                return coalesce(getElementArray($gvPersonaggio->pg_armatura, 0, 'idArmatura'), 'nochoice');
                break;
            case 'CA':
                return coalesce(getElementArray($gvPersonaggio->pg_armatura, 0, 'CA'), 10);
                break;
            case 'sorpreso': 
                return getElementArray($gvPersonaggio->pg_armatura, 0, 'Sorpreso');
                break;
            case 'senzascudo': 
                return getElementArray($gvPersonaggio->pg_armatura, 0, 'SenzaScudo');
                break;
            case 'allespalle':  
                return getElementArray($gvPersonaggio->pg_armatura, 0, 'AlleSpalle');
                break;
            case 'caincantesimi': 
                return getElementArray($gvPersonaggio->pg_armatura, 0, 'Incantesimi');
                break;
            case 'difese':  
                return getElementArray($gvPersonaggio->pg_armatura, 0, 'Difese');
                break;
            case 'valpuntiferita': return $gvPersonaggio->MaxPuntiFerita; break;
            case 'valferite': return $gvPersonaggio->Ferite; break;
            case 'valPPRimanenti': return $gvPersonaggio->PPRestanti; break;
            case 'valpuntimagiarimanenti': return $gvPersonaggio->PuntiMagiaRestanti; break;
            case 'valpuntimagiatotali': return $gvPersonaggio->PuntiMagiaTotali; break;
            case 'valvelocitamovimento': return $gvPersonaggio->VelMovimento; break;
            case 'valmoneterame': return getMoneta($gvPersonaggio->pg_moneta, 1); break;
            case 'valmoneteargento': return getMoneta($gvPersonaggio->pg_moneta, 2); break;
            case 'valmoneteelectrum': return getMoneta($gvPersonaggio->pg_moneta, 3); break;
            case 'valmoneteoro': return getMoneta($gvPersonaggio->pg_moneta, 4); break;
            case 'valmoneteplatino': return getMoneta($gvPersonaggio->pg_moneta, 5); break;
            case 'valsvuotaretasche-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Base');
                break;
            case 'valsvuotaretasche-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Razza');
                break;
            case 'valsvuotaretasche-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Destrezza');
                break;
            case 'valsvuotaretasche-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Armatura');
                break;
            case 'valsvuotaretasche-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Tratti');
                break;
            case 'valsvuotaretasche-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Oggetti');
                break;
            case 'valsvuotaretasche-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Livello');
                break;
            case 'valsvuotaretasche-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 1, 'Speciale');
                break;
            case 'valscassinareserrature-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Base');
                break;
            case 'valscassinareserrature-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Razza');
                break;
            case 'valscassinareserrature-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Destrezza');
                break;
            case 'valscassinareserrature-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Armatura');
                break;
            case 'valscassinareserrature-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Tratti');
                break;
            case 'valscassinareserrature-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Oggetti');
                break;
            case 'valscassinareserrature-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Livello');
                break;
            case 'valscassinareserrature-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 2, 'Speciale');
                break;
            case 'valtrappole-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Base');
                break;
            case 'valtrappole-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Razza');
                break;
            case 'valtrappole-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Destrezza');
                break;
            case 'valtrappole-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Armatura');
                break;
            case 'valtrappole-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Tratti');
                break;
            case 'valtrappole-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Oggetti');
                break;
            case 'valtrappole-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Livello');
                break;
            case 'valtrappole-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 3, 'Speciale');
                break;
            case 'valmovsil-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Base');
                break;
            case 'valmovsil-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Razza');
                break;
            case 'valmovsil-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Destrezza');
                break;
            case 'valmovsil-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Armatura');
                break;
            case 'valmovsil-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Tratti');
                break;
            case 'valmovsil-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Oggetti');
                break;
            case 'valmovsil-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Livello');
                break;
            case 'valmovsil-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 4, 'Speciale');
                break;
            case 'valnascondersi-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Base');
                break;
            case 'valnascondersi-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Razza');
                break;
            case 'valnascondersi-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Destrezza');
                break;
            case 'valnascondersi-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Armatura');
                break;
            case 'valnascondersi-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Tratti');
                break;
            case 'valnascondersi-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Oggetti');
                break;
            case 'valnascondersi-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Livello');
                break;
            case 'valnascondersi-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 5, 'Speciale');
                break;
            case 'valsentirerumori-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Base');
                break;
            case 'valsentirerumori-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Razza');
                break;
            case 'valsentirerumori-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Destrezza');
                break;
            case 'valsentirerumori-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Armatura');
                break;
            case 'valsentirerumori-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Tratti');
                break;
            case 'valsentirerumori-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Oggetti');
                break;
            case 'valsentirerumori-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Livello');
                break;
            case 'valsentirerumori-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 6, 'Speciale');
                break;
            case 'valscalarepareti-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Base');
                break;
            case 'valscalarepareti-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Razza');
                break;
            case 'valscalarepareti-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Destrezza');
                break;
            case 'valscalarepareti-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Armatura');
                break;
            case 'valscalarepareti-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Tratti');
                break;
            case 'valscalarepareti-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Oggetti');
                break;
            case 'valscalarepareti-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Livello');
                break;
            case 'valscalarepareti-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 7, 'Speciale');
                break;
            case 'valletturalinguaggi-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Base');
                break;
            case 'valletturalinguaggi-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Razza');
                break;
            case 'valletturalinguaggi-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Destrezza');
                break;
            case 'valletturalinguaggi-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Armatura');
                break;
            case 'valletturalinguaggi-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Tratti');
                break;
            case 'valletturalinguaggi-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Oggetti');
                break;
            case 'valletturalinguaggi-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Livello');
                break;
            case 'valletturalinguaggi-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 8, 'Speciale');
                break;
            case 'valindividuazionemagico-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Base');
                break;
            case 'valindividuazionemagico-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Razza');
                break;
            case 'valindividuazionemagico-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Destrezza');
                break;
            case 'valindividuazionemagico-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Armatura');
                break;
            case 'valindividuazionemagico-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Tratti');
                break;
            case 'valindividuazionemagico-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Oggetti');
                break;
            case 'valindividuazionemagico-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Livello');
                break;
            case 'valindividuazionemagico-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 9, 'Speciale');
                break;
            case 'valindividuazioneillusioni-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Base');
                break;
            case 'valindividuazioneillusioni-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Razza');
                break;
            case 'valindividuazioneillusioni-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Destrezza');
                break;
            case 'valindividuazioneillusioni-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Armatura');
                break;
            case 'valindividuazioneillusioni-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Tratti');
                break;
            case 'valindividuazioneillusioni-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Oggetti');
                break;
            case 'valindividuazioneillusioni-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Livello');
                break;
            case 'valindividuazioneillusioni-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 10, 'Speciale');
                break;
            case 'valcorrompere-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Base');
                break;
            case 'valcorrompere-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Razza');
                break;
            case 'valcorrompere-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Destrezza');
                break;
            case 'valcorrompere-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Armatura');
                break;
            case 'valcorrompere-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Tratti');
                break;
            case 'valcorrompere-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11,'Oggetti');
                break;
            case 'valcorrompere-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Livello');
                break;
            case 'valcorrompere-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 11, 'Speciale');
                break;
            case 'valscavarepassaggi-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Base');
                break;
            case 'valscavarepassaggi-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Razza');
                break;
            case 'valscavarepassaggi-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Destrezza');
                break;
            case 'valscavarepassaggi-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Armatura');
                break;
            case 'valscavarepassaggi-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Tratti');
                break;
            case 'valscavarepassaggi-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Oggetti');
                break;
            case 'valscavarepassaggi-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Livello');
                break;
            case 'valscavarepassaggi-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 12, 'Speciale');
                break;
            case 'valsvincolarsi-base':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Base');
                break;
            case 'valsvincolarsi-razza':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Razza');
                break;
            case 'valsvincolarsi-destr':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Destrezza');
                break;
            case 'valsvincolarsi-arm':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Armatura');
                break;
            case 'valsvincolarsi-tratti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Tratti');
                break;
            case 'valsvincolarsi-oggetti':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Oggetti');
                break;
            case 'valsvincolarsi-livello':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Livello');
                break;
            case 'valsvincolarsi-speciale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 13, 'Speciale');
                break;
            case 'valpugnalaretotale':  
                return getElementArray($gvPersonaggio->pg_abilitaladri, 14, 'Base');
                break;
            case 'equipaggiamento': return $gvPersonaggio->Equipaggiamento; break;
            default: return "-";
        }
    }
   /*function getElementArray($pArr, $pIndex, $pName){
        if($pArr == null) return null;
        if(count($pArr) > $pIndex) return $pArr[$pIndex]->$pName;
    }*/

    function getElementArray($pArr, $pKey, $pName){
        if($pArr == null) return null;
        if(array_key_exists($pKey, $pArr)) return $pArr[$pKey]->$pName;
    }

    function getModificatoreTiroSalvezza($pArr, $pTiroSalvezza){
        foreach($pArr as $lvTs){
            if($lvTs->idTiroSalvezza == $pTiroSalvezza) return $lvTs->Modificatore;
        }
        return null;
    }

    function getMoneta($pArr, $pMoneta){
        foreach ($pArr as $lvMoneta) {
            if($lvMoneta->idMoneta == $pMoneta) return $lvMoneta->Quantita;
        }
    }
?>
