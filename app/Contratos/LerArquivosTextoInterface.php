<?php

namespace App\Contratos;

interface LerArquivosTextoInterface
{

  public function processarArquivo ();

  public function criarPadraoSieg (array $dadosProcessados);
  
}