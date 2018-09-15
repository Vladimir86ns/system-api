<?php

namespace App\Transformers\Company;

use App\User;
use League\Fractal\TransformerAbstract;

class CompanyUserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform($user, string $token)
    {
        \Log::info(print_r($user->company, true));
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'company_id' => $user->company->id,
            'jwt_token' => $token,
        ];
    }
}
