<?php

namespace App\Http\Controllers\User;

use App\Advert;
use App\Report;
use App\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMailReport;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
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

    public function createAds()
    {

        $ads = Advert::where('status', Advert::STATUS_APPROVED)->get();

        return view('user.reports.ad-report', compact('ads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {

        //faz a validação dos dados
        $request->validate([
            'name' => 'required|max:255',
            'cpf_cnpj' => 'required|max:255',
            'email' => 'required|email',
            'tag' => 'required',
            // 'g-recaptcha-response' => 'required|recaptcha',

        ]);

        //salva as informações
        try {
            $dados = $request->only(['name', 'cpf_cnpj', 'email', 'tag', 'observation']);

            $dados['company_id'] = $company->id;
            $dados['token'] = Str::random(32);

            // salva
            if (!$register = Report::create($dados)) {
                //empresa/{city}/{slug}	user.company.show
                return redirect(get_route_detail_company($company))->with('error', __('general.msg_error'));
            }

            //envia o email
            try {
                //envia o email
                Mail::to($request->email)
                    // ->cc('sheylacarla@garriga.com.br')
                    ->send(new SendMailReport($company, $dados));
            } catch (Exception $e) {
                // return $e->getMessage();

                session()->flash('warning', 'Ocorreu algum problema ao enviar o email!');
            }


            //se tudo ocorreu
            return redirect(get_route_detail_company($company))->with('success', __('general.msg_success_reports'));
        } catch (\Exception $e) {

            return $e->getMessage();
            return redirect(get_route_detail_company($company))->with('error', __('general.msg_error'));
        }
    }



    public function storeAds(Request $request)
    {


        //faz a validação dos dados
        $request->validate([
            'name' => 'required|max:255',
            'cpf_cnpj' => 'required|max:255',
            'email' => 'required|email',
            'tag' => 'required',
            // 'g-recaptcha-response' => 'required|recaptcha',

        ]);

        //salva as informações
        try {
            $dados = $request->only(['name', 'cpf_cnpj', 'email', 'tag', 'advert_id', 'observation']);


            $dados['token'] = Str::random(32);


            // salva
            if (!$register = Report::create($dados)) {
                return redirect(route('user.ads-reports.index'))->with('error', __('general.msg_error'));
            }

            //envia o email
            // try {
            //     //envia o email
            //     // Mail::to($request->email)
            //     //     // ->cc('sheylacarla@garriga.com.br')
            //     //     ->send(new SendMailReport($company, $dados));
            // } catch (Exception $e) {
            //     // return $e->getMessage();

            //     session()->flash('warning', 'Ocorreu algum problema ao enviar o email!');
            // }


            //se tudo ocorreu
            return redirect(route('user.ads-reports.index'))->with('success', __('general.msg_success_reports'));
        } catch (\Exception $e) {


            return redirect(route('user.ads-reports.index'))->with('error', __('general.msg_error'));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
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
}
