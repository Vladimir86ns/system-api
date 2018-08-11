<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProduct extends Model
{
    protected $fillable = [
        'product_categories_id',
        'company_id',
        'name',
        'size',
        'cost',
        'price',
        'picture',
        'time_to_prepare',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the product categories record associated with the product.
     */
    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    /**
     * The company that belong to the product.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
