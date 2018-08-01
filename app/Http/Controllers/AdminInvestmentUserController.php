<?php

namespace App\Http\Controllers;

use Redirect;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\AdminInvestmentUserRequest;
use App\Services\AdminInvestment\AdminInvestmentUserService;
use App\Services\AdminInvestment\AdminInvestmentUserValidationService;

class AdminInvestmentUserController extends Controller
{
    /**
     * @var AdminInvestmentUserValidationService
     */
    protected $validationUserService;

    /**
     * @var AdminInvestmentUserService
     */
    protected $userService;

    /**
     * InvestmentController
     *
     */
    public function __construct(
        AdminInvestmentUserValidationService $validationUserService,
        AdminInvestmentUserService $userService
    ) {
        $this->validationUserService = $validationUserService;
        $this->userService = $userService;
    }

    public function dashboard()
    {
        if (Sentinel::check()) {
            return view('investment-admin.pages.dashboard');
        }

        return view('investment-admin.pages.login')->with('error', 'You must be logged in!');
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

        return view('investment-admin.pages.login');
    }

    /**
     * Account admin investment sign up form processing.
     *
     * @return Redirect
     */
    public function signUp(AdminInvestmentUserRequest $request)
    {
        $inputs = $request->all();
        $user = $this->userService->checkUserAlreadyExist($inputs);

        if ($user) {
            return $this->userService->addNewPermissionToUserAndRedirect($user);
        }

        $available = $this->validationUserService->isEmailAvailable($request->get('email'));

        if ($available) {
            return view('investment-admin.pages.login')->with('error', trans('auth/message.account_already_exists'));
        }

        try {
            $user = $this->userService->registerAndActivateNewUser($inputs);
            Sentinel::login($user, false);

            return Redirect::to('/investment-admin/dashboard')->with(
                "success",
                "{$user->first_name}, you are registered! Welcome as Investment Admin!"
            );
        } catch (UserExistsException $e) {
            return Redirect::back()->withInput()->withErrors($this->messageBag);
        }
    }

    /**
     * Account sign in form processing.
     * @param Request $request
     * @return Redirect
     */
    public function signIn(Request $request)
    {
        if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {

            return view('investment-admin.pages.dashboard');
        }

        return redirect('investment-admin/login')
            ->with('error', 'Your email or password are not correct!');
    }
}
