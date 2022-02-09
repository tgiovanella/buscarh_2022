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
        
            $promotor = count(Nps::where('answer', '>=8')->get() ) ? count( Nps::where('answer', '>=8')->get()) : 0 ;
            $neutro = count(Nps::where('answer', '>= 6')->where('answer', '<= 7')->get() ) ? count( Nps::where('answer', '>= 6')->where('answer', '<= 7')->get()) : 0;
            $detrator = count(Nps::where('answer', '< 6')->get() ) ? count( Nps::where('answer', '< 6')->get()) : 0;

        return view('admin.nps.index', compact('breadcrumb', 'nps', 'promotor', 'neutro', 'detrator'));
    }
}
