<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Usuários Cadastrados'];

        $users = User::when(isset($request->question) && !empty($request->question), function ($q) use ($request) {
            return $q->where('question', 'like', '%' . $request->question . '%');
        })
            ->paginate(config('myconfig.paginate'));

        return view('admin.users.index', compact('users', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         //home / Contato
         $breadcrumb = ['end' => 'Usuário'];
         $method = 'edit';

        return view('admin.users.edit', compact('user',  'method', 'breadcrumb'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {


        $id = $user->id; //pega o id

        $request->validate([
            'name'  => 'required',
            'email'  => 'required|email|unique:users,email,'. $id,

        ]);


        //salva as informações
        try {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->cpf = $request->cpf;
            $user->birth = $request->birth;
            $user->street = $request->street;
            $user->number = $request->number;
            $user->destrict = $request->destrict;
            $user->complement = $request->complement;
            $user->cep = $request->cep;
            $user->city_id = $request->city_id;

            $city = City::find($request->city_id);

            $user->city_name = @$city->title;
            $user->uf = @$city->state->letter;



            $user->save();


            if($request->has('token_payment')) {
                return redirect(route('user.checkout.create',$request->token_payment))->with('success', 'Os dados do usuário foi atualizado com sucesso.');
            }

        return redirect(route('admin.users.index'))->with('success', __('general.msg_success', ['id' => $user->id]));

        } catch (\Exception $e) {
            return redirect(route('admin.users.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
