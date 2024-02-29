<?php
function myAutoload($pClassName) {
    //$base_dir è una costante che viene letta da config.php
    $base_dir = DIR_BASE;
    //$file = $base_dir . '/classi/' . $pClassName . '.php';
    $file = $base_dir . '\\classi\\' . $pClassName . '.php';
//echo "<br/>trying to include {$pClassName} from file {$file}";
    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
}
?>
