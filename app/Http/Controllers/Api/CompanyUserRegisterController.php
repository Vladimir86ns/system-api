<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
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

        $user->company_pin = bcrypt($inputs['pin']);
        $user->save();
        $transformedUser = $this->companyUserTransformer->transform($user, $token);

        return $this->response->array($transformedUser);
    }
}
