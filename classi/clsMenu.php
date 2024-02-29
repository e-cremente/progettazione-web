<?php
	class clsMenu{
		public $menuarr;
		
		function clsMenu(){
			$this->manuarr = array();
		}	

		function render(){
			foreach($this->menuarr as $key => $VoceMenu) {
				$numFigli = count($VoceMenu->figli);
				if ($numFigli == 0) {
					echo '<li>';
						$VoceMenu->render();
					echo '</li>';					
				} else {
					echo '<li class="dropdown">';
					echo '<a href="javascript:void(0)" class="dropbtn">' . $VoceMenu->testo . '</a>';
					echo '<div class="dropdown-content">';
					foreach ($VoceMenu->figli as $key => $VMFiglio) {
						$VMFiglio->render();
					}
					echo '</div>';
					echo '</li>';
				}
			}
		}

		function appendiFiglio($pVoceMenu, $pIdPadre){
			if($pIdPadre == null) {
				$this->menuarr[$pVoceMenu->Id] = $pVoceMenu;
			} else if(array_key_exists($pIdPadre, $this->menuarr)) {
				$this->menuarr[$pIdPadre]->appendiFiglio($pVoceMenu);
			} else {
				foreach($this->menuarr as $key => $VoceMenu) {
					if(array_key_exists($pIdPadre, $VoceMenu->figli)){
						$VoceMenu->figli[$pIdPadre]->appendiFiglio($pVoceMenu);
						return;
					} 
				}
			}
		}
	}
?>