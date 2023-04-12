<?php
return array(
    'PAGINACION' => array(
        'PEQUENO' => 5,
        'NORMAL' => 10,
        'GRANDE' => 20,
    ),
    'EMAIL' => [
        'NUMERO_REINTENTOS' => 10,
        'NUMERO_EMAILS_ENVIO' => 20,
        'EMAIL_TIPOS' => array(
            'BIENVENIDA' => 1,
            'RESTAURAR_CONTRASEÑA' => 2
        ),
        'EMAIL_PRIORIDAD' => [
            'PRIORIDAD_ALTA' => 1,
            'PRIORIDAD_MEDIA' => 5,
            'PRIORIDAD_BAJA' => 10,
        ],
    ],
    'PATH'=>[
        'FICHERO_TRADUCCIONES' => [
            'IMPORT' => [
                'PHP'=>'lang/es/general.php',
                'VUE'=>'resources/js/traducciones/es.js',
            ],
            'EXPORT' => 'lang/general.php'
        ]
    ],
    'FILE' => [
        'PUBLICO'=> 0,
        'PRIVADO'=> 1,
        'TIEMPO_DURACION_AMAZON'=> 5
    ],
    'FILE_PATH' => [
        'USER' => [
            'IMAGEN' => '/users/imagenes',
            'FICHERO' => '/users/ficheros'
        ]
    ],
    'FORMATOS_FECHA' => [
        'USUARIO' => 'd/m/Y H:i',
        'BD' => 'Y-m-d H:i',
        'USUARIO_COMPLETA' => 'd/m/Y H:i:s',
        'BD_COMPLETA' => 'Y-m-d H:i:s',
        'USUARIO_CORTA' => 'd/m/Y',
        'USUARIO_CORTA_VUE' => 'DD/MM/YYYY',
        'BD_CORTA' => 'Y-m-d',
        'HORA' => 'H:i',
        'HORA_COMPLETA' => 'H:i:s',
    ],
    'FORMATOS_FICHEROS' => [
        'EXCEL' => '.xlsx'
    ],
);
