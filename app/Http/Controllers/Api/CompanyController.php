<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\Api\Company\CompanyService;
use App\Transformers\Company\ApiCompanyTransformer;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Collection;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends BaseController
{
    /**
     * @var CompanyService
     */
    protected $service;
    
    /**
     * @var CompanyTransformer
     */
    protected $transformer;
    
    /**
     * @var FractalManager
     */
    protected $fractal;
    
    /**
     * CompanyController constructor.
     */
    public function __construct(
        CompanyService $companyService,
        ApiCompanyTransformer $apiCompanyTransformer,
        FractalManager $fractalManager
    ) {
        $this->service = $companyService;
        $this->transformer = $apiCompanyTransformer;
        $this->fractal = $fractalManager;
    }
    
    public function getAll()
    {
        $result = new Collection($this->service->getAll(), $this->transformer);
        return response($this->fractal->createData($result)->toArray(), Response::HTTP_OK);
    }
}
