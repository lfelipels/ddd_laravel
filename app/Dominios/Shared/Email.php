<?php

namespace Ddd\Arquitetura\Dominios\Shared;

class Email
{
    private string $endereco;

    /**
     * Constructor.
     *
     * @param string $endereco
     */
    public function __construct(string $endereco)
    {
        if (filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Endereço de e-mail inválido');
        }

        $this->endereco = $endereco;
    }

    public function __toString()
    {
        return $this->endereco;
    }
}
