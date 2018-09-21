<?php

namespace App;

use App\Investment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'address',
        'city',
        'company_id',
        'postal',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get investments.
    */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get the owner of company.
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }
    

    /**
     * Get investor.
     */
    public function vgSystemSharing()
    {
        return $this->hasOne(VgSystemSharing::class);
    }
}
