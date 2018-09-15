<?php

namespace App\Transformers\Investor;

use App\Investment;
use App\AdminInvestment;
use League\Fractal\TransformerAbstract;

class InvestmentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Investment $investment
     * @return array
     */
    public function transform(Investment $investment)
    {
        return [
            'id' => $investment->id,
            'total_investment' => number_format($investment->total_investment, 2),
            'percentage' => $investment->percentage . ' %',
            'investment_collected_total' => number_format($investment->investment_collected_total, 2),
            'monthly_collected' => number_format($investment->monthly_collected, 2),
            'investment_collected' => $investment->investment_collected,
            'left_to_invest' => number_format(
                ($investment->adminInvestment->total_investition - $investment->adminInvestment->collected_to_date),
                2
            ),
            'name' => $investment->adminInvestment->name,
        ];
    }
}
