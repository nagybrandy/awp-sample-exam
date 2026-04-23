<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(PlantSeeder::class);

        $user = User::query()->where('email', 'test@example.com')->first();
        $plant = Plant::query()->first();
        if ($user && $plant) {
            $user->tendedPlants()->syncWithoutDetaching([$plant->id]);
        }
    }
}
