<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN INVESTOR
        $permissions = [
            'admin-investment' => 1,
        ];
        $user = Sentinel::registerAndActivate([
            'first_name' => 'Vladimir',
            'last_name' => 'Grujin',
            'email' => 'vladimirInvestments@gmail.com',
            'password' => 'test123',
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
            'password' => 'test123',
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Milos',
            'last_name' => 'Jandric',
            'email' => 'milosInvestor@gmail.com',
            'password' => 'test123',
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Milan',
            'last_name' => 'Bokan',
            'email' => 'bokanInvestor@gmail.com',
            'password' => 'test123',
            'permissions' => $permissions,
        ]);

        // OWNER
        $permissions = [
            'owner' => 1,
        ];
        Sentinel::registerAndActivate([
            'first_name' => 'Danijela',
            'last_name' => 'Kovacevic',
            'email' => 'danijelaOwner@gmail.com',
            'password' => 'test123',
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Vladimir',
            'last_name' => 'Jandric',
            'email' => 'vladimirOwner@gmail.com',
            'password' => 'test123',
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
            'password' => 'test123',
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
            'password' => 'test123',
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Petar',
            'last_name' => 'Korlat',
            'email' => 'petarKotlarEmployee@gmail.com',
            'password' => 'test123',
            'permissions' => $permissions,
        ]);

        Sentinel::registerAndActivate([
            'first_name' => 'Dejan',
            'last_name' => 'Nikolic',
            'email' => 'DejanNikolicEmployee@gmail.com',
            'password' => 'test123',
            'permissions' => $permissions,
        ]);
    }
}
