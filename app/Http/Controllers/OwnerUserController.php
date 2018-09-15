<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\OwnerUserRequest;
use App\Services\Owner\OwnerUserService;
use App\Services\Owner\OwnerUserValidationService;

class OwnerUserController extends Controller
{
    /**
     * @var OwnerUserValidationService
     */
    protected $validationService;

    /**
     * @var OwnerUserService
     */
    protected $userService;

    /**
     * InvestmentController
     *
     */
    public function __construct(
        OwnerUserValidationService $validationUserService,
        OwnerUserService $userService
    ) {
        $this->validationUserService = $validationUserService;
        $this->userService = $userService;
    }

    public function dashboard()
    {
        if (Sentinel::check()) {
            return view('owner.pages.dashboard');
        }

        return view('owner.pages.login')
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
            return redirect('/owner/dashboard');
        }

        return view('owner.pages.login');
    }

    /**
     * Account sign in form processing.
     * @param Request $request
     * @return Redirect
     */
    public function signIn(Request $request)
    {
        if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {
            return redirect('owner/dashboard');
        }

        return redirect('owner/login')
            ->with('error', 'Your email or password are not correct!');
    }

    /**
     * Account owner sign up form processing.
     *
     * @return Redirect
     */
    public function signUp(OwnerUserRequest $request)
    {
        $inputs = $request->all();
        $user = $this->validationUserService->checkUserAlreadyExist($inputs);

        if ($user) {
            return $this->userService->addNewPermissionToUserAndRedirect($user);
        }

        $notAvailable = $this->validationUserService->isEmailAvailable($request->get('email'));

        if ($notAvailable) {
            return view('owner.pages.login')->with('error', trans('auth/message.account_already_exists'));
        }

        try {
            $user = $this->userService->registerAndActivateNewUser($inputs);
            Sentinel::login($user, false);

            return redirect('/owner/dashboard')->with(
                "success",
                "{$user->first_name}, you are registered! Welcome as Owner!"
            );
        } catch (UserExistsException $e) {
            return redirect()->back()->withInput()->withErrors($this->messageBag);
        }
    }
}
