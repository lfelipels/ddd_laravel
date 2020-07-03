<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

class MatriculaDeAlunoDto
{
    private string $nome;

    private string $cpf;

    private int $cursoId;

    public function __construct(
        string $nome,
        string $cpf,
        int $cursoId
    ) {
        $this->nome = $nome;
        $this->cpf = $cpf;
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
}
