<?php

namespace App\Http\Controllers\Admin;

use App\ClaimCompany;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClaimCompanyController extends Controller
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

        $claims = ClaimCompany::when(isset($request->question) && !empty($request->question), function ($q) use ($request) {
            return $q->where('question', 'like', '%' . $request->question . '%');
        })->paginate(config('myconfig.paginate'));

        return view('admin.claims.index', compact('claims', 'breadcrumb'));
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
     * @param  \App\ClaimCompany  $claimCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ClaimCompany $claim, Request $request)
    {

        if($request->has('name')) {
            $name =  $request->name;
        } else {
            $name = $claim->company;
        }

        if($request->has('cpf_cnpj')) {
            $cpf_cnpj =  $request->cpf_cnpj;
        } else {
            $cpf_cnpj =  $claim->cnpj;

        }

        $companies = Company::
        when(isset($name) && !empty($name), function ($q) use ($name) {
            return $q->where('name', 'like', '%' . $name . '%')
            ->orWhere('fantasy','like','%' . $name . '%');
        })
        ->when(isset($cpf_cnpj) && !empty($cpf_cnpj), function ($q) use ($cpf_cnpj) {
            return $q->where('cpf_cnpj', 'like', '%' . $cpf_cnpj . '%');
        })
            ->orderBy('id', 'desc')
            //  ->orderBy('created_at','desc')
            ->paginate(config('myconfig.paginate'));
        return view('admin.claims.show', compact('claim','name','cpf_cnpj','companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClaimCompany  $claimCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ClaimCompany $claimCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClaimCompany  $claimCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClaimCompany $claimCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClaimCompany  $claimCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClaimCompany $claimCompany)
    {
        //
    }
}
