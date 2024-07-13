<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OnetimePlan;

class PopulateOnetimePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-onetime-plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate one-time plans into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $plans = [
            [
                'title' => 'Start',
                'description' => 'Ideal for personal car sale',
                'amount' => 500.00,
                'currency' => 'ETB',
                'features' => json_encode([
                    '40 days post on Konkolata',
                    'Post Analytics'
                ]),
                'validity_days' => 40,
                'max_posts' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Pro',
                'description' => 'Ideal for personal car sale',
                'amount' => 1500.00,
                'currency' => 'ETB',
                'features' => json_encode([
                    '50 days post on Konkolata',
                    '10 Days Smart Featured Post',
                    'Post Analytics',
                    '2 Free Reposts'
                ]),
                'validity_days' => 50,
                'max_posts' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Enterprise',
                'description' => 'Ideal for personal car sale',
                'amount' => 3500.00,
                'currency' => 'ETB',
                'features' => json_encode([
                    '60 days post on Konkolata',
                    '20 Days Smart Featured Post',
                    '2 days Pinned Post',
                    'Post Analytics',
                    '7 Free Reposts'
                ]),
                'validity_days' => 60,
                'max_posts' => 1,
                'is_active' => true
            ],
        ];

        foreach ($plans as $plan) {
            OnetimePlan::create($plan);
        }

        $this->info('One-time plans have been populated successfully.');
    }
}
