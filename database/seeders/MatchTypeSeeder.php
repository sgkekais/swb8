<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        DB::table('match_types')->insert([
            0 => [
                'id'            => 1,
                'description'   => 'Freundschaftsspiel',
                'description_short' => 'F',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            1 => [
                'id'            => 2,
                'description'   => 'Meisterschaft',
                'description_short' => 'M',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            2 => [
                'id'            => 3,
                'description'   => 'Pokal',
                'description_short' => 'P',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
        ]);
    }
}
