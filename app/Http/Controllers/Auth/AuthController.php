<?php namespace App\Http\Controllers;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AuthController extends JoshController
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
