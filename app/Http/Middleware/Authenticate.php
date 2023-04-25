<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        //return $request->expectsJson() ? null : route('login');


        if (!$request->expectsJson()) {
            if (Request::is('admin/*'))
                return route('admin.login'); // if not authenticated
            else
                return route('login');

        }
    }
}
