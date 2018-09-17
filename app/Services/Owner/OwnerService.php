<?php

namespace App\Services\Owner;

use App\Company;
use App\ProductCategory;
use Sentinel;
use Illuminate\Foundation\Auth\User;

class OwnerService
{
    /**
     * Store new product category.
     *
     * @param array $attributes
     * @param Company $company
     *
     * @return ProductCategory
     */
    public function store(array $attributes, Company $company)
    {
        return $company->productCategories()->create($attributes);
    }
}
