<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrador',      'description' => 'Acceso total al sistema'],
            ['name' => 'Agricultor',         'description' => 'Trabaj en fincas, gestiona todo el ciclo productivo de su finca'],
            ['name' => 'Trabajador',         'description' => 'Registra insumos y gastos en la finca en que trabaja']
        ];

        foreach ($roles as $rol) {
            Role::create($rol);
        }
    }
}
