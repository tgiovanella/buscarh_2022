<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Doctrine\DBAL\Driver\PDOException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //home / Contato
        $breadcrumb = ['end' => 'Categoria'];

        $categories = Category::when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->name . '%');
        })
            ->paginate(config('myconfig.paginate'));



        return view('admin.categories.index', compact('breadcrumb', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $breadcrumb = ['admin.categories.index' => 'Categorias', 'end' => 'Cadastrar'];
        $category = new Category();
        $method = \Request::route()->getActionMethod();

        return view('admin.categories.create', compact('breadcrumb', 'category', 'method'));
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
            'name' => 'required|max:255|unique:categories',
        ]);


        //salva as informações
        try {
            $dados = $request->only('name');
            //prepara o slug
            $slug = Str::slug($dados['name']);
            $dados['slug'] = $slug;


            //salva
            if (!$register = Category::create($dados)) {
                return redirect(route('admin.categories.index'))->with('error', __('general.msg_error'));
            }

            //se tudo ocorreu
            return redirect(route('admin.categories.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.categories.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        //home / Contato
        $breadcrumb = ['admin.categories.index' => 'Categoria', 'end' => 'Editar'];

        $method = 'edit';

        return view('admin.categories.edit', compact('subcategory', 'category', 'method', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        //faz a validação dos dados
        $request->validate([
            'name' => 'required|max:255|unique:categories,id,'.$category->id,
        ]);

        //salva as informações
        try {
            $dados = $request->only('name');
            //prepara o slug
            $slug = Str::slug($dados['name']);
            $dados['slug'] = $slug;

            //salva os dados
            $category->name = $dados['name'];
            $category->slug = $dados['slug'];
            $category->save();


            //se tudo ocorreu
            return redirect(route('admin.categories.index'))->with('success', __('general.msg_success', ['id' => $category->id]));
        } catch (\Exception $e) {

            return $e->getMessage();
            return redirect(route('admin.categories.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //salva as informações
        try {
            $category->delete();
            //se tudo ocorreu
            return redirect(route('admin.categories.index'))->with('success', __('general.msg_success_delete', ['id' => $category->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.categories.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.categories.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }
}
