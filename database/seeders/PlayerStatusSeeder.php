<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        DB::table('player_statuses')->insert([
            0 => [
                'id'            => 1,
                'description'   => 'aktiv',
                'can_play'      => 1,
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            1 => [
                'id'            => 2,
                'description'   => 'passiv',
                'can_play'      => 1,
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            2 => [
                'id'            => 3,
                'description'   => 'verletzt',
                'can_play'      => 0,
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
            3 => [
                'id'            => 4,
                'description'   => 'abwesend',
                'can_play'      => 0,
                'created_at'    => $timestamp,
                'updated_at'    => $timestamp,
            ],
        ]);
    }
}
