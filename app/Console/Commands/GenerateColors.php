<?php

namespace App\Console\Commands;

use App\Models\Color;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class GenerateColors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-colors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate colors';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Add colors to the database
        $colors = collect([
            ['name' => 'Red', 'hex' => '#FF0000'],
            ['name' => 'Green', 'hex' => '#00FF00'],
            ['name' => 'Blue', 'hex' => '#0000FF'],
            ['name' => 'Yellow', 'hex' => '#FFFF00'],
            ['name' => 'Purple', 'hex' => '#800080'],
            ['name' => 'Orange', 'hex' => '#FFA500'],
            ['name' => 'Pink', 'hex' => '#FFC0CB'],
            ['name' => 'Brown', 'hex' => '#A52A2A'],
            ['name' => 'Black', 'hex' => '#000000'],
            ['name' => 'White', 'hex' => '#FFFFFF'],
        ]);

        $colors->each(function ($color) {
            Color::create($color);
        });

        $this->info('Colors added to the database');
    }
}
