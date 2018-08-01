<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\InvestorUserRequest;
use App\Services\Investor\InvestorUserValidationService;
use App\Services\Investor\InvestorUserService;

class InvestorUserController extends Controller
{
    /**
     * @var InvestorUserValidationService
     */
    protected $validationService;

    /**
     * @var InvestorUserService
     */
    protected $userService;

    /**
     * InvestmentController
     *
     */
    public function __construct(
        InvestorUserValidationService $validationUserService,
        InvestorUserService $userService
    ) {
        $this->validationUserService = $validationUserService;
        $this->userService = $userService;
    }

    public function dashboard()
    {
        if (Sentinel::check()) {
            return view('investor.pages.dashboard');
        } else {
            return view('investor.pages.login')->with('error', 'You must be logged in!');
        }
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignIn()
    {
        if (Sentinel::check()) {
            return redirect('/investment-admin/dashboard');
        }

        return view('investor.pages.login');
    }

    /**
     * Account sign in form processing.
     * @param Request $request
     * @return Redirect
     */
    public function signIn(Request $request)
    {
        if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {
            // Redirect to the dashboard page
            return view('investor.pages.dashboard');
        } else {
            return Redirect::to('investor/login')->with('error', 'Your email or password are not correct!');
        }
    }

    /**
     * Account investor sign up form processing.
     *
     * @return Redirect
     */
    public function signUp(InvestorUserRequest $request)
    {
        $inputs = $request->all();
        $user = $this->validationUserService->checkUserAlreadyExist($inputs);

        if ($user) {
            return $this->userService->addNewPermissionToUserAndRedirect($user);
        }

        $available = $this->validationUserService->isEmailAvailable($request->get('email'));

        if ($available) {
            return view('investor.pages.login')->with('error', trans('auth/message.account_already_exists'));
        }

        try {
            $user = $this->userService->registerAndActivateNewUser($inputs);
            Sentinel::login($user, false);

            return redirect()->to('/investor/dashboard')->with(
                "success",
                "{$user->first_name}, you are registered! Welcome as Investor!"
            );
        } catch (UserExistsException $e) {
            return redirect()->back()->withInput()->withErrors($this->messageBag);
        }
    }
}
