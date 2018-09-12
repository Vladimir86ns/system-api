<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Investor\InvestorService;
use League\Fractal\Manager as FractalManager;
use App\Services\Investor\InvestorValidationService;
use App\Transformers\Investor\InvestmentTransformer;
use League\Fractal\Resource\Collection as FractalCollection;

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
     * @var InvestmentTransformer
     */
    protected $transform;

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
     * @param InvestmentTransformer $investmentTransformer
     */
    public function __construct(
        InvestorValidationService $investorValidationService,
        InvestorService $investorService,
        FractalManager $fractal,
        InvestmentTransformer $investmentTransformer
    ) {
        $this->validationService = $investorValidationService;
        $this->service = $investorService;
        $this->fractal = $fractal;
        $this->transform = $investmentTransformer;
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

    public function getUserInvestments()
    {
        $allUserInvestments = $this->service->findAllUserInvestments();

        $result = new FractalCollection($allUserInvestments, $this->transform);
        $transformedUserInvestment =  $this->fractal->createData($result)->toArray();

        return view('investor.pages.user_investments', compact([
            'transformedUserInvestment'
        ]));
    }
}
