<?php

namespace App\Services\Investment;

use App\User;
use Sentinel;
use App\Company;
use App\Investment;
use App\AdminInvestment;
use App\VgSystemSharing;
use App\Services\VgSystem\VgSystemService;
use App\Services\VgSystemSharing\VgSystemSharingService;
use App\Transformers\AdminInvestment\AdminInvestmentTransformer;

class InvestmentService
{
    /**
     * @var AdminInvestmentTransformer
     */
    protected $adminInvestmentTransformer;

    /**
     * @var vgSystemService
     */
    protected $vgSystemService;

    /**
     * @var vgSystemSharingService
     */
    protected $vgSystemSharingService;

    /**
     * InvestmentService
     *
     * @param VgSystemService $vgSystemService
     * @param AdminInvestmentTransformer $adminInvestmentTransformer
     * @param VgSystemSharingService $vgSystemSharingService
     */
    public function __construct(
        VgSystemService $vgSystemService,
        AdminInvestmentTransformer $adminInvestmentTransformer,
        VgSystemSharingService $vgSystemSharingService
    ) {
        $this->adminInvestmentTransformer = $adminInvestmentTransformer;
        $this->vgSystemService = $vgSystemService;
        $this->vgSystemSharingService = $vgSystemSharingService;
    }

    /**
     * Get single investment
     *
     * @param FractalManager $fractal
     */
    public function getInvestment($id)
    {
        return AdminInvestment::find($id);
    }

    /**
     * Create or update investment if already has, and
     * update admin investment,company for investment.
     *
     * @param int $id AdminInvestmentID
     * @param array $attributes
     *
     * @return
     */
    public function invest(int $id, array $attributes, Company $company)
    {
        $adminInvestment = $this->updateAdminInvestment($id, $attributes);
        $this->updateCompanyInvestmentCollected($company, $adminInvestment);
        $this->updateOrCreateUserInvestment($attributes, $adminInvestment);
        $this->updateVgSystem();
        $this->updateOrCreateVgSystemSharing($this->getUser());

        return $this->adminInvestmentTransformer->transform($adminInvestment);
    }

    /**
     * Update or create user investments, update admin investment
     * and company collected investment.
     *
     * @param array $attributes
     * @param AdminInvestment $investment
     *
     * @return
     */
    public function updateOrCreateUserInvestment(
        array &$attributes,
        AdminInvestment $adminInvestment
    ) {
        $investment = $this->findInvestmentIfAlreadyHave($adminInvestment->id);

        // if user has this investment just update it
        if ($investment) {
            $investment->total_investment += $attributes['total_investment'];

            // save percentage
            $investment->percentage = $this->getPercentage(
                $investment->total_investment,
                $adminInvestment->total_investition
            );

            return $investment->update();
        }

        $attributes = $this->prepareAttributes($attributes, $adminInvestment);
        $user = $this->getUser();

        $user->investments()->create($attributes);
    }

    /**
     * Find investition if already have
     *
     * @param int $id AdminInvestmentID
     *
     * @return Investment
     */
    public function findInvestmentIfAlreadyHave($adminInvestmentId)
    {
        return Investment::where('admin_investment_id', $adminInvestmentId)
            ->where('user_id', $this->getUser()->id)
            ->first();
    }

    /**
     * Get logged in user
     *
     * @return User
     */
    private function getUser()
    {
        return User::find(Sentinel::getUser()->id);
    }

    /**
     * Get company by id
     *
     * @param int $companyId CompanyID
     * @return Company
     */
    public function getCompany(int $companyId)
    {
        return Company::find($companyId);
    }

    /**
     * Get percentage how much for investition.
     *
     * @param float $investedAmount
     * @param float $totalAmount
     * @return float
     */
    private function getPercentage(float $investedAmount, float $totalAmount)
    {
        return $investedAmount / $totalAmount * 100;
    }

    /**
     * Append attributes for investition.
     *
     * @param array $attributes
     * @param AdminInvestment $adminInvestment
     * @return array
     */
    private function prepareAttributes(array &$attributes, AdminInvestment $adminInvestment)
    {
        $attributes['company_id'] = $adminInvestment->companies->id;
        $attributes['admin_investment_id'] = $adminInvestment->id;
        $attributes['percentage'] = $this->getPercentage(
            $attributes['total_investment'],
            $adminInvestment->total_investition
        );

        return $attributes;
    }

    /**
     * Update admin investment.
     *
     * @param int $adminInvestmentId
     * @param array $attributes
     * @return AdminInvestment
     */
    private function updateAdminInvestment(int $adminInvestmentId, array $attributes)
    {
        $adminInvestment = $this->getInvestment($adminInvestmentId);
        $adminInvestment->collected_to_date += $attributes['total_investment'];
        $adminInvestment->closed = $adminInvestment->total_investition == $adminInvestment->collected_to_date;
        $adminInvestment->update();

        return $adminInvestment;
    }

    /**
     * Update company investment collected.
     *
     * @param Company $company
     * @param AdminInvestment $adminInvestment
     */
    private function updateCompanyInvestmentCollected(Company $company, AdminInvestment $adminInvestment)
    {
        $company->update(['investment_collected' => $adminInvestment->collected_to_date]);
    }

    /**
     * Update vg system.
     *
     */
    private function updateVgSystem()
    {
        $this->vgSystemService->updateVgSystem();
    }

    private function updateOrCreateVgSystemSharing(User $user)
    {
        $this->vgSystemSharingService->updateOrCreateVgSystemSharing($user);
    }
}
