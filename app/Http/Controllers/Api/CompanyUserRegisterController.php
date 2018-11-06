<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use JWTAuth;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Transformers\Company\CompanyUserTransformer;

class CompanyUserRegisterController extends BaseController
{
    
    /**
     * @var CompanyUserTransformer
     */
    protected $companyUserTransformer;

    public function __construct(
        CompanyUserTransformer $companyUserTransformer
    ) {
        $this->companyUserTransformer = $companyUserTransformer;
    }

    public function registerCompany(Request $request)
    {
        $inputs = $request->all();

        if ($inputs['pin'] !== $inputs['repeat_pin']) {
            abort(400, 'Pin should be the same!');
        }

        if (Sentinel::authenticate($request->only(['email', 'password']))) {
            $user = User::find(Sentinel::getUser()->id);
        } else {
            abort(400, 'Your email or password are not correct!');
        }

        $permissions = json_decode($user->permissions, true);

        // check dose user has owner permissions
        if (!array_key_exists('owner', $permissions) || $permissions['owner'] == 0) {
            abort(400, 'Your are not authorized!');
        }

        $token = JWTAuth::fromUser($user);
        $user->owner_company_password = Hash::make($inputs['pin']);
        $user->save();
        $transformedUser = $this->companyUserTransformer->transform($user, $token);

        return $this->response->array($transformedUser);
    }

    public function loginCompany(Request $request)
    {
        $credentials = $request->all();
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            abort(400, 'Your credentials are not correct!');
        }

        if (!Hash::check($credentials['owner_company_password'], $user->owner_company_password)) {
            abort(400, 'Your credentials are not correct!');
        }

        $permissions = json_decode($user->permissions, true);

        if (!array_key_exists('owner', $permissions) || $permissions['owner'] == 0) {
            abort(400, 'Your are not authorized!');
        }

        $token = JWTAuth::fromUser($user);
        $transformedUser = $this->companyUserTransformer->transform($user, $token);

        return $this->response->array($transformedUser);
    }
    
    public function registerEmployee(Request $request)
    {
        $inputs = $request->all();

        if ($inputs['employee_password'] !== $inputs['repeat_employee_password']) {
            abort(400, 'Passwords should be the same!');
        }
        
        if (Sentinel::authenticate($request->only(['email', 'password']))) {
            $user = User::find(Sentinel::getUser()->id);
        } else {
            abort(400, 'Your email or password are not correct!');
        }

        $permissions = json_decode($user->permissions, true);

        // check dose user has owner permissions
        if (!array_key_exists('employee', $permissions) || $permissions['employee'] == 0) {
            abort(400, 'Your are not authorized!');
        }
    
        $dt = Carbon::now('Europe/Belgrade');
        $dt->addHours(8);
        
        $token = JWTAuth::fromUser($user, ['exp' => $dt->timestamp]);
        $user->employee_company_password = Hash::make($inputs['employee_password']);
        $user->save();
        $transformedUser = $this->companyUserTransformer->transform($user, $token);
        
        return $this->response->array($transformedUser);
    }
    
    public function loginEmployee(Request $request)
    {
        $credentials = $request->all();
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            abort(400, 'Your credentials are not correct!');
        }
        
        if (!Hash::check($credentials['employee_company_password'], $user->employee_company_password)) {
            abort(400, 'Your credentials are not correct!');
        }
        
        $permissions = json_decode($user->permissions, true);
        
        if (!array_key_exists('employee', $permissions) || $permissions['employee'] == 0) {
            abort(400, 'Your are not authorized!');
        }
        
        $token = JWTAuth::fromUser($user);
        $transformedUser = $this->companyUserTransformer->transform($user, $token);
        
        return $this->response->array($transformedUser);
    }
}
