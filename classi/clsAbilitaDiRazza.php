<?php
    class clsAbilitaDiRazza {
        //Proprietà private
        private $m_idAbilitadirazza;
        private $m_Nome;
        private $m_CostoPP;
        private $m_Razza;
        //RELAZIONI: PADRI
        private $m_razza;
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
            if ($pProperty == 'razza') {
                if ($this->m_razza == null) {
                    $this->m_razza = new clsRazza(selRazza($this->m_Razza));
                }
                return $this->m_razza;
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
        public function __construct($pDBRow = null, $pPrfx = '')
        {
            if ($pDBRow == null) return;
            $this->m_idAbilitadirazza = $pDBRow["{$pPrfx}idAbilitadirazza"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_CostoPP = $pDBRow["{$pPrfx}CostoPP"];
            $this->m_Razza = $pDBRow["{$pPrfx}Razza"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idAbilitadirazza'=>$this->m_idAbilitadirazza,
                'Nome'=>$this->m_Nome,
                'CostoPP'=>$this->m_CostoPP,
                'Razza'=>$this->m_Razza,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
