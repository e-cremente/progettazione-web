<?php
    class clsProficienza {
        //Proprietà private
        private $m_idProficienza;
        private $m_Nome;
        private $m_Categoria;
        private $m_CostoPP;
        private $m_ValoreBase;
        private $m_Abilita;
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
            $this->m_idProficienza = $pDBRow["{$pPrfx}idProficienza"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_Categoria = $pDBRow["{$pPrfx}Categoria"];
            $this->m_CostoPP = $pDBRow["{$pPrfx}CostoPP"];
            $this->m_ValoreBase = $pDBRow["{$pPrfx}ValoreBase"];
            $this->m_Abilita = $pDBRow["{$pPrfx}Abilita"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idProficienza'=>$this->m_idProficienza,
                'Nome'=>$this->m_Nome,
                'Categoria'=>$this->m_Categoria,
                'CostoPP'=>$this->m_CostoPP,
                'ValoreBase'=>$this->m_ValoreBase,
                'Abilita'=>$this->m_Abilita,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
