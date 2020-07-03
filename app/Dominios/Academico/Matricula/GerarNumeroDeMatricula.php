<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Ddd\Arquitetura\Dominios\Academico\Matricula\NumeroDeMatricula;

class GerarNumeroDeMatricula
{
    public function executar(): NumeroDeMatricula
    {
        $numero = new NumeroDeMatricula($this->calcularNumero());
        return $numero;
    }

    private function calcularNumero(): string
    {
        $numero = (int) uniqid(random_int(1, 9) * 10000);
        return (string) $numero;
    }
}
