<?php

namespace Database\Seeds;

use App\AdminInvestment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminInvestmentsTableCustomSeeder extends Seeder
{
    const PIZZA_BELISSIMO = 'Pizza Belissimo';
    const CAFFE_CASTELLO = 'Caffe Castello';
    const LIVORNO = 'Livorno';
    const AKA_PEKARA = 'Aka Pekara';
    const POMODORINO = 'Pomodorino';
    const DIZNI = 'Dizni';
    const THE_PUB = 'The Pub';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'name' => self::PIZZA_BELISSIMO,
                'total_investition' => 5000000,
                'country' => 'Serbia',
                'city' => 'Futog',
                'address' => 'Cara Lazara 77',
                'status' => AdminInvestment::PENDING,
            ],
            [
                'name' => self::CAFFE_CASTELLO,
                'total_investition' => 7500000,
                'country' => 'Serbia',
                'city' => 'Futog',
                'address' => 'Rade Kondica 123',
                'status' => AdminInvestment::PENDING,
            ],
            [
                'name' => self::LIVORNO,
                'total_investition' => 4500000,
                'country' => 'Serbia',
                'city' => 'Novi Sad',
                'address' => 'Patrijarha Pavla 45',
                'status' => AdminInvestment::PENDING,
            ],
            [
                'name' => self::AKA_PEKARA,
                'total_investition' => 3400000,
                'country' => 'Serbia',
                'city' => 'Futog',
                'address' => 'Brace Bosnjak 77',
                'status' => AdminInvestment::PENDING,
            ],
            [
                'name' => self::POMODORINO,
                'total_investition' => 6400500,
                'country' => 'Serbia',
                'city' => 'Novi Sad',
                'address' => 'Bulevar cara Lazara 94',
                'status' => AdminInvestment::PENDING,
            ],
            [
                'name' => self::DIZNI,
                'total_investition' => 6400200,
                'country' => 'Serbia',
                'city' => 'Novi Sad',
                'address' => 'Bulevar cara Lazara 92',
                'status' => AdminInvestment::PENDING,
            ],
            [
                'name' => self::THE_PUB,
                'total_investition' => 17500000,
                'country' => 'Serbia',
                'city' => 'Novi Sad',
                'address' => 'Lasla Gala 2',
                'status' => AdminInvestment::PENDING,
            ],
        ];

        foreach ($attributes as $attribute) {
            DB::table('admin_investments')->insert([
                'name' => $attribute['name'],
                'total_investition' => $attribute['total_investition'],
                'country' => $attribute['country'],
                'city' => $attribute['city'],
                'address' => $attribute['address'],
                'status' => $attribute['status'],
            ]);
        }
    }
}
