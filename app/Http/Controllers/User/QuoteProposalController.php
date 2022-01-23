<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuoteCandidate;
use Illuminate\Support\Facades\Auth;

class QuoteProposalController extends Controller
{
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'comment'             => ['required'],
                'price'             => ['required']
            ]);

            $quot = new QuoteCandidate();

            $quot->comment      = $request->comment;
            $quot->price        = $request->price;
            $quot->taxes        = $request->taxes;
            $quot->expenditure  = $request->expenditure;
            $quot->deadline     = $request->deadline;
            $quot->user_id      = Auth::user()->id;
            $quot->company_id   = $request->company_id;
            $quot->quote_id     = $request->quote_id;

            $upload = $this->_uploadFile($request);

            $quot->path_file = $upload;

            $quot->save();

            return redirect('/users');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['type' => 'error', 'message' => $e->errors()]);
        } catch (\Exception  $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage() . ', Contate o suporte!']);
        }
    }
    /**
     * Método que realiza o upload.
     */
    private function _uploadFile($request)
    {
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;
    
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('path_file') && $request->file('path_file')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = $request->quote_id . '_' . uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->path_file->extension();
    
            // Define finalmente o nome
            $nameFile = "cotacao_{$name}.{$extension}";
    
            // Faz o upload:
            //Arquivo
            $upload = $request->path_file->storeAs('proposta', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/proposta/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload ) {
                return redirect()->back()->with('error', 'Falha ao fazer upload')->withInput();
            } else {
                return $upload;
            }
    
        }
    }
}
