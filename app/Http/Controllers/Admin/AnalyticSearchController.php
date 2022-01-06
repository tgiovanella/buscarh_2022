<?php

namespace App\Http\Controllers\Admin;

use App\SearchAnalytic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SearchAnalyticExport;

class AnalyticSearchController extends Controller
{



    public function terms(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Termos Pesquisados'];

        $analytics = SearchAnalytic::when(isset($request->term) && !empty($request->term), function ($q) use ($request) {
            return $q->where('term', 'like', '%' . $request->term . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(config('myconfig.paginate'));


        return view('admin.analytics.terms', compact('analytics', 'breadcrumb'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function export() 
    {
        return Excel::download(new SearchAnalyticExport(), 'terms.xlsx');
    }
}
