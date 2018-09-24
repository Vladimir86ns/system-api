<?php

namespace App\Services\CompanyProduct;


use App\Company;
use App\CompanyProduct;
use App\Traits\Redis\RedisTrait;

class CompanyProductService
{
    use RedisTrait;
    
    /**
     * Get all company products.
     *
     * @param Company $company.
     * @return User
     */
    public function getAllProducts(Company $company)
    {
        return CompanyProduct::where('company_id', $company->id)
            ->with('productCategory')
            ->paginate(10);
    }
    
    /**
     * Get company product by id.
     *
     * @param Company $company.
     * @param int $productId Product ID.
     * @return CompanyProduct
     */
    public function getProduct(Company $company, int $productId)
    {
        return CompanyProduct::where('company_id', $company->id)
            ->with('productCategory')
            ->find($productId);
    }
    
    /**
     * Get all company products by name.
     *
     * @param Company $company.
     * @param string $name.
     * @return User
     */
    public function getAllProductsByName(Company $company, string $name)
    {
        return CompanyProduct::where('company_id', $company->id)
            ->where('name', 'like', '%' . $name . '%')
            ->with('productCategory')
            ->paginate(10);
    }
    
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
    
    /**
     * Store new product category.
     *
     * @param array $attributes
     * @param Company $company
     *
     * @return ProductCategory
     */
    public function storeProductCategory(array $attributes, Company $company)
    {
        return $company->productCategories()->create($attributes);
    }
    
    /**
     * Delete company product.
     *
     * @param int $id CompanyProduct ID
     * @return boolean
     */
    public function delete(int $id)
    {
        return CompanyProduct::find($id)->delete();
    }
}
