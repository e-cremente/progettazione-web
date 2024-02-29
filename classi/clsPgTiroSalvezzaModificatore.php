<?php
    class clsPgTiroSalvezzaModificatore {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idTiroSalvezza;
        private $m_Modificatore;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_tirosalvezza;
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
            if ($pProperty == 'tirosalvezza') {
                if ($this->m_tirosalvezza == null) {
                    $this->m_tirosalvezza = new clsTiroSalvezza(selTiroSalvezza($this->m_idTiroSalvezza));
                }
                return $this->m_tirosalvezza;
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
            $this->m_idTiroSalvezza = $array['idTiroSalvezza'];
            $this->m_Modificatore = $array['Modificatore'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idTiroSalvezza = $pDBRow["{$pPrfx}idTiroSalvezza"];
            $this->m_Modificatore = $pDBRow["{$pPrfx}Modificatore"];
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
                'idTiroSalvezza'=>$this->m_idTiroSalvezza,
                'Modificatore'=>$this->m_Modificatore,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_tirosalv_mod VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idTiroSalvezza}, ".
                "'{$this->m_Modificatore}'".
            ")";
        }
    }
?>
