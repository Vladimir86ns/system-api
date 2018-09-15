<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Sentinel;
use Illuminate\Support\Facades\DB;

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
class UsersTableCustomSeeder extends Seeder
{
    // OWNERS EMAIL
    const GOGA_OWNER_EMAIL = 'gogaOwner@gmail.com';
    const DANIJELA_OWNER_EMAIL = 'danijelaOwner@gmail.com';
    const NATASA_OWNER_EMAIL = 'natasaBokanOwner@gmail.com';
    const RAJKA_OWNER_EMAIL = 'rajkaOwner@gmail.com';
    const MARKO_OWNER_EMAIL = 'markoOwner@gmail.com';
    const VLADIMIR_OWNER_EMAIL = 'vladimirOwner@gmail.com';
    const ZORAN_OWNER_EMAIL = 'zoranOwner@gmail.com';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'test123';

        // ADMIN INVESTOR
        $permissions = [
            'admin-investment' => 1,
        ];
        Sentinel::registerAndActivate([
            'first_name' => 'Vladimir',
            'last_name' => 'Grujin',
            'email' => 'vladimirInvestments@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);


        // INVESTOR
        $permissions = [
            'investor' => 1,
        ];
        Sentinel::registerAndActivate([
            'first_name' => 'Zoran',
            'last_name' => 'Kovacevic',
            'email' => 'zoranInvestor@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Milos',
            'last_name' => 'Jandric',
            'email' => 'milosInvestor@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Milan',
            'last_name' => 'Bokan',
            'email' => 'bokanInvestor@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);

        // OWNER
        $permissions = [
            'owner' => 1,
        ];
        Sentinel::registerAndActivate([
            'first_name' => 'Danijela',
            'last_name' => 'Kovacevic',
            'email' => self::DANIJELA_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Vladimir',
            'last_name' => 'Jandric',
            'email' => self::VLADIMIR_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Goran',
            'last_name' => 'Stojanovic',
            'email' => self::GOGA_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Natasa',
            'last_name' => 'Bokan',
            'email' => self::NATASA_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Rajka',
            'last_name' => 'Karan',
            'email' => self::RAJKA_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Marko',
            'last_name' => 'Stojic',
            'email' => self::MARKO_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Zoran',
            'last_name' => 'Djakovic',
            'email' => self::ZORAN_OWNER_EMAIL,
            'password' => $password,
            'permissions' => $permissions,
        ]);

        // SUPERVISOR
        $permissions = [
            'supervisor' => 1,
        ];
        Sentinel::registerAndActivate([
            'first_name' => 'Predrag',
            'last_name' => 'Saponja',
            'email' => 'pedjaSupervisor@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);

        // EMPLOYEE
        $permissions = [
            'employee' => 1,
        ];
        Sentinel::registerAndActivate([
            'first_name' => 'Zoran',
            'last_name' => 'Pavlica',
            'email' => 'pavlicaEmployee@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Petar',
            'last_name' => 'Korlat',
            'email' => 'petarKotlarEmployee@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Dejan',
            'last_name' => 'Nikolic',
            'email' => 'DejanNikolicEmployee@gmail.com',
            'password' => $password,
            'permissions' => $permissions,
        ]);
    }
}
