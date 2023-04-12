<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    use Exportable;

    public function collection()
    {
        $users = User::all();

        $export = array();
        foreach ($users as $key => $user) {
            $export[$key]['user'] = $user->nombre;
            $export[$key]['apellidos'] = $user->apellidos;
            $export[$key]['email'] = $user->email;
            $export[$key]['fecha_nacimiento'] = $user->fecha_nacimiento_formateada;
            $export[$key]['roles'] = $user->getRoleNames()->implode(', ');
        }
        return collect($export);
    }

    public function headings(): array
    {
        return [
            __('general.nombre'),
            __('general.apellidos'),
            __('general.email'),
            __('general.fecha_nacimiento'),
            __('general.roles'),
        ];
    }

    public function title(): string
    {
        return __('general.usuarios');
    }
}
