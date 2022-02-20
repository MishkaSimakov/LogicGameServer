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

        // create levels
        Level::factory()->count(10)
            ->hasTransputs(5, [
                'type' => Level::INPUT
            ])
            ->hasTransputs(5, [
                'type' => Level::OUTPUT
            ])
            ->create()
            ->each(function (Level $level) {
                $level->allowedComponents()->saveMany(LogicalComponent::inRandomOrder()->take(2)->get());
            });
    }
}
