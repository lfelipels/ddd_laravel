<?php

namespace Ddd\Arquitetura\Suporte\Evento;

trait OuvinteDeEventoDoLaravel
{
    public function handle(Evento $evento): void
    {
       $this->processar($evento);
    }
}
