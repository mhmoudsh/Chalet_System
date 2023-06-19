<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if($request->is('admin')||$request->is('admin/*')){

                //redirect to admin login
                return route('admin.show_login_form');
            }else{
                //redirect to fron login in case there is front
                return route('admin.show_login_form');

                // return route('frontend.show_login_form');


            }


        }
    }
}
