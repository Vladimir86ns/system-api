<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\Api\Company\CompanyService;

class ProductController extends BaseController
{
    /**
     * @var CompanyService
     */
    protected $companyService;

    public function __construct(
        CompanyService $companyService
    ) {
        $this->service = $companyService;
    }

    /**
     * Get all company product categories
     *
     * @param int $id Company ID
     * @return ProductCategory;
     */
    public function getProductCategories($id)
    {
        return $this->service->getCategories($id);
    }
}