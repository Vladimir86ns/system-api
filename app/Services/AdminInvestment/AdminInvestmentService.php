<?php

namespace App\Services\AdminInvestment;

use App\User;
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

    /**
     * Get single investment
     *
     * @param id $id Investment ID
     * @return array
     */
    public function getInvestmentFromTransformer($id)
    {
        return $this->transformer->transform($this->getInvestment($id));
    }

    /**
     * Rejected investment
     *
     * @param array $attributes
     */
    public function reject(int $id)
    {
        $investmentsAdmin = $this->getInvestment($id);
        $investmentsAdmin->update(['status' => AdminInvestment::REJECTED]);
    }

    /**
     * Delete investment
     *
     * @param array $attributes
     */
    public function delete(int $id)
    {
        $investmentsAdmin = AdminInvestment::find($id);

        if ($investmentsAdmin) {
            $investmentsAdmin = AdminInvestment::where('id', $id)->delete();
        }

        return $investmentsAdmin;
    }


    /**
     * Approve investment
     *
     * @param array $attributes
     */
    public function approveOrUnApprove(int $id)
    {
        $investmentsAdmin = $this->getInvestment($id);

        if ($investmentsAdmin['status'] === AdminInvestment::APPROVED ||
            $investmentsAdmin['status'] === AdminInvestment::REJECTED
        ) {
            $investmentsAdmin->update(['status' => AdminInvestment::PENDING]);
        } elseif ($investmentsAdmin['status'] === AdminInvestment::PENDING ||
            $investmentsAdmin['status'] === AdminInvestment::REJECTED
        ) {
            $investmentsAdmin->update(['status' => AdminInvestment::APPROVED]);
        }
    }


    /**
     * Save investment in DB
     *
     * @param array $attributes
     * @param App\AdminInvestment
     * @param int $id
     */
    public function createProject(array &$attributes, AdminInvestment $investmentsAdmin)
    {
        if ($investmentsAdmin['on_production']) {
            return false;
        }

        $attributes['total_amount_investment'] = $investmentsAdmin->total_investition;

        $investmentsAdmin->companies()->create($attributes);
        $investmentsAdmin->on_production = true;
        $investmentsAdmin->update();

        return $investmentsAdmin->on_production;
    }

    /**
     * Get all owners
     *
     * @return User
     */
    public function getAllOwners()
    {
        return User::all()->filter(function ($value) {
            $permissions = json_decode($value->permissions, true);
            if (!array_has($permissions, 'owner')) {
                return;
            }

            if ($permissions['owner'] == 1) {
                return $value;
            }
        })->toArray();
    }

    /**
     * Get sum of total_investition and collected_to_date.
     *
     * @return User
     */
    public function getSumAdminInvestment()
    {
        // TODO need to write one sql later on.

        return [
            'total_investments' => AdminInvestment::sum('total_investition'),
            'total_collected_to_date' => AdminInvestment::sum('collected_to_date')
        ];
    }
}
