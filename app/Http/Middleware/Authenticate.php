<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as BasicAuthenticate;
use Auth;
use Closure;
use Arr;

class Authenticate extends BasicAuthenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
        // if (!Auth::guard($guards)->check()) {
        //     return redirect(route('login'));
        // }

        // $user = Auth::user();


        // return $next($request);


        $this->authenticate($request, $guards);

        if (!$guards) {
            $route = $request->route()->getAction();
            $flag = Arr::get($route, 'permission', null);
            // echo $flag;die;
            $user = Auth::user();
            // print_r($user->permissions);die;
            if($user->is_super==1){
                return $next($request);
            }else{
                if ($flag && !$user->hasPermission($flag)) {
                    if ($request->expectsJson()) {
                        return response()->json(['message' => 'Unauthenticated.'], 401);
                    }
                    abort(401);
                }
            }
            
        }
        return $next($request);
    }
}
