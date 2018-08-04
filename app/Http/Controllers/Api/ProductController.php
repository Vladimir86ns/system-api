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

    public function getProductCategories($id)
    {
        return $this->service->getCategories($id);
    }
}