<?php

namespace App\Services\Owner;

use Sentinel;
use Illuminate\Foundation\Auth\User;

class OwnerUserService
{
    /**
     * Add to existing user new permissions and redirect
     *
     * @param $user
     */
    public function addNewPermissionToUserAndRedirect($user)
    {
        $permissions = $user->permissions;

        $permissions['owner'] = 1;
        $user->permissions = $permissions;
        $user->update();

        return view('owner.pages.dashboard')->with('success', 'You are registered!');
    }

    /**
     * Register and activate new user
     *
     * @param array $attributes
     */
    public function registerAndActivateNewUser(array $attributes)
    {
        $permissions = [
            'owner' => 1,
        ];

        // Register the user as investor
        return Sentinel::registerAndActivate([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'permissions' => $permissions
        ]);
    }
}
