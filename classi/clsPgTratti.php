<?php
    class clsPgTratti {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idTratto;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_tratto;
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
            if ($pProperty == 'tratto') {
                if ($this->m_tratto == null) {
                    $this->m_tratto = new clsTratto(selTratto($this->m_idTratto));
                }
                return $this->m_tratto;
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
            $this->m_idTratto = $array['idTratto'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idTratto = $pDBRow["{$pPrfx}idTratto"];
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
                'idTratto'=>$this->m_idTratto,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_tratti VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idTratto}".
            ")";
        }
    }
?>
