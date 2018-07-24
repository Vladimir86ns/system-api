<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'project_id',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * The companies that belong to the product category.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
