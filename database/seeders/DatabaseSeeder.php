<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            "name"=> "Kenyo Solis",
            "email"=> "kenyosolt@gmail.com",
            "password"=> Hash::make("12345678")
        ]);

        User::create([
            "name"=> "Kiara",
            "email"=> "kiara@gmail.com",
            "password"=> Hash::make("12345678")
        ]);

        Categoria::create(["nombre" => "Alimentación", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Transporte", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Vivienda", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Salud", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Educación", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Entretenimiento", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Ropa", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Viajes", "tipo" => "Gasto"]);
        Categoria::create(["nombre" => "Ahorros", "tipo" => "Ingreso"]);
        Categoria::create(["nombre" => "Salario", "tipo" => "Ingreso"]);
        Categoria::create(["nombre" => "Freelance", "tipo" => "Ingreso"]);
        Categoria::create(["nombre" => "Inversiones", "tipo" => "Ingreso"]);
        Categoria::create(["nombre" => "Regalos", "tipo" => "Ingreso"]);
        Categoria::create(["nombre" => "Venta de bienes", "tipo" => "Ingreso"]);

    }
}
