<?php

namespace App\Http\Controllers\User;

use App\City;
use App\State;
use App\Company;
use App\Category;
use App\CompanyClick;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanySearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category = null, $subcategory = null)
    {


        // return $request;

        $uf = $request->input('uf'); //busca de estado
        $search = $request->input('q'); //busca de campo

        // return
        $companies = Company::select('companies.*')

            ->with('subcategories.category')
            ->with('city')
            ->when((isset($subcategory) && !empty($subcategory) && (isset($category) && !empty($category))), function ($q) use ($subcategory) {
                return $q->whereHas('subcategories', function ($q) use ($subcategory) {
                    return $q->where('subcategories.slug', '=', $subcategory);
                });
            })
            //filtra por categoria
            ->when(isset($category) && !empty($category), function ($q) use ($category) {
                return $q->whereHas('subcategories.category', function ($q) use ($category) {
                    return $q->where('categories.slug', '=', $category);
                });
            })
            //filtra por uf
            ->when(isset($uf) && !empty($uf), function ($q) use ($uf) {
                return $q->where('companies.uf', '=', $uf);
            })

            //filtro textual
            ->when(isset($search) && !empty($search), function ($q) use ($search) {

                //usa uma function para colocar um "and (expression1 and expression2 or expression3)
                return $q->where(function ($q2) use ($search) {
                    return $q2
                        ->where('companies.name', 'like', '%' . $search . '%')
                        ->orWhere('companies.fantasy', 'like', '%' . $search . '%')
                        ->orWhere('companies.uf', 'like', '%' . $search . '%')
                        ->orWhere('cities.title', 'like', '%' . $search . '%')
                        ->orWhere('categories.name', 'like', '%' . $search . '%')
                        ->orWhere('subcategories.name', 'like', '%' . $search . '%');




                        //testa a categoria
                        // ->orWhereHas('subcategories.category', function ($q3) use ($search) {
                        //     return $q3->orWhere('categories.name', 'like', '%' . $search . '%')
                        //         ->orWhere('subcategories.name', 'like', '%' . $search . '%');
                        // });
                        // ->orWhereHas('city', function ($q4) use ($search) {
                        //     return $q4->orWhere('cities.title', 'like', '%' . $search . '%');
                        // });
                });
                // return $q
                // ->where('companies.name','like', '%' . $search . '%')
                // ->orWhere('companies.fantasy','like', '%' . $search . '%');
            })
            ->leftJoin('cities', 'cities.id', '=', 'companies.city_id')
            ->leftJoin('company_subcategories', 'company_subcategories.company_id','=','companies.id')
            ->leftJoin('subcategories', 'subcategories.id', '=', 'company_subcategories.subcategory_id')
            ->leftJoin('categories', 'categories.id', '=', 'subcategories.category_id')
            ->orderBy('highlighted', 'desc')
            ->orderBy('companies.name', 'asc')
            ->distinct('companies.id')
            ->paginate(config('util.paginate'));

            // return $companies;


        //tras os ufs para montar o nav do filtro por estado
        $ufs = State::all();

        //sitebar da categoria
        $categories_sidebar = Category::with('subcategories')->where('slug', '=', $category)->first();


        return view('user.companies.index', compact('companies', 'categories_sidebar', 'ufs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($city, $slug, $id = null)
    {

        // return Str::slug($company->name. '-' . str_replace('-','',$company->cpf_cnpj))
        $company = Company::where('slug', $slug)->first();

        try {
            $data_click = [
                'letter_state' => $company->city->state->letter, 
                'iso_state' => $company->city->state->iso, 
                'city_name' => $company->city->title, 
                'company_name' => $company->name, 
                'company_id' => $company->id
            ];
    
            CompanyClick::create($data_click);
        } catch (\Exception $e) {
        
        }


        return view('user.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
