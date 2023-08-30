<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concretas\LerArquivosTextoSalvador;
use App\Concretas\CriarArquivoTexto;
use Illuminate\Support\Facades\Validator;

final class ArquivoSalvadorController extends Controller
{
    final public function index (): view
    {
     return view('welcome');
    }

   final public function tratarArquivoSalvador (Request $arquivoSalvador): void
  {
    $arquivoSalvador->validate(['arquivosalvador' => 'bail|required|file|max:5024|mimes:txt'],  ['arquivosalvador.required' => 'Faltou anexar o arquivo', 'arquivosalvador.mimes' => 'Somente pernitida as extensões: .txt', 'arquivosalvador.file' => 'Somente arquivo do tipo .txt', 'arquivosalvador.max' => 'Arquivo maior que o permitido']);

    if ($arquivoSalvador->file('arquivosalvador')->isValid())
    {
      $arquivoTextoSalvador= $arquivoSalvador->file('arquivosalvador');

      unset($arquivoSalvador);
      
     $arquivoSSA= new LerArquivosTextoSalvador($arquivoTextoSalvador);
     $dadosFiltrados= $arquivoSSA->processarArquivo();
      
     $novoArquivoTexto= new CriarArquivoTexto($dadosFiltrados, $arquivoTextoSalvador->getClientOriginalName());

     unset($arquivoTextoSalvador);

     $callback= $novoArquivoTexto->geraClosure();
   
     $novoArquivoTexto->criaArquivo($callback);
      
    } else
    {
      Throw new Exception ('Não foi possível subir o arquivo!');
    }
    
  }
}
