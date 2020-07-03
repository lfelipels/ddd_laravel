<?php

namespace Ddd\Arquitetura\Core\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Ddd\Arquitetura\Dominios\Academico\Aluno\AlunoMatriculado;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Ddd\Arquitetura\Dominios\Academico\Matricula\EnviarEmailAlunoMatriculado;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AlunoMatriculado::class => [
            EnviarEmailAlunoMatriculado::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
