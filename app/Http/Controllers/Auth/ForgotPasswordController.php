<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\ChuyenMuc;
use App\Models\Muc;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $muc = Muc::where('status', 1)->get();
        $chuyenmuc = ChuyenMuc::where('status', 1)->get();
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc]);
        $this->middleware('guest');
    }
}
