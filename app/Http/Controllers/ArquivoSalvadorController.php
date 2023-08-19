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
    $arquivoSalvador->validate(['arquivosalvador' => 'bail|required|file|max:5024|mimes:txt, csv'],  ['arquivosalvador.required' => 'Faltou anexar o arquivo', 'arquivosalvador.mimes' => 'Somente pernitida as extensoes: .txt e .csv', 'arquivosalvador.max' => 'Arquivo maior que o permitido']);

    if ($arquivoSalvador->file('arquivosalvador')->isValid())
    {
      $arquivoTextoSalvador= $arquivoSalvador->file('arquivosalvador');

      unset($arquivoSalvador);
      
     $arquivoSSA= new LerArquivosTextoSalvador($arquivoTextoSalvador);
     $dadosFiltrados= $arquivoSSA->processarArquivo();
     $dadosFormatados= $arquivoSSA->criaPadraoSieg($dadosFiltrados);

      unset($dadosFiltrados);

     $novoArquivoTexto= new CriarArquivoTexto($dadosFormatados, $arquivoTextoSalvador->getClientOriginalName());

      unset($dadosFormatados, $arquivoTextoSalvador);

     $callback= $novoArquivoTexto->geraClosure();
   
     $novoArquivoTexto->criaArquivo($callback);
      
    } else
    {
      Throw new Exception ('Não foi possível subir o arquivo!');
    }
    
  }
}
