<?php
namespace Ddd\Arquitetura\Suporte\Evento;

use Ddd\Arquitetura\Suporte\Evento\Evento;
use Ddd\Arquitetura\Suporte\Evento\DisparadorDeEvento;

class DisparadorDeEventoLaravel implements DisparadorDeEvento
{
    public function executar(Evento $evento): void
    {
        event($evento);
    }
}

