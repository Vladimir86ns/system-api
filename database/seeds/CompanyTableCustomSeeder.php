<?php

namespace database\seeds;

use App\User;
use App\AdminInvestment;
use Illuminate\Database\Seeder;

class CompanyTableCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'investment' => AdminInvestmentsTableCustomSeeder::PIZZA_BELISSIMO,
                'owner_email' => UsersTableCustomSeeder::DANIJELA_OWNER_EMAIL
            ],
            [
                'investment' => AdminInvestmentsTableCustomSeeder::CAFFE_CASTELLO,
                'owner_email' => UsersTableCustomSeeder::NATASA_OWNER_EMAIL
            ],
            [
                'investment' => AdminInvestmentsTableCustomSeeder::AKA_PEKARA,
                'owner_email' => UsersTableCustomSeeder::GOGA_OWNER_EMAIL
            ],
            [
                'investment' => AdminInvestmentsTableCustomSeeder::LIVORNO,
                'owner_email' => UsersTableCustomSeeder::RAJKA_OWNER_EMAIL
            ],
            [
                'investment' => AdminInvestmentsTableCustomSeeder::POMODORINO,
                'owner_email' => UsersTableCustomSeeder::MARKO_OWNER_EMAIL
            ],
            [
                'investment' => AdminInvestmentsTableCustomSeeder::DIZNI,
                'owner_email' => UsersTableCustomSeeder::VLADIMIR_OWNER_EMAIL
            ],
            [
                'investment' => AdminInvestmentsTableCustomSeeder::THE_PUB,
                'owner_email' => UsersTableCustomSeeder::ZORAN_OWNER_EMAIL
            ]
        ];

        foreach ($attributes as $attribute) {
            $investment = AdminInvestment::where('name', $attribute['investment'])->first();
            $investment->status = AdminInvestment::APPROVED;
            $investment->on_production = 1;
            $investment->update();

            $owner = User::where('email', $attribute['owner_email'])->first();

            $investment->companies()->create(
                [
                    'name' => $investment->name,
                    'total_amount_investment' => $investment->total_investition,
                    'owner_id' => $owner->id
                ]
            );
        }
    }
}
