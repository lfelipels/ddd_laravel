<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Ddd\Arquitetura\Dominios\Shared\Cpf;
use Ddd\Arquitetura\Suporte\Evento\DisparadorDeEvento;
use Ddd\Arquitetura\Dominios\Academico\Aluno\AlunoMatriculado;
use Ddd\Arquitetura\Dominios\Academico\Aluno\RepositorioDeAluno;
use Ddd\Arquitetura\Dominios\Academico\Curso\RepositorioDeCurso;
use Ddd\Arquitetura\Dominios\Academico\Matricula\MatriculaDeAlunoDto;
use Ddd\Arquitetura\Dominios\Shared\Email;

class MatricularAluno
{
    private RepositorioDeAluno $repositorioDeAluno;
    private RepositorioDeCurso $repositorioDeCurso;
    private DisparadorDeEvento $disparadorDeEvento;

    public function __construct(
        RepositorioDeAluno $repositorioDeAluno,
        RepositorioDeCurso $repositorioDeCurso,
        DisparadorDeEvento $disparadorDeEvento
    ) {
        $this->repositorioDeAluno = $repositorioDeAluno;
        $this->repositorioDeCurso = $repositorioDeCurso;
        $this->disparadorDeEvento = $disparadorDeEvento;
    }

    public function executar(MatriculaDeAlunoDto $dados): void
    {
        $aluno = $this->repositorioDeAluno->localizarPorCpf(new Cpf($dados->cpf()));
        if(!$aluno){
            //cadastra o aluno
            $this->repositorioDeAluno->adicionar(
                new Cpf($dados->cpf()),
                $dados->nome(),
                new Email($dados->email())
            );
            $aluno = $this->repositorioDeAluno->localizarPorCpf(new Cpf($dados->cpf()));
        }
        $curso = $this->repositorioDeCurso->localizarOuFalhar($dados->cursoId());
        $matricula = new Matricula();
        $matricula->matricular($curso, $aluno);

        //envia email de matricula para o aluno
        $this->disparadorDeEvento->executar(new AlunoMatriculado($aluno, $curso));
    }
}
