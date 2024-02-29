<?php

    class clsPersonaggio {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_Creatore;
        private $m_Nome;
        private $m_Razza;
        private $m_Classe;
        private $m_Classi_Secondarie;
        private $m_Allineamento;
        private $m_Livello;
        private $m_Livelli_Secondari;
        private $m_Esperienza;
        private $m_Ferite;
        private $m_MaxPuntiFerita;
        private $m_Origine;
        private $m_Famiglia;
        private $m_Stirpe_Clan;
        private $m_Religione;
        private $m_Classe_Sociale;
        private $m_Fratelli_Sorelle;
        private $m_Sesso;
        private $m_Anni;
        private $m_Altezza;
        private $m_Peso;
        private $m_Capelli;
        private $m_Occhi;
        private $m_Aspetto;
        private $m_PPRestanti;
        private $m_PuntiMagiaRestanti;
        private $m_PuntiMagiaTotali;
        private $m_VelMovimento;
        private $m_Equipaggiamento;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_creatore;
        private $m_razza;
        private $m_classe;
        private $m_allineamento;
        //RELAZIONI: FIGLI
        private $m_pg_abilita;
        private $m_pg_abilitadiclasse;
        private $m_pg_abilitadirazza;
        private $m_pg_abilitaladri;
        private $m_pg_arma;
        private $m_pg_armatura;
        private $m_pg_moneta;
        private $m_pg_proficienze;
        private $m_pg_proficienzearmi;
        private $m_pg_stilicombattimento;
        private $m_pg_svantaggi;
        private $m_pg_tirosalv_mod;
        private $m_pg_tratti;
        private $m_pg_incantesimi;

        //Proprietà pubbliche
        // funzioni magiche __get, __set {{{
        public function __set($pProperty, $pValue)
        {
            $lvAttribute = "m_".$pProperty;
            if (property_exists(__CLASS__, $lvAttribute)) {
                $this->$lvAttribute = $pValue;
                return;
            }
            throw new \Exception("setProperty: {$pProperty} not found in ".__CLASS__);
        }

        public function __get($pProperty)
        {
            //RELAZIONI: PADRI
            if ($pProperty == 'creatore') {
                if ($this->m_creatore == null) {
                    $this->m_creatore = new clsUtente(selUtente($this->m_Creatore));
                }
                return $this->m_creatore;
            }
            if ($pProperty == 'allineamento') {
                if ($this->m_allineamento == null) {
                    $this->m_allineamento = new clsAllineamento(selAllineamento($this->m_Allineamento));
                }
                return $this->m_allineamento;
            }
            if ($pProperty == 'classe') {
                if ($this->m_classe == null) {
                    $this->m_classe = new clsClasse(selClasse($this->m_Classe));
                }
                return $this->m_classe;
            }
            if ($pProperty == 'razza') {
                if ($this->m_razza == null) {
                    $this->m_razza = new clsRazza(selRazza($this->m_Razza));
                }
                return $this->m_razza;
            }
            //RELAZIONI: FIGLI
            if ($pProperty == 'pg_abilita') {
                if ($this->m_pg_abilita == null) {
                    $this->m_pg_abilita = $this->getArrayAbilita();
                 }
                return $this->m_pg_abilita;
            }
            if ($pProperty == 'pg_abilitadiclasse') {
                if ($this->m_pg_abilitadiclasse == null) {
                    $this->m_pg_abilitadiclasse = $this->getArrayAbilitaDiClasse();
                 }
                return $this->m_pg_abilitadiclasse;
            }
            if ($pProperty == 'pg_abilitadirazza') {
                if ($this->m_pg_abilitadirazza == null) {
                    $this->m_pg_abilitadirazza = $this->getArrayAbilitaDiRazza();
                 }
                return $this->m_pg_abilitadirazza;
            }
            if ($pProperty == 'pg_abilitaladri') {
                if ($this->m_pg_abilitaladri == null) {
                    $this->m_pg_abilitaladri = $this->getArrayAbilitaLadri();
                 }
                return $this->m_pg_abilitaladri;
            }
            if ($pProperty == 'pg_arma') {
                if ($this->m_pg_arma == null) {
                    $this->m_pg_arma = $this->getArrayArma();
                 }
                return $this->m_pg_arma;
            }
            if ($pProperty == 'pg_armatura') {
                if ($this->m_pg_armatura == null) {
                    $this->m_pg_armatura = $this->getArrayArmatura();
                 }
                return $this->m_pg_armatura;
            }
            if ($pProperty == 'pg_moneta') {
                if ($this->m_pg_moneta == null) {
                    $this->m_pg_moneta = $this->getArrayMoneta();
                 }
                return $this->m_pg_moneta;
            }
            if ($pProperty == 'pg_proficienze') {
                if ($this->m_pg_proficienze == null) {
                    $this->m_pg_proficienze = $this->getArrayProficienze();
                 }
                return $this->m_pg_proficienze;
            }
            if ($pProperty == 'pg_proficienzearmi') {
                if ($this->m_pg_proficienzearmi == null) {
                    $this->m_pg_proficienzearmi = $this->getArrayProficienzeArmi();
                 }
                return $this->m_pg_proficienzearmi;
            }
            if ($pProperty == 'pg_stilicombattimento') {
                if ($this->m_pg_stilicombattimento == null) {
                    $this->m_pg_stilicombattimento = $this->getArrayStiliCombattimento();
                 }
                return $this->m_pg_stilicombattimento;
            }
            if ($pProperty == 'pg_svantaggi') {
                if ($this->m_pg_svantaggi == null) {
                    $this->m_pg_svantaggi = $this->getArraySvantaggi();
                 }
                return $this->m_pg_svantaggi;
            }
            if ($pProperty == 'pg_tirosalv_mod') {
                if ($this->m_pg_tirosalv_mod == null) {
                    $this->m_pg_tirosalv_mod = $this->getArrayTiroSalvezzaModificatore();
                 }
                return $this->m_pg_tirosalv_mod;
            }
            if ($pProperty == 'pg_tratti') {
                if ($this->m_pg_tratti == null) {
                    $this->m_pg_tratti = $this->getArrayTratti();
                 }
                return $this->m_pg_tratti;
            }
            if ($pProperty == 'pg_incantesimi') {
                if ($this->m_pg_incantesimi == null) {
                    $this->m_pg_incantesimi = $this->getArrayIncantesimi();
                 }
                return $this->m_pg_incantesimi;
            }

            //ALTRE PROPRIETA
            $lvAttribute = "m_".$pProperty;
            if (property_exists(__CLASS__, $lvAttribute)) {
                return $this->$lvAttribute;
            }
            throw new \Exception("getProperty: {$pProperty} not found in ".__CLASS__);
        }
        // }}}

        // public function __construct($var = null, $pPrfx = '') {{{
        public function __construct($var = null, $pPrfx = '')
        {
            if (is_object($var)) {
                $this->constructFromDb($var, $pPrfx);
            } else if (is_array($var)) {
                $this->constructFromArray($var);
            } else if (is_numeric($var)) {
                $this->constructFromId($var);
            }
        //echo "<pre> Ho costruito:<br>";print_r($this);echo "</pre>";
        }

        function constructFromId($pIdPersonaggio){
            $lvDBRow = selPersonaggio($pIdPersonaggio);
            $this->constructFromDB($lvDBRow, "");
        }

        function constructFromArray($array){
            $this->m_idPersonaggio = getNextId();
            $this->m_Creatore = $array['owner'];
            $this->m_Nome = $array['nomepg'];
            $this->m_Razza = $array['race'];
            $this->m_Classe = $array['cls'];
            $this->m_Classi_Secondarie = $array['secondaryclass'];
            $this->m_Allineamento = $array['alignment'];
            $this->m_Livello = $array['lvl'];
            $this->m_Livelli_Secondari = $array['secondarylvl'];
            $this->m_Esperienza = $array['exp'];
            $this->m_Ferite = null; //$array['pf'];
            $this->m_MaxPuntiFerita = null; //$array['maxpf'];
            $this->m_Origine = $array['origin'];
            $this->m_Famiglia = $array['family'];
            $this->m_Stirpe_Clan = $array['clan'];
            $this->m_Religione = $array['rel'];
            $this->m_Classe_Sociale = $array['socclass'];
            $this->m_Fratelli_Sorelle = $array['fratsis'];
            $this->m_Sesso = $array['sex'];
            $this->m_Anni = $array['age'];
            $this->m_Altezza = $array['heigth'];
            $this->m_Peso = $array['weigth'];
            $this->m_Capelli = $array['hair'];
            $this->m_Occhi = $array['eyes'];
            $this->m_Aspetto = $array['appearance'];
            $this->m_PPRestanti = $array['pprestanti'];
            $this->m_PuntiMagiaRestanti = $array['puntimagiarestanti'];
            $this->m_PuntiMagiaTotali = $array['puntimagiatotali'];
            $this->m_VelMovimento = $array['velmovimento'];
            $this->m_Equipaggiamento = $array['equipaggiamento'];
        }

        function constructFromDb($pDBRow, $pPrfx){
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_Creatore = $pDBRow["{$pPrfx}Creatore"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_Razza = $pDBRow["{$pPrfx}Razza"];
            $this->m_Classe = $pDBRow["{$pPrfx}Classe"];
            $this->m_Classi_Secondarie = $pDBRow["{$pPrfx}Classi_Secondarie"];
            $this->m_Allineamento = $pDBRow["{$pPrfx}Allineamento"];
            $this->m_Livello = $pDBRow["{$pPrfx}Livello"];
            $this->m_Livelli_Secondari = $pDBRow["{$pPrfx}Livelli_Secondari"];
            $this->m_Esperienza = $pDBRow["{$pPrfx}Esperienza"];
            $this->m_Ferite = $pDBRow["{$pPrfx}Ferite"];
            $this->m_MaxPuntiFerita = $pDBRow["{$pPrfx}MaxPuntiFerita"];
            $this->m_Origine = $pDBRow["{$pPrfx}Origine"];
            $this->m_Famiglia = $pDBRow["{$pPrfx}Famiglia"];
            $this->m_Stirpe_Clan = $pDBRow["{$pPrfx}Stirpe_Clan"];
            $this->m_Religione = $pDBRow["{$pPrfx}Religione"];
            $this->m_Classe_Sociale = $pDBRow["{$pPrfx}Classe_Sociale"];
            $this->m_Fratelli_Sorelle = $pDBRow["{$pPrfx}Fratelli_Sorelle"];
            $this->m_Sesso = $pDBRow["{$pPrfx}Sesso"];
            $this->m_Anni = $pDBRow["{$pPrfx}Anni"];
            $this->m_Altezza = $pDBRow["{$pPrfx}Altezza"];
            $this->m_Peso = $pDBRow["{$pPrfx}Peso"];
            $this->m_Capelli = $pDBRow["{$pPrfx}Capelli"];
            $this->m_Occhi = $pDBRow["{$pPrfx}Occhi"];
            $this->m_Aspetto = $pDBRow["{$pPrfx}Aspetto"];
            $this->m_PPRestanti = $pDBRow["{$pPrfx}PPRestanti"];
            $this->m_PuntiMagiaRestanti = $pDBRow["{$pPrfx}PuntiMagiaRestanti"];
            $this->m_PuntiMagiaTotali = $pDBRow["{$pPrfx}PuntiMagiaTotali"];
            $this->m_VelMovimento = $pDBRow["{$pPrfx}VelMovimento"];
            $this->m_Equipaggiamento = $pDBRow["{$pPrfx}Equipaggiamento"];
        }
        // }}}

        function insertIntoDb(){
            EseguiQuery($this->insertstmt);
        }

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idPersonaggio'=>$this->m_idPersonaggio,
                'Nome'=>$this->m_Nome,
                'Creatore'=>$this->m_Nome,
                'Razza'=>$this->m_Razza,
                'Classe'=>$this->m_Classe,
                'Allineamento'=>$this->m_Allineamento,
                'Livello'=>$this->m_Livello,
                'LivelliSecondari'=>$this->m_Livelli_Secondari,
                'Esperienza'=>$this->m_Esperienza,
                'Ferite'=>$this->m_Ferite,
                'MaxPuntiFerita'=>$this->m_MaxPuntiFerita,
                'Origine'=>$this->m_Origine,
                'Famiglia'=>$this->m_Famiglia,
                'Stirpe_Clan'=>$this->m_Stirpe_Clan,
                'Religione'=>$this->m_Religione,
                'Classe_Sociale'=>$this->m_Classe_Sociale,
                'Fratelli_Sorelle'=>$this->m_Fratelli_Sorelle,
                'Sesso'=>$this->m_Sesso,
                'Anni'=>$this->m_Anni,
                'Altezza'=>$this->m_Altezza,
                'Peso'=>$this->m_Peso,
                'Capelli'=>$this->m_Capelli,
                'Occhi'=>$this->m_Occhi,
                'Aspetto'=>$this->m_Aspetto,
                'PPRestanti'=>$this->m_PPRestanti,
                'PuntiMagiaRestanti'=>$this->m_PuntiMagiaRestanti,
                'PuntiMagiaTotali'=>$this->m_PuntiMagiaTotali,
                'VelMovimento'=>$this->m_VelMovimento,
                'Equipaggiamento'=>$this->m_Equipaggiamento,
            ];
            return $lvRes;
        }
        // }}}

        // public function setInsertStmt() {{{
        function setInsertStmt(){
            $insert = "INSERT INTO personaggi (idPersonaggio";
            $values = "values (". $this->m_idPersonaggio;
            if (!empty($this->m_Creatore)){
                $insert .= ", Creatore";
                $values .= ", '{$this->m_Creatore}'";
            }
            if (!empty($this->m_Nome)){
                $insert .= ", Nome";
                $values .= ", '{$this->m_Nome}'";
            }
            if (!empty($this->m_Razza)){
                $insert .= ", Razza";
                $values .= ", {$this->m_Razza}";
            }
            if (!empty($this->m_Classe)){
                $insert .= ", Classe";
                $values .= ", {$this->m_Classe}";
            } 
            if (!empty($this->m_Classi_Secondarie)){
                $insert .= ", Classi_Secondarie";
                $values .= ", '{$this->m_Classi_Secondarie}'";
            } 
            if (!empty($this->m_Allineamento)){
                $insert .= ", Allineamento";
                $values .= ", '{$this->m_Allineamento}'";
            }
            if (!empty($this->m_Livello)){
                $insert .= ", Livello";
                $values .= ", {$this->m_Livello}";
            } 
            if (!empty($this->m_Livelli_Secondari)){
                $insert .= ", Livelli_Secondari";
                $values .= ", '{$this->m_Livelli_Secondari}'";
            } 
            if (!empty($this->m_Esperienza)){
                $insert .= ", Esperienza";
                $values .= ", {$this->m_Esperienza}";
            } 
            if (!empty($this->m_Ferite)){
                $insert .= ", Ferite";
                $values .= ", {$this->m_Ferite}";
            } 
            if (!empty($this->m_MaxPuntiFerita)){
                $insert .= ", MaxPuntiFerita";
                $values .= ", {$this->m_MaxPuntiFerita}";
            } 
            if (!empty($this->m_Origine)){
                $insert .= ", Origine";
                $values .= ", '{$this->m_Origine}'";
            } 
            if (!empty($this->m_Famiglia)){
                $insert .= ", Famiglia";
                $values .= ", '{$this->m_Famiglia}'";
            } 
            if (!empty($this->m_Stirpe_Clan)){
                $insert .= ", Stirpe_Clan";
                $values .= ", '{$this->m_Stirpe_Clan}'";
            } 
            if (!empty($this->m_Religione)){
                $insert .= ", Religione";
                $values .= ", '{$this->m_Religione}'";
            } 
            if (!empty($this->m_Classe_Sociale)){
                $insert .= ", Classe_Sociale";
                $values .= ", '{$this->m_Classe_Sociale}'";
            } 
            if (!empty($this->m_Fratelli_Sorelle)){
                $insert .= ", Fratelli_Sorelle";
                $values .= ", '{$this->m_Fratelli_Sorelle}'";
            } 
            if (!empty($this->m_Sesso)){
                $insert .= ", Sesso";
                $values .= ", '{$this->m_Sesso}'";
            } 
            if (!empty($this->m_Anni)){
                $insert .= ", Anni";
                $values .= ", {$this->m_Anni}";
            } 
            if (!empty($this->m_Altezza)){
                $insert .= ", Altezza";
                $values .= ", {$this->m_Altezza}";
            } 
            if (!empty($this->m_Peso)){
                $insert .= ", Peso";
                $values .= ", {$this->m_Peso}";
            } 
            if (!empty($this->m_Capelli)){
                $insert .= ", Capelli";
                $values .= ", '{$this->m_Capelli}'";
            } 
            if (!empty($this->m_Occhi)){
                $insert .= ", Occhi";
                $values .= ", '{$this->m_Occhi}'";
            } 
            if (!empty($this->m_Aspetto)){
                $insert .= ", Aspetto";
                $values .= ", '{$this->m_Aspetto}'";
            } 
            if (!empty($this->m_PPRestanti)){
                $insert .= ", PPRestanti";
                $values .= ", {$this->m_PPRestanti}";
            } 
            if (!empty($this->m_PuntiMagiaRestanti)){
                $insert .= ", PuntiMagiaRestanti";
                $values .= ", {$this->m_PuntiMagiaRestanti}";
            } 
            if (!empty($this->m_PuntiMagiaTotali)){
                $insert .= ", PuntiMagiaTotali";
                $values .= ", {$this->m_PuntiMagiaTotali}";
            } 
            if (!empty($this->m_VelMovimento)){
                $insert .= ", VelMovimento";
                $values .= ", {$this->m_VelMovimento}";
            } 
            if (!empty($this->m_Equipaggiamento)){
                $insert .= ", Equipaggiamento";
                $values .= ", '{$this->m_Equipaggiamento}'";
            } 
            $insert .= ") ";
            $values .= ")";
            $this->insertstmt = $insert . $values;
        }
        //}}}

        // public function getArrayAbilita() {{{
        function getArrayAbilita(){
            $result = selPgAbilita($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgAbilita($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayAbilitaDiClasse() {{{
        function getArrayAbilitaDiClasse(){
            $result = selPgAbilitaDiClasse($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgAbilitaDiClasse($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayAbilitaDiRazza() {{{
        function getArrayAbilitaDiRazza(){
            $result = selPgAbilitaDiRazza($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgAbilitaDiRazza($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayAbilitaLadri() {{{
        function getArrayAbilitaLadri(){
            $result = selPgAbilitaLadri($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[$row['idAbilitaladri']] = new clsPgAbilitaLadri($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayArma() {{{
        function getArrayArma(){
            $result = selPgArma($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgArma($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayArmatura() {{{
        function getArrayArmatura(){
            $result = selPgArmatura($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgArmatura($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayMoneta() {{{
        function getArrayMoneta(){
            $result = selPgMoneta($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgMoneta($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayProficienze() {{{
        function getArrayProficienze(){
            $result = selPgProficienze($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgProficienze($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayProficienzeArmi() {{{
        function getArrayProficienzeArmi(){
            $result = selPgProficienzeArmi($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgProficienzeArmi($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayStiliCombattimento() {{{
        function getArrayStiliCombattimento(){
            $result = selPgStiliCombattimento($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgStiliCombattimento($row);
            }
            return $arr;
        }
        //}}}

        // public function getArraySvantaggi() {{{
        function getArraySvantaggi(){
            $result = selPgSvantaggi($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgSvantaggi($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayTiroSalvezzaModificatore() {{{
        function getArrayTiroSalvezzaModificatore(){
            $result = selPgTiroSalvezzaModificatore($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgTiroSalvezzaModificatore($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayTratti() {{{
        function getArrayTratti(){
            $result = selPgTratti($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgTratti($row);
            }
            return $arr;
        }
        //}}}

        // public function getArrayIncantesimi() {{{
        function getArrayIncantesimi(){
            $result = selPgIncantesimi($this->idPersonaggio);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgIncantesimo($row);
            }
            return $arr;
        }
        //}}}

    }
?>
