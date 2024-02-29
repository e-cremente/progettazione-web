<?php
    include "header.php";
?>

<?php
	echo '<div class="containermanuali">';

	$ManualeAbilitaEPoteri = new clsManuale(['label'=>'Abilit&agrave; e Poteri', 'imgpath'=>'img/manualeabilitaepoteri.png', 'downloadpath'=>'manuali/abilitaepoteri.pdf',
		                                     'captionclass'=>'imgcaption captionabilitaepoteri']);
	$ManualeAbilitaEPoteri->render();

	$ManualeCampaignSet = new clsManuale(['label'=>'Campaign Set', 'imgpath'=>'img/campaignset.png', 'downloadpath'=>'manuali/campaignset.pdf',
		                                  'captionclass'=>'imgcaption captioncampaignset']);
	$ManualeCampaignSet->render();

	$ManualeCampaignSetRevised = new clsManuale(['label'=>'Campaign Set Revised', 'imgpath'=>'img/campaignsetrevised.png', 'downloadpath'=>'manuali/campaignsetrevised.pdf',
		                                         'captionclass'=>'imgcaption captioncampaignsetrevised']);
	$ManualeCampaignSetRevised->render();

	$ManualeDemihumanDeities = new clsManuale(['label'=>'Demihuman Deities', 'imgpath'=>'img/demihumandeities.png', 'downloadpath'=>'manuali/demihumandeities.pdf',
		                                       'captionclass'=>'imgcaption captiondemihumandeities']);
	$ManualeDemihumanDeities->render();

	$ManualeFaithAvatars = new clsManuale(['label'=>'Faith & Avatars', 'imgpath'=>'img/faithavatars.png', 'downloadpath'=>'manuali/faithavatars.pdf',
		                                       'captionclass'=>'imgcaption captionfaithavatars']);
	$ManualeFaithAvatars->render();

	$ManualeGiocatore = new clsManuale(['label'=>'Manuale del Giocatore', 'imgpath'=>'img/manualegiocatore.png', 'downloadpath'=>'manuali/giocatore.pdf',
		                                'captionclass'=>'imgcaption captiongiocatore']);
	$ManualeGiocatore->render();

	$ManualeGuerrieriEPreti = new clsManuale(['label'=>'Guerrieri e Preti...', 'imgpath'=>'img/guerrieriepreti.png', 'downloadpath'=>'manuali/guerrieriepreti.pdf',
		                                  'captionclass'=>'imgcaption captionguerrieriepreti']);
	$ManualeGuerrieriEPreti->render();

	$ManualeIncantesimiEMagia = new clsManuale(['label'=>'Incantesimi e Magia', 'imgpath'=>'img/incantesimiemagia.png', 'downloadpath'=>'manuali/incantesimiemagia.pdf',
		                                        'captionclass'=>'imgcaption captionincantesimiemagia']);
	$ManualeIncantesimiEMagia->render();

	$ManualeMaghiELadri = new clsManuale(['label'=>'Maghi e Ladri...', 'imgpath'=>'img/maghieladri.png', 'downloadpath'=>'manuali/maghieladri.pdf',
		                                  'captionclass'=>'imgcaption captionmaghieladri']);
	$ManualeMaghiELadri->render();

	$ManualePowersPantheons = new clsManuale(['label'=>'Powers & Pantheons', 'imgpath'=>'img/powerspantheons.png', 'downloadpath'=>'manuali/powerspantheons.pdf',
		                                      'captionclass'=>'imgcaption captionpowerspantheons']);
	$ManualePowersPantheons->render();

	$ManualePriest1 = new clsManuale(['label'=>'Priests\' Spells V1', 'imgpath'=>'img/priest1.png', 'downloadpath'=>'manuali/priest1.pdf',
		                              'captionclass'=>'imgcaption captionpriest1']);
	$ManualePriest1->render();

	$ManualePriest2 = new clsManuale(['label'=>'Priests\' Spells V2', 'imgpath'=>'img/priest2.png', 'downloadpath'=>'manuali/priest2.pdf',
		                              'captionclass'=>'imgcaption captionpriest2']);
	$ManualePriest2->render();

	$ManualePriest3 = new clsManuale(['label'=>'Priests\' Spells V3', 'imgpath'=>'img/priest3.png', 'downloadpath'=>'manuali/priest3.pdf',
		                              'captionclass'=>'imgcaption captionpriest3']);
	$ManualePriest3->render();

	$ManualeWizard1 = new clsManuale(['label'=>'Wizards\' Spells V1', 'imgpath'=>'img/wizard1.png', 'downloadpath'=>'manuali/wizard1.pdf',
		                              'captionclass'=>'imgcaption captionwizard1']);
	$ManualeWizard1->render();

	$ManualeWizard2 = new clsManuale(['label'=>'Wizards\' Spells V2', 'imgpath'=>'img/wizard2.png', 'downloadpath'=>'manuali/wizard2.pdf',
		                              'captionclass'=>'imgcaption captionwizard2']);
	$ManualeWizard2->render();

	$ManualeWizard3 = new clsManuale(['label'=>'Wizards\' Spells V3', 'imgpath'=>'img/wizard3.png', 'downloadpath'=>'manuali/wizard3.pdf',
		                              'captionclass'=>'imgcaption captionwizard3']);
	$ManualeWizard3->render();

	$ManualeWizard4 = new clsManuale(['label'=>'Wizards\' Spells V4', 'imgpath'=>'img/wizard4.png', 'downloadpath'=>'manuali/wizard4.pdf',
		                              'captionclass'=>'imgcaption captionwizard4']);
	$ManualeWizard4->render();

	echo '</div>';
?>

<?php 
    include "footer.php";
?>