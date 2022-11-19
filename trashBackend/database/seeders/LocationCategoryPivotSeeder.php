<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LocationCategoryPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = Location::all('uuid');
        $categories = Category::all('uuid');
        $toInsert = new Collection([]);

        foreach ($locations as $location) {
            foreach (range(1, rand(1, 4)) as $i) {
                $toInsert->add([
                    'location_uuid' => $location->uuid,
                    'category_uuid' => $categories->random()->uuid,
                ]);
            }
        }

        DB::table('category_location')->insertOrIgnore($toInsert->toArray());
    }
}
