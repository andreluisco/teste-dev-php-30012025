<?php

namespace Database\Seeders\Enderecos;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class EnderecoEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Load JSON data from a local file
        $json    = File::get('database/data/estados-brasileiros.json');
        $estados = json_decode($json, true)['UF'];

        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate the table
        DB::table('endereco_estados')
          ->truncate();

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        // Insert data into the database
        foreach ($estados as $estado) {
            DB::table('endereco_estados')
              ->insert([
                  'estado' => $estado['nome'],
                  'uf'     => $estado['sigla'],
              ]);
        }
    }
}
