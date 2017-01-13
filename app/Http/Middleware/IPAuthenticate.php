<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IPAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $id = $request->input('user_id');
        $ip = $request->ip();
        $domain = substr($ip, 0, 7);
        if ($domain == '192.111') {
            return $next($request);
        } else {
            if (isset($id)) {
                Auth::loginUsingId($id, true);
            }
            if (Auth::check()) {
                return $next($request);
            } else {
                $url = urlencode(request()->url());
                //$id = $request->session()->getId();
                $host = env('SSO_HOST', 'http://sso.app');
                return redirect()->to($host.'?url='.$url);
            }
        }
    }
}
