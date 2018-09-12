<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminInvestment extends Model
{
    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';
    const REJECTED = 'REJECTED';

    protected $fillable = [
        'name',
        'total_investition',
        'city',
        'country',
        'address',
        'status',
        'closed',
    ];

    protected $casts = [
        'closed' => 'boolean',
        'on_production' => 'boolean',
    ];

    public function companies()
    {
        return $this->hasOne(Company::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
