<?php
    class clsArma {
        //Proprietà private
        private $m_idArma;
        private $m_Nome;
        private $m_Costo;
        private $m_Peso;
        private $m_Taglia;
        private $m_Tipo;
        private $m_FattoreVelocita;
        private $m_DannoPM;
        private $m_DannoG;
        private $m_Categoria;
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
            $this->m_idArma = $pDBRow["{$pPrfx}idArma"];
            $this->m_Nome = $pDBRow["{$pPrfx}Nome"];
            $this->m_Costo = $pDBRow["{$pPrfx}Costo"];
            $this->m_Peso = $pDBRow["{$pPrfx}Peso"];
            $this->m_Taglia = $pDBRow["{$pPrfx}Taglia"];
            $this->m_Tipo = $pDBRow["{$pPrfx}Tipo"];
            $this->m_FattoreVelocita = $pDBRow["{$pPrfx}FattoreVelocita"];
            $this->m_DannoPM = $pDBRow["{$pPrfx}DannoPM"];
            $this->m_DannoG = $pDBRow["{$pPrfx}DannoG"];
            $this->m_Categoria = $pDBRow["{$pPrfx}Categoria"];
        }
        // }}}

        // public function toArray() {{{
        public function toArray()
        {
            $lvRes = [
                'idArma'=>$this->m_idArma,
                'Nome'=>$this->m_Nome,
                'Costo'=>$this->m_Costo,
                'Peso'=>$this->m_Peso,
                'Taglia'=>$this->m_Taglia,
                'Tipo'=>$this->m_Tipo,
                'FattoreVelocita'=>$this->m_FattoreVelocita,
                'DannoPM'=>$this->m_DannoPM,
                'DannoG'=>$this->m_DannoG,
                'Categoria'=>$this->m_Categoria,
            ];
            return $lvRes;
        }
        // }}}

    }
?>
