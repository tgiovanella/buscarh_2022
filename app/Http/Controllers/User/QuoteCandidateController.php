<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\QuoteCandidate;
use App\QuoteCandidateNotification;
use App\User;
use Illuminate\Support\Facades\Auth;

class QuoteCandidateController extends Controller
{

    public function index(int $quote_id)
    {

        $quotes_avalaibles = Quote::where('id', $quote_id)->with(['candidates' => fn ($m) => $m->with('company')])->first();

        return view('user.quotations.candidates', ['quotes_avalaibles' => $quotes_avalaibles]);
    }
    public function opportunity()
    {
        $candidate = User::where('id', Auth::user()->id)->whereHas('companies')->with('companies')->first();

        $notify = QuoteCandidateNotification::whereIn('company_id', $candidate->companies->pluck('id'))->with(['quote'=>fn($m)=>$m->with('company')])->get();

        return view('user.quotations.index', ['quotes' => $notify]);
    }

    public function update()
    {
        
    }
}
