<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteCandidateController extends Controller
{

    public function index()
    {
        return view('user.quotations.candidates');
    }
}
