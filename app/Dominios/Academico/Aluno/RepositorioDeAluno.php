<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Ddd\Arquitetura\Dominios\Shared\Cpf;

interface RepositorioDeAluno
{
    public function adicionar(Cpf $cpf, string $nome): void;
    public function localizarPorCpf(Cpf $cpf): ?Aluno;
}
