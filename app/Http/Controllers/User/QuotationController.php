<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quotation;

class QuotationController extends Controller
{
    public function index()
    {
        return view('quotation.index', ['quotations' => []]);
    }

    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'infos'             => ['required', 'min:25'],
                'title'             => ['required', 'min:5'],
                'operation_city'    => ['required'],
                'operation_uf'      => ['required'],
                'subcategory_id'    => ['required'],
            ]);

            $quot = new Quotation();

            $quot->title    = $request->title;
            $quot->infos    = strip_tags(trim($request->infos));
            $quot->status   = Quotation::STATUS_OPEN;

            //relacionamentos
            $quot->subcategories()->attach((array)$request->subcategory_id);
            $quot->cities()->sync((array)$request->operation_city);
            $quot->ufs()->sync((array)$request->operation_uf);

            $quot->save();

            return response()->json($request->all(), 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['type' => 'error', 'message' => $e->errors()]);
        } catch (\Exception  $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage() . ', Contate o suporte!']);
        }
    }
}
