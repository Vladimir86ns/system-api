<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    const SERBIA = 'Serbia';

    protected $fillable = [
        'users_id',
        'total_investment',
        'percentage',
        'investment_collected_total',
        'monthly_collected',
        'investment_collected',
        'company_id',
        'admin_investment_id'
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the companies for the investments.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the user that owns the investment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the investment.
     */
    public function adminInvestment()
    {
        return $this->belongsTo(AdminInvestment::class);
    }
}
