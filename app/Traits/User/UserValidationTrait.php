<?php

namespace App\Traits\User;

use Sentinel;
use App\User;
use Validator;

trait UserValidationTrait
{
    /**
     * Check user exists with email.
     *
     * @param string $email
     * @return User
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
    
    /**
     * Validate user credentials
     *
     * @param array $credentials
     * @param $validator
     * @return mixed
     */
    public function userCredentialsValidate(array $credentials, $validator)
    {
        $validator = Validator::make($credentials, $validator->rules(), $validator->messages());
    
        if ($validator->fails()) {
            return $validator->errors()->messages();
        }
    }
}
