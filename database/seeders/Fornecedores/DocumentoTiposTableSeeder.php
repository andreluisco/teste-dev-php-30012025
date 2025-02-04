<?php


namespace Database\Seeders\Fornecedores;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder para a tabela documento_tipos.
 *
 * Este seeder insere os tipos de documento (ex.: CPF e CNPJ) na tabela,
 * permitindo que a aplicação tenha os dados iniciais necessários para o cadastro.
 */
class DocumentoTiposTableSeeder extends Seeder
{
    /**
     * Executa o seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documento_tipos')
          ->insert([
              [
                  'tipo' => 'CPF',
              ],
              [
                  'tipo' => 'CNPJ',
              ],
          ]);
    }
}
