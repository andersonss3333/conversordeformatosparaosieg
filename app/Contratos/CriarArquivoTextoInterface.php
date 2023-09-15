<?php

namespace App\Contratos;

interface CriarArquivoTextoInterface
{
    public function criarArquivo(callable $closure);
}
