<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeScheduleRequest;
use App\Services\CompanyEmployee\CompanyEmployeeService;
use App\Services\CompanyEmployee\CompanyEmployeeValidationService;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{
    /**
     * @var CompanyEmployeeService
     */
    protected $service;
    
    /**
     * @var CompanyEmployeeValidationService
     */
    protected $validationService;
    
    /**
     * CompanyController
     *
     */
    public function __construct(
        CompanyEmployeeService $companyEmployeeService,
        CompanyEmployeeValidationService $companyEmployeeValidationService
    ) {
        $this->service = $companyEmployeeService;
        $this->validationService = $companyEmployeeValidationService;
    }
    
    /**
     * Get page with form for creating company product category.
     *
     * @return view
     */
    public function getAllCompanyEmployees($id)
    {
        try {
            $this->validationService->validateCompanyId($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
        $allEmployees = $this->service->getAllCompanyEmployees($id);
    
        return view('owner.pages.employee-time', compact('allEmployees'));
    }
    
    /**
     * Save employee to schedule.
     *
     * @param EmployeeScheduleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSchedule(Request $request, $id)
    {
        $inputs = $request->all();
        $employeeIds = $this->service->getAllEmployeeCheckedIds($inputs);
        
        if (empty($employeeIds)) {
            return redirect()->back()->with('error', 'Employee is required!');
        }
        // TODO make validation service to compare value
        // TODO also compare dose employee already has schedule
        
        $this->service->saveSchedule($inputs, $employeeIds, $id);
    
        return redirect()->back()->with('success', 'Employees added to schedule!');
    }
}
