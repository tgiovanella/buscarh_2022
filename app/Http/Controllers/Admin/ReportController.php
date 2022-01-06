<?php

namespace App\Http\Controllers\Admin;

use App\Advert;
use App\Report;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        //home / Contato
        $breadcrumb = ['end' => 'Empresas Denunciadas'];

        $status = $request->input('status') ?? 1;


        $companies = Company::whereExists(function ($query) use ($status) {
            $query->select("reports.company_id")
                ->from('reports')
                ->whereRaw('reports.company_id = companies.id and reports.status = ' . $status);
        })
            // ->where('companies.status', true)
            // ->where('')
            ->paginate(config('myconfig.paginate'));



        // $reports = Company::leftJoin('reports', 'companies.id','=','reports.company_id')
        // ->whereNotNull('reports.company_id')
        // ->when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
        //     return $q->where('reports.name','like','%'.$request->name.'%');
        // })

        // ->paginate(config('myconfig.paginate'));



        //  $reports = Report::
        //  when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
        //      return $q->where('name','like','%'.$request->name.'%');
        //  })
        //  ->paginate(config('myconfig.paginate'));

        //  return $reports;


        return view('admin.reports.index', compact('companies', 'breadcrumb'));
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
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {

        //home / Contato
        $breadcrumb = ['admin.reports.index' => 'Denúncias', 'end' => 'Editar'];
        $method = 'edit';


        return view('admin.reports.show', compact('report', 'method', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }


    //realiza o bloqueio da empresa
    public function block($id, Request $request)
    {
        try {

            DB::beginTransaction();

            $company = Company::find($id);
            $company->status = false; //bloqueia a empresa
            $company->save();

            //pega todos as denuncias pendentes daquela empresa
            $reports = $company->reports()->where('status', Report::STATUS_PENDING)->get();

            foreach ($reports as $report) {
                $report->status = Report::STATUS_CONFIRMED; //CONFIRMA QUE É VALIDO
                $report->save();
            }

            DB::commit();
            return json_encode(['status' => true, 'message' => 'A empresa foi bloqueada com sucesso.']);
        } catch (\Exception $e) {

            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Não foi possível bloquear a empresa.']);
        }

    }


    public function ignoreBlock($id, Request $request)
    {
        try {

            DB::beginTransaction();

            $company = Company::find($id);
            $company->status = true; //desbloqueia a empresa
            $company->save();

            //pega todos as denuncias pendentes daquela empresa
            $reports = $company->reports()->where('status', Report::STATUS_PENDING)->get();

            foreach ($reports as $report) {
                $report->status = Report::STATUS_CANCELED; //CANCELA A DENUNCIA
                $report->save();
            }

            DB::commit();
            return json_encode(['status' => true, 'message' => 'As denúncias foram ignoradas.']);
        } catch (\Exception $e) {

            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Não foi possível cancelar as denúncias da empresa.']);
        }

    }


    public function indexAds(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Empresas Denunciadas'];

        $status = $request->input('status') ?? 1;


        $adverts = Advert::whereExists(function ($query) use ($status) {
            $query->select("reports.advert_id")
                ->from('reports')
                ->whereRaw('reports.advert_id = adverts.id and reports.status = ' . $status);
        })
            ->where('adverts.status', 2)
            ->with('reports')
            ->paginate(config('myconfig.paginate'));

                // ->whereRaw('reports.company_id = companies.id and reports.status = ' . $status);



        return view('admin.reports.index-ads', compact('adverts', 'breadcrumb'));
    }
}
