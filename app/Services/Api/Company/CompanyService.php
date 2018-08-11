<?php

namespace App\Services\Api\Company;

use App\CompanyProduct;
use App\ProductCategory;

class CompanyService
{
    /**
     * Get all company product categories
     *
     * @param int $id Company ID
     * @return ProductCategory;
     */
    public function getCategories(int $id)
    {
        return ProductCategory::where('company_id', $id)->get();
    }

    /**
     * Get all company products
     *
     * @param int $id Company ID
     * @return ProductCategory;
     */
    public function getAllProducts(int $id)
    {
        return CompanyProduct::where('company_id', $id)->get();
    }
}
