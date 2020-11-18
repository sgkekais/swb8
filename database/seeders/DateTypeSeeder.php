<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        DB::table('date_types')->insert([
            0 => [
                'id'            => 1,
                'description'   => 'Allg. Umfrage',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            1 => [
                'id'            => 2,
                'description'   => 'Spiel',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            2 => [
                'id'            => 3,
                'description'   => 'Turnier',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            3 => [
                'id'            => 4,
                'description'   => 'Feier',
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
        ]);
    }
}
