<?php

namespace App\Http\Controllers\User;

use App\PageNav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Controler resonsável por montar os menus isntitucionais
 */
class NavigationController extends Controller
{

    public function getMenu($block, $layout) {

        $links = PageNav::where([['page_block_id',$block],['status',true]])->orderBy('order')->get();

        return view('user.layouts.navigations.'.$layout,compact('links'))->render();

    }

}
