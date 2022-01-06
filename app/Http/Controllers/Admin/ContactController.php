<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //home / Contato
        $breadcrumb = ['end' => 'Contato'];

        $contacts = Contact::

        when(isset($request->date) && !empty($request->date), function ($q) use ($request) {
            return $q->where('created_at','=',convertDate($request->date));
        })
        ->when(isset($request->name) && !empty($request->name), function ($q) use ($request) {
            return $q->where('name','like','%'.$request->name.'%');
        })
        ->when(isset($request->email) && !empty($request->email), function ($q) use ($request) {
            return $q->where('email','like','%'.$request->email.'%');
        })
        ->when(isset($request->status) && !empty($request->status), function ($q) use ($request) {
            return $q->where('status','=',$request->status);
        })

        ->orderBy('created_at','desc')
        ->paginate(config('myconfig.paginate'));



        return view('admin.contacts.index', compact('breadcrumb','contacts'));
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
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //caminho home / contato / visualizar
        $breadcrumb = ['admin.contacts.index' => 'Contato','end' => 'Visualizar'];

        //se não houve leitura antes, então atualiza a leitura
        if($contact->status != Contact::STATUS_READ) {
            $contact->status = Contact::STATUS_READ; //atualza o status de leitura
            $contact->admin_id = Auth::guard('admin')->user()->id;
            $contact->read_at = Carbon::now();
            $contact->save();
        }

        return view('admin.contacts.show',compact('contact','breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
