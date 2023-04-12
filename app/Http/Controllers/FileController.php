<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\RequestInterface;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    protected $except = [
        'get_file'
    ];

    public function get_file($filename){
        if(!Auth::user()){
            abort(403);
        }
        $disk = File::get_disk(true);
        if($disk == settings('DISK.AMAZON.PRIVADO')){
            $url = Storage::disk($disk)->temporaryUrl($filename, now()->addMinutes(constants('FILE.TIEMPO_DURACION_AMAZON')));
            return redirect($url);
        }else if($disk == settings('DISK.LOCAL.PRIVADO')){
            $url = config('filesystems.disks.'.$disk.'.root').'/'.$filename;
            return response()->download($url, null, [], null);
        }
    }
}
