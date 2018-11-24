<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyProductRequest;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyValidationService;
use App\Services\CompanyProduct\CompanyProductService;
use Illuminate\Http\Request;
use App\Traits\User\UserTrait;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 **/
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
     * @var CompanyProductServicec
     */
    protected $companyProductService;

    /**
     * CompanyController
     *
     * @param CompanyService $companyService
     * @param CompanyValidationService $ownerValidationService
     */
    public function __construct(
        CompanyService $companyService,
        CompanyValidationService $companyValidationService,
        CompanyProductService $companyProductService
    ) {
        $this->service = $companyService;
        $this->validation = $companyValidationService;
        $this->companyProductService = $companyProductService;
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
        $newProductCategory = $this->companyProductService->storeProductCategory($request->all(), $company);

        if (!$newProductCategory) {
            return redirect('/owner/product-category/create')
                ->with("error", "Something went wrong!");
        }

        return redirect('/owner/product-category/create')
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
        $image = $request->file('image-upload');
        
        $inputs = $request->all();
        
        $company = $this->validation->getCompanyFromUserRelation();
        
        if ($image) {
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/uploads/company-product/' . $company->id . '/');
    
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            
            Image::make($image)->resize(512, 512)->save($path . $fileName);
        }
        
        $inputs['picture'] = $fileName;
        $newProduct = $this->companyProductService->storeProduct($inputs, $company);

        if (!$newProduct) {
            return redirect('/owner/product/create')
                ->with("error", "Something went wrong!");
        }
    
        return redirect('/owner/product/create')
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
    
    /**
     * Get all company products.
     *
     * @return view
     */
    public function getAllProducts()
    {
        $company = $this->validation->getCompanyFromUserRelation();
        $products = $this->companyProductService->getAllProducts($company);
        
        return view('owner.pages.all-product', compact(['products']));
    }
    
    /**
     * Get all company products by name.
     *
     * @return view
     */
    public function getByName(Request $request)
    {
        $name = $request->get('name');
        $company = $this->validation->getCompanyFromUserRelation();
        
        if ($name) {
            $products = $this->companyProductService->getAllProductsByName($company, $name);
        } else {
            return $this->getAllProducts();
        }
    
        return view('owner.pages.all-product', compact(['products']));
    }
    
    /**
     * Get all company products, and selected product for edit page.
     *
     * @param int $id Product ID
     * @return CompanyProduct;
     */
    public function editProduct($id)
    {
        $company = $this->validation->getCompanyFromUserRelation();
        $productCategories = $company->productCategories->toArray();
        $products = $this->companyProductService->getAllProducts($company);
        $selectedProduct = $this->companyProductService->getProduct($company, $id);

        return view('owner.pages.all-product', compact(['products', 'selectedProduct', 'productCategories']));
    }
    
    /**
     * Update company product in DB.
     *
     * @param int $id Product ID
     * @return view
     */
    public function updateProduct($id, CompanyProductRequest $request)
    {
        $company = $this->validation->getCompanyFromUserRelation();
        $updated = $this->companyProductService->updateProduct($company, $id, $request->all());
        
        if (!$updated) {
            return redirect('/owner/product/all')
                ->with("error", "Something went wrong!");
        }
    
        return redirect('/owner/product/all')
            ->with("success", "Successfully updated {$request->get('name')} product!");
    }
    
    /**
     * Delete company product.
     *
     * @param int $id Product ID
     * @return view
     */
    public function deleteProduct($id)
    {
        $deleted = $this->companyProductService->delete($id);
        
        if (!$deleted) {
            return redirect('/owner/product/all')
                ->with("error", "Something went wrong!");
        }
        return redirect('/owner/product/all')
            ->with("success", "Successfully deleted product!");
    }
}
