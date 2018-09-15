<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Investor\InvestorService;
use App\Services\VgSystem\VgSystemService;
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
     * @var VgSystemService
     */
    protected $vgSystemService;

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
     * @param VgSystemService $vgSystemService
     */
    public function __construct(
        InvestorValidationService $investorValidationService,
        InvestorService $investorService,
        FractalManager $fractal,
        InvestmentTransformer $investmentTransformer,
        VgSystemService $vgSystemService
    ) {
        $this->validationService = $investorValidationService;
        $this->service = $investorService;
        $this->fractal = $fractal;
        $this->transform = $investmentTransformer;
        $this->vgSystemService = $vgSystemService;
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
        $transformedVgSystem = $this->vgSystemService->getVgSystemFromTransformer();

        return view(
            'investor.pages.find_all_investments',
            compact(['transformedAllInvestments', 'transformedVgSystem'])
        );
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

        $transformedVgSystem = $this->vgSystemService->getVgSystemFromTransformer();

        return view(
            'investor.pages.find_all_investments',
            compact(['transformedAllInvestments', 'transformedSingleInvestment', 'transformedVgSystem'])
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
