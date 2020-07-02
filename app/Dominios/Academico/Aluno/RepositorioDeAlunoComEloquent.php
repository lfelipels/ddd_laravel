<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Ddd\Arquitetura\Dominios\Academico\Aluno\Aluno;
use Ddd\Arquitetura\Dominios\Academico\Aluno\RepositorioDeAluno;
use Ddd\Arquitetura\Dominios\Shared\Cpf;

class RepositorioDeAlunoComEloquent implements RepositorioDeAluno
{
    public function adicionar(Cpf $cpf, string $nome): void
    {
        $aluno = new Aluno;
        $aluno->nome = $nome;
        $aluno->cpf = $cpf;
        $aluno->save();
    }

    public function localizarPorCpf(Cpf $cpf): ?Aluno
    {
        return Aluno::where('cpf', (string) $cpf)->first();
    }
}
