<?php

namespace Ddd\Arquitetura\Dominios\Academico\Aluno;

use Illuminate\Database\Eloquent\Model;
use Ddd\Arquitetura\Dominios\Shared\Cpf;

class Aluno extends Model
{
   public function getCpfAttribute(string $numero)
   {
        return new Cpf($numero);
   }

   public function setCpfAttribute(Cpf $numero)
   {
        $this->attributes['cpf'] = $numero;
   }
}
