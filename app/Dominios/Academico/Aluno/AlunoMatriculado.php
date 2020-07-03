<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Ddd\Arquitetura\Suporte\Evento\Evento;
use Ddd\Arquitetura\Suporte\Evento\EventoLaravel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlunoMatriculado implements Evento
{
    use EventoLaravel;

    private Aluno $aluno;

    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    public function aluno(): Aluno
    {
        return $this->aluno;
    }
}
