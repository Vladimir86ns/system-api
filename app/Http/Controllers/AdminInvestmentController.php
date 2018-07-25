<?php

namespace App\Http\Controllers;

class AdminInvestmentController extends Controller
{
    /**
     * Show form for creating a new investments.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investment-admin.create_investment');
    }
}
