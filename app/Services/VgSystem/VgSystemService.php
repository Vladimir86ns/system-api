<?php

namespace App\Services\VgSystem;

use App\VgSystem;
use App\Transformers\VgSystem\VgSystemTransformer;
use App\Services\AdminInvestment\AdminInvestmentService;

class VgSystemService
{
    /**
     * @var VgSystemTransformer
     */
    protected $transformer;

    /**
     * @var AdminInvestmentService
     */
    protected $adminInvestmentService;

    /**
     * VgSystem Controller
     *
     * @param VgSystemTransformer $vgSystemTransformer
     */
    public function __construct(
        VgSystemTransformer $vgSystemTransformer,
        AdminInvestmentService $adminInvestmentService
    ) {
        $this->transformer = $vgSystemTransformer;
        $this->adminInvestmentService = $adminInvestmentService;
    }

    /**
     * Get Vg System.
     *
     * @return VgSystem
     */
    public function getVgSystem()
    {
        return VgSystem::find(1);
    }

    /**
     * Get Vg System from transformer.
     *
     * @return VgSystem
     */
    public function getVgSystemFromTransformer()
    {
        return $this->transformer->transform($this->getVgSystem());
    }

    /**
     * Update vg system.
     *
     */
    public function updateVgSystem()
    {
        $allAdminInvestmentSum = $this->adminInvestmentService->getSumAdminInvestment();
        $vgSystem = $this->getVgSystem();

        $vgSystem->update([
            'total_investitions' => $allAdminInvestmentSum['total_investments'],
            'collected_to_date' => $allAdminInvestmentSum['total_collected_to_date'],
        ]);
    }
}
