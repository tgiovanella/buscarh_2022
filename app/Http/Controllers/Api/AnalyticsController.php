<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SearchAnalytic;
use Illuminate\Support\Facades\Auth;

use Jenssegers\Agent\Agent;

class AnalyticsController extends Controller
{
    private $agent;
    private $device;
    private $platform;
    private $version_platform;
    private $browser;
    private $version_browser;
    private $is_desktop;
    private $languages;
    private $remote_addr;
    private $url;
    private $user_id;
    private $term;

    public function __construct()
    {
        $this->agent = new Agent();

        $this->device = $this->agent->device();
        $this->platform = $this->agent->platform();
        $this->version_platform = $this->agent->version($this->platform);
        $this->browser = $this->agent->browser();
        $this->version_browser = $this->agent->version($this->browser);
        $this->is_desktop = $this->agent->isDesktop();
        $this->languages = implode(', ', $this->agent->languages()); //
        // $this->languages = 'pt'; //
        $this->remote_addr = @$_SERVER['REMOTE_ADDR']; //REMOTE_ADDR
        $this->url = @$_SERVER['HTTP_HOST']; //REMOTE_ADDR




    }
    public function search(Request $request)
    {
        $this->term = $request->term;
        $this->user_id = $request->user_id;

        //ao fazer a busca, grava uma sessão
        if (session()->exists('search-term')) {
            //verifica se existe, e se existir, deleta
            session()->forget('search-term');
        }

        $data = $this->toArray();

        $data['token'] = $this->getToken($this->term); //gera um token unico para o termo

        if (!SearchAnalytic::create($data)) {
            return 'ocorreu um erro';
        }

        //salva a sessão com o termo novo
        session(['search_term' => $data['token']]);

        return session('search_term');
        // return dd($this);
    }

    public function toArray()
    {
        $data = get_object_vars($this);

        unset($data['middleware']);
        unset($data['agent']);

        return $data;
    }

    private function getToken($term = '')
    {
        return md5(uniqid(rand(), true) . date('dmYHis') . $term);
    }
}
