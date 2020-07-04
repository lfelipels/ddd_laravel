<?php

namespace Ddd\Arquitetura\Dominios\Academico\Matricula;

use Ddd\Arquitetura\Aplicacoes\Shared\Emails\EmailAlunoMatriculado;
use Ddd\Arquitetura\Suporte\Evento\Evento;
use Ddd\Arquitetura\Suporte\Evento\OuvinteDeEvento;
use Ddd\Arquitetura\Suporte\Evento\OuvinteDeEventoDoLaravel;
use Illuminate\Support\Facades\Mail;

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
        $curso = $evento->curso();
        Mail::to($aluno->email)
        ->send(new EmailAlunoMatriculado(
            $aluno->nome,
            $curso->nome
        ));
    }
}
