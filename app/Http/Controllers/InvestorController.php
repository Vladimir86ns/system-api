<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Investor\InvestorService;
use App\Services\Investor\InvestorValidationService;

class InvestorController extends Controller
{
    /**
     * @var InvestorValidationService
     */
    protected $validationService;

    /**
     * @var InvestorService
     */
    protected $service;

    /**
     * InvestmentController
     *
     */
    public function __construct(
        InvestorValidationService $investorValidationService,
        InvestorService $investorService
    ) {
        $this->validationService = $investorValidationService;
        $this->service = $investorService;
    }

    /**
     * Get all investments for given country
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFromCountry($country)
    {
        $allInvestments = $this->service->getAllApprovedForGivenCountry($country);
        $transformedInvestments = $this->service->getFromTransformer($allInvestments);

        return view('investor.pages.find_all_investments', compact(['transformedInvestments']));
    }
}
