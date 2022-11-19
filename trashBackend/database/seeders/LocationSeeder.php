<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\RecycleType;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = RecycleType::all();

        for ($i = 0; $i < 10; $i++) {
            Location::factory()
                ->create([
                    RecycleType::RELATION_STRING => $types->random()->getKey(),
                ]);
        }
    }
}
