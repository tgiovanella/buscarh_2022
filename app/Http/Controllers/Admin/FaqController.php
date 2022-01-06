<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //home / Contato
         $breadcrumb = ['end' => 'FAQs'];

         $faqs = Faq::
         when(isset($request->question) && !empty($request->question), function ($q) use ($request) {
             return $q->where('question','like','%'.$request->question.'%');
         })
         ->paginate(config('myconfig.paginate'));

        return view('admin.faqs.index',compact('faqs','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = ['admin.pages.index' => 'FAQs', 'end' => 'Cadastrar'];
        $faq = new Faq();
        $method = \Request::route()->getActionMethod();

        return view('admin.faqs.create', compact('breadcrumb', 'faq', 'method'));
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
            $dados = $request->only('question','answer','order');
            //prepara o slug
            $slug = Str::slug($dados['question']);
            $dados['slug'] = $slug;


            //salva
            if (!$register = Faq::create($dados)) {
                return redirect(route('admin.faqs.index'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            return redirect(route('admin.faqs.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.faqs.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //home / Contato
        $breadcrumb = ['admin.faqs.index' => 'FAQs', 'end' => 'Editar'];
        $method = 'edit';



       return view('admin.faqs.edit',compact('faq','method','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //faz a validação dos dados
        $request->validate($this->role());

        //salva as informações
        try {
            $dados = $request->only('question','answer','order');

            //prepara o slug
            $slug = Str::slug($dados['question']);
            $dados['slug'] = $slug;

            //salva os dados
            $faq->question = $dados['question'];
            $faq->answer = $dados['answer'];
            $faq->order = $dados['order'];
            $faq->slug = $dados['slug'];
            $faq->save();


            //se tudo ocorreu
            return redirect(route('admin.faqs.index'))->with('success', __('general.msg_success', ['id' => $faq->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.faqs.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        //salva as informações
        try {
            $faq->delete();
            //se tudo ocorreu
            return redirect(route('admin.faqs.index'))->with('success', __('general.msg_success_delete', ['id' => $faq->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.faqs.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.faqs.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }


    //parametros para validação
    private function role() {
        return [
            'question' => 'required',
            'answer' => 'required',
            'order' => 'int',
        ];
    }


}
