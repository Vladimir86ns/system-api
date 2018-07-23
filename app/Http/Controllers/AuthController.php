<?php
namespace App\Http\Controllers;

use Redirect;
use Sentinel;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AuthController
{
    /**
     * Before login chose
     *
     * @return View
     */
    public function choseStatus()
    {
        // Show the page
        return view('chose_status');
    }

    /**
     * Logout page and redirect to chose status.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Sentinel::logout(Sentinel::getUser());

        return Redirect::to('/')->with('success', 'You have successfully logged out!');
    }
}
