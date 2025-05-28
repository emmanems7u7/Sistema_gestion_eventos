<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoServicioSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo__servicios')->insert([
            [
                'inventario_id' => 19,
                'categoria_id' => 2,
                'servicio_id' => 1,
                'tipo' => 'básica',
                'caracteristicas' => 'Equipo de 2 camarografos con camaras profesionales',
                'precio' => 100.00,
                'cantidad_personal' => 2,
                'cantidad_equipo' => 2,
                'created_at' => Carbon::parse('2025-05-09 23:39:46'),
                'updated_at' => Carbon::parse('2025-05-19 02:40:09'),
                'catalogo_id' => 'E003',
            ],
            [
                'inventario_id' => 1,
                'categoria_id' => 2,
                'servicio_id' => 1,
                'tipo' => 'Alta',
                'caracteristicas' => 'Equipo de 4 camaras profesionales',
                'precio' => 150.00,
                'cantidad_personal' => 4,
                'cantidad_equipo' => 4,
                'created_at' => Carbon::parse('2025-05-09 23:41:40'),
                'updated_at' => Carbon::parse('2025-05-19 02:40:18'),
                'catalogo_id' => 'E003',
            ],
            [
                'inventario_id' => 59,
                'categoria_id' => 2,
                'servicio_id' => 2,
                'tipo' => 'Basica',
                'caracteristicas' => 'Equipo de 2 guardias de seguridad con equipo completo',
                'precio' => 100.00,
                'cantidad_personal' => 2,
                'cantidad_equipo' => 0,
                'created_at' => Carbon::parse('2025-05-09 23:52:10'),
                'updated_at' => Carbon::parse('2025-05-19 02:48:18'),
                'catalogo_id' => 'P-001',
            ],
            [
                'inventario_id' => 20,
                'categoria_id' => 1,
                'servicio_id' => 1,
                'tipo' => 'Premium',
                'caracteristicas' => 'Equipo de 5 camarografos',
                'precio' => 300.00,
                'cantidad_personal' => 5,
                'cantidad_equipo' => 5,
                'created_at' => Carbon::parse('2025-05-10 00:41:49'),
                'updated_at' => Carbon::parse('2025-05-19 02:41:16'),
                'catalogo_id' => 'E-001',
            ],
            [
                'inventario_id' => null,
                'categoria_id' => 2,
                'servicio_id' => 6,
                'tipo' => 'Basica',
                'caracteristicas' => 'Equipo de 3 personas encargadas de la limpieza durante el evento',
                'precio' => 300.00,
                'cantidad_personal' => 3,
                'cantidad_equipo' => 3,
                'created_at' => Carbon::parse('2025-05-19 21:00:47'),
                'updated_at' => Carbon::parse('2025-05-19 21:00:47'),
                'catalogo_id' => 'E-0002',
            ],
            [
                'inventario_id' => null,
                'categoria_id' => 2,
                'servicio_id' => 6,
                'tipo' => 'dfg',
                'caracteristicas' => 'dfgdf',
                'precio' => 4.00,
                'cantidad_personal' => 34,
                'cantidad_equipo' => 34,
                'created_at' => Carbon::parse('2025-05-19 21:01:09'),
                'updated_at' => Carbon::parse('2025-05-19 21:01:09'),
                'catalogo_id' => 'P-001',
            ],
        ]);
    }
}
