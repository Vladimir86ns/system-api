<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    protected $fillable = [
        'company_id',
        'employee_id',
        'from_date',
        'from_time',
        'to_date',
        'to_time'
    ];
    
    /**
     * Set from date.
     *
     * @param  string  $value
     * @return void
     */
    public function setFromDateAttribute($value)
    {
        $this->attributes['from_date'] = date("Y-m-d", strtotime($value));
    }
    
    /**
     * Set to date.
     *
     * @param  string  $value
     * @return void
     */
    public function setToDateAttribute($value)
    {
        $this->attributes['to_date'] = date("Y-m-d", strtotime($value));
    }
    
    /**
     * Set from time.
     *
     * @param  string  $value
     * @return void
     */
    public function setFromTimeAttribute($value)
    {
        $this->attributes['from_time'] = date("h:i:s", strtotime($value));
    }
    
    /**
     * Set to time.
     *
     * @param  string  $value
     * @return void
     */
    public function setToTimeAttribute($value)
    {
        $this->attributes['to_time'] = date("h:i:s", strtotime($value));
    }
    
    /**
     * Get the employee.
     */
    public function employee()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
