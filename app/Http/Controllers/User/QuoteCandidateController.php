<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\QuoteCandidate;
use Illuminate\Support\Facades\Auth;

class QuoteCandidateController extends Controller
{

    public function index(int $quote_id)
    {

        $quotes_avalaibles = Quote::where('id', $quote_id)->with(['candidates'=>fn($m)=>$m->with('company')])->first();

        return view('user.quotations.candidates', ['quotes_avalaibles' => $quotes_avalaibles]);
    }
}
