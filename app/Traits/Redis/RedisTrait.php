<?php

namespace App\Traits\Redis;

use Illuminate\Support\Facades\Redis;

trait RedisTrait
{
    public function getSelectedEmployeesIdsFromRedis()
    {
        $ids = json_decode(Redis::get('selected_employees'), true);
        return $ids ? collect($ids)->unique()->toArray() : [];
    }
    
    public function saveIdInEmployeeSelectedIdsInRedis($ids)
    {
        Redis::set('selected_employees', json_encode($ids), 'EX', 900);
    }
    
    public function removeKeyForSelectingEmployeesFromRedis()
    {
        Redis::del('selected_employees');
    }
}
