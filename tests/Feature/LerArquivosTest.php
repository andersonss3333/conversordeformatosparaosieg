<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LerArquivosTest extends TestCase
{

  public function setUp()
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

  public function tearDown()
  {
    parent::tearDown();
  }
}
