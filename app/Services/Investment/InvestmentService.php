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
     * @param int $id AdminInvestmentID
     * @param array $attributes
     *
     * @return
     */
    public function updateInvestment(int $id, array $attributes, Company $company)
    {
        $adminInvestment = $this->getInvestment($id);
        $adminInvestment->collected_to_date += $attributes['total_investment'];
        $adminInvestment->closed = $adminInvestment->total_investition == $adminInvestment->collected_to_date;
        $adminInvestment->update();

        // update company
        $company->update(['investment_collected' => $adminInvestment->collected_to_date]);

        // update user investition
        $this->updateUserInvestmentData($id, $attributes, $adminInvestment);

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
        AdminInvestment $adminInvestment
    ) {
        $investment = $this->findInvestmentIfAlreadyHave($adminInvestment->id);

        // if user has this investment just update it
        if ($investment) {
            $investment->total_investment += $attributes['total_investment'];

            // save percentage
            $investment->percent_of_income = $this->getPercentage(
                $investment->total_investment,
                $adminInvestment->total_investition
            );

            $investment->update();

            return;
        }


        $user = $this->getUser();

        // append company id and percentage
        $attributes['company_id'] = $adminInvestment->companies->id;
        $attributes['admin_investment_id'] = $adminInvestment->id;
        $attributes['percent_of_income'] = $this->getPercentage(
            $attributes['total_investment'],
            $adminInvestment->total_investition
        );

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
        $user = $this->getUser();
        return Investment::where('admin_investment_id', $adminInvestmentId)
            ->where('user_id', $user->id)
            ->first();
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
}
