<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Concretas\LerArquivosTextoSalvador;
use Illuminate\Support\Facades\Storage;

class LerArquivosTest extends TestCase
{

  private $dados= null;
  
  public function setUp(): void
  {
    parent::setUp();
    
      $faker= \Faker\Factory::create('pt_BR');
    
      $dadosParaTestes=
       "{$faker->text($maxNbChars= 35)}\n
       {$faker->numerify('#')} {$faker->date('Y-m-d', $max= 'now')} {$faker->numerify('###.###/###-##')} {$faker->numerify('##.##')} {$faker->numerify('##.###.###/####-##')}\n
        {$faker->numerify('#')} {$faker->date('Y-m-d', $max= 'now')} {$faker->numerify('###.###/###-##')} {$faker->numerify('##.##')} {$faker->numerify('##.###.###/####-##')}\n
        {$faker->numerify('#')} {$faker->date('Y-m-d', $max= 'now')} {$faker->numerify('###.###/###-##')} {$faker->numerify('##.##')} {$faker->numerify('##.###.###/####-##')}";

    $arquivoTexto= fopen('arquivo.txt', 'w');

    fwrite($arquivoTexto, $dadosParaTestes);
    fclose($arquivoTexto);
    
    $this->dados= new LerArquivosTextoSalvador('arquivo.txt');
    
  }
  
    public function test_processarArquivosRetornaUmArray()
    { 
      $this->assertIsArray($this->dados->processarArquivos());
      
    }

    public function test_processarArquivosArrayNaoEstarVazio()
  {
    $this->assertNotEmpty($this->dados->processarArquivos());
  }

  public function test_processarArquivosPossuiSomenteStrings()
  {
    $this->assertContainsOnly('string', $this->dados->processarArquivos());
  }

  public function test_processarArquivosRetornaOsDadosNoFormatoCorreto()
  {
    $dados= $this->dados->processarArquivos();
    
    foreach($dados as $cnpjCga)
      {
        $this->assertMatchesRegularExpression('/[0-9]{2},[0-9]{3},[0-9]{3}\/[0-9]{4}-[0-9]{2}|[0-9]{11}/', $cnpjCga);
      }
  }
  
  public function tearDown(): void
  {
    unset($faker, $dadosParaTestes, $arquivoTexto);
    
    parent::tearDown();
  }
  
}
