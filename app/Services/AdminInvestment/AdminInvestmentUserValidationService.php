<?php

namespace App\Services\AdminInvestment;

use App\User;
use App\Services\AdminInvestment\AdminInvestmentUserService;

class AdminInvestmentUserValidationService
{
    /**
     * @var AdminInvestmentUserService
     */
    protected $userService;

    /**
     * InvestmentValidationService
     *
     * @param AdminInvestmentUserService $userService
     */
    public function __construct(
        AdminInvestmentUserService $userService
    ) {
        $this->userService = $userService;
    }

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
