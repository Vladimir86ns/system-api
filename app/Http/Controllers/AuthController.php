<?php
namespace App\Http\Controllers;

use App\Services\VgSystem\VgSystemService;
use App\User;
use Illuminate\Support\Facades\Auth;
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
    public function choseStatus(VgSystemService $vgSystemService)
    {
        
        
        $vgSystem = $vgSystemService->getVgSystemFromTransformer();
        $vgSystem['employee'] = 0;
        $vgSystem['investor'] = 0;
        $vgSystem['owner'] = 0;
        
        $users = User::get();
    
        // count how many employee, owner, investors
        foreach ($users as $user) {
            $permissions = json_decode($user->permissions, true);
            
            if (array_key_exists('employee', $permissions)) {
                $vgSystem['employee']++;
            }
    
            if (array_key_exists('investor', $permissions)) {
                $vgSystem['investor']++;
            }
    
            if (array_key_exists('owner', $permissions)) {
                $vgSystem['owner']++;
            }
        }

        return view('chose_status', compact(['vgSystem']));
    }

    /**
     * Logout page and redirect to chose status.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        // TODO  for now log out user like this , because of SENTINEL library.
        Sentinel::logout(Sentinel::getUser());

        return Redirect::to('/')->with('success', 'You have successfully logged out!');
    }
}
