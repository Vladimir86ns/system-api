<?php

namespace App\Http\Controllers;

use App\Services\Owner\OwnerService;
use App\Services\Owner\OwnerValidationService;
use Illuminate\Http\Request;
use App\Traits\User\UserTrait;
use Illuminate\Support\Facades\Redirect;

class OwnerController extends Controller
{
    use UserTrait;

    /**
     * @var FractalManager
     */
    protected $service;

	/**
	 * @var OwnerValidationService
	 */
	protected $validation;

    /**
     * OwnerController
     *
     * @param OwnerService $ownerService
     * @param OwnerValidationService $ownerValidationService
     */
    public function __construct(
        OwnerService $ownerService,
		OwnerValidationService $ownerValidationService
    ) {
        $this->service = $ownerService;
        $this->validation = $ownerValidationService;
    }

	/**
	 * Get page with form for creating company product category.
	 *
	 * @return view
	 */
    public function createProductCategory()
    {
        return  view('owner.pages.product-category');
    }

	/**
	 * Store new company product category in DB.
	 *
	 * @return view
	 */
    public function storeProductCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
        ]);

        $company = $this->validation->getCompanyFromUserRelation();
        $newProduct = $this->service->store($request->all(), $company);

        if ($newProduct) {
	        return redirect('/owner/create-product-category')
		        ->with("error", "Something went wrong!");
        }

	    return redirect('/owner/create-product-category')
		    ->with("success", "A new product category {$newProduct->name} is successfully added!");
    }
}
