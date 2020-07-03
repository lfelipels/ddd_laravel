<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Ddd\Arquitetura\Dominios\Shared\Cpf;
use Ddd\Arquitetura\Dominios\Academico\Aluno\RepositorioDeAluno;
use Ddd\Arquitetura\Dominios\Academico\Curso\RepositorioDeCurso;
use Ddd\Arquitetura\Dominios\Academico\Matricula\MatriculaDeAlunoDto;

class MatricularAluno
{
    private RepositorioDeAluno $repositorioDeAluno;
    private RepositorioDeCurso $repositorioDeCurso;

    public function __construct(
        RepositorioDeAluno $repositorioDeAluno,
        RepositorioDeCurso $repositorioDeCurso)
    {
        $this->repositorioDeAluno = $repositorioDeAluno;
        $this->repositorioDeCurso = $repositorioDeCurso;
    }

    public function executar(MatriculaDeAlunoDto $dados): void
    {
        $aluno = $this->repositorioDeAluno->localizarPorCpf(new Cpf($dados->cpf()));
        if(!$aluno){
            //cadastra o aluno
            $this->repositorioDeAluno->adicionar(new Cpf($dados->cpf()), $dados->nome());
            $aluno = $this->repositorioDeAluno->localizarPorCpf(new Cpf($dados->cpf()));
        }
        $curso = $this->repositorioDeCurso->localizarOuFalhar($dados->cursoId());
        $matricula = new Matricula();
        $matricula->matricular($curso, $aluno);
    }
}
