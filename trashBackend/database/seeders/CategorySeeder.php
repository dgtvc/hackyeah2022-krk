<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategory('Glass');
        $this->createCategory('Battery');
        $this->createCategory('Electronic');
        $this->createCategory('Router');
        $this->createCategory('Telephone');
        $this->createCategory('Medicines');
    }

    private function createCategory(
        string $name,
    ): void {
        Category::factory()->make(
            [
                'name' => $name,
            ]
        )->save();
    }
}
