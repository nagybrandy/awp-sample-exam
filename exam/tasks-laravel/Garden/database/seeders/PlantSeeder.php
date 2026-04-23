<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::query()->orderBy('id')->value('id');

        $rows = [
            ['name' => 'Cherry tomato', 'spot' => 'Herb box A, south side', 'care_note' => 'Water every morning'],
            ['name' => 'Rose', 'spot' => 'By the fence, east corner', 'care_note' => 'Prune in spring'],
            ['name' => 'Basil', 'spot' => 'Kitchen window sill', 'care_note' => 'Pinch flowers to keep leaves'],
            ['name' => 'Lavender', 'spot' => 'Front bed, full sun', 'care_note' => 'Well-drained soil'],
        ];

        foreach ($rows as $row) {
            Plant::query()->create([...$row, 'user_id' => $userId]);
        }
    }
}
