<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['name' => 'Alta'],
            ['name' => 'Media'],
            ['name' => 'Baja'],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}
