<?php
return array(
    'ROLES' => [
        'ID' => [
            'ADMINISTRADOR' => 1,
            'EMPLEADO' => 2,
        ],
        'NOMBRE' => [
            'ADMINISTRADOR' => 'ADMINISTRADOR',
            'EMPLEADO' => 'EMPLEADO',
        ],
    ],
    'PERMISOS' => [
        'ID' => [
            'VER_USUARIOS' => 1,
            'CREAR_USUARIOS' => 2,
            'EDITAR_USUARIOS' => 3,
            'ELIMINAR_USUARIOS' => 4,

            'VER_PERMISOS' => 5,
            'EDITAR_PERMISOS_USUARIO' => 6,
            'EDITAR_PERMISOS_ROL' => 7,
            'EDITAR_ROLES_USUARIO' => 8,
            'VER_ESTADISTICAS' => 9,
        ],
        'NOMBRE' => [
            'VER_USUARIOS' => 'VER_USUARIOS',
            'CREAR_USUARIOS' => 'CREAR_USUARIOS',
            'EDITAR_USUARIOS' => 'EDITAR_USUARIOS',
            'ELIMINAR_USUARIOS' => 'ELIMINAR_USUARIOS',
            'VER_PERMISOS' => 'VER_PERMISOS',
            'EDITAR_PERMISOS_USUARIO' => 'EDITAR_PERMISOS_USUARIO',
            'EDITAR_PERMISOS_ROL' => 'EDITAR_PERMISOS_ROL',
            'EDITAR_ROLES_USUARIO' => 'EDITAR_ROLES_USUARIO',
            'VER_ESTADISTICAS' => 'VER_ESTADISTICAS',
        ],
    ],
);
