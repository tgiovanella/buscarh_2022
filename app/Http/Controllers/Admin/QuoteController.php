<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Exports\QuoteExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\State;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class QuoteController extends Controller
{

    const STATUS = ['ACCEPT', 'OPEN'];
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

        $quote = Quote::where('user_id', Auth::user()->id)
            ->with(['subcategories', 'cities', 'company', 'candidates' => fn ($q) => $q->with('company')])
            ->whereHas('subcategories', fn ($query) => $query->whereIn('subcategory_id', $request->subcategory_id))
            ->whereHas('cities', fn ($query) => $query->whereIn('city_id', $request->operation_city))
            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->initial)), date('Y-m-d 23:59:59', strtotime($request->end))])
            ->whereIn('status', isset(self::STATUS[$request->inlineRadioOptions]) ? [self::STATUS[$request->inlineRadioOptions]] : self::STATUS)
            ->get();

        return $quote;
    }

    public function export(Request $request)
    {
        return Excel::download(new QuoteExport($request), 'cotacoes.xlsx');
    }

    public function exportPDF(Request $request)
    {

        $quotes = $this->search($request);

        $inicio = $request->initial;
        $fim = $request->end;
        $status = ['Finalizados', 'Abertos', 'Todas'][$request->inlineRadioOptions];

        $pdf = \PDF::loadView('admin.reports.quotepdf', compact('quotes', 'inicio', 'fim', 'status'));

        return  response($pdf->output())->withHeaders(
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => "inline; filename=cotacoes.pdf",
            ]
        );
    }
}
