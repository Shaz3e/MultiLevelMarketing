<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userWallet = [
            'user_id' => 1,
            'created_at' => now(),
        ];

        DB::table('user_wallets')->insert($userWallet);
    }
}
