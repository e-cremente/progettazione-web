<?php
	class clsVoceMenu{
		public $Id; 
		public $lingua;
		public $testo;
		public $azione;
		public $idpadre;
		public $figli;
		
		function clsVoceMenu($pId, $pLingua, $pTesto, $pAzione, $pIdpadre){
			$this->Id = $pId;
			$this->lingua = $pLingua;
			$this->testo = $pTesto;
			$this->azione = $pAzione;
			$this->idpadre = $pIdpadre;
			$this->figli = array();
		}	

		function render(){
			//if($this->azione != null){
				echo '<a href="'. $this->azione .'">'. $this->testo .'</a>';
			/*} else {
				//echo $this->testo;
				return null;
			}*/
		}

		function appendiFiglio($pFiglio){
			$this->figli[$pFiglio->Id] = $pFiglio;
		}
	}
?>