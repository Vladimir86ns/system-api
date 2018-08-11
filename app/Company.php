<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'total_amount',
        'income',
        'expense',
        'profit',
        'profit_sharing',
        'investment_collected',
        'phone_number',
        'investment_id',
        'owner_id',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the owner of projects.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the admin investments.
     */
    public function adminInvestment()
    {
        return $this->belongsTo(InvestmentsAdmin::class);
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
}
