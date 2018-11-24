<?php

namespace App\Services\CompanyEmployee;

use App\EmployeeSchedule;
use App\User;

class CompanyEmployeeService
{
    const IS_ON = 'on';
    
    /**
     * Get all employees by company ID.
     *
     * @param int $companyId
     * @return mixed
     */
    public function getAllCompanyEmployees(int $companyId)
    {
        return User::where('company_id', $companyId)->paginate(10);
    }
    
    /**
     * Save schedule for employees of company.
     *
     * @param array $attributes
     * @param array $ids
     * @param string $companyId
     */
    public function saveSchedule(array $attributes, array $ids, string $companyId)
    {
        $employees = [];
        foreach ($ids as $employeeId) {
            array_push($employees, $this->prepareAttributes($attributes, $employeeId, $companyId));
        };
    
        EmployeeSchedule::insert($employees);
    }
    
    /**
     * Return all checked employee ids for schedule.
     *
     * @param array $attributes
     * @return array
     */
    public function getAllEmployeeCheckedIds(array $attributes)
    {
        return array_keys($attributes, self::IS_ON);
    }
    
    /**
     * Prepare attributes for saving schedules.
     *
     * @param array $attributes
     * @param int $employeeId
     * @param string $companyId
     * @return mixed
     */
    private function prepareAttributes(array $attributes, int $employeeId, string $companyId)
    {
        $newAttributes['employee_id'] = $employeeId;
        $newAttributes['company_id'] = (int) $companyId;
        $newAttributes['from_date'] = date("Y-m-d", strtotime($attributes['from_date']));
        $newAttributes['from_time'] = date("H:i:s", strtotime($attributes['from_time']  . ':00:00'));
        $newAttributes['to_date'] = date("Y-m-d", strtotime($attributes['to_date']));
        $newAttributes['to_time'] = date("H:i:s", strtotime($attributes['to_time']  . ':00:00'));
        
        return $newAttributes;
    }
}
