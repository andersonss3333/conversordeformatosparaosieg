<?php

namespace App\Concretas;

use App\Abstratas\CriarArquivoTextoAbstrata;
use Exception;

class CriarArquivoTexto extends CriarArquivoTextoAbstrata
{
    public function __construct(array $dados, string $nomeArquivo)
    {
        parent::__construct($dados, $nomeArquivo);
    }

    final public function criaArquivo(callable $closure)
    {
        try {
            parent::criarArquivo($closure);
        } catch (Exception $arquivoNaoPodeSerAbertoException) {
            return $arquivoNaoPodeSerAbertoException->getMessage();
        }
    }

    final public function geraClosure()
    {
        return parent::gerarClosure();
    }
}
