<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyProductRequest;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyValidationService;
use App\User;
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
        $newProductCategory = $this->service->storeProductCompany($request->all(), $company);

        if (!$newProductCategory) {
            return redirect('/owner/create-product-category')
                ->with("error", "Something went wrong!");
        }

        return redirect('/owner/create-product-category')
            ->with("success", "A new product category {$newProductCategory->name} is successfully added!");
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
    
    /**
     * Store new product to DB.
     *
     * @return view
     */
    public function storeProduct(CompanyProductRequest $request)
    {
        $company = $this->validation->getCompanyFromUserRelation();
        $newProduct = $this->service->storeProduct($request->all(), $company);

        if (!$newProduct) {
            return redirect('/owner/create-product')
                ->with("error", "Something went wrong!");
        }
    
        return redirect('/owner/create-product')
            ->with("success", "A new product {$newProduct->name} is successfully added!");
        
    }
    
    /**
     * Get all un active employees.
     *
     * @return view
     */
    public function getUnActiveEmployees()
    {
        $employees = $this->service->getUnSelectedEmployees();
        return  view('owner.pages.add-employees', compact(['employees']));
    }
    
    /**
     * Tag selected employee before hire them.
     *
     * @param $id employeeID
     * @return view
     */
    public function selectEmployees($id)
    {
        $employees = $this->service->tagSelectedEmployees($id);
        return  view('owner.pages.add-employees', compact(['employees']));
    }
    
    /**
     * Un tag selected employee before hire them.
     *
     * @param $id employeeID
     * @return view
     */
    public function unSelectEmployees($id)
    {
        $employees = $this->service->unTagSelectedEmployees($id);
        return  view('owner.pages.add-employees', compact(['employees']));
    }
    
    /**
     * Hire employees to company.
     *
     * @return view
     */
    public function hireEmployees()
    {
        $company = $this->validation->getCompanyFromUserRelation();
        $this->service->hireEmployees($company);
        $employees = $this->service->getUnSelectedEmployees();
        
        return  view('owner.pages.add-employees', compact(['employees']));
    }
}
