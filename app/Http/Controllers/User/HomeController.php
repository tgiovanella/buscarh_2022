<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::check() && !is_complete_data_user(Auth::user())) { //se estiver logado
            // return Auth::user();


        }

        $categories = Category::select('id', 'name', 'slug')->orderBy('order','asc')->get();


        return view('user.home.index', compact('categories'));
    }

    public function segundo()
    {
        return view('user.home.segundo');
    }
}
