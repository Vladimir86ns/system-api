<?php

use Illuminate\Database\Seeder;
use database\seeds\UsersTableCustomSeeder;
use database\seeds\CompanyTableCustomSeeder;
use database\seeds\VgSystemTableCustomSeeder;
use database\seeds\AdminInvestmentsTableCustomSeeder;
use database\seeds\CompanyCategoriesTableCustomSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableCustomSeeder::class);
        $this->call(AdminInvestmentsTableCustomSeeder::class);
        $this->call(CompanyTableCustomSeeder::class);
        $this->call(CompanyCategoriesTableCustomSeeder::class);
        $this->call(VgSystemTableCustomSeeder::class);
        $this->call(CompanyProductsTableCustomSeeder::class);
    }
}
