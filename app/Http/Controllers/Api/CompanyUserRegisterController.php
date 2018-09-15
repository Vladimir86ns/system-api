<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
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

    public function register(Request $request)
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
        $user->company_pin = Hash::make($inputs['pin']);
        $user->save();
        $transformedUser = $this->companyUserTransformer->transform($user, $token);

        return $this->response->array($transformedUser);
    }

    public function login(Request $request)
    {
        $credentials = $request->all();
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            abort(400, 'Your credentials are not correct!');
        }

        if (!Hash::check($credentials['company_pin'], $user->company_pin)) {
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
}
