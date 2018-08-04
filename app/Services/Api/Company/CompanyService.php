<?php

namespace App\Services\Api\Company;

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
}