<?php

namespace App\Services\CompanyEmployee;

use App\Traits\Company\CompanyValidationTrait;
use App\User;

class CompanyEmployeeValidationService
{
    use CompanyValidationTrait;
    /**
     * @var CompanyEmployeeService
     */
    protected $service;
    
    /**
     * CompanyEmployeeValidationService constructor.
     */
    public function __construct(CompanyEmployeeService $companyEmployeeService)
    {
        $this->service = $companyEmployeeService;
    }
    
    public function validateAndGetAllEmployees(int $companyId)
    {
        return User::where('company_id', $companyId)->get();
    }
}
