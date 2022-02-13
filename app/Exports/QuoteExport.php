<?php

namespace App\Exports;

use App\Quote;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class QuoteExport implements FromView
{
    use Exportable;
    const STATUS = ['ACCEPT', 'OPEN'];

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $quote = Quote::where('user_id', Auth::user()->id)
            ->with(['subcategories', 'cities', 'company', 'candidates' => fn ($q) => $q->with('company')])
            ->whereHas('subcategories', fn ($query) => $query->whereIn('subcategory_id', $this->request->subcategory_id))
            ->whereHas('cities', fn ($query) => $query->whereIn('city_id', $this->request->operation_city))
            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($this->request->initial)), date('Y-m-d 23:59:59', strtotime($this->request->end))])
            ->whereIn('status', isset(self::STATUS[$this->request->inlineRadioOptions]) ? [self::STATUS[$this->request->inlineRadioOptions]] : self::STATUS)
            ->get();

        return view('admin.reports.quote', [
            'quotes' =>  $quote
        ]);
    }
}
