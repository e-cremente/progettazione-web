<?php
    class clsPgArma {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idArma;
        private $m_AtkRound;
        private $m_ModAtkDanno;
        private $m_Thaco;
        private $m_Raggio;
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
            $this->m_AtkRound = $array['AtkRound'];
            $this->m_ModAtkDanno = $array['ModAtkDanno'];
            $this->m_Thaco = $array['Thaco'];
            $this->m_Raggio = $array['Raggio'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idArma = $pDBRow["{$pPrfx}idArma"];
            $this->m_AtkRound = $pDBRow["{$pPrfx}AtkRound"];
            $this->m_ModAtkDanno = $pDBRow["{$pPrfx}ModAtkDanno"];
            $this->m_Thaco = $pDBRow["{$pPrfx}Thaco"];
            $this->m_Raggio = $pDBRow["{$pPrfx}Raggio"];
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
                'AtkRound'=>$this->m_AtkRound,
                'ModAtkDanno'=>$this->m_ModAtkDanno,
                'Thaco'=>$this->m_Thaco,
                'Raggio'=>$this->m_Raggio,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_arma VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idArma}, ".
                "{$this->m_AtkRound}, '{$this->m_ModAtkDanno}', ".
                "{$this->m_Thaco}, {$this->m_Raggio}".
            ")";
        }
    }
?>
