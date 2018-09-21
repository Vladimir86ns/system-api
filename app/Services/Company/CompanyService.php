<?php

namespace App\Services\Company;

use App\Company;
use App\ProductCategory;
use Sentinel;
use App\User;

class CompanyService
{
    private $employeeSelectedIds = [];
    
    /**
     * Store new product category.
     *
     * @param array $attributes
     * @param Company $company
     *
     * @return ProductCategory
     */
    public function storeProductCompany(array $attributes, Company $company)
    {
        return $company->productCategories()->create($attributes);
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
     * Get all un selected employees.
     *
     *
     * @return User
     */
    public function getUnSelectedEmployees()
    {
        return User::get()->filter(function($user) {
                $permission = json_decode($user->permissions, true);
                return !empty($permission['employee']) && $user->employee_active === 0;
            })->map(function ($user) {
                $user['selected'] = false;
                return $user;
            })->toArray();
    }
    
    /**
     * Tag selected employee.
     *
     * @param int $employeeId employeeID
     * @return User
     */
    public function tagSelectedEmployees(int $employeeId)
    {
        array_push($this->employeeSelectedIds, $employeeId);
        $employees = $this->getUnSelectedEmployees();
        
        return collect($employees)->map(function($employee) use ($employeeId) {
            $employee['selected'] = false;

            if (in_array($employee['id'], $this->employeeSelectedIds)) {
                $employee['selected'] = true;
            }
            
            return $employee;
        })->toArray();
    }
    
    /**
     * Reset selected employee Ids.
     *
     */
    public function initSelectedEmployees()
    {
        $this->employeeSelectedIds = [];
    }
}
