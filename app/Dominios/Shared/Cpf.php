<?php

namespace Ddd\Arquitetura\Dominios\Shared;

class Cpf
{
    private string $numero;

    /**
     * Constructor.
     *
     * @param string $numero
     */
    public function __construct(string $numero)
    {
        $this->valida($numero);
        $this->numero = $numero;
    }

    /**
     * valida o número de cpf
     *
     * @param string $numero
     * @throws \InvalidArgumentException
     * @return void
     */
    private function valida(string $numero)
    {
        if(preg_match('/\d{3}\.\d{3}\.\d{3}\-\d{1,2}/', $numero) == false){
            throw new \InvalidArgumentException("Cpf de nº {$numero} está inválido");
        }
    }

    public function __toString(): string
    {
        return $this->numero;
    }
}
