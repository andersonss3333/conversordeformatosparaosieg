<?php

namespace App\Http\Controllers;

use App\Concretas\CriarArquivoTexto;
use App\Concretas\LerArquivosTextoSalvador;
use Exception;
use Illuminate\Http\Request;

final class ArquivoSalvadorController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function tratarArquivoSalvador(Request $arquivoSalvador): void
    {
        $arquivoSalvador->validate(['arquivosalvador' => 'bail|required|file|max:5024|mimes:txt, csv'], ['arquivosalvador.required' => 'Faltou anexar o arquivo', 'arquivosalvador.mimes' => 'Somente pernitida as extensoes: .txt e .csv', 'arquivosalvador.max' => 'Arquivo maior que o permitido', 'arquivosalvador.file' => 'Somente arquivo do tipo .txt']);

        if ($arquivoSalvador->file('arquivosalvador')->isValid()) {
            $arquivoTextoSalvador = $arquivoSalvador->file('arquivosalvador');

            unset($arquivoSalvador);

            $arquivoSSA = new LerArquivosTextoSalvador($arquivoTextoSalvador);
            $dadosFiltrados = $arquivoSSA->processarArquivo();

            $novoArquivoTexto = new CriarArquivoTexto($dadosFiltrados, $arquivoTextoSalvador->getClientOriginalName());

            unset($arquivoTextoSalvador);

            $callback = $novoArquivoTexto->geraClosure();

            $novoArquivoTexto->criaArquivo($callback);
        } else {
            throw new Exception('Não foi possível subir o arquivo!');
        }
    }
}
