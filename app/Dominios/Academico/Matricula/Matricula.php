<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Illuminate\Database\Eloquent\Model;
use Ddd\Arquitetura\Dominios\Academico\Aluno\Aluno;
use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;

class Matricula extends Model
{
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function alunoMatriculadoNoCurso(int $aluno, int $curso): bool
    {
        $count = $this->where('aluno_id', $aluno)
            ->where('curso_id', $curso)
            ->count();
        return $count > 0;
    }


    public function matricular(Curso $curso, Aluno $aluno)
    {
        if ($this->alunoMatriculadoNoCurso($aluno->id, $curso->id)) {
            throw new \DomainException("Aluno já Matriculado no curso de {$curso->nome}");
        }
        $this->curso_id = $curso->id;
        $this->aluno_id = $aluno->id;
        $this->numero = $this->gerarNumeroDeMatricula();
        $this->save();
    }

    /**
     * Gera o numero de matricula do aluno
     *
     * @return NumeroDeMatricula
     */
    private function gerarNumeroDeMatricula(): NumeroDeMatricula
    {
        $numero = (int) uniqid(random_int(1, 9) * 10000);
        return new NumeroDeMatricula((string) $numero);
    }


    public function getNumeroAttribute(string $numero): NumeroDeMatricula
    {
        return new NumeroDeMatricula($numero);
    }

    public function setNumeroAttribute(NumeroDeMatricula $numero)
    {
        $this->attributes['numero'] = (string) $numero;
    }
}
