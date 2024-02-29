<?php
    class clsPgMoneta {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idMoneta;
        private $m_Quantita;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_moneta;
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
            if ($pProperty == 'moneta') {
                if ($this->m_moneta == null) {
                    $this->m_moneta = new clsMoneta(selMoneta($this->m_idMoneta));
                }
                return $this->m_moneta;
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
            $this->m_idMoneta = $array['idMoneta'];
            $this->m_Quantita = $array['Quantita'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idMoneta = $pDBRow["{$pPrfx}idMoneta"];
            $this->m_Quantita = $pDBRow["{$pPrfx}Quantita"];
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
                'idMoneta'=>$this->m_idMoneta,
                'Quantita'=>$this->m_Quantita,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_moneta VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idMoneta}, ".
                "{$this->m_Quantita}".
            ")";
        }
    }
?>
