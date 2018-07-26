<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminInvestmentCreateRequest;
use App\Services\AdminInvestment\AdminInvestmentService;

class AdminInvestmentController extends Controller
{
    /**
     * @var AdminInvestmentService
     */
    protected $service;

    /**
     * InvestmentController
     *
     */
    public function __construct(
        AdminInvestmentService $service
    ) {
        $this->service = $service;
    }

    /**
     * Show form for creating a new investments.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investment-admin.create_investment');
    }

    /**
     * Save in DB new investment.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminInvestmentCreateRequest $request)
    {
        $inputs = $request->all();

        $this->service->storeInvestment($inputs);

        return redirect('/investment-admin/get-all-investments')
            ->with('success', 'Created new investments successfully!');
    }

    /**
     * Get all investment
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllInvestments()
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected and edit investment is not included
        $transformedInvestment = null;
        $editInvestment = null;

        return view('investment-admin.all_investment', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

}
