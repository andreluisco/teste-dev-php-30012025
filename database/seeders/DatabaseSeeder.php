<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Fornecedores\DocumentoTiposTableSeeder;
use Database\Seeders\Enderecos\EnderecoEstadosSeeder;
use Database\Seeders\Logs\LogStatusTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Endereço
            EnderecoEstadosSeeder::class,

            // Fornecedores
            DocumentoTiposTableSeeder::class,

            // Logs
            LogStatusTableSeeder::class
        ]);
    }
}
