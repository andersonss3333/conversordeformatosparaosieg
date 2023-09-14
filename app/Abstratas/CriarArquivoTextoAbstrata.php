<?php

namespace App\Abstratas;

use App\Contratos\CriarArquivoTextoInterface;

abstract class CriarArquivoTextoAbstrata implements CriarArquivoTextoInterface
{
    private array $dadosFormatados = [];

    private string $nomeDoArquivo = '';

    protected function __construct(array $dadosFormatados, string $nomeArquivo)
    {
        $this->dadosFormatados = $dadosFormatados;
        $this->nomeDoArquivo = $nomeArquivo;
    }

    final public function criarArquivo($closure)
    {
        return response()->streamDownload($closure, $this->nomeDoArquivo, ['Content-Type' => 'text/plain'])->send();
    }

    final protected function gerarClosure()
    {
        $dadosCnpjCga = $this->dadosFormatados;

        $closure = function () use ($dadosCnpjCga) {
            $arquivoTexto = fopen('php://memory', 'w');

            foreach ($dadosCnpjCga as $cnpjCga) {
                fwrite($arquivoTexto, $cnpjCga." \n");
            }

            unset($dadosCnpjCga);

            rewind($arquivoTexto);

            echo stream_get_contents($arquivoTexto);

            fclose($arquivoTexto);
        };

        unset($dadosCnpjCga);

        return $closure;
    }
}
