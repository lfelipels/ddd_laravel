<?php

namespace Ddd\Arquitetura\Suporte\Evento;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

trait EventoLaravel
{
    use Dispatchable, SerializesModels;
}
