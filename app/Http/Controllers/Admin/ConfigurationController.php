<?php

namespace App\Http\Controllers\Admin;

use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          //home / Contato
          $breadcrumb = ['end' => 'Configurações'];

          $configurations = Configuration::
          when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
              return $q->where('name','like','%'.$request->name.'%');
          })
          ->paginate(config('myconfig.paginate'));

         return view('admin.configurations.index',compact('configurations','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = ['admin.pages.index' => 'FAQs', 'end' => 'Cadastrar'];
        $configuration = new Configuration();
        $method = \Request::route()->getActionMethod();

        return view('admin.configurations.create', compact('breadcrumb', 'configuration', 'method'));
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
             $dados = $request->only('name','value','descriptions');



             //salva
             if (!$register = Configuration::create($dados)) {
                 return redirect(route('admin.configurations.index'))->with('error', __('general.msg_error'));
             }

             //se tudo ocorreu
             return redirect(route('admin.configurations.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
         } catch (\Exception $e) {
             return redirect(route('admin.configurations.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
         //home / Contato
         $breadcrumb = ['admin.configurations.index' => 'Configurações', 'end' => 'Editar'];
         $method = 'edit';



        return view('admin.configurations.edit',compact('configuration','method','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
        //faz a validação dos dados
        $request->validate($this->role());

        //salva as informações
        try {
            $dados = $request->only('name','value','descriptions');



            //salva os dados
            $configuration->name = $dados['name'];
            $configuration->value = $dados['value'];
            $configuration->descriptions = $dados['descriptions'];
            $configuration->save();


            //se tudo ocorreu
            return redirect(route('admin.configurations.index'))->with('success', __('general.msg_success', ['id' => $configuration->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.configurations.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //salva as informações
        try {
            $configuration->delete();
            //se tudo ocorreu
            return redirect(route('admin.configurations.index'))->with('success', __('general.msg_success_delete', ['id' => $configuration->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.configurations.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.configurations.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }


    //parametros para validação
    private function role() {
        return [
            'name' => 'required',
            'value' => 'required',
        ];
    }
}
