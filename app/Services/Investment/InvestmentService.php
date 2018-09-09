<?php

namespace App\Services\Investment;

use App\User;
use Sentinel;
use App\Company;
use App\Investment;
use App\AdminInvestment;
use App\Transformers\AdminInvestment\AdminInvestmentTransformer;

class InvestmentService
{
    /**
     * @var AdminInvestmentTransformer
     */
    protected $adminInvestmentTransformer;

    /**
     * InvestmentService
     *
     * @param AdminInvestmentTransformer $adminInvestmentTransformer
     */
    public function __construct(
        AdminInvestmentTransformer $adminInvestmentTransformer
    ) {
        $this->adminInvestmentTransformer = $adminInvestmentTransformer;
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
     * Update investment, company and investition data for investment
     *
     * @param int $id
     * @param array $attributes
     *
     * @return
     */
    public function updateInvestment(int $id, array $attributes, Company $company)
    {
        $investment = $this->getInvestment($id);
        $investment->collected_to_date += $attributes['total_investment'];
        $investment->closed = $investment->total_investition == $investment->collected_to_date;
        $investment->update();

        // update company
        $company->update(['investment_collected' => $investment->collected_to_date]);

        // update user investition
        $this->updateUserInvestmentData($id, $attributes, $investment);

        return $this->adminInvestmentTransformer->transform($this->getInvestment($id));
    }

    /**
     * Update also and user investition data
     *
     * @param int $id
     * @param array $attributes
     * @param AdminInvestment $investment
     *
     * @return
     */
    public function updateUserInvestmentData(
        int $id,
        array &$attributes,
        AdminInvestment $investment
    ) {
        $investment = $this->findInvestmentIfAlreadyHave($id);

        // if user has this investment just update it
        if ($investment) {
            $investment->total_investment += $attributes['total_investment'];
            $investment->update();

            return;
        }

        $newInvestment = $this->findAdminSelectedToInvest($id);

        $user = $this->getUser();
        $attributes['company_id'] = $newInvestment->id;

        $user->investments()->create($attributes);
    }

    /**
     * Find investition if already have
     *
     * @param int $id
     *
     * @return Investment
     */
    public function findInvestmentIfAlreadyHave($id)
    {
        $user = $this->getUser();
        return Investment::where('id', $id)->where('user_id', $user->id)->first();
    }

    /**
     * Find admin investition where want to invest
     *
     * @param int $id
     *
     * @return AdminInvestment
     */
    private function findAdminSelectedToInvest($id)
    {
        return AdminInvestment::where('id', $id)->first();
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
}
