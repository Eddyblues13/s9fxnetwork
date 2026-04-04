<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentPlan;

class InvestmentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default investment plans
        $plans = [
            [
                'name' => 'BASIC PACKAGE',
                'min_deposit' => 20.00,
                'max_deposit' => 499.00,
                'percentage' => 5.00,
                'duration' => '24 Hours',
            ],
            [
                'name' => 'SUPER PACKAGE',
                'min_deposit' => 500.00,
                'max_deposit' => 3999.00,
                'percentage' => 15.00,
                'duration' => '24 Hours',
            ],
            [
                'name' => 'STANDARD PACKAGE',
                'min_deposit' => 4000.00,
                'max_deposit' => 5999.00,
                'percentage' => 20.00,
                'duration' => '24 Hours',
            ],
            [
                'name' => 'EXPERT PACKAGE',
                'min_deposit' => 6000.00,
                'max_deposit' => 100000.00,
                'percentage' => 30.00,
                'duration' => '24 Hours',
            ],
        ];

        // Insert the plans into the database
        foreach ($plans as $plan) {
            InvestmentPlan::create($plan);
        }
    }
}
