<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\QuoteCandidate;
use App\QuoteCandidateNotification;
use App\QuoteComment;
use App\User;
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

        $interested = QuoteCandidate::whereIn('company_id', $candidate->companies->pluck('id'))->pluck('company_id')->toArray();

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
}
