<?php
    class clsTratto {
        //Proprietà private
        private $m_idTratto;
        private $m_Nome;
        private $m_CostoPP;
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
            $this->m_idTratto = $pDBRow["{$pPrfx}idTratto"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_CostoPP = $pDBRow["{$pPrfx}CostoPP"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idTratto'=>$this->m_idTratto,
                'Nome'=>$this->m_Nome,
                'CostoPP'=>$this->m_CostoPP,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
