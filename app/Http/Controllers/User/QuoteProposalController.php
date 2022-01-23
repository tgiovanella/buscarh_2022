<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuoteCandidate;
use Illuminate\Support\Facades\Auth;

class QuoteProposalController extends Controller
{
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'comment'             => ['required'],
                'price'             => ['required']
            ]);

            $quot = new QuoteCandidate();

            $quot->comment      = $request->comment;
            $quot->price        = $request->price;
            $quot->taxes        = $request->taxes;
            $quot->expenditure  = $request->expenditure;
            $quot->deadline     = $request->deadline;
            $quot->user_id      = Auth::user()->id;
            $quot->company_id   = $request->company_id;
            $quot->quote_id     = $request->quote_id;
            $quot->save();

            return redirect('/users');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['type' => 'error', 'message' => $e->errors()]);
        } catch (\Exception  $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage() . ', Contate o suporte!']);
        }
    }
}
