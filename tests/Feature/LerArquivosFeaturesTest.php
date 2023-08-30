<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class LerArquivosFeaturesTest extends TestCase
{

  public function setUp(): void
  {
    parent::setUp();
  }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_carregarPaginaInicial()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_validarNaoAnexarOArquivo()
  {
    $this->post('/salvador',
      [
         'arquivosalvador' => ''
      ])->assertInvalid(['arquivosalvador' => 'Faltou anexar o arquivo']);
  }

  public function test_arquivoComExtensaoIncorreta()
  {
    $this->post('/salvador',
               [
                  'arquivosalvador' => 'arquivo.csv'
               ])->assertInvalid(['arquivosalvador' => 'Somente arquivo do tipo .txt']);
  }

  public function test_arquivoMaiorQueOPermitido()
  {
    $this->post('/salvador',
               ['arquivosalvador' => UploadedFile::fake()->create('arquivo.txt', 5025)])->assertInvalid(['arquivosalvador' => 'Arquivo maior que o permitido']);
  }
  
  public function test_validarArquivoAnexado()
  {
    
    $this->post('/salvador',
               ['arquivosalvador' => 'arquivo.txt']);
      $this->assertFileExists('arquivo.txt');
    
  }

  public function tearDown(): void
  {
    parent::tearDown();
  }
}
