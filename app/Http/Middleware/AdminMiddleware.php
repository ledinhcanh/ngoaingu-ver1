<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->idquyenhan > 0) {
                return $next($request);
            }else {
                return redirect()->back()->with('error','Bạn không có quyền vào trang này');;
            }
        }else {
            return redirect()->route('login.admin')->with('error','Đăng nhập để vào trang quản trị');;
        }
    }
}
