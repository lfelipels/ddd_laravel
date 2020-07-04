<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Ddd\Arquitetura\Dominios\Academico\Aluno\Aluno;
use Ddd\Arquitetura\Dominios\Academico\Aluno\RepositorioDeAluno;
use Ddd\Arquitetura\Dominios\Shared\Cpf;
use Ddd\Arquitetura\Dominios\Shared\Email;

class RepositorioDeAlunoComEloquent implements RepositorioDeAluno
{
    public function adicionar(Cpf $cpf, string $nome, Email $email): void
    {
        $aluno = new Aluno;
        $aluno->nome = $nome;
        $aluno->cpf = $cpf;
        $aluno->email = $email;
        $aluno->save();
    }

    public function localizarPorCpf(Cpf $cpf): ?Aluno
    {
        return Aluno::where('cpf', (string) $cpf)->first();
    }
}
