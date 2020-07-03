<?php
namespace Ddd\Arquitetura\Suporte\Evento;

use Ddd\Arquitetura\Suporte\Evento\Evento;

interface DisparadorDeEvento
{
    public function executar(Evento $evento): void;
}

