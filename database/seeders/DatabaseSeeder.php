<?php

namespace Database\Seeders;

use App\Models\LogicalComponent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create user
        User::factory()->create([
            'email' => 'msimakov661@gmail.com',
            'password' => Hash::make('password')
        ]);

        // create logical components
        $logical_components = [
            'And' => 'И',
            'Or' => 'ИЛИ',
            'Not' => 'НЕ'
        ];

        foreach ($logical_components as $slug => $name) {
            LogicalComponent::create([
                'slug' => $slug,
                'name' => $name
            ]);
        }
    }
}
