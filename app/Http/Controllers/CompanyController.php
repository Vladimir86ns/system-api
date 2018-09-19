<?php

namespace App\Http\Controllers;

use App\Services\Company\CompanyService;
use App\Services\Company\CompanyValidationService;
use Illuminate\Http\Request;
use App\Traits\User\UserTrait;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    use UserTrait;

    /**
     * @var CompanyService
     */
    protected $service;

    /**
     * @var CompanyValidationService
     */
    protected $validation;

    /**
     * CompanyController
     *
     * @param CompanyService $companyService
     * @param CompanyValidationService $ownerValidationService
     */
    public function __construct(
        CompanyService $companyService,
        CompanyValidationService $companyValidationService
    ) {
        $this->service = $companyService;
        $this->validation = $companyValidationService;
    }

    /**
     * Get page with form for creating company product category.
     *
     * @return view
     */
    public function createProductCategory()
    {
        return  view('owner.pages.add-product-category');
    }

    /**
     * Store new company product category in DB.
     *
     * @return view
     */
    public function storeProductCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
        ]);

        $company = $this->validation->getCompanyFromUserRelation();
        $newProduct = $this->service->store($request->all(), $company);

        if (!$newProduct) {
            return redirect('/owner/create-product-category')
                ->with("error", "Something went wrong!");
        }

        return redirect('/owner/create-product-category')
            ->with("success", "A new product category {$newProduct->name} is successfully added!");
    }
    
    /**
     * Get page with form for creating company product.
     *
     * @return view
     */
    public function createProduct()
    {
        $company = $this->validation->getCompanyFromUserRelation();
        
        $productCategories = $company->productCategories->toArray();

        return  view('owner.pages.add-product', compact(['productCategories']));
    }
}
