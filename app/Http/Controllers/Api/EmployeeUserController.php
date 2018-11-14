<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EmployeeUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Traits\User\UserTrait;
use App\Traits\User\UserValidationTrait;
use App\Transformers\Employee\EmployeeUserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Response;

class EmployeeUserController extends BaseController
{
    use UserTrait;
    use UserValidationTrait;
    
    const EMPLOYEE_PERMISSION = 'employee';
    
    /**
     * @var EmployeeUserTransformer
     */
    protected $transformer;
    
    public function __construct(
        EmployeeUserTransformer $employeeUserTransformer
    ) {
        $this->transformer = $employeeUserTransformer;
    }
    
    /**
     * Account investor sign up form processing.
     *
     * @return array
     */
    public function signUp(Request $request)
    {
        $inputs = $request->all();
        
        $errors = $this->userCredentialsValidate($inputs, new EmployeeUserRequest());
    
        if ($errors) {
            return response($errors, Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $user = $this->checkUserAlreadyExist($inputs);
        
        if ($user) {
            $token = JWTAuth::fromUser($user);
            $user = $this->addNewPermissionToUser($user, self::EMPLOYEE_PERMISSION);
    
            return response($this->transformer->transform($user, $token), Response::HTTP_OK);
        }

        try {
            $user = $this->registerAddPermissionAndActivateNewUser($inputs, self::EMPLOYEE_PERMISSION);
            $token = JWTAuth::fromUser($user);

            return response($this->transformer->transform($user, $token), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response('User not created', $e->getCode());
        }
    }
    
    /**
     * Sing in user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function signIn(Request $request)
    {
        $errors = $this->userCredentialsValidate($request->all(), new UserLoginRequest());
        
        if ($errors) {
            return response($errors, Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);
            
            return response($this->transformer->transform($user, $token), Response::HTTP_OK);
        };
    
        return response('Credentials are not correct!', Response::HTTP_NOT_ACCEPTABLE);
    }
}
