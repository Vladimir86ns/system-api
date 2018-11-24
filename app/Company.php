<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'total_amount_investment',
        'monthly_income',
        'monthly_expense',
        'monthly_profit',
        'profit_sharing',
        'investment_collected',
        'phone_number',
        'investment_id',
        'owner_id',
    ];

    /**
     * Get the owner of projects.
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'owner_id');
    }
    

    /**
     * Get the admin investments.
     */
    public function adminInvestment()
    {
        return $this->belongsTo(AdminInvestment::class);
    }

    /**
     * Get all company positions.
     */
    public function positions()
    {
        return $this->hasMany(CompanyPosition::class);
    }

    /**
     * Get all orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all product categories.
     */
    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    /**
     * Get the product categories record associated with the product.
     */
    public function companyProducts()
    {
        return $this->hasMany(CompanyProduct::class);
    }
    
    /**
     * Get the employee..
     */
    public function employeeSchedule()
    {
        return $this->hasOne(EmployeeSchedule::class);
    }
}
