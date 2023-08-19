<?php

namespace App\Abstratas;

use App\Contratos\LerArquivosTextoInterface;

abstract class LerArquivosTextoAbstrata implements LerArquivosTextoInterface
{
  private string $arquivoTexto= '';
  private $arquivoAberto= null;
  
  protected function __construct(string $arquivo)
  {
    $this->arquivoTexto= $arquivo;
  }

  final public function processarArquivo(): array
  {
    $this->arquivoAberto= fopen($this->arquivoTexto, 'r');

    if ($this->arquivoAberto)
    {
      $linha= ''; $cnpjECga= [];
      
      while(!feof($this->arquivoAberto))
      {
         $linha= fgets($this->arquivoAberto);
         
         $cnpjECga[]= $this->extrairCNPJOuCGA($linha, 'cnpj');
         $cnpjECga[]= $this->extrairCNPJOuCGA($linha, 'cga');
         
      }
      
       unset($linha);
      
       fclose($this->arquivoAberto);
      
       return $cnpjECga;
      
    } else
    {
      Throw new Exception('Arquivo não pode ser aberto.');
      
    }
  }

  final public function criarPadraoSieg (array $dadosProcessados): array
  {
    $dadosFormatados=[];
    
    foreach($dadosProcessados as $cnpjCga)
    {
      $quantidadeCaracteres= strlen($cnpjCga);

      switch($quantidadeCaracteres)
      {
        case $quantidadeCaracteres === 18:
        $dadosFormatados[]= preg_replace('/[\.]+/', ',', $cnpjCga);
        break;
        
        case $quantidadeCaracteres === 14:
        $dadosFormatados[]= preg_replace('/[\.\/-]+/', '', $cnpjCga);
        break;
        
      }
      
    }

    unset($dadosProcessados, $cnpjCga, $quantidadeCaracteres);
    
    return $dadosFormatados;
    
  }

  final private function extrairCNPJOuCGA(string $linha, string $dado): mixed
   {
     
    switch(strtolower($dado))
    {
       case $dado === 'cga':
       preg_match('/([0-9]{3}\.)([0-9]{3}\/)([0-9]{3}-[0-9]{2})/', $linha, $matches);
       break;
      
       case $dado === 'cnpj':
       preg_match('/[0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}-[0-9]{2}/', $linha, $matches);
       break;
    }

     unset($dado, $linha);
     
     return $matches === [] ?  : $matches[0];
  }
  
}