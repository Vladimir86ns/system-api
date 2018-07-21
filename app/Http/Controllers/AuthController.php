<?php namespace App\Http\Controllers;

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
        return view('before_login');
    }
}
