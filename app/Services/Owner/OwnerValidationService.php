<?php

namespace App\Services\Owner;

use App\Company;
use App\ProductCategory;
use App\Traits\Company\CompanyValidationTrait;
use Sentinel;
use Illuminate\Foundation\Auth\User;

class OwnerValidationService
{
    use CompanyValidationTrait;
}
