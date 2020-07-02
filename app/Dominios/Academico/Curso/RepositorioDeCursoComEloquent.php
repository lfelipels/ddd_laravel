<?php

namespace Ddd\Arquitetura\Dominios\Academico\Curso;

class RepositorioDeCursoComEloquent implements RepositorioDeCurso
{
    public function localizarPorId(int $cursoId): ?Curso
    {
        return Curso::find($cursoId);
    }

    public function localizarOuFalhar(int $cursoId): Curso
    {
        $curso = $this->localizarPorId($cursoId);
        if(!$curso) {
            throw new \DomainException('Curso não encontrado');
        }
        return $curso;
    }
}
