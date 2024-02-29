<?php
    class clsPgArmatura {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idArmatura;
        private $m_CA;
        private $m_Sorpreso;
        private $m_SenzaScudo;
        private $m_AlleSpalle;
        private $m_Incantesimi;
        private $m_Difese;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_armatura;
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
            if ($pProperty == 'armatura') {
                if ($this->m_armatura == null) {
                    $this->m_armatura = new clsArmatura(selArmatura($this->m_idArmatura));
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
            $this->m_idArmatura = $array['idArmatura'];
            $this->m_CA = $array['CA'];
            $this->m_Sorpreso = $array['Sorpreso'];
            $this->m_SenzaScudo = $array['SenzaScudo'];
            $this->m_AlleSpalle = $array['AlleSpalle'];
            $this->m_Incantesimi = $array['Incantesimi'];
            $this->m_Difese = $array['Difese'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idArmatura = $pDBRow["{$pPrfx}idArmatura"];
            $this->m_CA = $pDBRow["{$pPrfx}CA"];
            $this->m_Sorpreso = $pDBRow["{$pPrfx}Sorpreso"];
            $this->m_SenzaScudo = $pDBRow["{$pPrfx}SenzaScudo"];
            $this->m_AlleSpalle = $pDBRow["{$pPrfx}AlleSpalle"];
            $this->m_Incantesimi = $pDBRow["{$pPrfx}Incantesimi"];
            $this->m_Difese = $pDBRow["{$pPrfx}Difese"];
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
                'idArmatura'=>$this->m_idArmatura,
                'CA'=>$this->m_CA,
                'Sorpreso'=>$this->m_Sorpreso,
                'SenzaScudo'=>$this->m_SenzaScudo,
                'AlleSpalle'=>$this->m_AlleSpalle,
                'Incantesimi'=>$this->m_Incantesimi,
                'Difese'=>$this->m_Difese,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_armatura VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idArmatura}, ".
                "{$this->m_CC}, {$this->m_Sorpreso}, ".
                "{$this->m_SenzaScudo}, {$this->m_AlleSpalle}, ".
                "{$this->m_Incantesimi}, '{$this->m_Difese}'".
            ")";
        }
    }
?>
