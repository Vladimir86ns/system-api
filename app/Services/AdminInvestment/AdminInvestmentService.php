<?php

namespace App\Services\AdminInvestment;

use App\AdminInvestment;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager as FractalManager;
use App\Transformers\AdminInvestment\AdminInvestmentTransformer;

class AdminInvestmentService
{
    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * @var AdminInvestmentTransformer
     */
    protected $transformer;

    /**
     * InvestmentsAdminController
     *
     * @param FractalManager $fractal
     */
    public function __construct(
        FractalManager $fractalManager,
        AdminInvestmentTransformer $adminInvestmentTransformer
    ) {
        $this->fractal = $fractalManager;
        $this->transformer = $adminInvestmentTransformer;
    }

    /**
     * Get all investments
     *
     * @return AdminInvestment
     */
    public function getAll()
    {
        return AdminInvestment::get();
    }

    /**
     * Store new investments in DB
     *
     * @param array $attributes
     */
    public function storeInvestment(array &$attributes)
    {
        $attributes['status'] = AdminInvestment::PENDING;

        return AdminInvestment::create(array_except($attributes, ['token']));
    }

    public function getAllInvestmentsFromTransformer()
    {
        $result = new Collection($this->getAll(), $this->transformer);

        return $this->fractal->createData($result)->toArray();
    }
}
