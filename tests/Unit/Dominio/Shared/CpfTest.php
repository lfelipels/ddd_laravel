<?php

namespace Tests\Unit\Dominio\Shared;

use PHPUnit\Framework\TestCase;
use Ddd\Arquitetura\Dominios\Shared\Cpf;

class CpfTest extends TestCase
{

    public function testCriaCpfValido()
    {
        $numero = '123.456.789-10';
        $this->assertSame($numero, (string) new Cpf($numero));
    }

    public function testDeveLancarUmaExcecaoSeOhCpfForInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $cpf = new Cpf('123.456.78910');
    }
}
