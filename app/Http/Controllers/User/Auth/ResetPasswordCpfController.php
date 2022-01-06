<?php

namespace App\Http\Controllers\User\Auth;

use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ResetPasswordCpfController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:user');
    }

    public function showLinkRequestForm()
    {
        return view('user.auth.passwords.cpf');
    }

    public function broker()
    {
        return Password::broker('users');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
           'cpf' => 'required|max:20'
        ]);


        $response = $this->broker()->sendResetLink(
            $request->only('cpf')
        );


        if ($response === Password::RESET_LINK_SENT) {

            $user = User::select('email')->where('cpf',$request->only('cpf'))->first();

            $before = str_before($user->email,'@');
            $before_len = strlen($before);

            if($before_len > 2) {
                $init = str_limit($before,3,'');

                $hide = '';
                for($i = 0; $i < $before_len-3; $i++) $hide .= '*';
            } else {
                $init = str_limit($before,1,'');

                $hide = '';
                for($i = 0; $i < $before_len-3; $i++) $hide .= '*';
            }


            $after = str_after($user->email,'@');

            $email_hide =  $init . $hide .'@'. $after;

            $message = "Enviamos seu link de redefinição de senha para o email <strong>" . $email_hide ."</strong>.";
            return back()->with('status', $message);
        }



        return back()->withErrors(
//            ['cpf' => trans($response)]
            ['cpf' => 'Não encontramos um usuário com esse CPF cadastrado.']
        );

    }

}
