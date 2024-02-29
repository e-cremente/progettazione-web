<?php
    class clsArmatura {
        //Proprietà private
        private $m_idArmatura;
        private $m_Categoria;
        private $m_CA;
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
            $this->m_idArmatura = $pDBRow["{$pPrfx}idArmatura"];
            $this->m_Categoria = $pDBRow["{$pPrfx}Categoria"];
            $this->m_CA = $pDBRow["{$pPrfx}CA"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idArmatura'=>$this->m_idArmatura,
                'Categoria'=>$this->m_Categoria,
                'CA'=>$this->m_CA,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
