<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\User;

class CheckAdminInvestment
{
    const ROUTE = '/';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Sentinel::getUser()) {
            return redirect(self::ROUTE);
        }

        // from Sentinel get user I could get permission even
        // there is array with permission. That is why i then find
        // user by id. And then it is possible to see permission.
        $user = User::find(Sentinel::getUser()->id);
        $permission = json_decode($user->permissions, true);

        if (empty($permission['admin-investment'])) {
            return redirect(self::ROUTE)->with('error', 'Your have to be Admin Investor!');
        }

        if ($permission['admin-investment'] == 1) {
            return $next($request);
        }

        return redirect(self::ROUTE);
    }
}
