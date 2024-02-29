<?php
    class clsPgAbilita {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idAbilita;
        private $m_Val_Abilita;
        private $m_Val_Skill1;
        private $m_Val_Skill2;
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_abilita;
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
            if ($pProperty == 'abilita') {
                if ($this->m_abilita == null) {
                    $this->m_abilita = new clsAbilita(selAbilita($this->m_idAbilita));
                }
                return $this->m_abilita;
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
            $this->m_idAbilita = $array['idAbilita'];
            $this->m_Val_Abilita = $array['Val_Abilita'];
            $this->m_Val_Skill1 = $array['Val_Skill1'];
            $this->m_Val_Skill2 = $array['Val_Skill2'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idAbilita = $pDBRow["{$pPrfx}idAbilita"];
            $this->m_Val_Abilita = $pDBRow["{$pPrfx}Val_Abilita"];
            $this->m_Val_Skill1 = $pDBRow["{$pPrfx}Val_Skill1"];
            $this->m_Val_Skill2 = $pDBRow["{$pPrfx}Val_Skill2"];
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
                'idAbilita'=>$this->m_idAbilita,
                'Val_Abilita'=>$this->m_Val_Abilita,
                'Val_Skill1'=>$this->m_Val_Skill1,
                'Val_Skill2'=>$this->m_Val_Skill2,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_abilita VALUES (".
                "{$this->m_idPersonaggio}, {$this->m_idAbilita}, ".
                "{$this->m_Val_Abilita}, {$this->m_Val_Skill1}, ".
                "{$this->m_Val_Skill2}".
            ")";
        }
    }
?>
