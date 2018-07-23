<?php

namespace App\Services\InvestmentAdmin;

use App\User;
use App\Services\InvestmentAdmin\InvestmentAdminService;

class InvestmentAdminValidationService
{
    /**
     * @var InvestmentAdminService
     */
    protected $investmentAdminService;

    /**
     * InvestmentValidationService
     *
     * @param InvestmentAdminService $investmentAdminService
     */
    public function __construct(
        InvestmentAdminService $investmentAdminService
    ) {
        $this->investmentAdminService = $investmentAdminService;
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
