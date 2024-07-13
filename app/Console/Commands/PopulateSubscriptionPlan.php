<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscriptionPlan;

class PopulateSubscriptionPlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-subscription-plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate subscription plans into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $plans = [
            [
                'title' => 'Starter',
                'description' => 'Ideal for small brokers',
                'interval' => 'monthly',
                'amount' => 2000.00,
                'currency' => 'ETB',
                'features' => json_encode([
                    'Up to 5 posts per month',
                    'Basic Analytics',
                    'Broker Profile Page'
                ]),
                'duration_in_days' => 30,
                'max_posts' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Business',
                'description' => 'Ideal for growing brokers',
                'interval' => 'monthly',
                'amount' => 5000.00,
                'currency' => 'ETB',
                'features' => json_encode([
                    'Up to 15 posts per month',
                    'Detailed Analytics',
                    'Featured Broker Status',
                    'Priority Support'
                ]),
                'duration_in_days' => 30,
                'max_posts' => 15,
                'is_active' => true
            ],
            [
                'title' => 'Enterprise',
                'description' => 'Ideal for large brokers',
                'interval' => 'monthly',
                'amount' => 10000.00,
                'currency' => 'ETB',
                'features' => json_encode([
                    'Unlimited posts per month',
                    'Comprehensive Analytics',
                    'Priority Placement in Search Results',
                    'Custom Promotional Campaigns',
                    'Dedicated Support'
                ]),
                'duration_in_days' => 30,
                'max_posts' => 100,
                'is_active' => true
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }

        $this->info('Subscription plans have been populated successfully.');
    }
}
