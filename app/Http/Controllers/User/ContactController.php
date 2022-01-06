<?php

namespace App\Http\Controllers\User;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMailContact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
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
    public function create()
    {
        return view('user.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //faz a validação dos dados
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'subject' => 'required|max:100',
            'message' => 'required',
            // 'g-recaptcha-response' => 'required|recaptcha'

        ]);


        //salva as informações
        try {
            $dados = $request->only(
                'name',
                'email',
                'subject',
                'message'
            );




            //salva
            if (!$register = Contact::create($dados)) {

                return redirect(route('user.contacts.create'))->with('error', __('general.msg_error'));
            }




            //envia o email
            try {
                //envia o email
                Mail::to('contato@buscarhweb.com.br')
                    // ->cc('sheylacarla@garriga.com.br')
                    ->send(new SendMailContact($register));
            } catch (Exception $e) {
                //     return $e->getMessage();

                session()->flash('warning', 'Ocorreu algum problema ao enviar o email!');
            }


            // return $register;
            //se tudo ocorreu
            return redirect(route('user.contacts.create'))->with('success', __('general.msg_contact_success'));
        } catch (\Exception $e) {

            return $e->getMessage();

            return redirect(route('user.contacts.create'))->with('error', __('general.msg_error_exception', ['exception' => $e->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
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
