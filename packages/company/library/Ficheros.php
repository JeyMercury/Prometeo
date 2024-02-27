<?php

namespace Company\Library;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Ficheros {

    public static function get_url($file_id){
        $file = File::findOrFail($file_id);
        $disk = File::get_disk($file->privado);
        if($disk == settings('DISK.AMAZON.PRIVADO')){
            $disk=settings('DISK.LOCAL.PRIVADO');
        }
        return asset_cache(Storage::disk($disk)->url($file->file));
    }
}
