<?php

namespace App\Concretas;

use App\Abstratas\LerArquivosTextoAbstrata;

final class LerArquivosTextoSalvador extends LerArquivosTextoAbstrata
{
  public function __construct(string $arquivo)
  {
    parent::__construct($arquivo);
  }

  final public function processarArquivos(): array
  {
    try
    {
        parent::processarArquivos();
      
    } catch (Exception $arquivoNaoAbriException)
    {
        return $arquivoNaoAbriException->getMessage();
      
    }
  }

  final public function criaPadraoSieg(array $dadosProcessados): array
  {
    return parent::criarPadraoSieg($dadosProcessados);
  }

  final public function removePontosCnpj(string $cnpj): string
  {
    return parent::removerPontosCnpj($cnpj);
  }

  final public function limpaCga(string $cga): string
  {
    return parent::limparCga($cga);
  }
  
}