<?php
    class clsAbilitaDiClasse {
        //Proprietà private
        private $m_idAbilitadiclasse;
        private $m_Nome;
        private $m_CostoPP;
        private $m_Classe;
        //RELAZIONI: PADRI
        private $m_classe;
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
            if ($pProperty == 'classe') {
                if ($this->m_classe == null) {
                    $this->m_classe = new clsClasse(selClasse($this->m_Classe));
                }
                return $this->m_classe;
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
            $this->m_idAbilitadiclasse = $pDBRow["{$pPrfx}idAbilitadiclasse"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_CostoPP = $pDBRow["{$pPrfx}CostoPP"];
            $this->m_Classe = $pDBRow["{$pPrfx}Classe"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idAbilita'=>$this->m_idAbilitadiclasse,
                'Nome'=>$this->m_Nome,
                'CostoPP'=>$this->m_CostoPP,
                'Classe'=>$this->m_Classe,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
