<?php

namespace App\Transformers\AdminInvestment;

use League\Fractal\TransformerAbstract;
use App\AdminInvestment;

class AdminInvestmentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param AdminInvestment $adminInvestments
     * @return array
     */
    public function transform(AdminInvestment $adminInvestments)
    {
        return [
            'id' => $adminInvestments->id,
            'name' => $adminInvestments->name,
            'total_investition' => number_format($adminInvestments->total_investition, 2),
            'collected_to_date' => number_format($adminInvestments->collected_to_date, 2),
            'city' => $adminInvestments->city,
            'country' => $adminInvestments->country,
            'address' => $adminInvestments->address,
            'closed' => $adminInvestments->closed,
            'status' => $adminInvestments->status,
            'left_to_invest' =>number_format(
                ($adminInvestments->total_investition - $adminInvestments->collected_to_date),
                2
            ),
            'on_production' => $adminInvestments->on_production,
        ];
    }
}
