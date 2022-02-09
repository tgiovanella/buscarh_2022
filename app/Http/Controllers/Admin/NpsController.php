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
        
            //Totais
            $promotor =  Nps::where('answer', '>=', 8)->get();
            $neutro =  Nps::whereIn('answer',[6,7])->get();
            $detrator =  Nps::where('answer', '<', 6)->get();

            $totais = Nps::get();

            //Médias
            $mediaGeral = count($totais) > 0 ? $totais->sum('answer') / count($totais) : 0;
            $mediaPromotor = count($promotor) > 0 ? $promotor->sum('answer') / count($promotor) : 0;
            $mediaNeutro = count($neutro) > 0 ? $neutro->sum('answer') / count($neutro) : 0;
            $mediaDetrator = count($detrator) > 0 ? $detrator->sum('answer') / count($detrator) : 0;

        return view('admin.nps.index', compact('breadcrumb', 'nps', 'promotor', 'neutro', 'detrator', 'mediaGeral', 'mediaPromotor', 'mediaNeutro', 'mediaDetrator' ));
    }
}
