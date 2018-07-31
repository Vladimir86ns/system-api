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
            $user = Sentinel::getUser();
            $token = JWTAuth::fromUser($user);
        } else {
            abort(400, 'Your email or password are not correct!');
        }

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
            abort(400, 'Your email or pin are not correct!');
        }

        if (Hash::check($credentials['company_pin'], $user->company_pin)) {
            $token = JWTAuth::fromUser($user);
            $transformedUser = $this->companyUserTransformer->transform($user, $token);

            return $this->response->array($transformedUser);
        } else {
            abort(400, 'Your email or pin are not correct!');
        }
    }
}
