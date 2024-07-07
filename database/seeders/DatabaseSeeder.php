<?php

namespace Database\Seeders;

use App\Models\KnowledgebaseArticle;
use App\Models\User;
use App\Models\UserPayoutWallet;
use Database\Factories\KnowledgebaseArticleFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1000)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            SupportTicketProiritySeeder::class,
            SupportTicketStatusSeeder::class,
            TaskLabelSeeder::class,
            TodoLabelSeeder::class,
            CompanyAccountSeeder::class,

            // Local,
            // CompanySeeder::class,
            // DepartmentSeeder::class,
            UserSeeder::class,
            UserKycSeeder::class,
            UserPayoutWalletSeeder::class,
            UserWalletSeeder::class,
            // KnowledgebaseCategorySeeder::class,
            RankingSeeder::class,
            CurrencySeeder::class,

            AppSettingSeeder::class,

            // Run this seeder at the end
            RolePermissionSeeder::class,
        ]);
    }
}
