<?php

namespace App\Http\Controllers\User;

use App\Company;
use App\Http\Controllers\Controller;
use App\Mail\SendMailQuotation;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{

    /**
     * Dispara os email para prestadores
     * Afim de evitar travamento do browser, fiz como rota API, usada com WorkerProccess com javascript
     * Modificar em caso de usar background process no php
     */
    public function dispatchQuotation(Request $request)
    {
        $quot = Quotation::where('id', $request->id)->with(['subcategories', 'cities'])->first();

        if ($quot) {
            $applicants = Company::whereHas(
                'subcategories',
                fn ($s) => $s->whereIn('subcategory_id', (array)$quot->subcategories->pluck('id'))
            )->whereHas(
                'cities',
                fn ($c) => $c->whereIn('city_id', (array)$quot->cities->pluck('id'))
            )->get();

            foreach ($applicants  as $applicant) {

                Mail::to($applicant->email)->send(new SendMailQuotation($applicant, $quot->rh));
            }

            return response()->json(['messagem' => 'Email foi disparado com sucesso!']);
        }
        return response()->json(['messagem' => __('general.msg_error_exception')]);
    }
}
