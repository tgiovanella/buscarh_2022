<?php

namespace App\Http\Controllers\Api;

use App\Advert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{

    //TIPO
    // const TYPE_SLIDE = 1;
    // const TYPE_CLOUD = 2;
    // const TYPE_FULL = 3;
    // const TYPE_SIDEBAR = 4;


    public function full($category = null)
    {
        $category = null; //força para aprecer para todos
        return Advert::with(['file', 'configuration'])
            ->whereHas('configuration', function ($query) {
                $query->where('type', '=', Advert::TYPE_FULL);
            })
            ->whereHas('file', function ($query) {
                $query->whereNotNull('id');
            })
            ->when(isset($category) && !empty($category), function ($q) use ($category) {
                $q->whereHas('subcategory.category',function($query) use ($category) {
                    $query->where('id',$category);
                });
            })
            ->where('status', Advert::STATUS_ANNOUNCED)
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }

    public function slideLogo()
    {
        return Advert::with(['file', 'configuration'])
            ->whereHas('configuration', function ($query) {
                $query->where('type', '=', Advert::TYPE_SLIDE);
            })
            ->whereHas('file', function ($query) {
                $query->whereNotNull('id');
            })
            ->where('status', Advert::STATUS_ANNOUNCED)
            ->inRandomOrder()
            ->get();
    }

    public function slideCloud()
    {
        return Advert::with(['file', 'configuration'])
            ->whereHas('configuration', function ($query) {
                $query->where('type', '=', Advert::TYPE_CLOUD);
            })
            ->whereHas('file', function ($query) {
                $query->whereNotNull('id');
            })
            ->where('status', Advert::STATUS_ANNOUNCED)
            ->inRandomOrder()
            ->get();
    }

    public function slideSidebar($category = null)
    {

        $category = null; //força para aprecer para todos



        return Advert::with(['file', 'configuration','subcategory.category'])
            ->whereHas('configuration', function ($query) {
                $query->where('type', '=', Advert::TYPE_SIDEBAR);
            })
            ->whereHas('file', function ($query) {
                $query->whereNotNull('id');
            })
            ->when(isset($category) && !empty($category), function ($q) use ($category) {
                $q->whereHas('subcategory.category',function($query) use ($category) {
                    $query->where('id',$category);
                });
            })

            ->where([['status', Advert::STATUS_ANNOUNCED]])
            ->inRandomOrder()
            ->get();
    }
}
