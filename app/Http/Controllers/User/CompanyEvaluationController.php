<?php

namespace App\Http\Controllers\User;


use App\CompanyEvaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class CompanyEvaluationController extends Controller
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
    public function create($id)
    {
        $user_id = \Auth::user()->id ?? null; 
        return view('user.companyevaluation.create',compact('id','user_id'));
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
            'company_id' => 'required|max:255',
            'note' => 'required|max:100',
            'message' => 'required',
        ]);

        $id = $request->company_id;
        //salva as informações
        try {
            $dados = $request->only(
                'user_id',
                'company_id',
                'note',
                'message'
            );

            



            //salva
            if (!$register = CompanyEvaluation::create($dados)) {

                return redirect(route('user.companyevaluation.create',$id))->with('error', __('general.msg_error'));
            }

            


            //se tudo ocorreu
            return redirect(route('user.companyevaluation.create',$id))->with('success', __('general.msg_contact_success'));
        } catch (\Exception $e) {

            return $e->getMessage();

            return redirect(route('user.companyevaluation.create'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyEvaluation  $companyEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEvaluation $companyEvaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyEvaluation  $companyEvaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyEvaluation $companyEvaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyEvaluation  $companyEvaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyEvaluation $companyEvaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyEvaluation  $companyEvaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyEvaluation $companyEvaluation)
    {
        //
    }
}
