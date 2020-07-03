<?php

namespace Ddd\Arquitetura\Suporte\Evento;

use Ddd\Arquitetura\Suporte\Evento\Evento;

interface OuvinteDeEvento
{
    public function processar(Evento $evento);
}
