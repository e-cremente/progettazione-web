<?php
    class clsPgProficienze {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idProficienza;
        private $m_Valore;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_proficienza;
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
            if ($pProperty == 'proficienza') {
                if ($this->m_proficienza == null) {
                    $this->m_proficienza = new clsProficienza(selProficienza($this->m_idProficienza));
                }
                return $this->m_proficienza;
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
            $this->m_idProficienza = $array['idProficienza'];
            $this->m_Valore = $array['Valore'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idProficienza = $pDBRow["{$pPrfx}idProficienza"];
            $this->m_Valore = $pDBRow["{$pPrfx}Valore"];
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
                'idProficienza'=>$this->m_idProficienza,
                'Valore'=>$this->m_Valore,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_proficienza VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idProficienza}, ".
                "{$this->m_Valore}".
            ")";
        }
    }
?>
