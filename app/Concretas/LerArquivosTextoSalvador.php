<?php

namespace App\Concretas;

use App\Abstratas\LerArquivosTextoAbstrata;
use Exception;

final class LerArquivosTextoSalvador extends LerArquivosTextoAbstrata
{
    public function __construct(string $arquivo)
    {
        parent::__construct($arquivo);
    }

    final public function processarArquivos(): array
    {
        try {
            return parent::processarArquivo();
        } catch (Exception $arquivoNaoAbriException) {
            return $arquivoNaoAbriException->getMessage();
        }
    }
}
