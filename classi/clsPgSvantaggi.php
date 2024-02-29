<?php
    class clsPgSvantaggi {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idSvantaggio;
        private $m_Grave;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_svantaggio;
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
            if ($pProperty == 'svantaggio') {
                if ($this->m_svantaggio == null) {
                    $this->m_svantaggio = new clsSvantaggio(selSvantaggio($this->m_idSvantaggio));
                }
                return $this->m_svantaggio;
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
            $this->m_idSvantaggio = $array['idSvantaggio'];
            $this->m_Grave = $array['Grave'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idSvantaggio = $pDBRow["{$pPrfx}idSvantaggio"];
            $this->m_Grave = $pDBRow["{$pPrfx}Grave"];
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
                'idStile'=>$this->m_idSvantaggio,
                'Grave'=>$this->m_Grave,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_stilecombattimento VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idSvantaggio}, ".
                "{$this->m_Grave}".
            ")";
        }
    }
?>
