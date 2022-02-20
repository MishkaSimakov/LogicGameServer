<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\LevelTransput;
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
            'name' => 'Simakov Mikhail',
            'email' => 'msimakov661@gmail.com',
            'password' => Hash::make('password')
        ]);

        // create logical components
        $logical_components = ['И', 'ИЛИ', 'НЕ'];

        foreach ($logical_components as $logical_component) {
            LogicalComponent::create([
                'name' => $logical_component
            ]);
        }
    }
}
