<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;
use Ddd\Arquitetura\Dominios\Shared\Cpf;

interface RepositorioDeMatricula
{
    /** @return mixed */
    public function recuperarMatriculasPorAluno(Cpf $cpf);
    public function recuperarMatriculaPorAlunoECurso(Cpf $cpf, Curso $curso): ?Matricula;
}

