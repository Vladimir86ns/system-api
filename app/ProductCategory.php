<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'company_id',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * The companies that belong to the product category.
     */
    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
    
    /**
     * Get the company product.
     */
    public function companyProducts()
    {
        return $this->hasMany(ProductCategory::class);
    }
}
