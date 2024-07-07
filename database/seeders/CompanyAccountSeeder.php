<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyAccounts = [
            [
                'name' => 'Main Account',
                'starting_balance' => 0.00, // 50% of the PIN Generation
            ],
            [
                'name' => 'Main Networking Account',
                'starting_balance' => 1000000, // This will be using for PIN Generation
            ],
            [
                'name' => 'SST Account',
                'starting_balance' => 0.00, // Transfer SST
            ],
            [
                'name' => 'Commission Networking Account',
                'starting_balance' => 0.00,  // 50% of the PIN Generation
            ],
            [
                'name' => 'Farhan Arif Networking Account',
                'starting_balance' => 0,
            ],
        ];

        DB::table('company_accounts')->insert($companyAccounts);
    }
}
