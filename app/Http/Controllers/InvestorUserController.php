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
        }

        return view('investor.pages.login')
            ->with('error', 'You must be logged in!');
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignIn()
    {
        if (Sentinel::check()) {
            return redirect('/investor/dashboard');
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
            return view('investor.pages.dashboard');
        }

        return redirect('investor/login')
            ->with('error', 'Your email or password are not correct!');
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

        $notAvailable = $this->validationUserService->isEmailAvailable($request->get('email'));

        if ($notAvailable) {
            return view('investor.pages.login')->with('error', trans('auth/message.account_already_exists'));
        }

        try {
            $user = $this->userService->registerAndActivateNewUser($inputs);
            Sentinel::login($user, false);

            return redirect('/investor/dashboard')->with(
                "success",
                "{$user->first_name}, you are registered! Welcome as Investor!"
            );
        } catch (UserExistsException $e) {
            return redirect()->back()->withInput()->withErrors($this->messageBag);
        }
    }
}
