<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //home / Contato
         $breadcrumb = ['end' => 'Páginas'];

         $pages = Page::
         when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
             return $q->where('name','like','%'.$request->name.'%');
         })
         ->paginate(config('myconfig.paginate'));




        return view('admin.pages.index',compact('pages','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = ['admin.pages.index' => 'Páginas', 'end' => 'Cadastrar'];
        $page = new Page();
        $method = \Request::route()->getActionMethod();

        return view('admin.pages.create', compact('breadcrumb', 'page', 'method'));
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
            'title' => 'required|max:255',
            'body' => 'required',
        ]);


        //salva as informações
        try {
            $dados = $request->only('title','body');
            //prepara o slug
            $slug = Str::slug($dados['title']);
            $dados['slug'] = $slug;




            //salva
            if (!$register = Page::create($dados)) {
                return redirect(route('admin.pages.index'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            return redirect(route('admin.pages.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.pages.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
         //home / Contato
         $breadcrumb = ['end' => 'Páginas'];
         $method = 'edit';



        return view('admin.pages.show',compact('page','method','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //faz a validação dos dados
        $request->validate([
            'title' => 'required|max:255|unique:pages,id,'.$page->id,
        ]);

        //salva as informações
        try {
            $dados = $request->only('title','body');
            //prepara o slug
            $slug = Str::slug($dados['title']);
            $dados['slug'] = $slug;

            //salva os dados
            $page->title = $dados['title'];
            $page->body = $dados['body'];
            $page->slug = $dados['slug'];
            $page->save();


            //se tudo ocorreu
            return redirect(route('admin.pages.index'))->with('success', __('general.msg_success', ['id' => $page->id]));
        } catch (\Exception $e) {

            return $e->getMessage();
            return redirect(route('admin.page.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        try {
            $page->delete();
            //se tudo ocorreu
            return redirect(route('admin.pages.index'))->with('success', __('general.msg_success_delete', ['id' => $page->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.pages.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.pages.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }
}
