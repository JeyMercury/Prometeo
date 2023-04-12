<?php

use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('asset_cache')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function asset_cache($path, $secure = null)
    {
        $url = app('url')->asset($path . "?v=" . settings('VERSION_CACHE'), $secure);
        return str_replace('http:', '', str_replace('https:', '', $url));
    }
}

if (!function_exists('d')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed  $vars
     * @return void
     */
    function d(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }
    }
}

if (!function_exists('rol')) {
    function rol($nombre_rol)
    {
        return config('constants_permission.ROLES.NOMBRE.' . $nombre_rol);
    }
}

if (!function_exists('rol_id')) {
    function rol_id($nombre_rol)
    {
        return config('constants_permission.ROLES.ID.' . $nombre_rol);
    }
}

if (!function_exists('permiso')) {
    function permiso($nombre_permiso)
    {
        return config('constants_permission.PERMISOS.NOMBRE.' . $nombre_permiso);
    }
}

if (!function_exists('permiso_id')) {
    function permiso_id($permiso_id)
    {
        return config('constants_permission.PERMISOS.ID.' . $permiso_id);
    }
}

if (!function_exists('idioma')) {
    function idioma($nombre_idioma)
    {
        return config('constants_idiomas.IDIOMAS.NOMBRE.' . $nombre_idioma);
    }
}

if (!function_exists('idioma_id')) {
    function idioma_id($idioma_id)
    {
        return config('constants_idiomas.IDIOMAS.ID.' . $idioma_id);
    }
}

if (!function_exists('settings')) {
    function settings($path)
    {
        return config('settings.' . $path);
    }
}

if (!function_exists('constants')) {
    function constants($path)
    {
        return config('constants.' . $path);
    }
}

if (!function_exists('constants_text')) {
    function constants_text($path)
    {
        return config('constants_text.' . $path);
    }
}

if (!function_exists('generar_slug')) {
    function generar_slug($nombre)
    {
        $nombre = trim($nombre);
        $originales = 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿ';
        $modificadas = 'aaaaaaceeeeiiiinoooooouuuuaaaaaaaceeeeiiiidnoooooouuuuyyby';
        $valor = utf8_decode($nombre);
        $valor = strtr($valor, utf8_decode($originales), $modificadas);
        $valor = strtolower($valor);
        $valor = str_replace(' - ', '-', $valor);
        $valor = str_replace(' ', '-', $valor);
        $slug = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $valor);
        return $slug;
    }
}

if (!function_exists('boolean_to_text')) {
    function boolean_to_text($bool)
    {
        return $bool ? __('general.si') : __('general.no');
    }
}

if (!function_exists('antiguo_valor_fecha')) {
    function antiguo_valor_fecha($nombre_campo, $value)
    {
        if (old($nombre_campo) != null) {
            $value = Carbon\Carbon::createFromFormat(constants('FORMATOS_FECHA.USUARIO_CORTA'), old($nombre_campo));
        }

        return $value;
    }
}
