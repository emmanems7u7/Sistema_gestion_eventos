<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Equipos electronicos',
                'descripcion' => 'Equipos electronicos',
                'estado' => 1,
                'created_at' => Carbon::parse('2025-05-09 23:57:26'),
                'updated_at' => Carbon::parse('2025-05-09 23:57:26'),
            ],
            [
                'nombre' => 'Personal',
                'descripcion' => 'personal',
                'estado' => 1,
                'created_at' => Carbon::parse('2025-05-10 00:15:03'),
                'updated_at' => Carbon::parse('2025-05-10 00:15:03'),
            ],
        ]);
    }
}
