<?php

namespace App\Transformers\Company;

use App\Company;
use League\Fractal\TransformerAbstract;

class ApiCompanyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(Company $company)
    {
        return [
            'id' => $company->id,
            'name' => $company->name,
            'city' => $company->adminInvestment->city
        ];
    }
}
