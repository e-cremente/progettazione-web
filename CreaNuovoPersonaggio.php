<?php
    include "header.php";
?>
<?php

    if (!isset($_SESSION['user'])){ 
        stampaMessaggio('NoSaveAllowed');
    } else if (isset($_SESSION['user'])){
        pulisciErrore();
    }
    include "CaricaPersonaggio.php";
?>
<p id='msgerr' class='message_error' hidden></p>

    <!-- tutti i campi seguenti devono essere hidden -->
    <input name="idPersonaggio" id="idPersonaggio" type="text" hidden value="<?php echo getValue('idPersonaggio'); ?>"/>
    <input name="HiddenRazza" id="HiddenRazza" type="text" hidden value="<?php echo getValue('HiddenRazza'); ?>"/>
    <input name="HiddenClasse" id="HiddenClasse" type="text" hidden value="<?php echo getValue('HiddenClasse'); ?>"/>
<?php
    echo "<input name='Creatore' id='Creatore' type='text' hidden value='". (isset($_SESSION['user']) ? $_SESSION['user'] : '') ."'/>";
?>
<?php
    $lvTabPanes = new clsUITabbedPanes([
        "id"=>"tabbedPanes",
        "tabNames"=>["Personaggio", "Combattimento", "Proficienze", "Altre info", "Ab. Ladri", "Incantesimi", "Equipaggiamento"]
    ]);
    $lvPanelPersonaggio = getPanelPersonaggio();
    $lvTabPanes->addContent($lvPanelPersonaggio);
    $lvPanelCombattimento = getPanelCombattimento();
    $lvTabPanes->addContent($lvPanelCombattimento);
    $lvPanelProficienze = getPanelProficienze();
    $lvTabPanes->addContent($lvPanelProficienze);
    $lvPanelAltreInfo = getPanelAltreInfo();
    $lvTabPanes->addContent($lvPanelAltreInfo);
    $lvPanelAbLadri = getPanelAbLadri();
    $lvTabPanes->addContent($lvPanelAbLadri);
    $lvPanelIncantesimi = getPanelIncantesimi();
    $lvTabPanes->addContent($lvPanelIncantesimi);
    $lvPanelEquipaggiamento = getPanelEquipaggiamento();
    $lvTabPanes->addContent($lvPanelEquipaggiamento);
    $lvTabPanes->render();

    if(isset($_GET['idPersonaggio'])){
        $BtnEliminaPersonaggio = new clsButton('ELIMINA PERSONAGGIO', 'BtnEliminaPersonaggio', 'button', 'BtnEliminaPersonaggio', 'btnelimina', null, 'divbuttonelimina');
        $BtnEliminaPersonaggio->render();
    }
    
?>

<?php 
    include "footer.php";
?>
