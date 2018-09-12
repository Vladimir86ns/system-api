<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Investor\InvestorService;
use App\Services\Investor\InvestorValidationService;
use League\Fractal\Manager as FractalManager;

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
     * @var FractalManager
     */
    protected $fractal;

    /**
     * InvestmentController
     *
     * @param InvestorValidationService $investorValidationService
     * @param InvestorService $investorService
     * @param FractalManager $fractal
     */
    public function __construct(
        InvestorValidationService $investorValidationService,
        InvestorService $investorService,
        FractalManager $fractal
    ) {
        $this->validationService = $investorValidationService;
        $this->service = $investorService;
        $this->fractal = $fractal;
    }

    /**
     * Get all investments for given country
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFromCountry($country)
    {
        $allInvestments = $this->service->getAllApprovedForGivenCountry($country);
        $transformedAllInvestments = $this->service->getAllFromTransformer($allInvestments);

        return view('investor.pages.find_all_investments', compact(['transformedAllInvestments']));
    }

    /**
     * Get all investments and selected investments
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAndSelected($country, $id)
    {
        $allInvestments = $this->service->getAllApprovedForGivenCountry($country);
        $transformedAllInvestments = $this->service->getAllFromTransformer($allInvestments);

        $investment = $this->service->getInvestment($id);
        $transformedSingleInvestment = $this->service->getSingleFromTransformer($investment);

        return view(
            'investor.pages.find_all_investments',
            compact(['transformedAllInvestments', 'transformedSingleInvestment'])
        );
    }

    public function  getUserInvestments()
    {
      $allUserInvestments = $this->service->findAllUserInvestments();

      return view('investor.pages.user_investments', compact([
        'transformedAdminInvestments',
        'transformedInvestment',
        'pie'
      ]));
    }
}
