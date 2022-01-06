<?php

namespace App\Http\Controllers\Admin;

use App\OrderPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //home / Contato
        $breadcrumb = ['end' => 'Assinaturas'];


        $orders = OrderPayment::when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            // return $q->where('name', 'like', '%' . $request->name . '%');
        })
        ->whereHas('ads.company', function ($query) {

        })->with(['ads.company','user'])
            ->paginate(config('myconfig.paginate'));

        return view('admin.orders.index', compact('orders', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function show(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderPayment $orderPayment)
    {
        //
    }
}
