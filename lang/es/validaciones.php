<?php
return array(
    'user' => [
        'username' => [
            'required' => 'Es obligatorio indicar un username',
            'unique' => 'El username debe ser único',
        ],
        'nombre' => [
            'required' => 'Es obligatorio indicar un nombre',
        ],
        'apellidos' => [
            'required' => 'Es obligatorio indicar los apellidos',
        ],
        'email' => [
            'required' => 'Es obligatorio indicar un email',
            'email' => 'El email no es válido',
            'unique' => 'El email debe ser único',
        ],
        'password' => [
            'required' => 'Es obligatorio indicar una contraseña',
            'min' => 'La contraseña debe tener un mínimo de 6 caracteres',
        ],
    ],
    'rol' => [
        'name' => 'Es obligatorio indicar un nombre',
        'unique' => 'Este rol ya existe',
    ],
);
