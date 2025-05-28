<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('servicios')->insert([
            [
                'inventario_id' => 1,
                'role_id' => 4,
                'nombre' => 'Camarografos',
                'descripcion' => 'Servicio de camaras',
                'imagen' => 'servicios/OEeU9dN0lWrcLpm8SQbAUIatLpnSjoOIZEvYKGk6.jpg',
                'created_at' => Carbon::parse('2025-05-09 23:18:42'),
                'updated_at' => Carbon::parse('2025-05-18 19:06:10'),
            ],
            [
                'inventario_id' => null,
                'role_id' => 5,
                'nombre' => 'Seguridad',
                'descripcion' => 'Servicios de seguridad',
                'imagen' => 'servicios/szkwwN1wkMuOf4Y1tuKCHP0hy577tdwTCxMH2YHu.png',
                'created_at' => Carbon::parse('2025-05-09 23:51:39'),
                'updated_at' => Carbon::parse('2025-05-18 18:27:06'),
            ],
            [
                'inventario_id' => null,
                'role_id' => null,
                'nombre' => 'Limpieza',
                'descripcion' => 'Servicio de limpieza para eventos',
                'imagen' => 'servicios/66rc8Yv9jcWWomxBZluc6agln8RcJqqp2DSfLHpQ.png',
                'created_at' => Carbon::parse('2025-05-19 20:50:05'),
                'updated_at' => Carbon::parse('2025-05-19 20:50:05'),
            ],
        ]);
    }
}
