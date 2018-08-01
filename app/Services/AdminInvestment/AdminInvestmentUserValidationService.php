<?php

namespace App\Services\AdminInvestment;

use App\User;

class AdminInvestmentUserValidationService
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
}
