<?php
	class clsManuale{
		public $label;
		public $imgpath;
		public $imgclass;
		public $downloadpath;
		public $captionclass;
		public $divclass;

		function clsManuale($pArr){
			if(isset($pArr['label'])) $this->label = $pArr['label'];
			if(isset($pArr['imgpath'])) $this->imgpath = $pArr['imgpath'];
			if(isset($pArr['imgclass'])) $this->imgclass = $pArr['imgclass'];
			if(isset($pArr['downloadpath'])) $this->downloadpath = $pArr['downloadpath'];
			if(isset($pArr['captionclass'])) $this->captionclass = $pArr['captionclass'];
			if(isset($pArr['divclass'])) $this->divclass = $pArr['divclass'];
		}

		function render(){
			echo '<div class="'. ($this->divclass !== null ? $this->divclass : 'divmanuale') .'">';
			echo '<img src="'.$this->imgpath.'" class="'.($this->imgclass !== null ? $this->imgclass : 'imgmanuale').'">';
			echo '<a href="'.$this->downloadpath.'" class="'.($this->captionclass !== null ? $this->captionclass : 'imgcaption').'" download>'.$this->label.'</a>';
			echo '</div>';
		}
	}

?>