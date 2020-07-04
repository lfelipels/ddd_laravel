<?php

namespace Ddd\Arquitetura\Aplicacoes\Shared\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAlunoMatriculado extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome;
    public string $curso;

    public function __construct(string $nome, string $curso)
    {
        $this->nome = $nome;
        $this->curso = $curso;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Parabéns!! Você se matriculou no curso de {$this->curso}")
                ->view('emails.aluno-matriculado')
                ->with([
                    'nome' => $this->nome,
                    'curso' => $this->curso,
                ]);
    }
}
