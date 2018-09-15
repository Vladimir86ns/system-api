<?php

namespace App\Services\VgSystemSharing;

use App\User;
use App\VgSystem;
use App\Services\VgSystem\VgSystemService;
use App\Transformers\VgSystem\VgSystemTransformer;

class VgSystemSharingService
{
    /**
     * @var VgSystemService
     */
    protected $vgSystemService;

    /**
     * VgSystem Controller
     *
     * @param VgSystemService $vgSystemService
     */
    public function __construct(
        VgSystemService $vgSystemService
    ) {
        $this->vgSystemService = $vgSystemService;
    }

    public function updateOrCreateVgSystemSharing(User $user)
    {
        $vgSystemSharing = $user->vgSystemSharing;

        if ($vgSystemSharing) {
            return $vgSystemSharing->update([
                'total_invested' => $user->investments->sum('total_investment'),
                'percent_of_income' => $this->getPercentage($user->investments->sum('total_investment'))
            ]);
        }

        return $user->vgSystemSharing()->create([
            'total_invested' => $user->investments->sum('total_investment'),
            'percent_of_income' => $this->getPercentage($user->investments->sum('total_investment'))
        ]);
    }

    /**
     * Get percentage how much investor invested in vg System
     *
     * @param float $totalAmountInvestorInvested
     * @return float
     */
    private function getPercentage(float $totalAmountInvestorInvested)
    {
        $vgSystem = $this->vgSystemService->getVgSystem();
        return $totalAmountInvestorInvested / $vgSystem['total_investitions'] * 100;
    }
}
