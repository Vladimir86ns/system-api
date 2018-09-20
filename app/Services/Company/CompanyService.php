<?php

namespace App\Services\Company;

use App\Company;
use App\ProductCategory;
use Sentinel;
use Illuminate\Foundation\Auth\User;

class CompanyService
{
    /**
     * Store new product category.
     *
     * @param array $attributes
     * @param Company $company
     *
     * @return ProductCategory
     */
    public function storeProductCompany(array $attributes, Company $company)
    {
        return $company->productCategories()->create($attributes);
    }
    
    /**
     * Store new product.
     *
     * @param array $attributes
     * @param Company $company
     *
     * @return ProductCategory
     */
    public function storeProduct(array $attributes, Company $company)
    {
        return $company->companyProducts()->create($attributes);
    }
}
