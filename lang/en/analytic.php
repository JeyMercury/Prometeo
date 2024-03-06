<?php
$json_traducciones_vue = file_get_contents(base_path(constants('PATH.FICHERO_TRADUCCIONES.IMPORT.VUE')), true);
$json_traducciones_vue = str_replace('export default', '', $json_traducciones_vue);
$traducciones_vue = json_decode($json_traducciones_vue, true);
return array_merge(
    array(
        'usage_stats' => 'Usage stats'
    ),
    $traducciones_vue
);
