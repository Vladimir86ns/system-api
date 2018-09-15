<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VgSystem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_investitions',
        'collected_to_date',
        'monthly_collected',
    ];
}
