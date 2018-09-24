<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use database\seeds\UsersTableCustomSeeder;

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
class CompanyProductsTableCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LIVORNO company products
        $user = User::where('email', UsersTableCustomSeeder::RAJKA_OWNER_EMAIL)->first();
        $allCategories = $user->company->productCategories;

        // PICTURE PIZZA ADDRESS
        $capricciosaPizture = 'http://caribic.rs/uploads/cache/img-595c79c0165cf9e5799eca439c5bb45f';
        $veneziaPicture = 'http://caribic.rs/uploads/cache/img-cad840e82414ce83e7e668ef8ae8cce7';
        $mexicoPicture = 'http://caribic.rs/uploads/cache/img-0f5fa869a8dd6be4dd7a3b23bf90438c';
        $kulenPicture = 'http://caribic.rs/uploads/cache/img-22a6f9ffa782b8db78dfb7387fe80abc';
        $feferoniPicture = 'http://caribic.rs/uploads/cache/img-2fd2bb41ddb0609a9c0b54530ac74a62';

        $attributes = [
            'Pizza' => [
                [
                    'name' => 'Capricciosa',
                    'type' => 'Mala',
                    'size' => 27,
                    'cost' => 100,
                    'price' => 200,
                    'picture' => $capricciosaPizture,
                    'time_to_prepare' => 6
                ],
                [
                    'name' => 'Capricciosa',
                    'type' => 'Srednja',
                    'size' => 32,
                    'cost' => 250,
                    'price' => 590,
                    'picture' => $capricciosaPizture,
                    'time_to_prepare' => 9,
                ],
                [
                    'name' => 'Capricciosa',
                    'type' => 'Velika',
                    'size' => 42,
                    'cost' => 320,
                    'price' => 650,
                    'picture' => $capricciosaPizture,
                    'time_to_prepare' => 12,
                ],
                [
                    'name' => 'Capricciosa',
                    'type' => 'Porodicna',
                    'size' => 50,
                    'cost' => 540,
                    'price' => 1090,
                    'picture' => $capricciosaPizture,
                    'time_to_prepare' => 14,
                ],
                [
                    'name' => 'Venezia',
                    'type' => 'Mala',
                    'size' => 27,
                    'cost' => 200,
                    'price' => 440,
                    'picture' => $veneziaPicture,
                    'time_to_prepare' => 6
                ],
                [
                    'name' => 'Venezia',
                    'type' => 'Srednja',
                    'size' => 32,
                    'cost' => 300,
                    'price' => 790,
                    'picture' => $veneziaPicture,
                    'time_to_prepare' => 9,
                ],
                [
                    'name' => 'Venezia',
                    'type' => 'Velika',
                    'size' => 42,
                    'cost' => 560,
                    'price' => 950,
                    'picture' => $veneziaPicture,
                    'time_to_prepare' => 12,
                ],
                [
                    'name' => 'Venezia',
                    'type' => 'Porodicna',
                    'size' => 50,
                    'cost' => 660,
                    'price' => 1390,
                    'picture' => $veneziaPicture,
                    'time_to_prepare' => 14,
                ],
                [
                    'name' => 'Mexico',
                    'type' => 'Mala',
                    'size' => 27,
                    'cost' => 100,
                    'price' => 200,
                    'picture' => $mexicoPicture,
                    'time_to_prepare' => 6
                ],
                [
                    'name' => 'Mexico',
                    'type' => 'Srednja',
                    'size' => 32,
                    'cost' => 250,
                    'price' => 590,
                    'picture' => $mexicoPicture,
                    'time_to_prepare' => 9,
                ],
                [
                    'name' => 'Mexico',
                    'type' => 'Velika',
                    'size' => 42,
                    'cost' => 320,
                    'price' => 650,
                    'picture' => $mexicoPicture,
                    'time_to_prepare' => 12,
                ],
                [
                    'name' => 'Mexico',
                    'type' => 'Porodicna',
                    'size' => 50,
                    'cost' => 540,
                    'price' => 1090,
                    'picture' => $mexicoPicture,
                    'time_to_prepare' => 14,
                ],
                [
                    'name' => 'Kulen',
                    'type' => 'Mala',
                    'size' => 27,
                    'cost' => 100,
                    'price' => 280,
                    'picture' => $kulenPicture,
                    'time_to_prepare' => 6
                ],
                [
                    'name' => 'Kulen',
                    'type' => 'Srednja',
                    'size' => 32,
                    'cost' => 250,
                    'price' => 650,
                    'picture' => $kulenPicture,
                    'time_to_prepare' => 9,
                ],
                [
                    'name' => 'Kulen',
                    'type' => 'Velika',
                    'size' => 42,
                    'cost' => 320,
                    'price' => 750,
                    'picture' => $kulenPicture,
                    'time_to_prepare' => 12,
                ],
                [
                    'name' => 'Kulen',
                    'type' => 'Porodicna',
                    'size' => 50,
                    'cost' => 540,
                    'price' => 1190,
                    'picture' => $kulenPicture,
                    'time_to_prepare' => 14,
                ],
                [
                    'name' => 'Feferoni',
                    'type' => 'Srednja',
                    'size' => 32,
                    'cost' => 430,
                    'price' => 850,
                    'picture' => $feferoniPicture,
                    'time_to_prepare' => 9,
                ],
                [
                    'name' => 'Feferoni',
                    'type' => 'Velika',
                    'size' => 42,
                    'cost' => 560,
                    'price' => 1050,
                    'picture' => $feferoniPicture,
                    'time_to_prepare' => 12,
                ]
            ],
            'Burgers' => [
                [
                    'name' => 'Hamburger',
                    'cost' => 40,
                    'price' => 120,
                    'picture' => 'http://caribic.rs/uploads/cache/img-22219cf7627aa8d422298ed6b45a4cae',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Hamburger Veliki',
                    'cost' => 60,
                    'price' => 200,
                    'picture' => 'http://caribic.rs/uploads/cache/img-544959887a38f136c2e03df1d2d8b28d',
                    'time_to_prepare' => 9,
                ],
                [
                    'name' => 'Cheeseburger',
                    'cost' => 60,
                    'price' => 130,
                    'picture' => 'http://caribic.rs/uploads/cache/img-6fafde48f315f28a4b6f4e20d955dd97',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Cheeseburger Veliki',
                    'cost' => 60,
                    'price' => 200,
                    'picture' => 'http://caribic.rs/uploads/cache/img-939cd31d873277b39be091c6bd84e7e1',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Veliki Dupli Cheeseburger',
                    'cost' => 100,
                    'price' => 150,
                    'picture' => 'http://caribic.rs/uploads/cache/img-4a28a1b87a0f8e08875562fd21d43795',
                    'time_to_prepare' => 8,
                ],
                [
                    'name' => 'Livorno Burger',
                    'cost' => 155,
                    'price' => 280,
                    'picture' => 'http://caribic.rs/uploads/cache/img-501b4bc7beeb268e0305628c42ea2022',
                    'time_to_prepare' => 8,
                ],
                [
                    'name' => 'Farmer Burger',
                    'cost' => 150,
                    'price' => 270,
                    'picture' => 'http://caribic.rs/uploads/cache/img-2f42fba07caafaae8eb21c06e3722d95',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Bečki burger',
                    'cost' => 140,
                    'price' => 300,
                    'picture' => 'http://caribic.rs/uploads/cache/img-038b29f6f877820cd99961dc9ecb167e',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Grande Cheeseburger',
                    'cost' => 60,
                    'price' => 270,
                    'picture' => 'http://caribic.rs/uploads/cache/img-3fc38869d58102bae008916f11cbd961',
                    'time_to_prepare' => 7,
                ]
            ],
            'Sandwich' => [
                [
                    'name' => 'Index Sandwich',
                    'type' => 'Mali',
                    'cost' => 130,
                    'price' => 280,
                    'picture' => 'http://caribic.rs/uploads/cache/img-ac6cb0109a4a5e2367310d2c6328d826',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Index Sandwich',
                    'type' => 'Veliki',
                    'cost' => 220,
                    'price' => 340,
                    'picture' => 'http://caribic.rs/uploads/cache/img-ac6cb0109a4a5e2367310d2c6328d826',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Chicken Feta Sandwich',
                    'type' => 'Mali',
                    'cost' => 140,
                    'price' => 290,
                    'picture' => 'http://caribic.rs/uploads/cache/img-918280d96f2311eda97a8b2f2ffe5878',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Chicken Feta Sandwich',
                    'type' => 'Veliki',
                    'cost' => 200,
                    'price' => 370,
                    'picture' => 'http://caribic.rs/uploads/cache/img-918280d96f2311eda97a8b2f2ffe5878',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Mexico Sandwich',
                    'type' => 'Mali',
                    'cost' => 130,
                    'price' => 320,
                    'picture' => 'http://caribic.rs/uploads/cache/img-6119fa239a552ed4c4fa326feeac8eda',
                    'time_to_prepare' => 7,
                ],
                [
                    'name' => 'Mexico Sandwich',
                    'type' => 'Veliki',
                    'cost' => 200,
                    'price' => 400,
                    'picture' => 'http://caribic.rs/uploads/cache/img-6119fa239a552ed4c4fa326feeac8eda',
                    'time_to_prepare' => 7,
                ]
            ],
            'Pancake' => [
                [
                    'name' => 'Eurokrem',
                    'type' => 'Slatke',
                    'cost' => 50,
                    'price' => 150,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Krem',
                    'type' => 'Slatke',
                    'cost' => 30,
                    'price' => 100,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Banana I Plazma',
                    'type' => 'Slatke',
                    'cost' => 120,
                    'price' => 230,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Hawaii',
                    'type' => 'Slatke',
                    'cost' => 110,
                    'price' => 230,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Jagoad i banane',
                    'type' => 'Slatke',
                    'cost' => 110,
                    'price' => 230,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Svarcwald',
                    'type' => 'Slatke',
                    'cost' => 110,
                    'price' => 230,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Bela Cokolada',
                    'type' => 'Slatke',
                    'cost' => 40,
                    'price' => 100,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Nutella',
                    'type' => 'Slatke',
                    'cost' => 110,
                    'price' => 230,
                    'picture' => 'http://caribic.rs/uploads/cache/img-dc129529d9a58ab866376aeedd6c45a5',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Pileca',
                    'type' => 'Slane',
                    'cost' => 50,
                    'price' => 270,
                    'picture' => 'http://caribic.rs/uploads/cache/img-72d5326d0637bcec432f2e8dedc64a6e',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Kulen',
                    'type' => 'Slane',
                    'cost' => 50,
                    'price' => 270,
                    'picture' => 'http://caribic.rs/uploads/cache/img-72d5326d0637bcec432f2e8dedc64a6e',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Pizza',
                    'type' => 'Slane',
                    'cost' => 50,
                    'price' => 270,
                    'picture' => 'http://caribic.rs/uploads/cache/img-72d5326d0637bcec432f2e8dedc64a6e',
                    'time_to_prepare' => 6,
                ],
                [
                    'name' => 'Sunka',
                    'type' => 'Slane',
                    'cost' => 50,
                    'price' => 200,
                    'picture' => 'http://caribic.rs/uploads/cache/img-72d5326d0637bcec432f2e8dedc64a6e',
                    'time_to_prepare' => 6,
                ],
            ],
            'Drinks' => [
                [
                    'name' => 'Coca Cola',
                    'type' => 'Sok',
                    'cost' => 50,
                    'price' => 130,
                    'picture' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdAVdqLZ81SLGouj7kwf-VPCUuod0M7ZpXSCj1VuSWChELwV4h',
                ],
                [
                    'name' => 'Fanta',
                    'type' => 'Sok',
                    'cost' => 50,
                    'price' => 130,
                    'picture' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOsMKMk4vF1X0DBxcGGnBKxiE4u5jRhnFHtSNryT4qfLRgjYHO',
                ],
                [
                    'name' => 'Sprite',
                    'type' => 'Sok',
                    'cost' => 50,
                    'price' => 130,
                    'picture' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE1NsNxdYJOHJYccXkTGU1aZRkmvK_H861xXt2hsZkau15gLQ-',
                ],
                [
                    'name' => 'Ice Tea',
                    'type' => 'Sok',
                    'cost' => 50,
                    'price' => 140,
                    'picture' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzanWMV7R_A1Z4lCPzFE7mQVxdORbK2D_rA_NTO5dR06jPnYFPBA',
                ]
            ]
        ];

        // Pizza
        foreach ($attributes['Pizza'] as $pizza) {
            $category = $allCategories->where('name', 'Pizza')->first();
            $pizza['product_category_id'] = $category->id;
            $user->company->companyProducts()->create(
                $pizza
            );
        }

        // Burgers
        foreach ($attributes['Burgers'] as $burger) {
            $category = $allCategories->where('name', 'Burgers')->first();
            $burger['product_category_id'] = $category->id;
            $user->company->companyProducts()->create(
                $burger
            );
        }

        // Sandwich
        foreach ($attributes['Sandwich'] as $sandwich) {
            $category = $allCategories->where('name', 'Sandwich')->first();
            $sandwich['product_category_id'] = $category->id;
            $user->company->companyProducts()->create(
                $sandwich
            );
        }

        // Pancake
        foreach ($attributes['Pancake'] as $pancake) {
            $category = $allCategories->where('name', 'Pancake')->first();
            $pancake['product_category_id'] = $category->id;
            $user->company->companyProducts()->create(
                $pancake
            );
        }

        // Drinks
        foreach ($attributes['Drinks'] as $drink) {
            $category = $allCategories->where('name', 'Drinks')->first();
            $drink['product_category_id'] = $category->id;
            $user->company->companyProducts()->create(
                $drink
            );
        }
    }
}
