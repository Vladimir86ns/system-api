<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VgSystemSharing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_invested',
        'investment_id',
        'user_id'
    ];

    /**
     * Get investor.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
