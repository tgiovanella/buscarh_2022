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

}
