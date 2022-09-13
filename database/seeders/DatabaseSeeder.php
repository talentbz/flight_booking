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
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('123456'),                
                'role'     => 1,
                'status'   => 1,
            ],
            [
                'name'     => 'User1',
                'email'    => 'user1@gmail.com',
                'password' => Hash::make('123456'),                
                'role'     => 2,
                'status'   => 1,
            ],
            [
                'name'     => 'User2',
                'email'    => 'user2@gmail.com',
                'password' => Hash::make('123456'),                
                'role'     => 2,
                'status'   => 1,
            ],
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
                'min_count'    => 1,
                'max_count'    => 10,
                'seat_type_id' => 1,
            ],
            [
                'seat_count'   => '11 - 20 Seats',
                'percentage'   => 15,
                'min_count'    => 11,
                'max_count'    => 20,
                'seat_type_id' => 1,
            ],
            [
                'seat_count'   => '21 - 30 Seats',
                'percentage'   => 25,
                'min_count'    => 21,
                'max_count'    => 30,
                'seat_type_id' => 1,
            ],
            [
                'seat_count'   => '1 - 40 Seats',
                'percentage'   => 0,
                'min_count'    => 1,
                'max_count'    => 40,
                'seat_type_id' => 2,
            ],
            [
                'seat_count'   => '41 - 90 Seats',
                'percentage'   => 10,
                'min_count'    => 41,
                'max_count'    => 90,
                'seat_type_id' => 2,
            ],
            [
                'seat_count'   => '91 - 140 Seats',
                'percentage'   => 15,
                'min_count'    => 91,
                'max_count'    => 140,
                'seat_type_id' => 2,
            ],
            [
                'seat_count'   => '141 - 190 Seats',
                'percentage'   => 20,
                'min_count'    => 141,
                'max_count'    => 190,
                'seat_type_id' => 2,
            ],

        ]);
        
        DB::table('price_by_dates')->insert([
            [
                'seat_date'   => '10 days',
                'percentage'  => 5,
                'date'        => 10,
            ],
            [
                'seat_date'   => '9 days',
                'percentage'  => 7,
                'date'        => 9,
            ],
            [
                'seat_date'   => '8 days',
                'percentage'  => 9,
                'date'        => 8,
            ],
            [
                'seat_date'   => '7 days',
                'percentage'  => 10,
                'date'        => 7,
            ],
            [
                'seat_date'   => '6 days',
                'percentage'  => 12,
                'date'        => 6,
            ],
            [
                'seat_date'   => '5 days',
                'percentage'  => 14,
                'date'        => 5,
            ],
            [
                'seat_date'   => '4 days',
                'percentage'  => 16,
                'date'        => 4,
            ],
            [
                'seat_date'   => '3 days',
                'percentage'  => 25,
                'date'        => 3,
            ],
            [
                'seat_date'   => '2 days',
                'percentage'  => 25,
                'date'        => 2,
            ],
            [
                'seat_date'   => '1 days',
                'percentage'  => 25,
                'date'        => 1,
            ],
        ]);
        DB::table('air_lines')->insert([
            [
                'name'    => 'ACC - LHR',
                'status'  => 1,
            ],
            [
                'name'    => 'ACR - JFK',
                'status'  => 1,
            ],
        ]);
        DB::table('baggage')->insert([
            [
                'price'    => 45,
                'weight'  => 23,
            ],
        ]);
    }
}
