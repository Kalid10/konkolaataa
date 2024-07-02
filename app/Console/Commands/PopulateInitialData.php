<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\InitialDataPopulatorHelper;

class PopulateInitialData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-initial-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate initial data for the application.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        InitialDataPopulatorHelper::createColors();
        $this->info('Colors created successfully.');

        InitialDataPopulatorHelper::generateCarBodyTypes();
        $this->info('Car body types generated successfully.');

        InitialDataPopulatorHelper::generateCarBrandsAndModels();
        $this->info('Car brands and models generated successfully.');

        InitialDataPopulatorHelper::generateEngineTypes();
        $this->info('Engine types generated successfully.');

        InitialDataPopulatorHelper::generateCarConditionTypes();
        $this->info('Car condition types generated successfully.');

        InitialDataPopulatorHelper::generateFuelTypes();
        $this->info('Fuel types generated successfully.');

        InitialDataPopulatorHelper::generateCities();
        $this->info('Cities generated successfully.');
    }
}
