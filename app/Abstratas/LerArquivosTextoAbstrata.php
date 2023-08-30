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
      $linha= ''; $cnpjECga= []; $cnpj= null; $cga= null;
      
      while(!feof($this->arquivoAberto))
      {
         $linha= fgets($this->arquivoAberto);
         
         $cnpj= $this->removerPontosCnpj($this->extrairCNPJOuCGA($linha, 'cnpj'));
         $cga= $this->limparCga($this->extrairCNPJOuCGA($linha, 'cga'));

         if($cnpj !== null && $cga !== null)
         {
           $cnpjECga[]= $cnpj . '|' . $cga;
         }
         
      }
      
       unset($linha, $cnpj, $cga);
      
       fclose($this->arquivoAberto);
      
       return $cnpjECga;
      
    } else
    {
      Throw new Exception('Arquivo não pode ser aberto.');
      
    }
  }


  private function extrairCNPJOuCGA(string $linha, string $dado)
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
     
     if($matches !== [])
     {
       return $matches[0];
     }
  }

  private function removerPontosCnpj(?string $cnpj)
  {
    if($cnpj !== null)
    {
      return preg_replace('/[\.]+/', ',', $cnpj);
    }
  }

  private function limparCga(?string $cga)
  {
    if($cga !== null) 
    {
      return preg_replace('/[\.\/-]+/', '', $cga);
    }
  }
  
}