<?php

namespace App\Exports;

use App\SearchAnalytic;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class SearchAnalyticExport implements FromCollection, WithHeadings
{
    use Exportable;


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SearchAnalytic::select('term', 'languages', 'platform', 'browser', 'version_browser', 'remote_addr',
        'url', 'created_at')->get(); 
    }


    public function headings(): array
    {
        return [
            'Termo',
            'Linguagens',
            'Plataforma',
            'Navegador',
            'Versão Navegador',
            'IP',
            'URL',
            'Data'
        ];
    }
}
