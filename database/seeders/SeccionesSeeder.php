<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('secciones')->insert([
            [
                'id' => 5,
                'titulo' => 'Administración de Usuarios',
                'icono' => 'fas fa-users',
                'accion_usuario' => 'admin',
                'created_at' => Carbon::parse('2025-04-09 19:59:32'),
                'updated_at' => Carbon::parse('2025-04-09 19:59:32'),
            ],
            [
                'id' => 6,
                'titulo' => 'Configuración',
                'icono' => 'fas fa-cog',
                'accion_usuario' => 'admin',
                'created_at' => Carbon::parse('2025-04-11 18:43:25'),
                'updated_at' => Carbon::parse('2025-04-11 18:43:25'),
            ],
            [
                'id' => 7,
                'titulo' => 'Roles y Permisos',
                'icono' => 'fas fa-user-lock',
                'accion_usuario' => 'admin',
                'created_at' => Carbon::parse('2025-04-14 18:42:46'),
                'updated_at' => Carbon::parse('2025-04-14 18:42:46'),
            ],
            [
                'id' => 8,
                'titulo' => 'Seccion',
                'icono' => 'user',
                'accion_usuario' => 'admin4',
                'created_at' => Carbon::parse('2025-05-02 18:21:40'),
                'updated_at' => Carbon::parse('2025-05-02 18:21:40'),
            ],
            [
                'id' => 10,
                'titulo' => 'Administración y Parametrización',
                'icono' => 'fas fa-cogs',
                'accion_usuario' => 'admin4',
                'created_at' => Carbon::parse('2025-05-02 18:38:17'),
                'updated_at' => Carbon::parse('2025-05-02 18:38:17'),
            ],
            [
                'id' => 11,
                'titulo' => 'Inventarios',
                'icono' => 'fas fa-box',
                'accion_usuario' => 'admin',
                'created_at' => Carbon::parse('2025-05-08 06:07:07'),
                'updated_at' => Carbon::parse('2025-05-08 06:07:07'),
            ],
            [
                'id' => 12,
                'titulo' => 'Gestión de Eventos',
                'icono' => 'fas fa-calendar-alt',
                'accion_usuario' => 'admin',
                'created_at' => Carbon::parse('2025-05-08 07:18:53'),
                'updated_at' => Carbon::parse('2025-05-08 07:18:53'),
            ],
            [
                'id' => 13,
                'titulo' => 'administracion imagenes',
                'icono' => 'fas fa-images',
                'accion_usuario' => 'admin',
                'created_at' => Carbon::parse('2025-05-13 07:11:13'),
                'updated_at' => Carbon::parse('2025-05-13 07:11:13'),
            ],
        ]);
    }
}
