<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\Company;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{


    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'infos'             => ['required', 'min:25'],
                'title'             => ['required', 'min:5'],
                'operation_city'    => ['required'],
                'company_id'        => ['required'],
                //'operation_uf'      => ['required'],
                'subcategory_id'    => ['required'],
            ]);

            $quot = new Quote();

            $quot->title        = $request->title;
            $quot->company_id   = $request->company_id;
            $quot->description  = strip_tags(trim($request->infos));
            $quot->status       = Quote::STATUS_OPEN;
            $quot->user_id      = Auth::user()->id;
            $quot->save();

            //Atualiza o saldo de moedas do solicitante.
            $company = Company::where("id", $request->company_id)->first();
            $company->used_coins = $company->used_coins + 20;
            $company->save();

            //relacionamentos
            $quot->subcategories()->attach((array)$request->subcategory_id);
            $quot->cities()->sync((array)$request->operation_city);

            return response()->json(['type' => 'success', 'message' => 'Cotação cadastrada com sucesso!', 'data' => $quot->toArray()], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['type' => 'error', 'message' => $e->errors()]);
        } catch (\Exception  $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage() . ', Contate o suporte!']);
        }
    }

    public function delete(Request $request)
    {

        $quote = Quote::find($request->id);
        $quote->subcategories()->detach();
        $quote->cities()->detach();
        $quote->candidates()->delete();

        $quote->delete();

        return response()->json(['type' => 'success', 'message' => 'Cotação removida com sucesso!'], 200);
    }
}
