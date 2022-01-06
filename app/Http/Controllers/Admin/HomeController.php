<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\User;
use App\Advert;
use App\Contact;
use App\SearchAnalytic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inscription;
use App\FestivalGrade;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {


        $new_companies = Company::where('created_at', '>=', date('Y-m-d', strtotime("first day of this month")))
            ->count();

        $user_register = User::count();

        $terms_seach = SearchAnalytic::where('created_at', '>=', date('Y-m-d', strtotime("first day of this month")))->count();

        $search_analytics = SearchAnalytic::orderBy('created_at', 'desc')
            ->limit(5)
                ->get();

        $total_companies = Company::count();
        $total_adverts = Advert::count();
        $total_contact = Contact::count();






        return view('admin.home.index', compact('new_companies','user_register','search_analytics','terms_seach','total_companies','total_adverts','total_contact'));
    }
}
