<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Ddd\Arquitetura\Suporte\Evento\Evento;
use Ddd\Arquitetura\Suporte\Evento\EventoLaravel;
use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;

class AlunoMatriculado implements Evento
{
    use EventoLaravel;

    private Aluno $aluno;
    private Curso $curso;

    public function __construct(Aluno $aluno, Curso $curso)
    {
        $this->aluno = $aluno;
        $this->curso = $curso;
    }

    public function aluno(): Aluno
    {
        return $this->aluno;
    }

    public function curso(): Curso
    {
        return $this->curso;
    }
}
