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
        /**
         *DECIDIR A DONDE REDIRIGIR TODAS LAS PETICIONES
         */
        if($request->path()=='register'||$request->path()=='doReg'||$request->path()=='doLog'||$request->path()=='/') {
            return $next($request);
        }
        else if($request->session()->get('user_obj')==null){
            return redirect('/')->withCookie(cookie('prev_path', $request->path(), 5));
        }
        else{
            return $next($request);
        }
    }

}