<?php
    class clsPgAbilitaDiClasse {
        //Proprietà private
        private $m_idPersonaggio;
        private $m_idAbilitadiclasse;
        public $insertstmt;
        //RELAZIONI: PADRI
        private $m_abilitadiclasse;
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
            if ($pProperty == 'abilitadiclasse') {
                if ($this->m_abilitadiclasse == null) {
                    $this->m_abilitadiclasse = new clsAbilitaDiClasse(selAbilitaDiClasse($this->m_idAbilitadiclasse));
                }
                return $this->m_abilitadiclasse;
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
            $this->m_idAbilitadiclasse = $array['idAbilitadiclasse'];
        }

        public function constructFromDb($pDBRow, $pPrfx)
        {
            if ($pDBRow == null) return;
            $this->m_idPersonaggio = $pDBRow["{$pPrfx}idPersonaggio"];
            $this->m_idAbilitadiclasse = $pDBRow["{$pPrfx}idAbilitadiclasse"];
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
                'idAbilitadiclasse'=>$this->m_idAbilitadiclasse,
            ];
            return $lvRes;
        }
        // }}}

        function setInsertStmt(){
            $this->insertstmt = "INSERT INTO pg_abilitadiclasse VALUES (" .
                "{$this->m_idPersonaggio}, {$this->m_idAbilitadiclasse}".
            ")";
        }
    }
?>
