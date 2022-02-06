<?php

namespace App\Http\Controllers\Admin;

use App\Nps;
use App\Http\Controllers\Controller;

class NpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //home / Contato
        $breadcrumb = ['end' => 'Nps'];

        $nps = Nps::when(1==1 , function ($q) {
            return $q;
        })
            ->paginate(config('myconfig.paginate'));
        
            $npsNegativo = count(Nps::where('answer', 0)->get());
            $npsPositivo = count(Nps::where('answer', 1)->get());

        return view('admin.nps.index', compact('breadcrumb', 'nps', 'npsNegativo', 'npsPositivo'));
    }
}
