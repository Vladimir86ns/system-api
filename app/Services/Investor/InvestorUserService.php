<?php

namespace App\Services\Investor;

use Sentinel;
use Illuminate\Foundation\Auth\User;

class InvestorUserService
{
    /**
     * Add to existing user new permissions and redirect
     *
     * @param $user
     */
    public function addNewPermissionToUserAndRedirect($user)
    {
        $permissions = $user->permissions;

        $permissions['investor'] = 1;
        $user->permissions = $permissions;
        $user->update();

        return view('investor.pages.dashboard')->with('success', 'You are registered!');
    }

    /**
     * Register and activate new user
     *
     * @param array $attributes
     */
    public function registerAndActivateNewUser(array $attributes)
    {
        $permissions = [
            'investor' => 1,
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
