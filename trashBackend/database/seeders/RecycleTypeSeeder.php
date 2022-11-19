<?php

namespace Database\Seeders;

use App\Models\RecycleType;
use Illuminate\Database\Seeder;

class RecycleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategory('Repair');
        $this->createCategory('Recycle');
    }

    private function createCategory(
        string $name,
    ): void {
        RecycleType::factory()->make(
            [
                'name' => $name,
            ]
        )->save();
    }
}
