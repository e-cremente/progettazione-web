<?php
    class clsSvantaggio {
        //Proprietà private
        private $m_idSvantaggio;
        private $m_Nome;
        private $m_PPModerato;
        private $m_PPGrave;
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
            $this->m_idSvantaggio = $pDBRow["{$pPrfx}idSvantaggio"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_PPModerato = $pDBRow["{$pPrfx}PPModerato"];
            $this->m_PPGrave = $pDBRow["{$pPrfx}PPGrave"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idSvantaggio'=>$this->m_idSvantaggio,
                'Nome'=>$this->m_Nome,
                'PPModerato'=>$this->m_PPModerato,
                'PPGrave'=>$this->m_PPGrave,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
