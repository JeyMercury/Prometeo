<?php

use App\Mail\Mail;
use App\Models\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\ExtraInfoController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EstadisticaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['prefix' => 'prompts', 'as' => 'prompts.'], function () {
    Route::get('/', [PromptController::class, 'index'])->name('index');
    Route::get('create', [PromptController::class, 'create'])->name('create');
    Route::post('store', [PromptController::class, 'store'])->name('store');
    Route::get('edit/{id}', [PromptController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [PromptController::class, 'update'])->name('update');
    // Route::delete('destroy/{id}', [PromptController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'extra_info', 'as' => 'extra_info.'], function () {
    Route::get('/', [ExtraInfoController::class, 'index'])->name('index');
    Route::get('create', [ExtraInfoController::class, 'create'])->name('create');
    Route::post('store', [ExtraInfoController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ExtraInfoController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [ExtraInfoController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [ExtraInfoController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'analytics', 'as' => 'analytics.'], function () {
    Route::get('/', [AnalyticController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'permission:VER_USUARIOS'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('datatable', [UserController::class, 'getDataTable'])->name('datatable');
    Route::get('show/{id}', [UserController::class, 'show'])->name('show');
    Route::get('exportar', [UserController::class, 'exportar'])->name('exportar');
    Route::get('ficha_user_pdf/{id}', [UserController::class, 'ficha_user_pdf'])->name('ficha_user_pdf');

    Route::middleware(['permission:CREAR_USUARIOS'])->group(function () {
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
    });

    Route::middleware(['permission:EDITAR_USUARIOS'])->group(function () {
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('destroy_imagen/{id}', [UserController::class, 'destroy_imagen'])->name('destroy_imagen');
        Route::delete('destroy_fichero/{id}', [UserController::class, 'destroy_fichero'])->name('destroy_fichero');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix' => 'permisos', 'as' => 'permisos.', 'middleware' => 'permission:VER_PERMISOS'], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');

    Route::middleware(['permission:EDITAR_PERMISOS_ROL'])->group(function () {
        Route::get('create_rol', [PermissionController::class, 'create_rol'])->name('create_rol');
        Route::post('store_rol', [PermissionController::class, 'store_rol'])->name('store_rol');
        Route::get('edit_rol/{id}', [PermissionController::class, 'edit_rol'])->name('edit_rol');
        Route::post('update_rol/{id}', [PermissionController::class, 'update_rol'])->name('update_rol');
        Route::get('edit_rol_permission/{id}', [PermissionController::class, 'edit_rol_permission'])->name('edit_rol_permission');
        Route::put('update_rol_permission/{id}', [PermissionController::class, 'update_rol_permission'])->name('update_rol_permission');
    });

    Route::middleware(['permission:EDITAR_PERMISOS_USUARIO'])->group(function () {
        Route::get('edit_user_permission/{id}', [PermissionController::class, 'edit_user_permission'])->name('edit_user_permission');
        Route::put('update_user_permission/{id}', [PermissionController::class, 'update_user_permission'])->name('update_user_permission');
    });

    Route::middleware(['permission:EDITAR_ROLES_USUARIO'])->group(function () {
        Route::get('edit_user_rol/{id}', [PermissionController::class, 'edit_user_rol'])->name('edit_user_rol');
        Route::put('update_user_rol/{id}', [PermissionController::class, 'update_user_rol'])->name('update_user_rol');
    });
});

Route::group(['prefix' => 'eventos', 'as' => 'eventos.'], function () {
    Route::get('/calendario', [EventoController::class, 'calendario'])->name('calendario');
    Route::get('/api_eventos', [EventoController::class, 'api_eventos'])->name('api_eventos');
    Route::post('/store', [EventoController::class, 'store'])->name('store');
    Route::put('/update/{evento}', [EventoController::class, 'update'])->name('update');
    Route::put('/destroy/{evento}', [EventoController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'estadisticas', 'as' => 'estadisticas.', 'middleware' => 'permission:VER_ESTADISTICAS'], function () {
    Route::get('/', [EstadisticaController::class, 'index'])->name('index');
});

Route::get('/files/get_file/{file_name}', [FileController::class, 'get_file'])->where('file_name', '^(.+)\/([^\/]+)$');

Route::get('/mail/{id}', function ($id) {
    if (config('app.env') == 'production') {
        abort('404');
    }
    $email = Email::findOrFail($id);
    $mail = new Mail();
    Email::switch_tipo($mail, $email->tipo);

    return $mail->with(['body' => $email->body, 'prueba' => true]);
});
