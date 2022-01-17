<?php

namespace App\Http\Controllers\User;

use App\Company;
use App\Http\Controllers\Controller;
use App\Mail\SendMailQuotation;
use App\Quote;
use App\QuoteCandidateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{

    /**
     * Dispara os email para prestadores
     * Afim de evitar travamento do browser, fiz como rota API, usada com WorkerProccess com javascript
     * Modificar em caso de usar background process no php
     */
    public function dispatchQuotation(int $id)
    {

        try {
            $quot = Quote::where('id', $id)->with(['subcategories', 'cities'])->firstOrFail();

            $cities = array_values(array_column($quot->cities->toArray(), 'id'));
            $sub = array_values(array_column($quot->subcategories->toArray(), 'id'));
            //Localiza os prestadores
            $applicants = Company::with(
                [
                    'city' => fn ($m) => $m->whereIn('id', $cities),
                    'subcategories' => fn ($m) => $m->whereIn('subcategories.id', $sub)
                ]
            )->get();
            $found = 0;
            $company_founds = [];
            foreach ($applicants  as $applicant) {
                //deve estar em ao menos uma das categoria e uma das cidades
                if ($applicant->subcategories !== null && $applicant->city !== null) {
                    /* var_dump($applicant->email); */
                    ++$found;

                    $company_founds[] = ['company_id' => $applicant->id, 'quote_id' => $id];
                    //envia o email
                    // Mail::to($applicant->email)->send(new SendMailQuotation($applicant, $quot));
                }
            }

            if ($found === 0) {
                return response()->json(['type' => 'error', 'message' => "Não foram encontrados prestadores nas cidades selecionadas!"]);
            }
            QuoteCandidateNotification::insert($company_founds);

            return response()->json(['type' => 'success', 'message' => "Notificação foram enviadas com sucesso, {$found} empresas foram notificadas!"]);
        } catch (\Exception $th) {
            return response()->json(['type' => 'error', 'message' =>  $th->getMessage()]);
        }
    }
}
