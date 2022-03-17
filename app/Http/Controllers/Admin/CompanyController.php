<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\City;
use App\State;
use App\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Plane;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Empresas'];


        $companies = Company::
        when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->name . '%')->orWhere('fantasy','like','%' . $request->name . '%');
        })
        ->when(isset($request->email) && !empty($request->email), function ($q) use ($request) {
            return $q->where('email', 'like', '%' . $request->email . '%');
        })
        ->when(isset($request->cpf_cnpj) && !empty($request->cpf_cnpj), function ($q) use ($request) {
            return $q->where('cpf_cnpj', 'like', '%' . $request->cpf_cnpj . '%');
        })
            ->orderBy('id', 'desc')
            //  ->orderBy('created_at','desc')
            ->paginate(config('myconfig.paginate'));

        //  return $companies[0]->city;

        return view('admin.companies.index', compact('breadcrumb', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $subcategories_selected = [];
        //home / Contato
        $breadcrumb = ['end' => 'Empresas'];
        $method = 'create';

        $company = new Company();

        $ufs = State::select('id', 'title', 'letter')->orderBy('title')->get();
        $cities = [];
        //trás as categorias
        $categories = Category::has('subcategories')
            ->with(['subcategories' => function ($query) {
                return $query->orderBy('subcategories.name', 'ASC');
            }])->orderBy('categories.name')->get();


        $operation_cities = [];
        $operation_ufs = [];


        return view('admin.companies.create', compact('company', 'ufs','operation_cities','operation_ufs', 'cities', 'categories', 'subcategories_selected', 'method', 'breadcrumb'));
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
        $request->validate($this->role());



        //salva as informações
        try {
            $dados = $request->only(
                'name',
                'fantasy',
                'cpf_cnpj',
                'site',
                'phone',
                'cep',
                'uf',
                'city_id',
                'address',
                'number',
                'district',
                'complement',
                'email',
                'owner_id',
                'responsible'
            );



            // //prepara o slug
            // $slug = Str::slug($dados['name'] . '-' . str_replace('-', '', $dados['cpf_cnpj']));



            // return $slug;


            DB::beginTransaction();

            //salva
            if (!$register = Company::create($dados)) {
                DB::rollBack();
                return redirect(route('admin.companies.index'))->with('error', __('general.msg_error')); //se ocorrer algum erro
            }


             //atualiza com o id
            $register->slug = create_slug_company($dados['name'],$dados['cpf_cnpj'], $register->id);
            $register->save();


            //pega todas as subcategorias da empresa
            $subcategories = $request->input('subcategory_id');
            //vincula as subcategorias aa empresa recem criada
            $register->subcategories()->sync($subcategories);

            //vincula as uf de operação
            $operation_ufs = $request->input('operation_uf');
            $register->operation_ufs()->sync($operation_ufs);

            //vincula as cidades de operações
            $operation_city = $request->input('operation_city');
            $register->operation_cities()->sync($operation_city);




            DB::commit();

            //adiciona uf de atuação

            //se tudo ocorreu
            return redirect(route('admin.companies.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect(route('admin.companies.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {


        //para fazer o selected
        $subcategories_selected =  [];
        foreach ($company->subcategories as $item) {
            $subcategories_selected[] = $item->id;
        }


        $operation_ufs =  [];
        foreach ($company->operation_ufs as $item) {
            $operation_ufs[] = $item->id;
        }

        $operation_cities = [];
        foreach ($company->operation_cities as $item) {
            $operation_cities[] = $item->id;
        }

        $planes = Plane::where('status', 1)->get(); //todos os planos


        //home / Contato
        $breadcrumb = ['end' => 'Empresas'];
        $method = 'edit';


        $ufs = State::select('id', 'title', 'letter')->orderBy('title')->get();
        $cities = [];

        if ($company->city_id) {
            $cities = City::where('state_id', $company->city->state_id)->get();
        }
        //trás as categorias
        $categories = Category::has('subcategories')
            ->with(['subcategories' => function ($query) {
                return $query->orderBy('subcategories.name', 'ASC');
            }])->orderBy('categories.name')->get();

        return view('admin.companies.edit', compact('company', 'planes', 'ufs','operation_cities','operation_ufs', 'cities', 'categories', 'subcategories_selected', 'method', 'breadcrumb'));
    }

    private function role()
    {
        return [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        //faz a validação dos dados
        $request->validate($this->role());


        //salva as informações
        try {
            $dados = $request->only(
                'name',
                'fantasy',
                'cpf_cnpj',
                'site',
                'phone',
                'cep',
                'uf',
                'city_id',
                'address',
                'number',
                'district',
                'complement',
                'email',
                'owner_id',
                'responsible',
                'coins',
                'used_coins'
            );


            //pega o id do UF e transforma ele em letter
            $dados['uf'] = State::where('id', $dados['uf'])->first()->letter;



            $dados['slug'] = create_slug_company($dados['name'],$dados['cpf_cnpj'], $company->id);

            $company->name = $dados['name'];
            $company->slug = $dados['slug'];
            $company->fantasy = $dados['fantasy'];
            $company->cpf_cnpj = $dados['cpf_cnpj'];
            $company->site = $dados['site'];
            $company->phone = $dados['phone'];
            $company->cep = $dados['cep'];
            $company->uf = $dados['uf'];
            $company->city_id = $dados['city_id'];
            $company->address = $dados['address'];
            $company->number = $dados['number'];
            $company->district = $dados['district'];
            $company->complement = $dados['complement'];
            $company->email = $dados['email'];
            $company->responsible = $dados['responsible'];
            $company->balance_coins = $dados['coins'];
            $company->used_coins = 0;
            $company->coins = $dados['coins'];

            $company->save();



            //pega todas as subcategorias da empresa
            $subcategories = $request->input('subcategory_id');

            //vincula as subcategorias aa empresa recem criada
            $company->subcategories()->sync($subcategories);


            //adiciona uf de atuação
            //vincula as uf de operação
            $operation_ufs = $request->input('operation_uf');
            $company->operation_ufs()->sync($operation_ufs);

            //vincula as cidades de operações
            $operation_city = $request->input('operation_city');
            $company->operation_cities()->sync($operation_city);

            //se tudo ocorreu
            return redirect(route('admin.companies.index'))->with('success', __('general.msg_success', ['id' => $company->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.companies.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {


        //salva as informações
        try {

            DB::beginTransaction();
            $company->subcategories()->sync([]); //deleta as categorias
            $company->delete();
            DB::commit();

            //se tudo ocorreu
            return redirect(route('admin.companies.index'))->with('success', __('general.msg_success_delete', ['id' => $company->id]));
        } catch (\Exception $e) {

            DB::rollBack();
            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.companies.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.companies.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    public function highlighted(Request $request, Company $company)
    {
        $request->validate([
            'plane_id' => 'required'
        ]);


        //salva as informações
        try {
            $dados = $request->only(
                'plane_id'
            );


            if (true) {
                $company->highlighted = true;
                $company->save();
            }

            //se tudo ocorreu
            return redirect(route('admin.companies.index'))->with('success', __('general.msg_success', ['id' => $company->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.companies.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }
}
