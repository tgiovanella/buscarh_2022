<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Subcategoria'];

        $categories = Category::all();

        $subcategories = Subcategory::
        when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('name','like','%'.$request->name.'%');
        })
        ->when(isset($request->category) && !empty($request->category), function ($q) use ($request) {
            return $q->where('category_id','=',$request->category);
        })
        ->paginate(config('myconfig.paginate'));



        return view('admin.subcategories.index',compact('breadcrumb', 'subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //home / Contato
        $breadcrumb = ['admin.subcategories.index' => 'Subcategorias','end' => 'Nova'];

        $subcategory = new Subcategory();

        $categories = Category::all();

        $method = 'create';

        return view('admin.subcategories.create',compact('breadcrumb','method','subcategory','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:subcategories',
            'category_id' => 'required'
        ]);

        $data = $request->only(['name','category_id']);
        $data['slug'] = Str::slug($data['name']);

        Subcategory::create($data);

        return redirect(route('admin.subcategories.index'))->with('success','Enviado com success');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {


        //home / Contato
        $breadcrumb = ['admin.subcategories.index' => 'Subcategorias','end' => 'Editar'];

        $method = 'edit';

        $categories = Category::all();



        return view('admin.subcategories.edit',compact('subcategory','categories','method','breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|max:255|unique:subcategories,id,'.$subcategory->id,
        ]);
;


        //salva as informações
        try {

            //prepara o slug

            $data = $request->only(['name']);
            $data['slug'] = Str::slug($data['name']);

            //salva os dados
            $subcategory->name = $data['name'];
            $subcategory->slug = $data['slug'];
            $subcategory->save();


            //se tudo ocorreu
            return redirect(route('admin.subcategories.index'))->with('success', __('general.msg_success', ['id' => $subcategory->id]));
        } catch (\Exception $e) {
            return redirect(route('admin.subcategories.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //salva as informações
        try {
            $subcategory->delete();
            //se tudo ocorreu
            return redirect(route('admin.subcategories.index'))->with('success', __('general.msg_success_delete', ['id' => $subcategory->id]));
        } catch (\Exception $e) {

            //caso for integriddade de fk
            if ($e->getCode() == config('myconfig.execptions.existing_record'))
                return redirect(route('admin.subcategories.index'))->with('warning', __('general.msg_alert_fk'));

            return redirect(route('admin.subcategories.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }
}
