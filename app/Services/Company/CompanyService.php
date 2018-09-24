<?php

namespace App\Services\Company;

use App\CompanyProduct;
use App\User;
use Sentinel;
use App\Company;
use App\ProductCategory;
use App\Traits\Redis\RedisTrait;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    use RedisTrait;

    /**
     * Get all un selected employees.
     *
     *
     * @return User
     */
    public function getUnSelectedEmployees()
    {
        return User::get()->filter(function ($user) {
            $permission = json_decode($user->permissions, true);
            return !empty($permission['employee']) && $user->employee_active === 0;
        })->map(function ($user) {
            $user['selected'] = false;
            return $user;
        })->toArray();
    }

    /**
     * Tag selected employee, add id in redis.
     *
     * @param int $employeeId employeeID
     * @return User
     */
    public function tagSelectedEmployees(int $employeeId)
    {
        $ids = $this->addIdInRedis($employeeId);
        return $this->getSelectedEmployees($ids);
    }

    /**
     * Un tag selected employee, remove id from redis.
     *
     * @param int $employeeId employeeID
     * @return User
     */
    public function unTagSelectedEmployees(int $employeeId)
    {
        $ids = $this->removeIdFromRedis($employeeId);
        return $this->getSelectedEmployees($ids);
    }
    
    /**
     * Hire employees to company.
     *
     * @param Company $company.
     * @return User
     */
    public function hireEmployees(Company $company)
    {
        $ids = $this->getSelectedEmployeesIdsFromRedis();
        $employees = User::whereIn('id', $ids)->get();
    
        DB::transaction(function () use ($employees, $company) {
            foreach ($employees as $employee) {
                $employee->company_id = $company->id;
                $employee->employee_active = 1;
                $employee->save();
            }
        });
    
        $this->removeKeyForSelectingEmployeesFromRedis();
    }

    /**
     * Get ids from redis, and return employees with selected propery.
     *
     * @param array $ids employeeIds
     * @return User
     */
    private function getSelectedEmployees(array $ids)
    {
        $employees = $this->getUnSelectedEmployees();

        return collect($employees)->map(function ($employee) use ($ids) {
            $employee['selected'] = false;
            if (in_array($employee['id'], $ids)) {
                $employee['selected'] = true;
            }

            return $employee;
        })->toArray();
    }

    /**
     * Save in redis and gate value from redis.
     * This key is set to 15min.
     *
     * @param int $employeeId employeeID
     * @return array
     */
    private function addIdInRedis(int $employeeId)
    {
        $ids = $this->getSelectedEmployeesIdsFromRedis();
        $selectedIds = $ids ? collect($ids)->unique()->toArray() : [];
        array_push($selectedIds, $employeeId);
        
        $this->saveIdInEmployeeSelectedIdsInRedis($selectedIds);

        return $selectedIds;
    }

    /**
     * Un select id from redis.
     * This key is set to 15min.
     *
     * @param int $employeeId employeeID
     * @return array
     */
    private function removeIdFromRedis(int $employeeId)
    {
        $ids = $this->getSelectedEmployeesIdsFromRedis();

        $newIds = collect($ids)->filter(function ($id) use ($employeeId) {
            return $id != $employeeId;
        })->toArray();
    
        $this->saveIdInEmployeeSelectedIdsInRedis($newIds);

        return $newIds;
    }
}
