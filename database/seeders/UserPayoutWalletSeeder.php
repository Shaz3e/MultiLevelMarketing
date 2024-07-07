<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPayoutWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPayoutWallets = [
            'user_id' => 1,
        ];

        DB::table('user_payout_wallets')->insert($userPayoutWallets);
    }
}
