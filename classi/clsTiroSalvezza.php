<?php
    class clsTiroSalvezza {
        //Proprietà private
        private $m_idTiroSalvezza;
        private $m_NomeTV;
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
            $this->m_idTiroSalvezza = $pDBRow["{$pPrfx}idTiroSalvezza"];
            $this->m_NomeTV = $pDBRow["{$pPrfx}NomeTV"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idTiroSalvezza'=>$this->m_idTiroSalvezza,
                'NomeTV'=>$this->m_NomeTV,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
