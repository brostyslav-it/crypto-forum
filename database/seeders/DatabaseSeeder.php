<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'avatar' => 'avatars/default.png',
            'password' => env('ADMIN_PASSWORD'),
            'is_admin' => true,
        ]);

        Category::create(['name' => 'Bitcoin']);
        Category::create(['name' => 'Ethereum']);
        Category::create(['name' => 'Blockchain']);
        Category::create(['name' => 'DeFi (Decentralized Finance)']);
        Category::create(['name' => 'NFTs (Non-Fungible Tokens)']);
        Category::create(['name' => 'Smart Contracts']);
        Category::create(['name' => 'Mining']);
        Category::create(['name' => 'Wallets']);
        Category::create(['name' => 'Crypto Exchanges']);
        Category::create(['name' => 'Staking']);
    }
}
