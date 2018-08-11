<?php

namespace App\Services\Investment;

use App\User;
use App\Services\Investment\InvestmentService;

class InvestmentValidationService
{
    /**
     * @var InvestmentService
     */
    protected $investmentService;

    /**
     * InvestmentValidationService
     *
     * @param InvestmentService $investmentService
     */
    public function __construct(
        InvestmentService $investmentService
    ) {
        $this->investmentService = $investmentService;
    }

    /**
     * Check dose investment is less then total amount to pay of investition
     *
     * @param number $totalInvestment
     * @param int $id
     */
    public function validateInvest(int $totalInvestment, int $id)
    {
        $error = [];
        $adminInvestment = $this->investmentService->getInvestment($id);

        if (!$adminInvestment) {
            $error['total_investment'] = "Invalid ID!";
        }

        $sumToPayOff = $adminInvestment->total_investition - $adminInvestment->collected_to_date;

        if ($sumToPayOff < $totalInvestment) {
            $formated = number_format($sumToPayOff, 2);
            $error['total_investment'] = "You can't invest more then {$formated}.";
        }

        return $error;
    }
}
