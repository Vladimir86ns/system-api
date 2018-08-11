<?php

namespace App\Services\Investor;

use App\AdminInvestment;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Manager as FractalManager;
use App\Transformers\AdminInvestment\AdminInvestmentTransformer;

class InvestorService
{
    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * @var AdminInvestmentTransformer
     */
    protected $adminInvestmentTransformer;

    /**
     * InvestmentController
     *
     * @param FractalManager $fractalManager
     * @param AdminInvestmentTransformer $adminInvestmentTransformer
     */
    public function __construct(
        FractalManager $fractalManager,
        AdminInvestmentTransformer $adminInvestmentTransformer
    ) {
        $this->fractal = $fractalManager;
        $this->adminInvestmentTransformer = $adminInvestmentTransformer;
    }

    /**
     * Get investment
     *
     * @param int $id
     */
    public function getInvestment(int $id)
    {
        return AdminInvestment::find($id);
    }

    /**
     * Get all investments for given country where status approved
     *
     * @param string $country
     */
    public function getAllApprovedForGivenCountry(string $country)
    {
        return AdminInvestment::where('country', $country)
            ->where('status', AdminInvestment::APPROVED)
            ->where('on_production', 1)
            ->get();
    }

    /**
     * Get all investments from transformer
     *
     * @param Collection $adminInvestments
     */
    public function getAllFromTransformer(Collection $adminInvestments)
    {
        $result = new FractalCollection($adminInvestments, $this->adminInvestmentTransformer);

        return $this->fractal->createData($result)->toArray();
    }

    /**
     * Get single investment from transformer
     *
     * @param AdminInvestment $adminInvestments
     */
    public function getSingleFromTransformer(AdminInvestment $adminInvestment)
    {
        return $this->adminInvestmentTransformer->transform($adminInvestment);
    }
}
