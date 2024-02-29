<?php
    class clsStileCombattimento {
        //Proprietà private
        private $m_idStile;
        private $m_Nome;
        private $m_Effetto;
        //RELAZIONI: PADRI
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
            $this->m_idStile = $pDBRow["{$pPrfx}idStile"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_Effetto = $pDBRow["{$pPrfx}Effetto"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idStile'=>$this->m_idStile,
                'Nome'=>$this->m_Nome,
                'Effetto'=>$this->m_Effetto,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
