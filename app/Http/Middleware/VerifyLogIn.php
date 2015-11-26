<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 25/11/2015
 * Time: 21:30
 */

namespace App\Http\Middleware;

use Closure;

class VerifyLogIn {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->path()=='register'||$request->path()=='regForm'||$request->path()=='login'||$request->path()=='/') {
            return $next($request);
        }
        else if($request->session()->get('user_obj')==null){
            return redirect('/');
        }
        else{
            return $next($request);
        }
    }

}