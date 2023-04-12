<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use Softeca\Library\Pdf;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\User\CreateFormRequest;
use App\Http\Requests\User\UpdateFormRequest;

class UserController extends Controller
{
    protected $except = [];

    /**
     * Función para mostrar un listado de los diferentes usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Los Users se obtendran mediante los datatable

        return view('Users.index', [
            'buscador' => $request->getQueryString(),
        ]);
    }

    /**
     * Función a la cuál se consultaran los datos mediante el datatable de index
     */
    public function getDataTable(Request $request)
    {
        $users = User::buscar($request)
            ->paginate(constants('paginacion.NORMAL'));
        return UserResource::collection($users);
    }

    /**
     * Función para mostrar la vista de alta un usuario
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Users.create');
    }

    /**
     * Función para dar de crear un usuario
     *
     * Tipo POST
     * [VALIDACIONES PREVIAS] - CreateFormRequest
     *
     * @param  \App\Http\Requests\User\CreateFormRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request)
    {
        $user = new User();
        DB::beginTransaction();
        if ($user->guardar($request->all()) && Email::nuevo_email_bienvenida($user)) {
            DB::commit();
            return redirect()->route('users.index')->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }

    /**
     * Mostrar un usuario especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Users.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Función para mostrar la vista de edicion de un usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Edicion de un usuario.
     *
     * [VALIDACIONES PREVIAS] - UpdateFormRequest (Que hereda de CreateFormRequest, pero quitando la validacion de password)
     *
     * Tipo PUT
     *
     * @param  \App\Http\Requests\User\UpdateFormRequest;
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        $user = User::findorfail($id);
        if ($user->guardar($request->all())) {
            DB::commit();
            return redirect()->route('users.index')->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }

    /**
     * Borramos un usuario
     * Se hace mediante un SweetAlert de confirmacion y Ajax, por eso construimos la respues de esa manera,
     * mediante un json, que nos servira para mostrar el mensaje de error o de success
     *
     * @param  int  $id
     * @return json
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $user = User::findOrFail($id);
        if ($user->delete()) {
            DB::commit();
            $salida = [
                'resultado' => true,
                'text' => __('general.constants_text.ELIMINAR.SUCCESS'),
            ];
        } else {
            $salida = [
                'resultado' => false,
                'text' => __('general.constants_text.ELIMINAR.ERROR'),
            ];
        }
        return json_encode($salida);
    }

    /**
     * Borramos la imagen de un usuario
     * Se hace mediante un SweetAlert de confirmacion y Ajax, por eso construimos la respues de esa manera,
     * mediante un json, que nos servira para mostrar el mensaje de error o de success
     *
     * @param  int  $id
     * @return json
     */

    public function destroy_imagen($id)
    {
        $user = User::findOrFail($id);
        DB::beginTransaction();
        if ($user->borrar_imagen()) {
            DB::commit();
            $salida = [
                'resultado' => true,
                'text' => __('general.constants_text.ELIMINAR.SUCCESS'),
            ];
        } else {
            $salida = [
                'resultado' => false,
                'text' => __('general.constants_text.ELIMINAR.ERROR'),
            ];
        }
        return json_encode($salida);
    }

    /**
     * Borramos el fichero de un usuario
     * Se hace mediante un SweetAlert de confirmacion y Ajax, por eso construimos la respues de esa manera,
     * mediante un json, que nos servira para mostrar el mensaje de error o de success
     *
     * @param  int  $id
     * @return json
     */

    public function destroy_fichero($id)
    {
        $user = User::findOrFail($id);
        DB::beginTransaction();
        if ($user->borrar_fichero()) {
            DB::commit();
            $salida = [
                'resultado' => true,
                'text' => __('general.constants_text.ELIMINAR.SUCCESS'),
            ];
        } else {
            $salida = [
                'resultado' => false,
                'text' => __('general.constants_text.ELIMINAR.ERROR'),
            ];
        }
        return json_encode($salida);
    }

    /**
     * Funcion que nos sirve para exportar en Excel el listado de Usuarios
     *
     * @param  \App\Http\Requests\User\UpdateFormRequest;
     * @return Maatwebsite\Excel\Excel
     */

    public function exportar()
    {
        $nombre_fichero = __('general.usuarios') . constants('FORMATOS_FICHEROS.EXCEL');
        return Excel::download(new UsersExport(), $nombre_fichero);
    }

    /**
     * Funcion que nos sirve para exportar en PDF los datos de un usuario
     *
     * @param  int  $id;
     */
    public function ficha_user_pdf($id)
    {
        $user = User::find($id);

        $pdf = new Pdf('utf-8');
        $pdf->mirrorMargins(1);
        $pdf->AddPage('P', 10, 10, 10, 10, 8, 2, 'A4');
        $pdf->loadView('Pdf.Users.ficha_user', ['user' => $user]);
        $pdf->download(__('general.ficha') . ' ' . $user->nombre_completo . '.pdf');
    }
}
