<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Ddd\Arquitetura\Dominios\Shared\Cpf;
use Ddd\Arquitetura\Dominios\Shared\Email;

interface RepositorioDeAluno
{
    public function adicionar(Cpf $cpf, string $nome, Email $email): void;
    public function localizarPorCpf(Cpf $cpf): ?Aluno;
}
