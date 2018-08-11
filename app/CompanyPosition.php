<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyPosition extends Model
{
    protected $fillable = [
        'name',
        'company_id',
    ];

    /**
     * Get the user that owns the company.
     */
    public function company()
    {
        return $this->belongsTo(Project::class);
    }
}
