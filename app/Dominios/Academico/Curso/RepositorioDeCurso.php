<?php

namespace Ddd\Arquitetura\Dominios\Academico\Curso;

interface RepositorioDeCurso
{
    public function localizarPorId(int $cursoId): ?Curso;
    public function localizarOuFalhar(int $cursoId): ?Curso;
}
