<?php

namespace App\Transformers\Employee;

use App\User;
use League\Fractal\TransformerAbstract;

class EmployeeUserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform($user, string $token)
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            
            // if a user is an owner, he will have a relation,
            // if an employee, he has in db base field with company_id.
            'company_id' => $user->company->id ?? $user->company_id,
            'jwt_token' => $token,
        ];
    }
}
