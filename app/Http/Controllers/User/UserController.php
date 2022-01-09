<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\User;
use App\Subcategory;
use App\Category;
use App\City;
use App\State;
use stdClass;

class UserController extends Controller
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
    {
        $_user = Auth::guard('user')->user();

        $user = User::where('id', $_user->id)->with(
            [
                'companies' => fn ($m) => $m->with(
                    [
                        'city' => fn ($s) => $s->with('state')
                    ]
                )
            ]
        )->first();

        $user->quotations = [];

        $ufs = State::select('id', 'title', 'letter')->orderBy('title')->get();
        $cities = City::with('state')->get();

        $categories = Category::has('subcategories')
            ->with(
                [
                    'subcategories' => fn ($q) => $q->orderBy('subcategories.name', 'ASC')
                ]
            )->orderBy('categories.name')->get();


        return view('user.users.index', compact(
            'user',
            'categories',
            'ufs',
            'cities',
        ));
    }

    public function company()
    {

        $company = new Company();

        $method = 'create';

        $subcategories_selected = [];

        $ufs = State::select('id', 'title', 'letter')->orderBy('title')->get();
        $cities = [];

        $operation_ufs =  [];

        $operation_cities = [];

        //trás as categorias
        $categories = Category::has('subcategories')
            ->with(['subcategories' => function ($query) {
                return $query->orderBy('subcategories.name', 'ASC');
            }])->orderBy('categories.name')->get();



        return view('user.users.company', compact(
            'categories',
            'ufs',
            'cities',
            'company',
            'method',
            'subcategories_selected',
            'operation_ufs',
            'operation_cities'
        ));
    }

    public function editCompany(Company $company)
    {


        $method = 'edit';

        //para fazer o selected
        $subcategories_selected =  [];
        foreach ($company->subcategories as $item) {
            $subcategories_selected[] = $item->id;
        }

        $ufs = State::select('id', 'title', 'letter')
            ->orderBy('title')->get();

        $cities = [];

        if ($company->city_id) {
            $cities = City::where('state_id', $company->city->state_id)->get();
        }

        $operation_ufs =  [];
        foreach ($company->operation_ufs as $item) {
            $operation_ufs[] = $item->id;
        }

        $operation_cities = [];
        foreach ($company->operation_cities as $item) {
            $operation_cities[] = $item->id;
        }


        //trás as categorias
        $categories = Category::has('subcategories')
            ->with(['subcategories' => function ($query) {
                return $query->orderBy('subcategories.name', 'ASC');
            }])->orderBy('categories.name')->get();

        return view(
            'user.users.company',
            compact('categories', 'company', 'method', 'cities', 'ufs', 'subcategories_selected', 'operation_ufs', 'operation_cities')
        );
    }


    public function createCompany(Request $request)
    {
        $request->validate([]);


        //pega todas as subcategorias da empresa
        $subcategories = $request->input('subcategory_id');

        $data = $request->only([
            'name', #nome
            'fantasy', #nome fantasia
            'cpf_cnpj', #c
            'site', #url do site
            'phone', #telefone
            'cep', #cep
            'uf', #uf
            'address', #endereço - logradouro
            'number', #numero (inteiro) - se for S/N então é ZERO (0)
            'district', #bairro
            'city_id', #cidade
            'complement', #complemento
            'responsible', #nome do responsável
            'email', #email
            'owner_id', #usuário dono da empresa (para administrar)
        ]);

        $data['owner_id'] = Auth::guard('user')->user()->id; //pega o usuário logado
        // return $data;

        $result = Company::create($data);

        //atualiza com o id
        $result->slug = create_slug_company($data['name'], $data['cpf_cnpj'], $result->id);
        $result->save();

        //vincula as subcategorias aa empresa recem criada
        $result->subcategories()->attach($subcategories);

        //adiciona uf de atuação
        //vincula as uf de operação
        $operation_ufs = $request->input('operation_uf');
        $result->operation_ufs()->sync($operation_ufs);

        //vincula as cidades de operações
        $operation_city = $request->input('operation_city');
        $result->operation_cities()->sync($operation_city);

        return redirect(route('user.users.index'));
    }

    public function updateCompany(Company $company, Request $request)
    {
        $request->validate([]);


        // return $request;

        //pega todas as subcategorias da empresa
        $subcategories = $request->input('subcategory_id');

        $company->subcategories()->sync($subcategories);


        $data = $request->only([
            'name', #nome
            'fantasy', #nome fantasia
            'cpf_cnpj', #c
            'site', #url do site
            'phone', #telefone
            'cep', #cep
            'uf', #uf
            'address', #endereço - logradouro
            'number', #numero (inteiro) - se for S/N então é ZERO (0)
            'district', #bairro
            'city_id', #cidade
            'complement', #complemento
            'resposible', #nome do responsável
            'email', #email
            'owner_id', #usuário dono da empresa (para administrar)
        ]);

        $data['owner_id'] = Auth::guard('user')->user()->id; //pega o usuário logado
        // return $data;

        // $result = Company::create($data);

        //pega o id do UF e transforma ele em letter
        $data['uf'] = State::where('id', $data['uf'])->first()->letter;


        $company->name = $data['name'];
        $company->fantasy = $data['fantasy'];
        $company->cpf_cnpj = $data['cpf_cnpj'];
        $company->site = $data['site'];
        $company->phone = $data['phone'];
        $company->cep = $data['cep'];
        $company->uf = $data['uf'];
        $company->address = $data['address'];
        $company->number = $data['number'];
        $company->district = $data['district'];
        $company->city_id = $data['city_id'];
        $company->complement = $data['complement'];
        $company->responsible = $data['resposible'];
        $company->email = $data['email'];
        $company->owner_id = $data['owner_id'];
        $company->slug = create_slug_company($data['name'], $data['cpf_cnpj'], $company->id);



        //adiciona uf de atuação
        //vincula as uf de operação
        $operation_ufs = $request->input('operation_uf');
        $company->operation_ufs()->sync($operation_ufs);

        //vincula as cidades de operações
        $operation_city = $request->input('operation_city');
        $company->operation_cities()->sync($operation_city);

        $company->save();

        //vincula as subcategorias aa empresa recem criada
        // $result->subcategories()->attach($subcategories);

        return redirect(route('user.users.index'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
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
    public function update(Request $request, User $user)
    {


        $id = $user->id; //pega o id

        $request->validate([
            'name'  => 'required',
            'email'  => 'required|email|unique:users,email,' . $id,

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


            if ($request->has('token_payment')) {
                return redirect(route('user.checkout.create', $request->token_payment))->with('success', 'Os dados do usuário foi atualizado com sucesso.');
            }

            return redirect(route('user.users.index'))->with('success', __('general.msg_success', ['id' => $user->id]));
        } catch (\Exception $e) {
            return redirect(route('user.users.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
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

    public function destroyCompany(Company $company)
    {
        //salva as informações
        try {

            $company->subcategories()->detach();
            $company->delete();
            //se tudo ocorreu
            return redirect(route('user.users.index'))->with('success', __('general.msg_success_delete', ['id' => $company->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('user.users.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('user.users.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }
}
