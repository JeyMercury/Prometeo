<?php

namespace Company\Library;


class Fechas {


    public static function get_meses_año(){
        return [
            1 => __('general.fechas.enero'),
            2 => __('general.fechas.febrero'),
            3 => __('general.fechas.marzo'),
            4 => __('general.fechas.abril'),
            5 => __('general.fechas.mayo'),
            6 => __('general.fechas.junio'),
            7 => __('general.fechas.julio'),
            8 => __('general.fechas.agosto'),
            9 => __('general.fechas.septiembre'),
            10 => __('general.fechas.octubre'),
            11 => __('general.fechas.noviembre'),
            12 => __('general.fechas.diciembre'),
        ];
    }

    public static function get_mes_año($mes){
        $meses_ano = self::get_meses_año();
        return $meses_ano[$mes];
    }
}
