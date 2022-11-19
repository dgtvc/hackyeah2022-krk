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
        $this->createCategory('Glass', 'Trash');
        $this->createCategory('Battery', 'Trash');
        $this->createCategory('Electronic', 'Trash');
        $this->createCategory('Medicines', 'Trash');
        $this->createCategory('Glass', 'Recycle');
        $this->createCategory('Battery', 'Recycle');
        $this->createCategory('Electronic', 'Recycle');
    }

    private function createCategory(
        string $name,
        string $type
    ): void {
        Category::factory()->make([
                'name' => $name,
                'type' => $type,
            ]
        )->save();
    }
}
