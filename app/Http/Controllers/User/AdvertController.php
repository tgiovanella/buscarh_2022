<?php

namespace App\Http\Controllers\User;

use App\Advert;
use App\AdvertConfiguration;
use App\Category;
use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMailStatusOrderAds;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdvertController extends Controller
{



    private $path_file = 'banners'; //destino da pasta para salvar os arquivos de banners
    private $path_storage = 'storage';


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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $ads_config = AdvertConfiguration::all();
        $method = \Request::route()->getActionMethod();


        return view('user.ads.create', compact('categories', 'method', 'ads_config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




        // return $request;
        //salva as informações
        try {

            DB::beginTransaction();

            $dados = $request->only('advert_configuration_id', 'title', 'description', 'site', 'subcategory_id');


            $config = AdvertConfiguration::find($dados['advert_configuration_id']);



            $dados['type'] = $config->type;
            $dados['position'] = $config->position;

            //salva os dados do usuário
            $dados['user_id'] = Auth::user()->id;
            $dados['email_payment'] = Auth::user()->email;
            $dados['responsible_payment'] = Auth::user()->name;
            $dados['phone'] = Auth::user()->phone;


            //gera o token
            $dados['token_id'] = md5(uniqid(rand(), true));




            //faz o upload do arquivo
            $name_file = $this->upload($request);


            if($name_file) {

                $banner = [
                    'path' => $name_file,
                    'origin' => File::FILE_USER //marca que foi feito pelo cadastro  FILE_USER
                ];
                $file = File::create($banner);
                // return $file_id;/
                $dados['file_id'] = $file->id;

            } else {
                $dados['file_id'] = null;

            }





            //salva
            if (!$register = Advert::create($dados)) {
                DB::rollBack();

                return redirect(route('user.ads.create'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            DB::commit();


            //envia o email
            try {
                //envia o email
                Mail::to(Auth::user()->email)
                    // ->cc('sheylacarla@garriga.com.br')
                    ->send(new SendMailStatusOrderAds(Advert::STATUS_PENDING, Auth::user()->name, $register));
            } catch (Exception $e) {
                //     return $e->getMessage();

                session()->flash('warning', 'Ocorreu algum problema ao enviar o email!');
            }




            return redirect(route('user.home'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect(route('user.ads.create'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
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

        return abort(404);
        // return $advert;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {

        $method = 'edit';


        return view('user.ads/edit', compact('method', 'advert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $advert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        //
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
        } else {
            return false;
        }
    }
}
