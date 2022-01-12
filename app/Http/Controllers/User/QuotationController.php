<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
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
                //'operation_uf'      => ['required'],
                'subcategory_id'    => ['required'],
            ]);

            $quot = new Quote();

            $quot->title        = $request->title;
            $quot->description  = strip_tags(trim($request->infos));
            $quot->status       = Quote::STATUS_OPEN;
            $quot->user_id      = Auth::user()->id;
            $quot->save();

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
}
