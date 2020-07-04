<?php

namespace Tests\Unit\Dominio\Academico\Matricula;

use PHPUnit\Framework\TestCase;
use Ddd\Arquitetura\Dominios\Academico\Matricula\NumeroDeMatricula;

class NumeroMatriculaTest extends TestCase
{

    public function testCriaNumeroDeMatriculaValida()
    {
        $numero = new NumeroDeMatricula('123456');
        $this->assertSame('123456', (string) $numero);
        $this->assertEquals(NumeroDeMatricula::TAMANHO_NUM_MATRICULA, strlen($numero));
    }

    public function testDeveLancarUmaExcecaoSeONumeroDeMatriculaForInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $numero = new NumeroDeMatricula('1a3456');
    }
}
