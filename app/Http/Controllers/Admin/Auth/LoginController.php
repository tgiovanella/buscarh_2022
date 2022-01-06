<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Festival;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');

        // //registra o festival ativo
        // $festival = Festival::orderBy('year','desc')->orderBy('number','desc')->with('banner')->first();
        // session(['festival_adm' => $festival]); //salva a sessão com as informações do festival
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        //deleta a sessão do festival
        // session()->forget('festival_adm');

        $this->guard()->logout();
        return redirect('/admin/login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
