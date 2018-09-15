<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\AdminInvestment;

class VgSystemTableCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allAdminInvestment =  AdminInvestment::all();

        DB::table('vg_systems')->insert([
          'total_investitions' => $allAdminInvestment->sum('total_investition'),
          'collected_to_date' => $allAdminInvestment->sum('collected_to_date'),
        ]);
    }
}
