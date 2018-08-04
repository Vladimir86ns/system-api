<?php

namespace App\Services\Api\Company;

use App\ProductCategory;

class CompanyService
{
    public function getCategories(int $id)
    {
        return ProductCategory::where('company_id', $id)->get();
    }
}