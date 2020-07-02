<?php

namespace Ddd\Arquitetura\Dominios\Academico\Curso;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome', 'duracao'];
}
