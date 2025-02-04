<?php


namespace Database\Seeders\Logs;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder para a tabela log_status.
 *
 * Este seeder insere os status iniciais (pending, success e failed) na tabela,
 * os quais serão utilizados para rastrear o processo de importação de dados.
 */
class LogStatusTableSeeder extends Seeder
{
    /**
     * Executa o seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('log_status')
          ->insert([
              ['status' => 'pending'],
              ['status' => 'success'],
              ['status' => 'failed'],
          ]);
    }
}
