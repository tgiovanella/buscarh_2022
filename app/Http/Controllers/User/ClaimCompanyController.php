<?php

namespace App\Http\Controllers\User;

use App\ClaimCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClaimCompanyController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.claims.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //faz a validação dos dados
        $request->validate([
            'name' => 'required|max:255',
            'company' => 'required|max:255',
            'cpf' => 'required|max:255',
            'rg_cnh' => 'required|max:100',
            'cnpj' => 'required|max:100',
        ]);

        // ClaimCompany
        //salva as informações
        try {
            $dados = $request->only(
                'name',
                'cpf',
                'rg_cnh',
                'cnpj',
                'company'
            );



            $dados['user_id'] = Auth::user()->id;


            //salva
            if (!$register = ClaimCompany::create($dados)) {

                return redirect(route('user.claims.create'))->with('error', __('general.msg_error'));
            }







            // return $register;
            //se tudo ocorreu
            return redirect(route('user.claims.create'))->with('success', __('general.msg_contact_success'));
        } catch (\Exception $e) {

            return $e->getMessage();

            return redirect(route('user.claims.create'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
