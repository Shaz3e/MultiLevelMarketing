<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rankings = [
            [
                'level' => 1,
                'name' => 'Team Leader',
                'reward' => 'Tablet',
                'bonus_point' => 1500
            ],
            [
                'level' => 2,
                'name' => 'Team Manager',
                'reward' => 'Mobile Phone',
                'bonus_point' => 2500
            ],
            [
                'level' => 3,
                'name' => 'Senior Manager',
                'reward' => 'Laptop',
                'bonus_point' => 5000
            ],
            [
                'level' => 4,
                'name' => 'Regional Manager',
                'reward' => 'Bike',
                'bonus_point' => 10000
            ],
            [
                'level' => 5,
                'name' => 'Senior Director',
                'reward' => 'Special Gifts / 0.5 Million Almost',
                'bonus_point' => 50000
            ],
            [
                'level' => 6,
                'name' => 'Director',
                'reward' => 'Gold Biscuit',
                'bonus_point' => 100000
            ],
            [
                'level' => 7,
                'name' => 'Regional President',
                'reward' => 'Car',
                'bonus_point' => 300000
            ],
            [
                'level' => 8,
                'name' => 'President',
                'reward' => 'Flat',
                'bonus_point' => 500000
            ],
            [
                'level' => 9,
                'name' => 'Global Ambassador',
                'reward' => 'Become a Business Partner',
                'bonus_point' => 1000000
            ],
        ];

        DB::table('rankings')->insert($rankings);
    }
}
