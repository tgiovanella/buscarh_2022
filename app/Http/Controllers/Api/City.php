<?php

namespace App\Http\Controllers\Api;

use App\City as AppCity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class City extends Controller
{

    public function citiesUF(/* ?string  */$ufs = null)
    {
        $cities = [];
        if ($ufs) {
            $ufs = array_map('intval', explode(',', $ufs) ?? [$ufs]);
            $cities = AppCity::whereIn('state_id', $ufs)->get();
        }
        return response()->json($cities);
    }

    public function cities($uf = null, $id = null)
    {
        return AppCity::select('*')
            ->when(isset($id) && !empty($id), function ($q) use ($id) {
                return $q->where('id', $id);
            })
            ->when(isset($uf) && !empty($uf), function ($q) use ($uf) {
                return $q->where('state_id', $uf);
            })
            ->get();
    }

    public function citiesLike($term = null)
    {
        return AppCity::select('cities.id', DB::raw('CONCAT(cities.title,"/",states.letter) as text'))
            ->when(isset($term) && !empty($term), function ($q) use ($term) {
                return $q->where('cities.title', 'like', '%' . $term . '%');
            })->leftJoin('states', 'states.id', '=', 'cities.state_id')
            ->get();
    }
}
