<?php

namespace App\Http\Controllers\Admin\Reports;

use App\CompanyClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RegionsReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Total de Cliques por Região'];

        $clicks = CompanyClick::select('letter_state',DB::raw('count(*) count'))
        ->groupBy('letter_state')->get();

       return view('admin.rep.regions',compact('clicks','breadcrumb'));
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
    public function show(Request $request, $uf)
    {
        $breadcrumb = ['admin.clicks-regions.index' => 'Total de Cliques e Regiões', 'end' => $uf];

        $clicks = CompanyClick::select('company_id', 'company_name','letter_state', DB::raw('count(*) count'))
        ->when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('company_name','like','%'.$request->name.'%');
        })
        ->where('letter_state',$uf)
        ->groupBy('company_id','company_name','letter_state')
        ->get();

       return view('admin.rep.regions-clicks',compact('clicks','breadcrumb','uf'));
    }

    public function detail($id)
    {
        $breadcrumb = ['admin.clicks-regions.index' => 'Total de Cliques e Regiões', 'end' => $id];


        $clicks = CompanyClick::where('company_id',$id)
        ->orderBy('created_at','desc')
        ->get();


       return view('admin.rep.regions-detail',compact('clicks','breadcrumb'));
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
