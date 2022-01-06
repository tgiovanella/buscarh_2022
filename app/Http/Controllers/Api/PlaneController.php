<?php

namespace App\Http\Controllers\Api;

use App\AdvertConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaneController extends Controller
{
    public function configuration($id = null)
    {
        $response = null;
        $configs = AdvertConfiguration::with('plane')

            ->when((isset($id) && !empty($id)), function ($q) use ($id) {
                return $q->where('advert_configurations.id', '=', $id);
            })->get()->toArray();

        $i = 0;
        foreach ($configs as $key => $value) {
            $configs[$i]['img'] = '/' . config('myconfig.img_type_ads.' . $value['type']);
            $configs[$i]['plane']['period'] = __('messages.' .  $configs[$i]['plane']['period']);

            $i++;
        }

        return collect($configs);
    }
}
