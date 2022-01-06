<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Company;
use Illuminate\Http\Request;

use App\Exports\CompanyExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ContactsReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //home / Contato
         $breadcrumb = ['end' => 'Relatório de Contatos por Empresa'];

         $companies = Company::
         when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
             return $q->where('name','like','%'.$request->name.'%');
         })
         ->paginate(150);

        //  return $companies;

        return view('admin.rep.contacts',compact('companies','breadcrumb'));
        
    }

    public function export() 
    {
        return Excel::download(new CompanyExport(), 'companies.xlsx');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
