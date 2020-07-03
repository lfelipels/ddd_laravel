<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Ddd\Arquitetura\Dominios\Academico\Aluno\Aluno;
use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;
use Illuminate\Database\Eloquent\Collection;

class RepositorioDeMatriculaComEloquent
{
    /**
     * Recupera as matriculas de um aluno
     *
     * @param \Ddd\Arquitetura\Dominios\Academico\Aluno\Aluno $aluno
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recuperarMatriculasPorAluno(Aluno $aluno): Collection
    {
        return Matricula::where('aluno_id', $aluno->id)->get();
    }

    /**
     * Recupera os dados de uma matricula do aluno
     *
     * @param \Ddd\Arquitetura\Dominios\Academico\Aluno\Aluno $aluno
     * @param \Ddd\Arquitetura\Dominios\Academico\Curso\Curso $curso
     * @return Matricula|null
     */
    public function recuperarMatriculaPorAlunoECurso(Aluno $aluno, Curso $curso): ?Matricula
    {
        return Matricula::where('aluno_id', $aluno->id)
            ->where('curso_id', $curso->id)
            ->first();
    }
}

