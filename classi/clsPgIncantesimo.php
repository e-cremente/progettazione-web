    <?php
    class clsPgIncantesimo {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_Nome;
        private $m_Livello;
        private $m_Componenti;
        private $m_Durata;
        private $m_Raggio;
        private $m_TiroSalvezza;
        private $m_Velocita;
        private $m_Effetto;    
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_Personaggio;
        private $m_Incantesimo;
        //RELAZIONI: FIGLI

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
            if ($pProperty == 'Personaggio') {
                if ($this->m_Personaggio == null) {
                    $this->m_Personaggio = new clsPersonaggio(selPersonaggio($this->m_idPersonaggio));
                }
                return $this->m_Personaggio;
            }
            if ($pProperty == 'Incantesimo') {
                if ($this->m_Incantesimo == null) {
                    $this->m_Incantesimo = new clsIncantesimo(selIncantesimo($this->m_Nome));
                }
                return $this->m_Incantesimo;
            }
            //ALTRE PROPRIETA
            $lvAttribute = "m_".$pProperty;
            if (property_exists(__CLASS__, $lvAttribute)) {
                return $this->$lvAttribute;
            }
            throw new \Exception("getProperty: {$pProperty} not found in ".__CLASS__);
        }
        // }}}

        // public function __construct($pDBRow = null, $pPrfx = '') {{{
        public function __construct($var = null, $pPrfx = '')
        {
            if (is_object($var)) {
                $this->constructFromDb($var, $pPrfx);
            } else if (is_array($var)) {
                $this->constructFromArray($var);
            }
        //echo "<pre> Ho costruito:<br>";print_r($this);echo "</pre>";
        }

        function constructFromArray($array){
            $this->m_idPersonaggio = $array['idPersonaggio'];
            $this->m_Nome = $array['Nome'];
            $this->m_Livello = $array['Livello'];
            $this->m_Componenti = $array['Componenti'];
            $this->m_Durata = $array['Durata'];
            $this->m_Raggio = $array['Raggio'];
            $this->m_TiroSalvezza = $array['TiroSalvezza'];
            $this->m_Velocita = $array['Velocita'];
            $this->m_Effetto = $array['Effetto'];    
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_Livello = $pDBRow["{$pPrfx}Livello"];
            $this->m_Componenti = $pDBRow["{$pPrfx}Componenti"];
            $this->m_Durata = $pDBRow["{$pPrfx}Durata"];
            $this->m_Raggio = $pDBRow["{$pPrfx}Raggio"];
            $this->m_TiroSalvezza = $pDBRow["{$pPrfx}TiroSalvezza"];
            $this->m_Velocita = $pDBRow["{$pPrfx}Velocita"];
            $this->m_Effetto = $pDBRow["{$pPrfx}Effetto"];
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
                'Livello'=>$this->m_Livello,
                'Componenti'=>$this->m_Componenti,
                'Durata'=>$this->m_Durata,
                'Raggio'=>$this->m_Raggio,
                'TiroSalvezza'=>$this->m_TiroSalvezza,
                'Velocita'=>$this->m_Velocita,
                'Effetto'=>$this->m_Effetto,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_incantesimi VALUES (" .
                "{$this->m_idPersonaggio}, '{$this->m_Nome}', {$this->m_Livello}, '{$this->m_Componenti}', '{$this->m_Durata}', ".
                "'{$this->m_Raggio}', '{$this->m_TiroSalvezza}', {$this->m_Velocita}, '{$this->m_Effetto}'".
            ")";
        }
    }
?>
