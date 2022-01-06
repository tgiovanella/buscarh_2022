<?php

namespace App\Http\Controllers\Admin;

use App\PageNav;
use App\PageBlock;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageNavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //home / Contato
        $breadcrumb = ['end' => 'Menu Institucional'];

        $navs = PageNav::
        when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('name','like','%'.$request->name.'%');
        })
        ->orderBy('page_block_id')
        ->paginate(config('myconfig.paginate'));




       return view('admin.navs.index',compact('navs','breadcrumb'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $breadcrumb = ['admin.navs.index' => 'Menu Institucional', 'end' => 'Cadastrar'];
        $nav = new PageNav();
        $method = \Request::route()->getActionMethod();


        $blocks = PageBlock::where('status',true)->get();

        return view('admin.navs.create', compact('breadcrumb','blocks', 'nav', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->role());



        //salva as informações
        try {
            $dados = $request->only('name','page_block_id','slug', 'url','observation','status','order');
            //prepara o slug

            // //prepara o slug
            // $slug = Str::slug($dados['name']);
            // $dados['slug'] = $slug;


            //salva
            if (!$register = PageNav::create($dados)) {
                return redirect(route('admin.navs.index'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            return redirect(route('admin.navs.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.navs.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PageNav  $pageNav
     * @return \Illuminate\Http\Response
     */
    public function show(PageNav $pageNav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageNav  $pageNav
     * @return \Illuminate\Http\Response
     */
    public function edit(PageNav $nav)
    {
         //home / Contato
        $breadcrumb = ['admin.navs.index' => 'Menu Institucional', 'end' => 'Editar'];
        $method = 'edit';

        $blocks = PageBlock::where('status',true)->get();

        return view('admin.navs.edit',compact('nav','blocks','method','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageNav  $pageNav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageNav $nav)
    {
        //faz a validação dos dados
        $request->validate($this->role());

        //salva as informações
        try {
            $dados = $request->only('name','page_block_id','slug', 'url','observation','status','order');

            //salva os dados
            $nav->name = $dados['name'];
            $nav->page_block_id = $dados['page_block_id'];
            $nav->slug = $dados['slug'];
            $nav->url = $dados['url'];
            $nav->order = $dados['order'];
            $nav->observation = $dados['observation'];
            $nav->status = $dados['status'];
            $nav->save();


            //se tudo ocorreu
            return redirect(route('admin.navs.index'))->with('success', __('general.msg_success', ['id' => $nav->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.navs.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageNav  $pageNav
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageNav $nav)
    {
        //salva as informações
        try {
            $nav->delete();
            //se tudo ocorreu
            return redirect(route('admin.navs.index'))->with('success', __('general.msg_success_delete', ['id' => $nav->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.navs.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.navs.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    //parametros para validação
    private function role() {
        return [
            'name' => 'required|max:255',
            'url' => 'required|max:255',
            'slug' => 'required|max:255',
            'order' => 'required|int',
            'status' => 'required'
        ];
    }
}
