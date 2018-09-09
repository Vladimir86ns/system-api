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

    /**
     * Validate Company exist
     *
     * @param int $id Company ID
     * @return \Company
     */
    public function getAndValidateCompany(int $id)
    {
        $this->validateId($id);

        $company = $this->investmentService->getCompany($id);

        if ($company) {
            return $company;
        }

        abort(404, "Company ID: {$id} is invalid!");
    }

    /**
     * Validate id is integer
     *
     * @param int $id
     */
    private function validateId($id)
    {
        if (!is_int($id)) {
            abort(404, "Id must be a number!");
        }
    }
}
