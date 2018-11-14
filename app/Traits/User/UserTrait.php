<?php

namespace App\Traits\User;

use Sentinel;
use App\User;

trait UserTrait
{
    public function getUser()
    {
        return User::find(Sentinel::getUser()->id);
    }

    public function getCompany()
    {
        return $this->getUser()->company;
    }
    
    /**
     * Add to existing user new permissions.
     *
     * @param User $user
     * @param string $permissionName
     * @return User
     */
    public function addNewPermissionToUser(User $user, string $permissionName)
    {
        $permissions = $user->permissions;
        
        $permissions[$permissionName] = 1;
        $user->permissions = $permissions;
        $user->update();
        
        return $user;
    }
    
    /**
     * Register user.
     *
     * @param array $attributes
     * @param string $permissionName
     * @return mixed
     */
    public function registerAddPermissionAndActivateNewUser(array $attributes, string $permissionName)
    {
        $permissions = [
            $permissionName => 1,
        ];
        
        $attributes['permissions'] = json_encode($permissions);
        $attributes['password'] = bcrypt($attributes['password']);
        
        return User::create($attributes);
    }
}
