<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456'),                
            'role'     => 1,
            'status'   => 1,
        ]);

        DB::table('seat_types')->insert([
            [
                'name'     => 'Business Seat',
                'price'    => 200,
            ],
            [
                'name'     => 'Economy Seat',
                'price'    => 150,
            ],
        ]);
        DB::table('price_by_counts')->insert([
            [
                'seat_count'   => '1 - 10 Seats',
                'percentage'   => 0,
                'seat_type_id' => 1,
            ],
            [
                'seat_count'   => '11 - 20 Seats',
                'percentage'   => 15,
                'seat_type_id' => 1,
            ],
            [
                'seat_count'   => '21 - 30 Seats',
                'percentage'   => 25,
                'seat_type_id' => 1,
            ],
            [
                'seat_count'   => '1 - 40 Seats',
                'percentage'   => 0,
                'seat_type_id' => 2,
            ],
            [
                'seat_count'   => '41 - 90 Seats',
                'percentage'   => 10,
                'seat_type_id' => 2,
            ],
            [
                'seat_count'   => '91 - 140 Seats',
                'percentage'   => 15,
                'seat_type_id' => 2,
            ],
            [
                'seat_count'   => '141 - 190 Seats',
                'percentage'   => 20,
                'seat_type_id' => 2,
            ],

        ]);
        
        DB::table('price_by_dates')->insert([
            [
                'seat_date'   => '10 days',
                'percentage'   => 5,
            ],
            [
                'seat_date'   => '9 days',
                'percentage'   => 7,
            ],
            [
                'seat_date'   => '8 days',
                'percentage'   => 9,
            ],
            [
                'seat_date'   => '7 days',
                'percentage'   => 10,
            ],
            [
                'seat_date'   => '6 days',
                'percentage'   => 12,
            ],
            [
                'seat_date'   => '5 days',
                'percentage'   => 14,
            ],
            [
                'seat_date'   => '4 days',
                'percentage'   => 16,
            ],
            [
                'seat_date'   => '1-3 days',
                'percentage'   => 25,
            ],
        ]);
    }
}