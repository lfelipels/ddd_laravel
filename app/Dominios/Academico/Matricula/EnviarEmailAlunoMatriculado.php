<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Illuminate\Support\Facades\Log;
use Ddd\Arquitetura\Suporte\Evento\Evento;
use Ddd\Arquitetura\Suporte\Evento\OuvinteDeEvento;
use Ddd\Arquitetura\Suporte\Evento\OuvinteDeEventoDoLaravel;

class EnviarEmailAlunoMatriculado implements OuvinteDeEvento
{
    use OuvinteDeEventoDoLaravel;

    /**
     * Undocumented function
     *
     * @param \Ddd\Arquitetura\Dominios\Academico\Aluno\AlunoMatriculado $evento
     * @return void
     */
    public function processar(Evento $evento)
    {
        $aluno = $evento->aluno();
        Log::info("Enviando email para {$aluno->nome}");
    }
}
