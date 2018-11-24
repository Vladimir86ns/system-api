<?php

namespace App\Traits\Company;

use App\Company;
use App\Traits\User\UserTrait;
use Symfony\Component\HttpFoundation\Response;

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
     * Validate Company exist
     *
     * @param int $id Company ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function validateCompanyId($id)
    {
        $this->validateId($id);
        
        $company = Company::find($id);
        
        if (!$company) {
            throw new \Exception(
                "Company ID: {$id} is invalid!",
                Response::HTTP_NOT_FOUND
            );
        }
    }
    
    
    /**
     * Validate User company relatrion.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCompanyFromUserRelation()
    {
        $company = $this->getCompany();

        if ($company) {
            return $company;
        }
        
        throw new \Exception("Company not found!", Response::HTTP_NOT_FOUND);
    }
    
    private function validateId($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Id must be number!", Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
