<?php

namespace App\Services\CompanyProduct;


use App\Company;
use App\CompanyProduct;

class CompanyProductService
{
    
    /**
     * Update company product.
     *
     * @param Company $company
     * @param int $productId ProductID
     * @param array $attributes
     *
     * @return CompanyProduct
     */
    public function updateProduct(Company $company, int $productId, array $attributes)
    {
        return CompanyProduct::where('company_id', $company->id)
            ->where('id', $productId)->update(array_except($attributes, ['_token', 'btnSubmit']));
    }
}
