<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

class MatriculaDeAlunoDto
{
    private string $nome;
    private string $cpf;
    private string $email;
    private int $cursoId;

    public function __construct(
        string $nome,
        string $cpf,
        string $email,
        int $cursoId
    ) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->cursoId = $cursoId;
    }

    public function nome()
    {
        return $this->nome;
    }

    public function cpf()
    {
        return $this->cpf;
    }


    public function cursoId()
    {
        return $this->cursoId;
    }

    public function email()
    {
        return $this->email;
    }
}
