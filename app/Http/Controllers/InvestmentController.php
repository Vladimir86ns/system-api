<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\Investment\InvestmentService;
use App\Services\Investment\InvestmentValidationService;

class InvestmentController extends Controller
{
    /**
     * @var InvestmentValidationService
     */
    protected $validationService;

    /**
     * @var InvestmentService
     */
    protected $service;

    /**
     * InvestmentController
     *
     */
    public function __construct(
        InvestmentValidationService $investmentValidationService,
        InvestmentService $investmentService
    ) {
        $this->validationService = $investmentValidationService;
        $this->service = $investmentService;
    }

    public function invest(Request $request, $id)
    {
        $request->validate([
            'total_investment' => 'required|numeric'
        ]);
        $attributes = $request->all();

        $error = $this->validationService->validateInvest($attributes['total_investment'], $id);

        if ($error) {
            return Redirect::back()->with('error', $error['total_investment']);
        }

        $investment = $this->service->updateInvestment($id, $attributes);

        $formated = number_format($attributes['total_investment'], 2);

        return Redirect::back()->with(
            "success",
            "You just invested {$formated} in {$investment['name']}."
        );
    }
}
