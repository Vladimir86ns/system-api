<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanyCategoriesTableCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LIVORNO
        $categories = [
            'Pizza',
            'Burgers',
            'Sandwich',
            'Pancake',
            'Drinks'
        ];

        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::LIVORNO)->first();

        foreach ($categories as $category) {
            $company->productCategories()->create(
                ['name' => $category]
            );
        }

        // PIZZA_BELISSIMO
        $categories = [
            'Pizza',
            'Burgers',
            'Sandwich',
            'Pancake',
            'Drinks'
        ];

        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::PIZZA_BELISSIMO)->first();

        foreach ($categories as $category) {
            $company->productCategories()->create(
                ['name' => $category]
            );
        }

        // CAFFE_CASTELLO
        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::CAFFE_CASTELLO)->first();
        $company->productCategories()->create(
            ['name' => 'Drinks']
        );

        // AKA_PEKARA
        $categories = [
            'Milks',
            'Products',
        ];

        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::AKA_PEKARA)->first();

        foreach ($categories as $category) {
            $company->productCategories()->create(
                ['name' => $category]
            );
        }

        // POMODORINO
        $categories = [
            'Daily Action',
            'Burgers',
            'Sandwich',
            'Special Sandwich',
            'Breakfast',
            'Salat',
            'Desert',
            'Drinks',
        ];

        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::POMODORINO)->first();

        foreach ($categories as $category) {
            $company->productCategories()->create(
                ['name' => $category]
            );
        }

        // DIZNI
        $categories = [
            'Pancakes',
            'Drinks',
            'Pizza'
        ];

        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::DIZNI)->first();

        foreach ($categories as $category) {
            $company->productCategories()->create(
                ['name' => $category]
            );
        }

        // THE_PUB
        $categories = [
            'Breakfast',
            'Drinks',
            'Pizza',
            'Burgers'
        ];

        $company = Company::where('name', AdminInvestmentsTableCustomSeeder::THE_PUB)->first();

        foreach ($categories as $category) {
            $company->productCategories()->create(
                ['name' => $category]
            );
        }
    }
}
