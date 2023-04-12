<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Rol\CreateFormRequest as RolCreateFormRequest;
use App\Http\Requests\Rol\UpdateFormRequest as RolUpdateFormRequest;

class PermissionController extends Controller
{
    public function index()
    {
        return view('Permisos.index', [
            'roles' => Rol::all()
        ]);
    }

    public function create_rol()
    {
        return view('Permisos.create_rol');
    }

    public function store_rol(RolCreateFormRequest $request)
    {
        DB::beginTransaction();
        $rol = new Rol();
        if ($rol->guardar($request->all())) {
            DB::commit();

            return redirect()
                ->route('gestion_permisos.edit_rol_permission', $rol->id)
                ->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }

    public function edit_rol($id)
    {
        return view('Permisos.edit_rol', [
            'rol' => Rol::findOrFail($id),
        ]);
    }

    public function update_rol(RolUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        $rol = Rol::findOrFail($id);
        if ($rol->guardar($request->all())) {
            DB::commit();

            return redirect()->route('gestion_permisos.index')->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }

    public function edit_rol_permission($id)
    {
        $rol = Rol::findOrFail($id);

        return view('Permisos.edit_rol_permission', [
            'rol' => $rol,
            'permisos' => Permission::orderBy('orden')->get(),
            'permisos_rol' => $rol->permissions
        ]);
    }

    public function update_rol_permission(Request $request, $id)
    {
        DB::beginTransaction();
        $role = Rol::findOrFail($id);
        if ($role->guardar_permisos($request)) {
            DB::commit();

            return redirect()->route('gestion_permisos.index')->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }


    public function edit_user_permission($id)
    {
        $user = User::findOrFail($id);
        $permisos = Permission::orderBy('orden')->get();

        return view('Permisos.edit_user_permission', [
            'user' => $user,
            'permisos' => $permisos,
            'permisos_user_from_rol' => $user->getPermissionsViaRoles(),
            'permisos_user_directos' => $user->getDirectPermissions()
        ]);
    }

    public function update_user_permission(Request $request, $id)
    {
        DB::beginTransaction();
        $user = User::findOrFail($id);
        if ($user->guardar_permisos_user($request->permisos)) {
            DB::commit();

            return redirect()->route('users.index')->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }

    public function edit_user_rol($id)
    {
        $user = User::findOrFail($id);
        $roles = Rol::all();

        return view('Permisos.edit_user_rol', [
            'user' => $user,
            'roles' => $roles,
            'roles_user' => $user->getRoleNames()
        ]);
    }

    public function update_user_rol(Request $request, $id)
    {
        DB::beginTransaction();
        $user = User::findOrFail($id);
        if ($user->guardar_roles_user($request->roles)) {
            DB::commit();

            return redirect()->route('users.index')->with('success', __('general.constants_text.SUCCESS'));
        }

        return back()->withInput()->with('error', __('general.constants_text.ERROR'));
    }
}
