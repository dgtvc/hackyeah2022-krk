<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportOrangeFiles extends Command
{
    protected $signature = 'import:orange';

    protected $description = 'Import orange files';

    public function handle(): int
    {
//        $this->

        $files = Storage::disk('local')->allFiles('orange');

        foreach ($files as $file) {
            $this->parse($file);
        }

        return Command::SUCCESS;
    }

    private function parse(string $file)
    {
        $data = json_decode(Storage::disk('local')->get($file));

        foreach ($data as $location) {
            $this->importLocation($location);
        }
    }

    private function importLocation(mixed $location)
    {
//        Location
    }
}
