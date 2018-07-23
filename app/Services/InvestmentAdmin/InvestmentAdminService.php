<?php

namespace App\Services\InvestmentAdmin;

use Sentinel;
use App\User;
use App\InvestmentsAdmin;

class InvestmentAdminService
{
    /**
     * Check dose user already exist with given email and password.
     *
     * @param $attributes
     * @return Redirect
     */
    public function checkUserAlreadyExist(array $attributes)
    {
        return Sentinel::authenticate(array_only($attributes, ['email', 'password']));
    }


    /**
     * Add to existing user new permissions and redirect
     *
     * @param $user
     * @return User
     */
    public function addNewPermissionToUserAndRedirect(User $user)
    {
        $permissions = $user->permissions;

        $permissions['admin_investment'] = 1;
        $user->permissions = $permissions;
        $user->update();

        return view('investment-admin.dashboard')->with('success', 'You are registered!');
    }

    /**
     * Register and activate new user
     *
     * @param array $attributes
     * @return User
     */
    public function registerAndActivateNewUser(array $attributes)
    {
        $permissions = [
            'investment-admin' => 1,
        ];

        // Register the user as investor-admin
        return Sentinel::registerAndActivate([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'permissions' => $permissions
        ]);
    }
}
