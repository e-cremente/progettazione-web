<?php
    class clsIncantesimo {
        //Proprietà private
        private $m_NomeIncantesimo;
        private $m_idIncantesimo;
        //RELAZIONI: PADRI
        //RELAZIONI: FIGLI
        private $m_pg_incantesimo;
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
            //RELAZIONI: FIGLI
            if ($pProperty == 'pg_incantesimo') {
                if ($this->m_pg_incantesimo == null) {
                    $this->m_pg_incantesimo = $this->getArrayPgIncantesimi();
                 }
                return $this->m_pg_incantesimo;
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
            $this->m_NomeIncantesimo = $pDBRow["{$pPrfx}NomeIncantesimo"];
            $this->m_idIncantesimo = $pDBRow["{$pPrfx}idIncantesimo"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'NomeIncantesimo'=>$this->m_NomeIncantesimo,
                'idIncantesimo'=>$this->m_idIncantesimo
            ];
            return $lvRes;
        }
        // }}}

        // public function getArrayPgIncantesimi() {{{
        function getArrayPgIncantesimi(){
            $result = selIncPersonaggi($this->NomeIncantesimo);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = new clsPgIncantesimo($row);
            }
            return $arr;
        }

    }
?>
