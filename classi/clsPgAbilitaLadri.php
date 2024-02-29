<?php
    class clsPgAbilitaLadri {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idAbilitaladri;
        private $m_Base;
        private $m_Razza;
        private $m_Destrezza;
        private $m_Armatura;
        private $m_Tratti;
        private $m_Oggetti;
        private $m_Livello;
        private $m_Speciale;
        //
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_abilitaladri;
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
            if ($pProperty == 'abilitaladri') {
                if ($this->m_abilitaladri == null) {
                    $this->m_abilitaladri = new clsAbilitaLadri(selAbilitaLadri($this->m_idAbilitaladri));
                }
                return $this->m_abilitaladri;
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
            $this->m_idAbilitaladri = $array['idAbilitaladri'];
            $this->m_Base = $array['Base'];
            $this->m_Razza = $array['Razza'];
            $this->m_Destrezza = $array['Destrezza'];
            $this->m_Armatura = $array['Armatura'];
            $this->m_Tratti = $array['Tratti'];
            $this->m_Oggetti = $array['Oggetti'];
            $this->m_Livello = $array['Livello'];
            $this->m_Speciale = $array['Speciale'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idAbilitaladri = $pDBRow["{$pPrfx}idAbilitaladri"];
            $this->m_Base = $pDBRow["{$pPrfx}Base"];
            $this->m_Razza = $pDBRow["{$pPrfx}Razza"];
            $this->m_Destrezza = $pDBRow["{$pPrfx}Destrezza"];
            $this->m_Armatura = $pDBRow["{$pPrfx}Armatura"];
            $this->m_Tratti = $pDBRow["{$pPrfx}Tratti"];
            $this->m_Oggetti = $pDBRow["{$pPrfx}Oggetti"];
            $this->m_Livello = $pDBRow["{$pPrfx}Livello"];
            $this->m_Speciale = $pDBRow["{$pPrfx}Speciale"];
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
                'idAbilitaladri'=>$this->m_idAbilitaladri,
                'Base'=>$this->m_Base,
                'Razza'=>$this->m_Razza,
                'Destrezza'=>$this->m_Destrezza,
                'Armatura'=>$this->m_Armatura,
                'Tratti'=>$this->m_Tratti,
                'Oggetti'=>$this->m_Oggetti,
                'Livello'=>$this->m_Livello,
                'Speciale'=>$this->m_Speciale,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_abilitaladri VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idAbilitaladri}, ".
                "{$this->m_Base}, {$this->m_Razza}, ".
                "{$this->m_Destrezza}, {$this->m_Armatura}, ".
                "{$this->m_Tratti}, {$this->m_Oggetti}, ".
                "{$this->m_Livello}, {$this->m_Speciale}".
            ")";
        }
    }
?>
