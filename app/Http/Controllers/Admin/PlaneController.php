<?php

namespace App\Http\Controllers\Admin;

use App\Plane;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use PagSeguroRecorrente;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Planos'];

        $planes = Plane::when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->name . '%');
        })
            ->paginate(config('myconfig.paginate'));

        return view('admin.planes.index', compact('planes', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = ['admin.planes.index' => 'Planos', 'end' => 'Cadastrar'];
        $plane = new Plane();
        $method = \Request::route()->getActionMethod();

        return view('admin.planes.create', compact('breadcrumb', 'plane', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->role());



        //salva as informações
        try {

            DB::beginTransaction();

            $dados = $request->only('name', 'period', 'amount_per_payment', 'trial_period_duration', 'details');
            //prepara o slug

            //prepara o slug
            $dados['reference'] = $this->referenceGenerate($dados);


            // return $dados;
            //envia para a pagaseguro
            $dados['code'] = PagSeguroRecorrente::setReference($dados['reference']) //chamada deste método é opcional
                ->sendPreApprovalRequest([
                    'preApprovalName' => $dados['name'], //Nome do plano
                    'preApprovalCharge' => 'AUTO', //Tipo de Cobrança
                    'preApprovalPeriod' =>  $dados['period'], //Periodicidade do plano
                    'preApprovalAmountPerPayment' => $dados['amount_per_payment'], //Valor exato da cobrança
                    'preApprovalTrialPeriodDuration' => $dados['trial_period_duration'], //Tempo de teste OPCIONAL
                ]);

                return $dados;



            //salva
            if (!$register = Plane::create($dados)) {
                DB::rollback();
                return redirect(route('admin.planes.index'))->with('error', __('general.msg_error'));
            }


            DB::commit();

            //se tudo ocorreu
            return redirect(route('admin.planes.index'))->with('success', __('general.msg_success', ['id' => $register->id]));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('admin.planes.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function show(Plane $plane)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function edit(Plane $plane)
    {
        //home / Contato
        $breadcrumb = ['admin.planes.index' => 'Planos', 'end' => 'Editar'];
        $method = 'edit';



        return view('admin.planes.edit', compact('plane', 'blocks', 'method', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plane $plane)
    {
        //faz a validação dos dados
        $request->validate($this->role());

        //salva as informações
        try {
            $dados = $request->only('name', 'period', 'amount_per_payment', 'trial_period_duration', 'details');


            //SE AINDA NÃO EXISTE PLANO, VINCULA
            if (!$plane->code) {
                $dados['code'] = PagSeguroRecorrente::setReference($plane->reference) //chamada deste método é opcional
                    ->sendPreApprovalRequest([
                        'preApprovalName' => $dados['name'], //Nome do plano
                        'preApprovalCharge' => 'AUTO', //Tipo de Cobrança
                        'preApprovalPeriod' =>  $dados['period'], //Periodicidade do plano
                        'preApprovalAmountPerPayment' => $dados['amount_per_payment'], //Valor exato da cobrança
                        'preApprovalTrialPeriodDuration' => $dados['trial_period_duration'], //Tempo de teste OPCIONAL
                    ]);
            } else {
                $dados['code'] = null;
            }
            //envia para a pagaseguro


            //salva os dados
            $plane->name = $dados['name'];
            $plane->period = $dados['period'];
            $plane->amount_per_payment = $dados['amount_per_payment'];
            $plane->trial_period_duration = $dados['trial_period_duration'];
            $plane->details = $dados['details'];
            // $plane->reference = $dados['reference'];
            $plane->code = $dados['code'];


            $plane->save();


            //se tudo ocorreu
            return redirect(route('admin.planes.index'))->with('success', __('general.msg_success', ['id' => $plane->id]));
        } catch (\Exception $e) {

            return redirect(route('admin.planes.index'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plane $plane)
    {
        //
    }

    private function role()
    {
        return [
            'name' => 'required',
            'period' => 'required',
            'amount_per_payment' => 'required|numeric|min:1',
            'trial_period_duration' => 'numeric',
        ];
    }

    private function referenceGenerate($dados)
    {
        return Str::slug($dados['name'] . '_' .  $dados['amount_per_payment'] . '_' . $dados['period'] . '_' . uniqid(rand()), '_');
    }
}
