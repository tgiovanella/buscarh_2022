<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    public function index()
    {
        return view('quotation.index', ['quotations' => []]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'infos'             => ['required', 'min:25'],
            'title'             => ['required', 'min:5'],
            'operation_city'    => ['required'],
            'operation_uf'      => ['required'],
            'subcategory_id'    => ['required'],
        ]);

        return response()->json($request->all(), 200);
    }
}
