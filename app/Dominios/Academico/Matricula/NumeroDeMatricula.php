<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

class NumeroDeMatricula
{
    private string $numero;
    const TAMANHO_NUM_MATRICULA = 6;

    public function __construct(string $numero)
    {
        if(preg_match('/\D/', $numero) == true || strlen($numero) !== self::TAMANHO_NUM_MATRICULA){
            throw new \InvalidArgumentException('Número de matrícula inválido');
        }

        $this->numero = $numero;
    }

    public function __toString()
    {
        return $this->numero;
    }
}
