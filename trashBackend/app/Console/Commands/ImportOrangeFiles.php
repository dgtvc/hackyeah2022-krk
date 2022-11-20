<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\CategoryLocation;
use App\Models\Location;
use App\Models\RecycleType;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ImportOrangeFiles extends Command
{
    protected $signature = 'import:orange';

    protected $description = 'Import orange files';

    private Model $recycleType;
    private Collection $trashCategories;

    private int $count = 0;

    public function handle(): int
    {
        $this->trashCategories = Category::query()->whereIn('name', [
            'Router',
            'Telephone',
        ])->get();

        $this->recycleType = RecycleType::query()->where('name', 'Recycle')->firstOrFail();

        $files = Storage::disk('local')->allFiles('orange');

        foreach ($files as $file) {
            $this->parse($file);
        }

        $this->info('Counted: ' . $this->count);

        return Command::SUCCESS;
    }

    private function parse(string $file)
    {
        $data = json_decode(Storage::disk('local')->get($file));

        foreach ($data as $location) {
            $this->importLocation($location);
        }
    }

    private function importLocation(stdClass $location)
    {
        $model = Location::query()->updateOrCreate([
            'title' => $location->name,
            'address' => implode('; ', $location->formatted_address),
            'lat' => $location->_geoloc->lat,
            'lng' => $location->_geoloc->lng,
        ], [
            'description' => $this->buildHours($location->formatted_opening_hours),
            RecycleType::RELATION_STRING => $this->recycleType->getKey(),
        ]);

        $model->categories()->detach();

        $this->trashCategories->each(fn (Category $category) => CategoryLocation::create([
            Category::RELATION_STRING => $category->getKey(),
            Location::RELATION_STRING => $model->getKey(),
        ]));

        $this->count++;
    }

    private function buildHours($openingHours): string
    {
        $text = '<ul>' . PHP_EOL;

        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday",];

        for ($i = 0; $i < 7; $i++) {
            $text .= "<li>" . PHP_EOL;
            $text .= substr($days[$i], 0, 3) .': ';
            $text .= implode(';', $openingHours->{mb_strtolower($days[$i])});
            $text .= "</li>" . PHP_EOL;
        }

        $text .= '</ul>';

        return $text;
    }
}
