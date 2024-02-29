<?php
    class clsPgProficienzeArmi {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idArma;
        private $m_PP;
        private $m_Scelta;
        private $m_Esperto;
        private $m_Specializzato;
        private $m_Maestro;
        private $m_Alto;
        private $m_Grande;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_arma;
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
            if ($pProperty == 'arma') {
                if ($this->m_arma == null) {
                    $this->m_arma = new clsArma(selArma($this->m_idArma));
                }
                return $this->m_arma;
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
            $this->m_idArma = $array['idArma'];
            $this->m_PP = $array['PP'];
            $this->m_Scelta = $array['Scelta'];
            $this->m_Esperto = $array['Esperto'];
            $this->m_Specializzato = $array['Specializzato'];
            $this->m_Maestro = $array['Maestro'];
            $this->m_Alto = $array['Alto'];
            $this->m_Grande = $array['Grande'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idArma = $pDBRow["{$pPrfx}idArma"];
            $this->m_PP = $pDBRow["{$pPrfx}PP"];
            $this->m_Scelta = $pDBRow["{$pPrfx}Scelta"];
            $this->m_Esperto = $pDBRow["{$pPrfx}Esperto"];
            $this->m_Specializzato = $pDBRow["{$pPrfx}Specializzato"];
            $this->m_Maestro = $pDBRow["{$pPrfx}Maestro"];
            $this->m_Alto = $pDBRow["{$pPrfx}Alto"];
            $this->m_Grande = $pDBRow["{$pPrfx}Grande"];
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
                'idArma'=>$this->m_idArma,
                'PP'=>$this->m_PP,
                'Scelta'=>$this->m_Scelta,
                'Esperto'=>$this->m_Esperto,
                'Specializzato'=>$this->m_Specializzato,
                'Maestro'=>$this->m_Maestro,
                'Alto'=>$this->m_Alto,
                'Grande'=>$this->m_Grande,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_proficienzaarmi VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idArma}, ".
                "{$this->m_PP}, {$this->m_Scelta}, ".
                "{$this->m_Esperto}, {$this->m_Specializzato}, ".
                "{$this->m_Maestro}, {$this->m_Alto}, ".
                "{$this->m_Grande}".
            ")";
        }
    }
?>
