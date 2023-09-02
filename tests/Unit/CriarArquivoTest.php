<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Concretas\CriarArquivoTexto;

class CriarArquivoTest extends TestCase
{
  private $instanciaCriarArquivoTexto= null;
  
  public function setUp(): void
  {
    parent::setUp();
    
    $this->instanciaCriarArquivoTexto= new CriarArquivoTexto(file('arquivo2.txt'), basename('arquivo2.txt'));
    
  }

  
    public function test_retornaClosure()
    {
        $this->assertTrue(is_callable($this->instanciaCriarArquivoTexto->geraClosure()));
    }

  
  public function tearDown(): void
  {
    parent::tearDown();
  }
}
