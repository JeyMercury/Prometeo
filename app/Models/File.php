<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{


    public function user_imagen(){
        return $this->hasOne(User::class, 'imagen_id', 'id')->toSql();
    }

    public function user_fichero(){
        return $this->hasOne(User::class, 'fichero_id', 'id' );
    }


    public static function subir_fichero($fichero, $path, $privado = true){
        if(!is_null($fichero)){
            $datos_fichero = pathinfo($fichero->getClientOriginalName());
            $nombre_archivo = str_replace(' ', '_', $datos_fichero['filename']) . '_' . Carbon::now()->timestamp . '.' . $datos_fichero['extension'];
            $disk = self::get_disk($privado);

            if($path_fichero = $fichero->storeAs($path, $nombre_archivo, $disk)){
                $fichero->path_fichero = $path_fichero;
                $fichero->privado = $privado;
                $fichero->nombre = $nombre_archivo;
                $file = new File();
                if($file->guardar($fichero)){
                    return $file->id;
                }
            }
            return false;
        }
        return null;
    }

    public function guardar($datos_fichero){
        $this->file = $datos_fichero->path_fichero;
        $this->nombre = $datos_fichero->nombre;
        $this->type = $datos_fichero->getClientMimeType();
        $this->privado = $datos_fichero->privado;
        if($this->save()){
            return true;
        }
        return false;
    }

    public static function borrar_fichero($file_id){
        $fichero = self::findOrFail($file_id);
        if($fichero->delete()){
            $disk = self::get_disk($fichero->privado);
            if(Storage::disk($disk)->delete($fichero->file)){
                return true;
            }
        }
        return false;
    }

    public static function get_disk($privado){
        $almacenamiento = settings('ALMACENAMIENTO');
        if($almacenamiento == 'local'){
            if($privado){
                $disk = settings('DISK.LOCAL.PRIVADO');
            }else{
                $disk = settings('DISK.LOCAL.PUBLICO');
            }
        }else if($almacenamiento == 'amazon'){
            if($privado){
                $disk = settings('DISK.AMAZON.PRIVADO');
            }else{
                $disk = settings('DISK.AMAZON.PUBLICO');
            }
        }

        return $disk;
    }
}
