<?php
    class clsPgStiliCombattimento {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idStile;
        private $m_PP;
        private $m_Specializzato;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_stile;
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
            if ($pProperty == 'stile') {
                if ($this->m_stile == null) {
                    $this->m_stile = new clsStileCombattimento(selStile($this->m_idStile));
                }
                return $this->m_stile;
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
            $this->m_idStile = $array['idStile'];
            $this->m_PP = $array['PP'];
            $this->m_Specializzato = $array['Specializzazione'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idStile = $pDBRow["{$pPrfx}idStile"];
            $this->m_PP = $pDBRow["{$pPrfx}PP"];
            $this->m_Specializzato = $pDBRow["{$pPrfx}Specializzazione"];
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
                'idStile'=>$this->m_idStile,
                'PP'=>$this->m_PP,
                'Specializzato'=>$this->m_Specializzato,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_stilecombattimento VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idStile}, ".
                "{$this->m_PP}, {$this->m_Specializzato}".
            ")";
        }
    }
?>
