<?php

namespace App\Traits\Company;

use App\Traits\User\UserTrait;

trait CompanyValidationTrait
{
    use UserTrait;

    /**
     * Validate Company exist
     *
     * @param int $id Company ID
     * @return \Company
     */
    public function getAndValidateCompanyId($id)
    {
        $this->validateId($id);

        $company = Company::find($id);

        if ($company) {
            return $company;
        }

        abort(404, "Company ID: {$id} is invalid!");
    }

    /**
     * Validate User company relatrion.
     *
     * @return \Company
     */
    public function getCompanyFromUserRelation()
    {
        $company = $this->getCompany();

        if ($company) {
            return $company;
        }

        abort(404, "Company not found!");
    }
}
