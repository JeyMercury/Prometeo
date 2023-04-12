<?php
return array(
    'VERSION_CACHE' => env('VERSION_CACHE'),
    'ALMACENAMIENTO' => env('ALMACENAMIENTO'),
    'DISK' => [
        'LOCAL' => [
            'PUBLICO' => 'public',
            'PRIVADO' => 'private',
        ],
        'AMAZON' => [
            'PUBLICO' => 's3_public',
            'PRIVADO' => 's3_private',
        ],
    ]
);
