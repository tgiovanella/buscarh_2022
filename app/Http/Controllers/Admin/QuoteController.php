<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State;

class QuoteController extends Controller
{
    public function index()
    {

        $ufs = State::select('id', 'title', 'letter')->orderBy('title')->get();
        $categories = Category::has('subcategories')
            ->with(
                [
                    'subcategories' => fn ($q) => $q->orderBy('subcategories.name', 'ASC')
                ]
            )->orderBy('categories.name')->get();

        return view('admin.quotes.index', compact(
            'categories',
            'ufs',
        ));
    }

    public function search(Request $request)
    {
        return response()->json($request->all());
    }
}
