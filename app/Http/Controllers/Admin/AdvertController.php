<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Plane;
use App\Advert;
use App\Category;
use Carbon\Carbon;
use App\Subcategory;
use App\OrderPayment;
use App\AdvertConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\SendMailStatusOrderAds;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdvertController extends Controller
{


    private $path_file = 'banners'; //destino da pasta para salvar os arquivos de banners
    private $path_storage = 'storage';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //home / Contato
        $breadcrumb = ['end' => 'Anúncios'];

        $ads = Advert::when(isset($request->title) && !empty($request->title), function ($q) use ($request) {
            return $q->where('title', 'like', '%' . $request->title . '%');
        })

        ->orderBy('created_at','desc')
            ->paginate(config('myconfig.paginate'));




        return view('admin.ads.index', compact('ads', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = ['admin.ads.index' => 'Cadastro de Anúncio', 'end' => 'Cadastrar'];
        $ad = new Advert();
        $method = \Request::route()->getActionMethod();

        $categories = Category::has('subcategories')
            ->with(['subcategories' => function ($query) {
                return $query->orderBy('subcategories.name', 'ASC');
            }])->orderBy('categories.name')->get();

        $ads_config = AdvertConfiguration::where('status', 1)->get(); //todos os ads
        $planes = Plane::where('status', 1)->get(); //todos os planos


        return view('admin.ads.create', compact('breadcrumb', 'ad', 'ads_config','categories', 'planes', 'method'));
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

            DB::beginTransaction();

            $dados = $request->only('advert_configuration_id', 'title', 'subcategory_id',
            'description',
            'site',
            'has_company',
            'company_id',
            'email_payment',
            'responsible_payment',
            'phone',
            'status');

            $config = AdvertConfiguration::find($dados['advert_configuration_id']);

            $dados['type'] = $config->type;
            $dados['position'] = $config->position;



            //faz o upload do arquivo
            $name_file = $this->upload($request);


            //gera o token
            $dados['token_id'] = md5(uniqid(rand(), true));

            $banner = [
                'path' => $name_file,
                'origin' => File::FILE_ADMIN //marca que foi feito pelo cadastro  admin
            ];

            $file_id = File::create($banner)->id;

            $dados['file_id'] = $file_id;

            if ($request->type_submit == 'payment') {

                $plan = Plane::find($config['plane_id']);
                // return $plan;
                // return $config;

                //cria a ordem de pagamento do pagseguro
                if (!$order = OrderPayment::create([
                    'plane_id' => $config['plane_id'],
                    'subscribed_at' => now(),
                    'status' => 1, //pendente
                    'trial_expired_at' => Carbon::now()->addDay($plan['trial_period_duration']),
                    // 'user_id' =>
                ])) {
                    DB::rollBack();

                    return redirect(route('admin.ads.index'))->with('error', __('general.msg_error'));
                }


                $dados['order_payment_id'] = $order->id;

                $dados['status'] = Advert::STATUS_APPROVED;
            }




            //salva
            if (!$register = Advert::create($dados)) {
                DB::rollBack();

                return redirect(route('admin.ads.index'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            DB::commit();


            //encaminha email com o link de pagamento
            //envia o email
            try {
                if ($request->type_submit == 'payment') { ///se processou o pagamento envia o link de pagamento

                    //envia que o anuncio foi criado
                    Mail::to($dados['email_payment'])
                        ->send(new SendMailStatusOrderAds(Advert::STATUS_PENDING, $dados['responsible_payment'], $register));


                    //envia o email com o link de pagamento
                    Mail::to($dados['email_payment'])
                        ->send(new SendMailStatusOrderAds(Advert::STATUS_APPROVED, $dados['responsible_payment'], $register, $order));
                } else {
                    //envia que o anuncio foi criado
                    Mail::to($dados['email_payment'])
                        ->send(new SendMailStatusOrderAds(Advert::STATUS_PENDING, $dados['responsible_payment'], $register));
                }
            } catch (Exception $e) {
                //     return $e->getMessage();

                session()->flash('warning', 'Ocorreu algum problema ao enviar o email!');
            }

            return redirect(route('admin.ads.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect(route('admin.ads.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $ad)
    {


        // return $ad->company;



        //home / Contato
        $breadcrumb = ['admin.ads.index' => 'Cadastro de Anúncio', 'end' => 'Cadastrar'];
        $method = 'edit';

        $ads_config = AdvertConfiguration::where('status', 1)->get(); //todos os ads

        $categories = Category::has('subcategories')
            ->with(['subcategories' => function ($query) {
                return $query->orderBy('subcategories.name', 'ASC');
            }])->orderBy('categories.name')->get();


        $planes = Plane::where('status', 1)->get(); //todos os planos




        return view('admin.ads.edit', compact('ad', 'method','categories', 'ads_config', 'planes', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $ad)
    {

        //faz a validação dos dados
        $request->validate($this->role());

        // return $request;
        //salva as informações
        try {
            $dados = $request->only('advert_configuration_id','subcategory_id', 'title', 'description',
            'site', 'has_company', 'company_id', 'email_payment', 'responsible_payment', 'phone', 'status');


            $config = AdvertConfiguration::find($dados['advert_configuration_id']);

            $dados['type'] = $config->type;
            $dados['position'] = $config->position;

            // $dados['subcategory_id'] = ; //sssssSubcategory::first()->id;


            if ($request->hasFile('banner')) {


                //faz o upload do arquivo
                $name_file = $this->upload($request);


                $banner = [
                    'path' => $name_file,
                    'origin' => File::FILE_ADMIN //marca que foi feito pelo cadastro  admin
                ];
                $file_id = File::create($banner)->id;

                $dados['file_id'] = $file_id;


                //verifica
                $ad->file_id = $dados['file_id'];
            }

            //cria a ordem de pagamento do pagseguro
            if ($request->type_submit == 'payment') {

                $plan = Plane::find($config['plane_id']);
                // return $plan;
                // return $config;

                //cria a ordem de pagamento do pagseguro
                if (!$order = OrderPayment::create([
                    'plane_id' => $config['plane_id'],
                    'subscribed_at' => now(),
                    'status' => 1, //pendente
                    'trial_expired_at' => Carbon::now()->addDay($plan['trial_period_duration']),
                    // 'user_id' =>
                ])) {
                    DB::rollBack();

                    return redirect(route('admin.ads.index'))->with('error', __('general.msg_error'));
                }


                $dados['order_payment_id'] = $order->id;
                $ad->order_payment_id = $dados['order_payment_id'];

                $dados['status'] = Advert::STATUS_APPROVED;

                //encaminha email com o link de pagamento
                //envia o email
                try {
                    //envia o email com o link de pagamento
                    Mail::to($dados['email_payment'])
                        ->send(new SendMailStatusOrderAds(Advert::STATUS_APPROVED, $dados['responsible_payment'], $ad, $order));
                } catch (Exception $e) {
                    session()->flash('warning', 'Ocorreu algum problema ao enviar o email!');
                }
            }


            $ad->advert_configuration_id = $dados['advert_configuration_id'];
            $ad->title = $dados['title'];
            $ad->description = $dados['description'];
            $ad->site = $dados['site'];
            $ad->status = $dados['status'];
            $ad->type = $dados['type'];
            $ad->position = $dados['position'];
            $ad->subcategory_id = $dados['subcategory_id'];

            $ad->has_company = $dados['has_company'];
            $ad->phone = $dados['phone'];
            $ad->company_id = $dados['has_company'] ? $dados['company_id'] : null;
            $ad->email_payment = $dados['email_payment'];
            $ad->responsible_payment = $dados['responsible_payment'];



            $ad->save(); //salva

            //se tudo ocorreu
            return redirect(route('admin.ads.index'))->with('success', __('general.msg_success', ['id' => $ad->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.ads.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $ad)
    {
        //salva as informações
        try {

            DB::beginTransaction();


            if ($ad->file) {
                $path = $ad->file->path;


                if ($ad->file()->delete()) {
                    unlink(public_path($path)); //se deletar exclui o arquivo
                }
            }



            $ad->delete();
            //se tudo ocorreu

            DB::commit();
            return redirect(route('admin.ads.index'))->with('success', __('general.msg_success_delete', ['id' => $ad->id]));
        } catch (\Exception $e) {

            db::rollBack();

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.ads.index'))->with('warning', __('general.msg_alert_fk'));


            return redirect(route('admin.ads.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    private function role()
    {
        return [
            'advert_configuration_id' => 'required',
            'title' => 'required',
            'site' => 'required',
            'status' => 'required',
            'banner' => 'mimes:jpeg,jpg,png,gif|max:500',

        ];
    }


    private function upload(Request $request)
    {
        if ($request->hasFile('banner') &&  $request->file('banner')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->banner->extension();


            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $file = $request->file('banner');

            // Faz o upload:
            $upload = $request->banner->storeAs($this->path_file, $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/PASTA/NOME_DO_ARQUIVO.EXTENSAO


            //se ocorrer um erro, dispara a exception
            if (!$upload) {
                throw new \Exception();
            }

            return ($this->path_storage . DIRECTORY_SEPARATOR . $this->path_file . DIRECTORY_SEPARATOR . $nameFile);
        }
    }

    public function destroyFile(Request $request, $id)
    {


        try {

            DB::beginTransaction();
            $ad = Advert::find($request->id);


            $path = $ad->file->path;
            if ($ad->file()->delete()) {

                unlink(public_path($path)); //se deletar exclui o arquivo
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return json_encode(['error' => $exception->getMessage()]);
        }

        DB::commit();



        return $ad;
    }
}
