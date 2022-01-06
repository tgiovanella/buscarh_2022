<?php

namespace App\Http\Controllers\User\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');

        //registra o festival ativo
        // $festival = Festival::orderBy('year','desc')->orderBy('number','desc')->with('banner')->first();
        // session(['festival' => $festival]); //salva a sessão com as informações do festival
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function logout(Request $request)
    {

        //deleta a sessão do festival
        // session()->forget('festival');

        $this->guard()->logout();
        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }
}
