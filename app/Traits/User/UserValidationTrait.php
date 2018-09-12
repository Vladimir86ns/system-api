<?php

namespace App\Traits\User;

use Sentinel;
use App\User;

trait UserValidationTrait
{
    /**
     * Check user exists with email.
     *
     * @param string $email
     */
    public function isEmailAvailable(string $email)
    {
        return User::where('email', $email)->exists();
    }

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
}
