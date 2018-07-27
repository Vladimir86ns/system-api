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
     * Get single investment
     *
     * @param int $id Investment ID
     * @return AdminInvestment
     */
    public function getInvestment($id)
    {
        return AdminInvestment::find($id);
    }

    /**
     * Store new investments in DB
     *
     * @param array $attributes
     * @return AdminInvestment
     */
    public function storeInvestment(array &$attributes)
    {
        $attributes['status'] = AdminInvestment::PENDING;

        return AdminInvestment::create(array_except($attributes, ['token']));
    }


    /**
     * Get all investment from transformer
     *
     * @return array AdminInvestment
     */
    public function getAllInvestmentsFromTransformer()
    {
        $result = new Collection($this->getAll(), $this->transformer);

        return $this->fractal->createData($result)->toArray();
    }

    /**
     * Update investment
     *
     * @param array $attributes
     * @param int $id
     * @return AdminInvestment
     */
    public function updateInvestment(array $attributes, int $id)
    {
        AdminInvestment::where('id', $id)->update($attributes);
    }
}
