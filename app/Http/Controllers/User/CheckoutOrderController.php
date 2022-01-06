<?php

namespace App\Http\Controllers\User;

use App\Advert;
use PagSeguroRecorrente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CheckoutOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($token)
    {

        header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');

        $token_complet = $token;

        $token = explode('-', $token)[1];

        $ads = Advert::where('token_id', $token)->first();



        $plane = $ads->configuration->plane; //dados de configuração do plane



        if (Auth::check() && !is_complete_data_user(Auth::user())) { //se estiver logado
            // return Auth::user();
            return redirect(route('user.users.index', ['token' => $token_complet]));
        }

        // return $plane;

        return view('user.checkout.payment', compact('ads', 'plane'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




        DB::beginTransaction();


        try {


            $reference_payment = md5(uniqid(rand(), true));
            $hash = PagSeguroRecorrente::setPlan($request->plane_code)
                ->setReference($reference_payment) // OPCIONAL
                ->setSenderInfo([
                    'senderName' => $request->senderName,
                    'senderPhone' => $request->senderPhone, //Qualquer formato, desde que tenha o DDD
                    'senderEmail' => $request->senderEmail,
                    // 'senderIp' => '123.123.123.123', //OPCIONAL
                    'senderHash' => $request->senderHash,
                    'senderCPF' => $request->senderCPF //Ou senderCNPJ se for Pessoa Júridica
                ])
                ->setCreditCardHolder([
                    'creditCardHolderBirthDate' => $request->creditCardHolderBirthDate, //Deve estar nesse formato,
                ])
                ->setSenderAddress([
                    'senderAddressStreet' => $request->senderAddressStreet,
                    'senderAddressNumber' => $request->senderAddressNumber,
                    'senderAddressComplement' => $request->senderAddressComplement, // OPCIONAL
                    'senderAddressDistrict' => $request->senderAddressDistrict,
                    'senderAddressPostalCode' => $request->senderAddressPostalCode,
                    'senderAddressCity' => $request->senderAddressCity,
                    'senderAddressState' => $request->senderAddressState
                ])

                ->sendPreApproval([
                    'creditCardToken' => $request->creditCardToken
                ]);


            Log::info(print_r($request->all(), true));
            Log::info(print_r($hash, true));


            $ads = Advert::find($request->ads_id);
            $ads->status = Advert::STATUS_ANNOUNCED;

            // if($ads->type == Advert::TYPE_HIGHLIGHT) {
            // }

            $ads->save();

            $plane = $ads->configuration->plane; //dados de configuração do plane


            //atualiza os dados da ordem de pagamento
            $order = $ads->order_payment;
            $order->hash_payment = $hash;
            $order->status = 3; //status que foi pago
            $order->reference_payment = $reference_payment;
            $order->trial_expired_at = Carbon::now()->addDay($plane->trial_period_duration);
            $order->save();

            // "subscribed_at": "2020-01-07 04:02:56",
            // "expired_at": null,
            // "trial_expired_at": "2020-02-06 04:02:56",

            session()->flash('success', 'O pagamento foi processado.');

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $hash
            ]);
        } catch (\Exception $ex) {

            DB::rollback(); //faz rollback nas atualizações anteriores


            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function cancel(Advert $ads)
    {


        try {
            if (isset($ads->order_payment->hash_payment)) {
                $hash = $ads->order_payment->hash_payment;
                $result = PagSeguroRecorrente::cancelPreApproval($hash);

                $ads->status = Advert::STATUS_CANCELED;
                $ads->save();

                return redirect(route('user.users.ads.edit', $ads))->with('success', __('A sua assinatura foi cancelada com sucesso!'));
            }
        } catch (\Exception $e) {
            // return $ex->getMessage();
            return redirect(route('user.users.ads.edit', $ads))->with('error', __('Ocorreu algum problema ao cancelar.', ['exception' => $e->getMessage()]));
        }

        return redirect(route('user.users.ads.edit', $ads))->with('error', __('Ocorreu algum problema ao cancelar.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
