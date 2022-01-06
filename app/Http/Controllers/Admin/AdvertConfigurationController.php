<?php

namespace App\Http\Controllers\Admin;


use App\AdvertConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plane;

class AdvertConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Configurações de Anúncios'];

        $adsconfig = AdvertConfiguration::when(isset($request->title) && !empty($request->title), function ($q) use ($request) {
            return $q->where('title', 'like', '%' . $request->title . '%');
        })
            ->paginate(config('myconfig.paginate'));

        return view('admin.ads-config.index', compact('adsconfig', 'breadcrumb'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = ['admin.ads-config.index' => 'Configurações de Anúncio', 'end' => 'Cadastrar'];
        $ads_config = new AdvertConfiguration();
        $method = \Request::route()->getActionMethod();

        $planes = Plane::where('status', 1)->get();



        return view('admin.ads-config.create', compact('breadcrumb', 'planes', 'ads_config', 'method'));
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
            $dados = $request->only('title', 'type', 'amount', 'height', 'width', 'plane_id', 'status');
            //salva
            if (!$register = AdvertConfiguration::create($dados)) {
                return redirect(route('admin.ads-config.index'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            return redirect(route('admin.ads-config.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.ads-config.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdvertConfiguration  $advertConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertConfiguration $advertConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdvertConfiguration  $advertConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertConfiguration $ads_config)
    {

        //home / Contato
        $breadcrumb = ['admin.ads-config.index' => 'Configurações de Anúncio', 'end' => 'Editar'];

        $method = 'edit';

        $planes = Plane::where('status', 1)->get();


        return view('admin.ads-config.edit', compact('ads_config', 'planes', 'method', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvertConfiguration  $advertConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvertConfiguration $ads_config)
    {

        //faz a validação dos dados
        $request->validate($this->role());

        //salva as informações
        try {
            $dados = $request->only('title', 'type', 'amount', 'value', 'width', 'height', 'status', 'plane_id');

            $ads_config->title = $dados['title'];
            $ads_config->type = $dados['type'];
            // $ads_config->position = $dados['position'];
            $ads_config->amount = $dados['amount'];
            $ads_config->plane_id = $dados['plane_id'];
            // $ads_config->value = 0;
            $ads_config->width = $dados['width'];
            $ads_config->height = $dados['height'];
            $ads_config->status = $dados['status'];

            $ads_config->save();
            //se tudo ocorreu
            return redirect(route('admin.ads-config.index'))->with('success', __('general.msg_success', ['id' => $ads_config->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.ads-config.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdvertConfiguration  $advertConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertConfiguration $ads_config)
    {
        //salva as informações
        try {
            $ads_config->delete();
            //se tudo ocorreu
            return redirect(route('admin.ads-config.index'))->with('success', __('general.msg_success_delete', ['id' => $ads_config->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.ads-config.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.ads-config.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    //parametros para validação
    private function role()
    {
        return [
            'title' => 'required',
            'type' => 'required',
            'amount' => 'required|min:1',
            'height' => 'required|min:1',
            'width' => 'required|min:1',
            // 'value' => 'required|min:1',
            'status' => 'required',
        ];
    }
}
