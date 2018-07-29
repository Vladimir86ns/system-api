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
     * @return redirect
     */
    public function create()
    {
        return view('investment-admin.pages.create_investment');
    }

    /**
     * Save in DB new investment.
     *
     * @param  App\Http\Requests\AdminInvestmentService
     * @return redirect
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
     * @return redirect
     */
    public function getAllInvestments()
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected and edit investment is not included
        $transformedInvestment = null;
        $editInvestment = null;

        return view('investment-admin.pages.all_investment', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Show the form for editing investment.
     *
     * @param int $id Investment ID
     * @return redirect
     */
    public function edit($id)
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();
        $editInvestment = $this->service->getInvestment($id);

        // selected investment is not included
        $transformedInvestment = null;

        return view('investment-admin.pages.all_investment', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Update investment.
     *
     * @param App\Http\Requests\AdminInvestmentService
     * @param int $id Investment ID
     * @return redirect
     */
    public function update(AdminInvestmentCreateRequest $request, $id)
    {
        $inputs = $request->except(['_token', 'btnSubmit']);
        $this->service->updateInvestment($inputs, $id);

        return redirect('/investment-admin/get-all-investments')
            ->with('success', 'Updated investment successfully!');
    }

    /**
     * Get all investments and selected investment.
     *
     * @param $id Investment ID
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included
        $transformedInvestment = $this->service->getInvestmentFromTransformer($id);

        // edit investment is not included
        $editInvestment = null;

        return view('investment-admin.pages.all_investment', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Reject or delete investment
     *
     * @param int $id Investment ID
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $this->service->reject($id);

        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included and check is maybe deleted
        $transformedInvestment = false;
        $investment = $this->service->getInvestment($id);
        if ($investment) {
            $transformedInvestment = $this->service->getInvestmentFromTransformer($id);
        }

        // edit investment is not included
        $editInvestment = null;

        return view('investment-admin.pages.all_investment', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

        /**
     * Reject or delete investment
     *
     * @param int $id Investment ID
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $isDeleted = $this->service->delete($id);

        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included and check is maybe deleted
        $transformedInvestment = false;
        $investment = $this->service->getInvestment($id);
        if ($investment) {
            $transformedInvestment = $this->service->getInvestmentFromTransformer($id);
        }

        // edit investment is not included
        $editInvestment = null;

        if (!$isDeleted) {
            return back()->with('error', 'Id of investment is invalid!');
        }

        return redirect('/investment-admin/get-all-investments')
            ->with('success', 'You jut deleted investment successfully!');
    }

    /**
     * Approve investment
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function approveOrUnApprove($id)
    {
        $this->service->approveOrUnApprove($id);

        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included
        $transformedInvestment = $this->service->getInvestmentFromTransformer($id);

        // edit investment is not included
        $editInvestment = null;

        return view('investment-admin.pages.all_investment', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Before confirm investments fill up with more data
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function beforeConfirm($id)
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();
        $editInvestment = $this->service->getInvestment($id);
        $allOwners = $this->service->getAllOwners();

        // selected investment is not included
        $transformedInvestment = null;

        return view('investment-admin.before-production.selected', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            'allOwners'
        ]));
    }
}
