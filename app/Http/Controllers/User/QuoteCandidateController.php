<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\QuoteCandidate;
use App\QuoteCandidateNotification;
use App\QuoteComment;
use App\User;
use App\QuoteNps;
use Dotenv\Regex\Success;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuoteCandidateController extends Controller
{

    public function index(int $quote_id)
    {

        $quotes_avalaibles = Quote::where('id', $quote_id)->whereNotIn('status', ['ACCEPT'])
            ->with(
                [
                    'candidates' => fn ($m) => $m->with('company')->withCount('comments')
                ]
            )->first();

        return view('user.quotations.candidates', ['quotes_avalaibles' => $quotes_avalaibles]);
    }

    public function opportunity()
    {
        $candidate = User::where('id', Auth::user()->id)->whereHas('companies')->with('companies')->first();

        $interested = QuoteCandidate::whereIn('company_id', $candidate->companies->pluck('id'))->pluck('quote_id')->toArray();

        $notify = QuoteCandidateNotification::whereHas('quote')->whereIn('company_id', $candidate->companies->pluck('id'))
            ->with([
                'quote' => fn ($m) => $m > with('company'),
            ])
            ->get(); 

        return view('user.quotations.index', ['quotes' => $notify, 'interested' => $interested, 'candidate' => $candidate->companies]);
    }

    public function info($id)
    {
        $candidate = QuoteCandidate::where('id', $id)->with('company')->first();

        return view('user.proposal.info', ['candidate' => $candidate]);
    }

    //aceita proposta
    public function acceptProposal(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $quote = Quote::find($request->id);

                $quote->status = 'ACCEPT';
                $quote->proposal_id = $request->proposal_id;
                $quote->save();

                $proposal  = QuoteCandidate::find($request->proposal_id);

                $proposal->accepted_proposal = 'ACCEPT';
                $proposal->save();

                //atualiza ou cria 
                QuoteComment::updateOrCreate([
                    'proposal_id' => $proposal->id, 'quote_id' => $quote->id
                ], [
                    'finish_quote' => true,
                    'company_id' =>  $proposal->company_id,
                    'user_id' => Auth::user()->id,
                    'comment' => 'Finalizado'
                ]);
            });

            return response()->json(['type' => 'success', 'message' => 'Proposta foi aceita com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage() . " Contate o suporte!"]);
        }
    }

    /**
     * Retorna todas as propostas aceitas para esse prestador
     */
    public function getProposalAccept()
    {
        $candidate = User::where('id', Auth::user()->id)->whereHas('companies')->with('companies')->first();

        $interested = QuoteCandidate::whereIn('company_id', $candidate->companies->pluck('id'))->pluck('company_id')->toArray();

        $notify = QuoteCandidateNotification::whereHas('quote')->whereIn('company_id', $candidate->companies->pluck('id'))
            ->with([
                'quote' => fn ($m) => $m>with('company'),
            ])
            ->get();

        return view('user.quotations.index', ['quotes' => $notify, 'interested' => $interested, 'candidate' => $candidate->companies]);
    }
    /**
     * Função que verifica se o prestador ja respondeu o NPS das propostas aceitas
     */
    public function saveNps(Request $request)
    {
        try {
            $nps = new QuoteNps();
            $nps->user_id = $request->user_id;
            $nps->company_id = $request->company_id;
            $nps->quote_id = $request->quote_id;
            $nps->comment = $request->comment;
            $nps->answer = $request->answer;
            $nps->save();


            //Atualiza o campo NPS na tabela candidate_quotes
            $candidate = QuoteCandidate::where("id", $request->id)->first();
            $candidate->nps_answer = '1';
            $candidate->save();
            return response()->json(['type' => 'success', 'message' => 'Deu bão!!']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage() . " Contate o suporte!"]);
        }
        
    }

}
