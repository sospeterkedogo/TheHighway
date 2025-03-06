<?php 

function loadTemplate($filename, $templateVars) {
    extract($templateVars);
    ob_start();
    require $filename;
    $output = ob_get_clean();
    return $output;
}

?>